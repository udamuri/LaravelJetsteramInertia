<?php

namespace App\Http\Controllers\Jetstream\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Retrieve details of an expense receipt from storage.
     *
     * @param   \Crater\Models\Expense $expense
     * @return  \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Dashboard', [
            'start' => 1,
        ]);
    }
}
