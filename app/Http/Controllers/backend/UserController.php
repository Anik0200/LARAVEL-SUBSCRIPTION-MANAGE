<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //Show User Page
    public function index()
    {
        $users = User::with('package')->where('role', 0)->get();
        return view('backend.users.index', compact('users'));
    }

    //Show User Page
    public function create()
    {
        $packages = Package::all();
        return view('backend.users.create', compact('packages'));
    }

    //Store New User
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'  => 'required|max:20',
                'email' => 'required|max:50|email|unique:users',
                'phone' => 'required|max:14|unique:users',
            ],
            [
                'name.required'  => 'Name Is Required!',
                'email.required' => 'Email Is Required!',
                'email.unique'   => 'Email Already Exist!',
                'phone.required' => 'Phone Is Required!',
                'phone.unique'   => 'Phone Already Exist!',
            ]
        );

        $user = User::create([
            'package_id' => $request->package_id,
            'start_date' => $request->start_date,
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'facebook'   => $request->facebook,
            'password'   => Hash::make('12345'),
        ]);

        if ($user) {
            return redirect()->route('user.index')->with('success', 'User Created!');
        } else {
            return back()->with('error', 'Something Wrong!');
        }
    }

    //User Edit Page
    public function edit($id)
    {
        $user     = User::find($id);
        $packages = Package::all();

        if ($user) {
            return view('backend.users.edit', compact('user', 'packages'));
        } else {
            return back()->with('error', 'User Not Found!');
        }
    }

    //User Update Page
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return back()->with('error', 'User Not Found!');
        }

        $request->validate(
            [
                'name'  => 'required|max:20',
                'email' => 'required|max:50|email|unique:users,email,' . $user->id,
                'phone' => 'required|max:14|unique:users,phone,' . $user->id,
            ],
            [
                'name.required'  => 'Name Is Required!',
                'email.required' => 'Email Is Required!',
                'email.unique'   => 'Email Already Exist!',
                'phone.required' => 'Phone Is Required!',
                'phone.unique'   => 'Phone Already Exist!',
            ]
        );

        $user->update([
            'package_id' => $request->package_id,
            'start_date' => $request->start_date,
            'name'       => $request->name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'facebook'   => $request->facebook,
        ]);

        if ($user) {
            return redirect()->route('user.index')->with('success', 'User Updated!');
        } else {
            return back()->with('error', 'Something Wrong!');
        }
    }

    //User Active
    public function active($id)
    {
        $user = User::find($id);
        if (!$user) {
            return back()->with('error', 'SomeThing Wrong!');
        }

        $user->update([
            'status' => 1,
        ]);

        if ($user) {
            return redirect()->route('user.index')->with('success', 'User Activeted!');
        } else {
            return back()->with('error', 'Something Wrong!');
        }
    }

    //User Active
    public function deActive($id)
    {
        $user = User::find($id);
        if (!$user) {
            return back()->with('error', 'SomeThing Wrong!');
        }

        $user->update([
            'status' => 0,
        ]);

        if ($user) {
            return redirect()->route('user.index')->with('success', 'User DeActivated!');
        } else {
            return back()->with('error', 'Something Wrong!');
        }
    }

    //User Active
    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return back()->with('error', 'SomeThing Wrong!');
        }

        $user->delete();

        if ($user) {
            return redirect()->route('user.index')->with('success', 'User Deleted!');
        } else {
            return back()->with('error', 'Something Wrong!');
        }
    }

    public function fetch(Request $request)
    {
        $packages = Package::findOrfail($request->package_id);

        return response()->json([
            'data' => $packages,
        ]);
    }
}
