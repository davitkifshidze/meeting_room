<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\AdminLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AdminAuthController extends Controller
{

    public function __construct()
    {
        if (!Route::is('admin_logout')):
            $this->middleware("guest:admin");
        endif;
    }

    /**
     * Return Login form
     */
    public function show()
    {
        return view('admin.login');
    }

    public function login(AdminLogin $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if ($user && $user->admin == 1) {
            if (auth()->guard('admin')->attempt($credentials)) {
                return redirect()->route('dashboard')->with('login_success', __('admin.success_login'));
            } else {
                return back()->withInput()->with('wrong_fields', __('admin.wrong_fields'));
            }
        } else {
            return back()->withInput()->with('wrong_fields', __('admin.not_admin'));
        }

    }

    public function logout()
    {
        if(auth()->guard('admin')->check())
        {
            auth()->guard('admin')->logout();
            session()->invalidate();
            session()->regenerateToken();
            return redirect()->route('login.show')->with('logout', __('success_logout'));
        }

    }


}

