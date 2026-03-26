<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class AdminPermissionController extends Controller
{
    // Khu vực quản lí
    function manager(){

        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.',$permission->slug)[0];
        });

        return view('admin.permission.manager',compact('permissions'));
    }

    // Cập nhật
    function edit($id){

        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.',$permission->slug)[0];
        });

        $permission_info = Permission::find($id);
        return view('admin.permission.edit',compact('permissions','permission_info'));
    }

    // Xóa
    function destroy($id){
        Permission::where('id',$id)->delete();
        return redirect()->route('admin.permission.manager')->with('status_complete','Xóa quyền thành công');
    }

    function update(Request $request, $id){

        $request->validate([
            'name' => 'required|min:2|max:255|regex:/^[\p{L}\s]+$/u',
            'slug' => 'required'
        ]);

        Permission::where('id',$id)->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'desc' => $request->desc
        ]);

        return redirect()->route('admin.permission.manager')->with('status_complete','Cập nhật thành công');
    }

    // Thêm
    function store(Request $request){

        $request->validate([
            'name' => 'required|min:2|max:255|regex:/^[\p{L}\s]+$/u|unique:permissions',
            'slug' => 'required'
        ]);

        Permission::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'desc' => $request->desc
        ]);

        return back()->with('status_complete','Thêm quyền thành công');
    }
}
