<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    //View Profile Page
    public function index()
    {
        return view('backend.profile.index');
    }

    //Update Profile Page
    public function update(Request $request)
    {
        $request->validate(
            [
                'name'  => 'required|max:20',
                'email' => 'required|max:50|email|unique:users,email,' . Auth::user()->id,
                'phone' => 'required|max:14|unique:users,phone,' . Auth::user()->id,
                'image' => 'nullable|mimes:png,jpg,jpeg',
            ],
            [
                'name.required'  => 'Name Is Required!',
                'email.required' => 'Email Is Required!',
                'email.unique'   => 'Email Already Exist!',
                'email.max'      => 'Max Fifty Cahercter Suppot!',
                'phone.required' => 'Phone Number Is Required!',
                'phone.unique'   => 'Phone Number Alreday Exist!',
                'phone.max'      => 'Max Fourten Cahercter Suppot!',
                'image.mimes'    => 'Support Only Png Jpg Or Jpeg File',
            ]
        );

        if (Auth::check() && Auth::user()->role == 1) {
            $adminUp = DB::table('users')
                ->where('id', Auth::user()->id);

            $imgName = Auth::user()->image;

            if ($request->hasFile('image')) {
                $image_path = public_path('storage/images/' . Auth::user()->image);
                $image      = $request->file('image');

                $imgName = time() . '.' . $image->extension();

                $imgDel = File::delete($image_path);
                $image->storeAs('images', $imgName, 'public');
            }

            if ($adminUp) {
                $adminUp->update([
                    'name'  => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'image' => $imgName,
                ]);
                return back()->with('success', 'Profile Updated!');
            } else {
                return back()->with('error', 'Something Wrong!');
            }
        }
    }
}
