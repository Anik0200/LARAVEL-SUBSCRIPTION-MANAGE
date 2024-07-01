<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Packagelist;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //View Report Page
    public function index()
    {
        $reports = User::with('package')->whereNotIn('role', [1])->get();

        return view('backend.report.index', compact('reports'));
    }

    public function sorting(Request $request)
    {
        if ($request->has('start_date')) {
            $reports = User::with('package')->where('start_date', $request->start_date)->get();

            return response()->json([
                'status' => 200,
                'data'   => $reports,
            ]);
        } elseif ($request->has('days')) {

            $day     = (int) $request->days;
            $reports = User::with('package')
                ->whereBetween('start_date', [now()->subDays($day), now()])
                ->get();

            return response()->json([
                'status' => 200,
                'data'   => $reports,
            ]);
        }

    }

    //Notification Page
    public function notification()
    {
        $reports = User::with('package')->whereNotIn('role', [1])->get();
        return view('backend.report.notification', compact('reports'));
    }

    //Package Renew Page
    public function renew($id)
    {
        $list = User::findOrfail($id);
        return view('backend.report.editNoti', compact('list'));
    }

    //Package Update
    public function renewUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'start_date' => 'required|date',
            ],
            [
                'start_date.required' => 'Chose Date!',
            ]
        );

        $list = User::find($id);
        $list->update([
            'start_date' => $request->start_date,
        ]);

        if ($list) {
            return redirect()->route('notification')->with('success', 'Succefully Renew!');
        } else {
            return back()->with('error', 'SomeThing Wrong!');
        }
    }
}
