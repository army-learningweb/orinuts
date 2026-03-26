<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\user_role;

use App\Models\User;

class AdminUserController extends Controller
{
    // Danh sách -------------------------------------------
    function list()
    {
        // Lấy danh sách user
        $users = User::orderBy('created_at', 'asc')->paginate(6);

        // Lấy id của admin
        $admin_id = Auth::user()->id;

        // Lấy số liệu thống kê
        $total_users = User::all()->count();
        $active_status = User::where('is_active', 'active')->count();
        $unactive_status = User::where('is_active', 'unactive')->count();
        $subpended_status = User::where('is_active', 'subpended')->count();
        
        return view('admin.user.list', compact('users', 'total_users', 'active_status', 'unactive_status', 'subpended_status', 'admin_id'));
    }

    // Danh sách lọc theo trạng thái + tìm kiếm (Ajax) -------------------------------------------
    function list_filter(Request $request)
    {
        // Lấy giá trị từ Ajax
        $status_value = $request->status_value;
        $search_value = $request->search_value;

        // Lấy id của admin
        $admin_id = Auth::user()->id;

        // Mặc định
        if (!$status_value && !$search_value) $users = User::orderBy('created_at', 'asc')->paginate(6);

        // Nếu có search không có status
        if ($search_value && !$status_value) $users = User::where('name', 'like', '%' . $search_value . '%')->paginate(6);

        // Nếu có status không có search
        if ($status_value && !$search_value) $users = User::where('is_active', $status_value)->orderBy('created_at', 'asc')->paginate(6);

        // Nếu có cả 2
        if ($status_value && $search_value) $users = User::where('is_active', $status_value)->where('name', 'like', '%' . $search_value . '%')->paginate(6);

        // Render file blade 'users.blade.php' thành chuỗi HTML với hàn render();
        if (count($users) > 0) {
            $view = view('admin.user.partials.list_normal', compact('users', 'admin_id'))->render();
        } else {
            $view = '';
        }

        // Trả dữ liệu json về cho Ajax
        $data = [
            'view' => $view,
        ];
        return response()->json($data);
    }

    // Thùng rác -------------------------------------------
    function trash()
    {
        $users = User::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(6);
        $total_users = count(User::onlyTrashed()->get());
        return view('admin.user.trash', compact('users', 'total_users'));
    }

    // Thùng rác lọc theo tìm kiếm
    function trash_filter(Request $request)
    {
        $search_value = $request->search_value_trash;

        if (!empty($search_value)) {
            $users = User::onlyTrashed()->where('name', 'like', '%' . $search_value . '%')->paginate(6);
        } else {
            $users = User::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(6);
        }

        $view = view('admin.user.partials.list_trash', compact('users'))->render();

        $data = ['view' => $view];

        return response()->json($data);
    }

    // Trang thêm -------------------------------------------
    function create()
    {
        return view('admin.user.create');
    }

    // Chuẩn hóa dữ liệu + thêm mới ----------------------------------------
    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255|regex:/^[\p{L}\s]+$/u',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => $request->is_active,
            'email_verified_at' => now()
        ]);

        return redirect()->route('admin.users.list')->with('status_complete', 'Thêm thành công');
    }

    // Trang cập nhật
    function edit(User $user)
    {
        $roles = Role::all();
        $user_role = user_role::where('user_id',$user->id)->pluck('role_id')->toArray();
        
        return view('admin.user.edit', compact('user', 'roles','user_role'));
    }

    // Chuẩn hóa dữ liệu + cập nhật
    function update(Request $request,User $user)
    {

        $request->validate([
            'name' => 'required|string|min:2|max:255|regex:/^[\p{L}\s]+$/u',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable',
        ]);

        if (empty($request->password)) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'is_active' => $request->is_active
            ]);
        } else {
            $request->validate([
                'password' => 'confirmed'
            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_active' => $request->is_active
            ]);
        }

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.list')->with('status_complete', 'Cập nhật thành công');
    }

    // Xóa
    function destroy($id)
    {
        if ($id == Auth::user()->id) {
            return redirect()->route('admin.users.list')->with('delete_failed', 'Bạn không thể thao tác lên chính mình !');
        }
        User::find($id)->delete();
        return redirect()->route('admin.users.list')->with('status_complete', 'Xóa thành công');
    }

    // Xóa vĩnh viễn
    function forceDelete($id)
    {
        User::onlyTrashed()->where('id', $id)->forceDelete();
        return back()->with('status_complete', 'Xóa thành công');
    }

    // Khôi phục
    function restore($id)
    {
        User::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.users.list')->with('status_complete', 'Khôi phục thành công');
    }

    // Cập nhật nhanh trạng thái -------------------------------------------
    function updateStatus(Request $request)
    {
        // Lấy giá trị từ Ajax
        $status_value = $request->status_value;
        $user_id = $request->user_id;

        if ($user_id == Auth::user()->id) {
            return false;
        }

        // Cập nhật
        if ($status_value == 'unactive') {
            User::where('id', $user_id)->update([
                'is_active' => $status_value,
                'updated_at' => now()
            ]);
        } else {
            User::where('id', $user_id)->update([
                'is_active' => $status_value,
                'email_verified_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Lấy dữ liệu thống kê
        $total_users = User::all()->count();
        $active_status = User::where('is_active', 'active')->count();
        $unactive_status = User::where('is_active', 'unactive')->count();
        $subpended_status = User::where('is_active', 'subpended')->count();

        // Trả view
        $view = view('admin.user.partials.status_user', compact('status_value'))->render();

        // Trả view cho Ajax
        $data = [
            'view' => $view,
            'user_id' => $user_id,
            'active_status' => $active_status,
            'unactive_status' => $unactive_status,
            'subpended_status' => $subpended_status
        ];
        return response()->json($data);
    }

    // Hành động hàng loạt -------------------------------------------
    function action(Request $request)
    {
        // Lấy giá trị từ request
        $action = $request->action;
        $users_id = $request->user_id;

        // Kiểm tra
        if (!$action && !$users_id) {
            return back()->withInput()->with('status_failed', 'Chọn để thực hiện hành động');
        }

        if ($users_id and !$action) {
            return back()->withInput()->with('status_failed', 'Chọn để thực hiện hành động');
        }

        if ($action == NULL) {
            return back()->withInput()->with('status_failed', 'Bạn cần chọn hành động');
        }

        if ($users_id == NULL) {
            return back()->withInput()->with('status_failed', 'Chọn thành viên để hành động');
        }

        // Thực hiện hành động
        foreach ($users_id as $id) {

            // Bỏ vào thùng rác
            if ($action == 'delete') {
                User::destroy($users_id);
                return redirect()->route('admin.users.list')->with('status_complete', 'Đã bỏ vào thùng rác');
            }

            // Đình chỉ
            if ($action == 'subpended') {
                User::where('id', $id)->update([
                    'is_active' => $action,
                    'updated_at' => now()
                ]);
            }

            // Hoạt động
            if ($action == 'active') {
                User::where('id', $id)->update([
                    'is_active' => $action,
                    'updated_at' => now()
                ]);
            }

            // Xóa vĩnh viễn
            if ($action == 'forceDelete') {
                User::onlyTrashed()->where('id', $id)->forceDelete();
            }

            // Khôi phục
            if ($action == 'restore') {
                User::onlyTrashed()->where('id', $id)->restore();
            }
        }

        return redirect()->route('admin.users.list')->with('status_complete', 'Thao tác thành công');
    }
}
