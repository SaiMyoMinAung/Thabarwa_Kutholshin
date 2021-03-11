<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Http\Request;
use App\ViewModels\UserModel;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\UserStoreFormRequest;
use App\Http\Requests\UserUpdateFormRequest;
use App\Http\Resources\Select2\UserSelect2ResourceCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $columns = array(
                0 => 'DT_RowIndex',
                1 => 'name',
                2 => 'email',
                3 => 'phone',
                4 => 'city'
            );

            $totalData = User::count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $order = ($order == 'DT_RowIndex') ? 'created_at' : $order;
            $dir = $request->input('order.0.dir');

            $users = User::query();

            if (!empty($request->input('search.value'))) {
                $search = $request->input('search.value');

                $users->where('users.name', 'LIKE', "%{$search}%")
                    ->orWhere('users.email', 'LIKE', "%{$search}%")
                    ->orWhere('users.phone', 'LIKE', "%{$search}%")
                    ->orWhereHas('city', function (Builder $query) use ($search) {
                        $query->where('cities.name', 'LIKE', "%{$search}%");
                    });
            }

            $totalFiltered = $users->count();

            // sorting
            if ($order == 'city') {
                $users->select('users.*')->join('cities', 'users.city_id', '=', 'cities.id')
                    ->orderBy('cities.name', $dir);
            } else {
                $users->orderBy($order, $dir);
            }

            $users = $users->offset($start)
                ->limit($limit)
                ->get();

            $data = array();
            if (!empty($users)) {
                foreach ($users as $key => $user) {
                    $show =  route('users.show', $user->uuid);
                    $edit =  route('users.edit', $user->uuid);
                    $delete = route('users.destroy', $user->uuid);

                    $nestedData['DT_RowIndex'] = $key + 1;
                    $nestedData['name'] = $user->name;
                    $nestedData['email'] = $user->email ?? '-';
                    $nestedData['phone'] = $user->phone;
                    $nestedData['city'] = $user->city->name ?? '-';
                    // $nestedData['phone'] = substr(strip_tags($user->phone), 0, 50) . "...";
                    $nestedData['options'] = "<a class='btn btn-default text-primary' data-uuid=$user->uuid data-toggle='editconfirmation' data-href=$edit><i class='fas fa-edit'></i></a> - ";
                    $nestedData['options'] .= "<a class='btn btn-default text-danger' data-toggle='confirmation' data-href=$delete><i class='fas fa-trash'></i></a>";
                    $nestedData['uuid'] = $user->uuid;
                    $data[] = $nestedData;
                }
            }

            $json_data = array(
                "draw"            => intval($request->input('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            );

            return $json_data;
        }

        return view('backend.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userModel = new UserModel();

        return view('backend.user.create', $userModel);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreFormRequest $request)
    {
        $data = $request->userData()->all();

        User::create($data);

        return redirect(route('users.index'))->with('success', 'Create User Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $userModel = new UserModel($user, true);

        return view('backend.user.create', $userModel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateFormRequest $request, User $user)
    {
        $data = $request->userData()->all();

        $user->update($data);

        return redirect(route('users.index'))->with('success', 'Update User Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return back()->with('danger', 'Cannot Delete User');
    }

    public function getAllUsers(Request $request)
    {
        $city_id = auth()->user()->city->id;

        $users = User::where('users.name', 'like', '%' . $request->q . '%')
            ->where('city_id', $city_id)
            ->orderBy('id', 'desc')
            ->paginate(5);

        return response()->json(new UserSelect2ResourceCollection($users), 200);
    }
}
