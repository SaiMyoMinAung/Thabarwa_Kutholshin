<?php

namespace App\Http\Controllers\Backend;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateFormRequest;

class ProfileController extends Controller
{
    public function profile()
    {
        $admin = auth()->user();

        return view('backend.profile.show', compact('admin'));
    }

    public function update(ProfileUpdateFormRequest $request, Admin $admin)
    {
        $adminData = $request->profileData()->all();
        
        $admin->update($adminData);

        return back()->with('success', 'Update Profile Successful');
    }
}
