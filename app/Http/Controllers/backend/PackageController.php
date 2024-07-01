<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    //View Package Page
    public function index()
    {
        $packages = Package::all();
        return view('backend.packages.index', compact('packages'));
    }

    //View Package Create Page
    public function create()
    {
        return view('backend.packages.create');
    }

    //View Package Store Page
    public function store(Request $request)
    {
        $request->validate(
            [
                'package_name'     => 'required|max:20',
                'package_duartion' => 'required|integer',
                'package_price'    => 'required|integer',
            ],
            [
                'package_name.required'     => 'Name Is Required',
                'package_duartion.required' => 'Duratin Is Required',
                'package_price.required'    => 'Price Is Required',
            ]
        );

        $package = Package::create([
            'package_name'     => $request->package_name,
            'package_duartion' => $request->package_duartion,
            'package_price'    => $request->package_price,
        ]);

        if ($package) {
            return redirect()->route('package.index')->with('success', 'Package Created!');
        } else {
            return back()->with('error', 'SomeThing Wrong!');
        }
    }

    //Package Edit Page
    public function edit($id)
    {
        $package = Package::find($id);

        if ($package) {
            return view('backend.packages.edit', compact('package'));
        } else {
            return back()->with('error', 'Package Not Found!');
        }
    }

    //Package Update Page
    public function update(Request $request, $id)
    {
        $package = Package::find($id);
        if (!$package) {
            return back()->with('error', 'Package Not Found!');
        }

        $request->validate(
            [
                'package_name'     => 'required|max:20',
                'package_duartion' => 'required|integer',
                'package_price'    => 'required|integer',
            ],
            [
                'package_name.required'     => 'Name Is Required',
                'package_duartion.required' => 'Duratin Is Required',
                'package_price.required'    => 'Price Is Required',
            ]
        );

        $package->update([
            'package_name'     => $request->package_name,
            'package_duartion' => $request->package_duartion,
            'package_price'    => $request->package_price,
        ]);

        if ($package) {
            return redirect()->route('package.index')->with('success', 'Package Updated!');
        } else {
            return back()->with('error', 'SomeThing Wrong!');
        }
    }

    //Package Active
    public function active($id)
    {
        $package = Package::find($id);
        if (!$package) {
            return back()->with('error', 'SomeThing Wrong!');
        }

        $package->update([
            'package_status' => 1,
        ]);

        if ($package) {
            return redirect()->route('package.index')->with('success', 'Package Activeted!');
        } else {
            return back()->with('error', 'Something Wrong!');
        }
    }

    //Package DeActive
    public function deActive($id)
    {
        $package = Package::find($id);
        if (!$package) {
            return back()->with('error', 'SomeThing Wrong!');
        }

        $package->update([
            'package_status' => 0,
        ]);

        if ($package) {
            return redirect()->route('package.index')->with('success', 'Package DeActiveted!');
        } else {
            return back()->with('error', 'Something Wrong!');
        }
    }

    //Package Delete
    public function delete($id)
    {
        $package = Package::find($id);
        if (!$package) {
            return back()->with('error', 'SomeThing Wrong!');
        }

        $package->delete();

        if ($package) {
            return redirect()->route('package.index')->with('success', 'Package Deleted!');
        } else {
            return back()->with('error', 'Something Wrong!');
        }
    }
}
