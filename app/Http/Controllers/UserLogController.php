<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLog;
use DataTables;

class UserLogController extends Controller
{
    public function getLogs(Request $request)
    {
        if ($request->ajax()) {
            $query = UserLog::with('user')->select('user_logs.*');

            if ($request->has('search') && $request->search['value'] != '') {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search['value'] . '%');
                });
            }

            $logs = $query->get();

            return DataTables::of($logs)
                ->addIndexColumn()
                ->addColumn('user', function (UserLog $log) {
                    return $log->user ? $log->user->name : '';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<button data-id="' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // For the initial page load
        return view('user-logs.index');
    }

    public function index()
    {
        return redirect()->action([UserLogController::class, 'getLogs']);
    }

    public function deleteLog($id)
    {
        $log = UserLog::find($id);
        if ($log) {
            $log->delete();
            return response()->json(['success' => 'Log deleted successfully.']);
        } else {
            return response()->json(['error' => 'Log not found.'], 404);
        }
    }
}
