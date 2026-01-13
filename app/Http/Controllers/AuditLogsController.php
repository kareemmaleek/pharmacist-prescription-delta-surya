<?php

namespace App\Http\Controllers;

use App\Models\AuditLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditLogsController 
{
    public function indexAuditLogs()
    {
        if(Auth::user()->role !== 0) return redirect()->route('dashboard')->with('error', 'No Permission!');

        $logsData = AuditLogs::query()->paginate(15);

        return view('auditlogs.index', compact('logsData'));
    }
}
