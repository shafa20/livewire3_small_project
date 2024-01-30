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
use Illuminate\Support\Facades\Auth;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->hasPermissionTo('role.list')) {
         
            abort(403, 'Unauthorized action.');
        }
        $roles = Role::with('permissions')->latest()->get();
        return view('role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('role.create')) {
         
            abort(403, 'Unauthorized action.');
        }
        $permissions = Permission::all();
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
        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);
        }
        
         //$role->syncPermissions($request->permissions);

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
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('role.edit')) {
         
            abort(403, 'Unauthorized action.');
        }
        $permissions = Permission::all();
        $role = Role::with('permissions')->find($id);
        $data = $role->permissions()->pluck('id')->toArray();
        return view('role.edit',compact('permissions' ,'role','data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
       
        $request->validate([
            'name' => "required|unique:roles,name,{$role->id}",
        ]);
        $role->update(['name' => $request->name]);
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);
        }
        session()->flash('success', 'Role has been Updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
       // abort_if(!userCan('role.delete'), 403);
       if (!Auth::user()->hasPermissionTo('role.delete')) {
         
            abort(403, 'Unauthorized action.');
        }

        $role->delete();
         session()->flash('success', 'Role has been Deleted!');
         return back();
            
    }
}
