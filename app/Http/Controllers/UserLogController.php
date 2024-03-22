<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLog;

class UserLogController extends Controller
{
    public function index()
    {
        $logs = UserLog::with('user')->latest()->paginate();
        return view('user-logs.index', compact('logs'));
    }
}

