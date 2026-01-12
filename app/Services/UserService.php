<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserService{

    protected AuditLogsService $logs;

    public function __construct(AuditLogsService $logs)
    {
        $this->logs = $logs;
    }

    public function proceedLogin(array $credentials): User
    {
        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Incorrect Email or Password!']
            ]);
        }
        
        return Auth::user();
    }

    public function proceedLogout($req)
    {
        $user = Auth::user();
        

        $this->logs->createLogs('LOGOUT', $user->email . ' has been logout.');
        
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
    }

}