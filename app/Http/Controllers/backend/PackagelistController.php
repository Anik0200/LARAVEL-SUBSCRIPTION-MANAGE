<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Packagelist;
use App\Models\User;
use Illuminate\Http\Request;

class PackagelistController extends Controller
{
    //View Package Lists
    public function index()
    {
        $lists = User::with('package')->whereNotIn('role', [1])->get();
        return view('backend.packageList.index', compact('lists'));
    }

    //Package List Create Page
    public function create()
    {
        $users = User::where('status', 1)
            ->whereNotIn('id', [1])
            ->get();

        $packages = Package::where('package_status', 1)
            ->get();

        return view('backend.packageList.create', compact('users', 'packages'));
    }

    //Package List Store Page
    public function store(Request $request)
    {
        $request->validate(
            [
                'user_id'    => 'required|integer',
                'package_id' => 'required|integer',
                'start_date' => 'required|date',
            ],
            [
                'user_id.required'    => 'User Is Required!',
                'package_id.required' => 'Package Is Required!',
            ]
        );

        $store = Packagelist::create([
            'user_id'    => $request->user_id,
            'package_id' => $request->package_id,
            'start_date' => $request->start_date,
        ]);

        if ($store) {
            return redirect()->route('packageList.index')->with('success', 'New Package List Created!');
        } else {
            return back()->with('error', 'SomeThing Wrong!');
        }
    }

    //Package List Create Page
    public function edit($id)
    {
        $list = Packagelist::findOrfail($id);

        $users = User::where('status', 1)
            ->whereNotIn('id', [1])
            ->get();

        $packages = Package::where('package_status', 1)
            ->get();

        return view('backend.packageList.edit', compact('users', 'packages', 'list'));
    }

    //Package List Create Page
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'user_id'    => 'required|integer',
                'package_id' => 'required|integer',
                'start_date' => 'required|date',
            ],
            [
                'user_id.required'    => 'User Is Required!',
                'package_id.required' => 'Package Is Required!',
            ]
        );

        $list = Packagelist::findOrfail($id);

        $list->update([
            'user_id'    => $request->user_id,
            'package_id' => $request->package_id,
            'start_date' => $request->start_date,
        ]);

        if ($list) {
            return redirect()->route('packageList.index')->with('success', 'Package Updated!');
        } else {
            return back()->with('error', 'SomeThing Wrong!');
        }
    }

    //List Active
    public function active($id)
    {
        $list = Packagelist::find($id);
        if (!$list) {
            return back()->with('error', 'SomeThing Wrong!');
        }

        $list->update([
            'list_status' => 1,
        ]);

        if ($list) {
            return redirect()->route('packageList.index')->with('success', 'Package List Activeted!');
        } else {
            return back()->with('error', 'Something Wrong!');
        }
    }

    //List DeActive
    public function deActive($id)
    {
        $list = Packagelist::find($id);
        if (!$list) {
            return back()->with('error', 'SomeThing Wrong!');
        }

        $list->update([
            'list_status' => 0,
        ]);

        if ($list) {
            return redirect()->route('packageList.index')->with('success', 'Package List DeActiveted!');
        } else {
            return back()->with('error', 'Something Wrong!');
        }
    }

    //List Delete
    public function delete($id)
    {
        $list = Packagelist::find($id);
        if (!$list) {
            return back()->with('error', 'SomeThing Wrong!');
        }

        $list->delete();

        if ($list) {
            return redirect()->route('packageList.index')->with('success', 'List Deleted!');
        } else {
            return back()->with('error', 'Something Wrong!');
        }
    }
}
