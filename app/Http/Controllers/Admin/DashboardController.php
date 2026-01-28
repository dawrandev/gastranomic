<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {}

    public function dashboard(Request $request)
    {
        $user = $request->user();
        $dashboardData = $this->dashboardService->getAdminDashboardData($user);

        return view('pages.admin.dashboard', $dashboardData);
    }
}
