<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Actions\Role\CreateRole;
use App\Actions\Role\UpdateRole;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\RoleFormRequest;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::latest()->get();
        return view('role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        $permissions = Permission::all();
        // $permission_groups = User::getPermissionGroup();

        return view('role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|unique:roles,name',
        ]);
        $role = Role::create($request->only('name'));
        $role->syncPermissions($request->permissions);

        session()->flash('success', 'Role Created!');
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('role.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $id)
    {
        // abort_if(!userCan('role.update'), 403);

        // try {
        //     UpdateRole::update($request, $role);

        //     session()->flash('success', 'Role Updated!');
        //     return back();
        // } catch (\Throwable $th) {

        //     session()->flash('Error', 'Something is wrong');
        //     return back();
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
       // abort_if(!userCan('role.delete'), 403);

        try {
            if (!is_null($role)) {
                $role->delete();
                session()->flash('success', 'Role Deleted!');
            }
            return back();
        } catch (\Throwable $th) {
            session()->flash('error', 'Something is wrong');
            return back();
        }
    }
}
