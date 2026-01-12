<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\LoginRequest;
use App\Services\AuditLogsService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    protected AuditLogsService $logs;
    protected UserService $userService;

    public function __construct(UserService $userService, AuditLogsService $logs)
    {
        $this->userService = $userService;
        $this->logs = $logs;
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
        
        if($user){
            $request->session()->regenerate();

            $this->logs->createLogs('ACCESS', 'User ' . $request->input('email') . ' has been logged in.');
        }
        

        return redirect()
        ->route('dashboard')
        ->with('success', 'Login successful');
    }

    public function proceedLogout(Request $request, UserService $service)
    {
        $service->proceedLogout($request);
        
        return redirect()->route('login')->with('success', 'Logout Sucessfully!');
    }
}
