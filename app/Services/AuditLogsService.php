<?php 

namespace App\Services;

use App\Models\AuditLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditLogsService{

    protected Request $req;

    public function __construct(Request $req) {
        $this->req = $req;
    }
    
    public function createLogs($module, $desc)
    {
        $user = Auth::user();

        $record = AuditLogs::create([
            "user_id" => $user->id,
            "ip_address" => $this->req->ip(),
            "module" => $module,
            "description" => $desc
        ]);
        
        return $record;

    }
}