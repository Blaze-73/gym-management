<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Plan;
use App\Models\Membership;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Get admin dashboard statistics
     */
    public function index()
    {
        $stats = [
            // User Stats
            'total_users' => User::count(),
            'total_clients' => User::where('role', 'client')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'new_users_this_month' => User::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),

            // Membership Stats
            'total_memberships' => Membership::count(),
            'active_memberships' => Membership::where('status', 'active')
                ->where('end_date', '>', now())
                ->count(),
            'expired_memberships' => Membership::where('end_date', '<=', now())
                ->count(),
            'expiring_soon' => Membership::where('status', 'active')
                ->whereBetween('end_date', [now(), now()->addDays(7)])
                ->count(),

            // Revenue Stats (based on active memberships)
            'total_revenue' => $this->calculateTotalRevenue(),
            'monthly_revenue' => $this->calculateMonthlyRevenue(),

            // Plan Stats
            'total_plans' => Plan::count(),
            'most_popular_plan' => $this->getMostPopularPlan(),
        ];

        return response()->json([
            'stats' => $stats,
            'recent_memberships' => Membership::with(['user', 'plan'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get(),
        ]);
    }

    /**
     * Calculate total revenue from all active memberships
     */
    private function calculateTotalRevenue()
    {
        return Membership::join('plans', 'memberships.plan_id', '=', 'plans.id')
            ->where('memberships.status', 'active')
            ->sum('plans.price');
    }

    /**
     * Calculate revenue for current month
     */
    private function calculateMonthlyRevenue()
    {
        return Membership::join('plans', 'memberships.plan_id', '=', 'plans.id')
            ->whereMonth('memberships.created_at', now()->month)
            ->whereYear('memberships.created_at', now()->year)
            ->sum('plans.price');
    }

    /**
     * Get the most popular plan
     */
    private function getMostPopularPlan()
    {
        $plan = Membership::select('plan_id')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('plan_id')
            ->orderBy('total', 'desc')
            ->with('plan')
            ->first();

        return $plan ? [
            'plan' => $plan->plan,
            'total_subscriptions' => $plan->total
        ] : null;
    }

    /**
     * Get membership trends (last 6 months)
     */
    public function trends()
    {
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = [
                'month' => $date->format('M Y'),
                'new_memberships' => Membership::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count(),
                'revenue' => Membership::join('plans', 'memberships.plan_id', '=', 'plans.id')
                    ->whereMonth('memberships.created_at', $date->month)
                    ->whereYear('memberships.created_at', $date->year)
                    ->sum('plans.price'),
            ];
        }

        return response()->json([
            'trends' => $months
        ]);
    }
}