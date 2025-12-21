<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 1) {
            return redirect()->route('admin.dashboard.admin');
        }

        return redirect()->route('dashboard.customer');
    }
}
