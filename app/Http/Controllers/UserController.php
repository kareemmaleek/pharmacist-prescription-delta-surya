<?php

namespace App\Http\Controllers;

use App\Http\Requests\user\EditUserRequest;
use App\Http\Requests\user\NewUserRequest;
use App\Http\Requests\user\LoginRequest;
use App\Models\User;
use App\Services\AuditLogsService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController
{

    protected AuditLogsService $logs;
    protected UserService $userService;

    public function __construct(UserService $userService, AuditLogsService $logs)
    {
        $this->userService = $userService;
        $this->logs = $logs;
    }

    public function indexUser()
    {
        if(Auth::user()->role !== 0) return redirect()->route('dashboard')->with('error', 'No Permission!');

        $userData = User::query()->paginate(10);

        return view('user.index', compact('userData'));
    }

    public function indexNewUser()
    {
        if(Auth::user()->role !== 0) return redirect()->route('dashboard')->with('error', 'No Permission!');

        return view('user.newUser');
    }

    public function indexEditUser($uid)
    {
        if(Auth::user()->role !== 0) return redirect()->route('dashboard')->with('error', 'No Permission!');
        
        $userData = User::query()->where('uid', '=', $uid)->firstOrFail();

        return view('user.editUser', compact('userData'));
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

    public function proceedChangeStatus(Request $request, UserService $service)
    {
        try{
            $service->changeStatus($request->input('uid'), $request->input('status'));

            return redirect()->route('users')->with('success', 'Status Successfull Changed!');
        }catch(\Exception $e){
            return redirect()->route('users')->with('error', 'Uh-oh!, Something when wrong.');
        }
    }

    public function createNewUser(NewUserRequest $request, UserService $service)
    {   
        try{
            $service->createNewUser($request->validated());

            return redirect()->route('users')->with('success', 'New User Successfully created!');
        }catch(\Exception $e){
            return redirect()->route('users')->with('error', 'Uh-oh!, Something when wrong.');
        }
    }

    public function updateUser($uid, EditUserRequest $request, UserService $service)
    {
        try{
            $service->editUser($request->validated(), $uid);

            return redirect()->route('users')->with('success', 'Successfully Edit User!');
        }catch(\Exception $e){
            return redirect()->route('users')->with('error', 'Uh-oh!, Something when wrong.');
        }
    }
}
