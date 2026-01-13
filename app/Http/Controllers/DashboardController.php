<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController
{
     public function indexDashboard(DashboardService $service)
        {
            $data = $service->getData();

            return view('dashboard.index', compact('data'));
            
        }
}
