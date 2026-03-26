<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Permission;
use App\Models\role_permission;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AdminRoleController extends Controller
{
    // Khu vực quản lí
    function manager(){
        $roles = Role::all();
        $permissions = Permission::all()->groupBy(function($permission){
            return explode('.',$permission->slug)[0];
        });

        return view('admin.role.manager',compact('roles','permissions'));
    }

    // Thêm
    function store(Request $request){
        
        $request->validate([
            'name' => 'required|min:2|max:255|regex:/^[\p{L}\s]+$/u|unique:roles',
            'desc' => 'required|min:2|max:255|regex:/^[\p{L}\s]+$/u|unique:roles',
        ]);

        if($request->permission_id == null) return back()->withInput()->with('status_failed','Bạn chưa chọn quyền cho vai trò này');

        $new_role = Role::create([
            'name' => $request->name,
            'desc' => $request->desc
        ]);

        $new_role->permissions()->attach($request->permission_id);

        return back()->with('status_complete','Thêm vai trò thành công');
    }

    // Cập nhật
    function edit(Role $role){
    
        $roles = Role::all();
        $permissions = Permission::all()->groupBy(function($permission){
            return explode('.',$permission->slug)[0];
        });
        $role_permission = role_permission::where('role_id',$role->id)->pluck('permission_id')->toArray();
        
        return view('admin.role.edit',compact('role','roles','permissions','role_permission'));
    }

    function update(Request $request,Role $role){

        $request->validate([
            'name' => 'required|min:2|max:255|regex:/^[\p{L}\s]+$/u|unique:roles,name,'.$role->id,
            'desc' => 'required|min:2|max:255|regex:/^[\p{L}\s]+$/u',
            'permission_id'=>'nullable|array',
            'permission_id.*'=>'exists:permissions,id'
        ]);

        if($request->permission_id == null) return back()->withInput()->with('status_failed','Bạn chưa chọn quyền cho vai trò này');

        $role->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'updated_at' => now()
        ]);

        $role->permissions()->sync($request->permission_id);

        return redirect()->route('admin.role.manager')->with('status_complete','Cập nhật vai trò thành công');
    }

    // Xóa
    function destroy(Role $role){
        $role->delete();
        return back()->with('status_complete','Xóa vai trò thành công');
    }
}
