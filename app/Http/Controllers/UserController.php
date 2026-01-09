<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\LoginRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public function __construct(protected UserService $userService)
    {

    }

    public function indexDashboard()
    {

        return view('dashboard.index');
        
    }

    public function indexAccess()
    {

        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        
        return view('access.login');
    }

    public function proceedLogin(LoginRequest $request)
    {
        $user = $this->userService->proceedLogin($request->validated());

        $request->session()->regenerate();

        return redirect()
        ->route('dashboard')
        ->with('success', 'Login successful');
    }

    public function proceedLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logout Sucessfully!');
    }
}
