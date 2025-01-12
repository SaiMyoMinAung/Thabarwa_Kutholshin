<?php

namespace App\Http\Controllers\Backend;

use App\Admin;
use App\Office;
use Illuminate\Http\Request;
use App\Mail\AdminInviteMail;
use App\ViewModels\AdminModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\AdminStoreFormRequest;
use App\Http\Requests\AdminUpdateFormRequest;
use App\Http\Resources\AdminResource;

use Illuminate\Validation\ValidationException;

class AdminController extends Controller
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
                4 => 'office',
            );

            $totalData = Admin::withTrashed()->count();

            $totalFiltered = $totalData;

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $order = ($order == 'DT_RowIndex') ? 'created_at' : $order;
            $dir = $request->input('order.0.dir');

            $admins = Admin::query()->withTrashed();

            // start search query
            if (!empty($request->input('search.value'))) {
                $search = $request->input('search.value');

                $admins->where('admins.name', 'LIKE', "%{$search}%")
                    ->orWhere('admins.email', 'LIKE', "%{$search}%")
                    ->orWhere('admins.phone', 'LIKE', "%{$search}%")
                    ->orWhereHas('office', function (Builder $query) use ($search) {
                        $query->where('offices.name', 'LIKE', "%{$search}%");
                    });
            }
            // end search query            

            // start sorting
            if ($order == 'office') {
                $admins->select('admins.*')->join('offices', 'admins.office_id', '=', 'offices.id')
                    ->orderBy('offices.name', $dir);
            } else {
                $admins->orderBy($order, $dir);
            }
            // end sorting

            $totalFiltered = $admins->count();

            $admins = $admins->offset($start)
                ->limit($limit)
                ->get();

            $data = array();
            if (!empty($admins)) {
                foreach ($admins as $key => $admin) {
                    $show =  route('admins.show', $admin->uuid);
                    $edit =  route('admins.edit', $admin->uuid);
                    $delete = route('admins.destroy', $admin->uuid);

                    $nestedData['DT_RowIndex'] = $key + 1;
                    $nestedData['name'] = $admin->name;
                    $nestedData['email'] = $admin->email ?? '-';
                    $nestedData['phone'] = $admin->phone;
                    $nestedData['office'] = $admin->office->name ?? '-';
                    $nestedData['role'] = $admin->roles()->first() ? $admin->roles()->first()->name : '-';

                    // $nestedData['phone'] = substr(strip_tags($admin->phone), 0, 50) . "...";
                    $nestedData['options'] = "<a class='btn btn-default text-primary' data-uuid=$admin->uuid data-toggle='editconfirmation' data-href=$edit><i class='fas fa-edit'></i></a> - ";
                    if ($admin->trashed()) {
                        $nestedData['options'] .= "<a class='btn btn-default text-green' data-toggle='confirmation' data-href=$delete><i class='fas fa-recycle'></i></a>";
                    } else {
                        $nestedData['options'] .= "<a class='btn btn-default text-danger' data-toggle='confirmation' data-href=$delete><i class='fas fa-trash'></i></a>";
                    }

                    $nestedData['uuid'] = $admin->uuid;
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

        return view('backend.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $adminModel = new AdminModel();

        return view('backend.admin.create', $adminModel);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreFormRequest $request)
    {
        $data = $request->adminData()->all();

        $admin = Admin::create($data);

        $admin->syncRoles([$request->role_id]);

        $password = $request->getPassword();

        // Mail::to($admin->email)->send(new AdminInviteMail($admin, $password));

        return redirect(route('admins.index'))->with('success', "Created Password is $password");
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
    public function edit(Admin $admin)
    {
        $adminModel = new AdminModel($admin, true);

        return view('backend.admin.create', $adminModel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateFormRequest $request, Admin $admin)
    {
        $data = $request->adminData()->all();

        $admin->update($data);

        $admin->syncRoles([$request->role_id]);

        if ($request->resetPassword()) {
            $password = $request->getPassword();

            Mail::to($admin->email)->send(new AdminInviteMail($admin, $password));
        }

        return redirect(route('admins.index'))->with('success', 'Update Admin Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        if ($admin->trashed()) {
            $admin->restore();
            return back()->with('success', 'Restore Admin Successful.');
        } else {
            $admin->delete();
            return back()->with('success', 'Delete Admin Successful.');
        }
    }

    public function information()
    {
        $admin = Admin::find(auth()->user()->id);

        return response()->json(new AdminResource($admin), 200);
    }
}
