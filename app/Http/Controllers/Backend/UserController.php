<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Ward;
use App\StateRegion;
use Illuminate\Http\Request;
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
                0 => 'id',
                1 => 'name',
                2 => 'email',
                3 => 'phone',
            );

            $totalData = User::count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if (empty($request->input('search.value'))) {
                $users = User::offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            } else {
                $search = $request->input('search.value');

                $users =  User::where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

                $totalFiltered = User::where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->count();
            }

            $data = array();
            if (!empty($users)) {
                foreach ($users as $key => $user) {
                    $show =  route('users.show', $user->uuid);
                    $edit =  route('users.edit', $user->uuid);

                    $nestedData['DT_RowIndex'] = $key + 1;
                    $nestedData['name'] = $user->name;
                    $nestedData['email'] = $user->email ?? '-';
                    $nestedData['phone'] = $user->phone;
                    // $nestedData['phone'] = substr(strip_tags($user->phone), 0, 50) . "...";
                    $nestedData['options'] = "&emsp;<a href='{$show}' title='SHOW' ><i class='fa fa-fw fa-eye'></i></a>
                              &emsp;<a href='{$edit}' title='EDIT' ><i class='fa fa-fw fa-edit'></i></a>";
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
        $wards = Ward::all();
        $stateRegions = StateRegion::all();
        return view('backend.user.create', compact('wards', 'stateRegions'));
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
        $wards = Ward::all();
        $stateRegions = StateRegion::all();
        return view('backend.user.edit', compact('wards', 'stateRegions', 'user'));
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
        //
    }

    public function getAllUsers(Request $request)
    {
        $users = auth()->user()->stateRegion
            ->users()
            ->where('users.name', 'like', '%' . $request->q . '%')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return response()->json(new UserSelect2ResourceCollection($users), 200);
    }
}
