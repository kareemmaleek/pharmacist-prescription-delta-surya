<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService{

    protected AuditLogsService $logs;

    public function __construct(AuditLogsService $logs)
    {
        $this->logs = $logs;
    }

    public function proceedLogin(array $credentials): User
    {

        $validation = User::query()->where('email', '=', $credentials['email'])->firstOrFail();

        if($validation->status == 'inactive'){
            throw ValidationException::withMessages([
                'email' => ['This Account got inactive by administrator, please contact DEV!']
            ]);
        }

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
        

        $this->logs->createLogs('ACCESS', $user->email . ' has been logout.');
        
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
    }

    public function changeStatus($uid, $last_status)
    {
        $user = Auth::user();
        $status = $last_status === 'active' ? 'inactive' : 'active';
       
        $query = User::query()->where('uid', '=', $uid)->firstOrFail();

        $query->status = $status;
        $query->save();

        if($user->uid === $uid){
            $this->logs->createLogs('ACCESS', $user->email . ' has been logout.');
        
            Auth::logout();
        }

        $this->logs->createLogs('USERS', $user->email . ' has been change status user '. $user->email .' to ' . $status);

        return $query;
    }

    public function createNewUser(array $data)
    {
        $user = Auth::user();
        if($user->role != 0) return throw new \Exception('No Permission!');

        return DB::transaction(function () use ($data, $user){
            $userCreate = User::create([
                "name" => $data['name'],
                "username" => $data['username'],
                "email" => $data['email'],
                "password" => Hash::make($data['password']),
                "role" => $data['role'],
            ]);

            $this->logs->createLogs('USERS', $user->email . ' has been created user with email: ' . $userCreate->email);

            return $userCreate;
        });
        
    }

    public function editUser(array $data, $uid)
    {
        $user = Auth::user();
        if($user->role != 0) return throw new \Exception('No Permission!');

        return DB::transaction(function () use ($data, $uid, $user) {

            if (empty($data['password'])) {
                unset($data['password']);
            } else {
                $data['password'] = Hash::make($data['password']);
            }

            $updateUser = User::query()->where('uid', '=', $uid)->firstOrFail();

            $updateUser->update($data);
            
            $this->logs->createLogs('USERS', $user->email . ' has been edited user with uid: ' . $updateUser->uid);

            return $updateUser;
        });
    }

}