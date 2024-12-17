<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // Tạo view đăng nhập cho admin
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        // Tìm admin
        $admin = Admin::where('Email', $credentials['email'])->first();

        if (Hash::check($credentials['password'], $admin->Password)) {
            // Đăng nhập admin
            Auth::guard('admin')->login($admin, $remember);

            // Redirect đến trang admin
            return redirect()->intended('/admin');
        }
        // Sai thông tin
        return back()->withErrors(['User' => 'Sai thông tin tài khoản hoặc mật khẩu!']);
    }


    public function logout()
    {
        // Xóa thông tin người dùng khỏi session
        session()->forget(['admin_id', 'admin_name']);
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
