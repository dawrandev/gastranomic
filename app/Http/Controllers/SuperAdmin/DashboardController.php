<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {}

    public function dashboard()
    {
        $locale = session('dashboard_locale', 'uz');
        $dashboardData = $this->dashboardService->getSuperadminDashboardData($locale);

        return view('pages.superadmin.dashboard', array_merge($dashboardData, ['current_locale' => $locale]));
    }

    public function setLocale($locale)
    {
        if (in_array($locale, ['uz', 'ru', 'en', 'kk'])) {
            session(['dashboard_locale' => $locale]);
        }

        return redirect()->route('superadmin.dashboard');
    }
}
