<?php

namespace App\Http\Controllers\Backend;

use App\Constants\PermissionConstant;
use Spatie\Permission\Models\Role;
use App\Constants\SuperRoleConstant;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public $lists;
    public function __construct()
    {
        // $this->authorizeResource(Role::class, 'role');
        $this->lists = [
            'internal-donated-items', 'share-internal-donated-item', 'see-setting', 'team', 'yogi', 'volunteer',
            'admin', 'item-sub-type', 'item-type', 'country', 'state-region', 'city', 'unit', 'center', 'ward', 'alms-round',
            'office', 'role'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::where('name', '!=', SuperRoleConstant::SuperRole)->paginate(10);

        $lists = $this->lists;

        return view('backend.role.index', compact('roles', 'lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::query();

        // forInternalDonatedItemRecordAdminType
        $pForIDIRecordAdminType = PermissionConstant::forIDIRAT;

        $lists = $this->lists;

        return view('backend.role.create', compact('permissions', 'lists', 'pForIDIRecordAdminType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        $validated_data = $request->validated();

        $role = new Role();
        $role->name = $validated_data['name'];
        $role->save();

        $permissions = Permission::whereIn('id', $validated_data['permission_id'])->get();

        $role->syncPermissions($permissions ?? []);

        return redirect(route('roles.index'))->with('success', trans('controller.success.create', ['model' => 'Role']));
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
    public function edit(Role $role)
    {
        if ($role->name == SuperRoleConstant::SuperRole) {
            return redirect(route('roles.index'));
        }

        $checked_permissions_id = $role->permissions->pluck('id')->toArray();

        $lists = $this->lists;


        return view('backend.role.edit', compact('role', 'lists', 'checked_permissions_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        if ($role->name == SuperRoleConstant::SuperRole) {
            return redirect(route('roles.index'));
        }

        $validated_data = $request->validated();

        $role->update($validated_data);

        $role->syncPermissions($validated_data['permission_id'] ?? []);

        return redirect(route('roles.index'))->with('success', trans('controller.success.update', ['model' => 'Role']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if ($role->name == SuperRoleConstant::SuperRole || count($role->users) > 0) {
            return redirect(route('roles.index'));
        }

        $role->delete();

        return redirect(route('roles.index'))->with('success', trans('controller.success.delete', ['model' => 'Admin']));
    }
}
