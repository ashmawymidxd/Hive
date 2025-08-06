<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AdminProfileController extends Controller
{
    // Show admin profile edit form
    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.edit', compact('admin'));
    }

    // Update profile information
    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,'.$admin->id,
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'profile')
                ->withInput();
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $uploadPath = public_path('assets/admin/img/admin');

            // Create directory if it doesn't exist
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }

            // Delete old image if it's not the default
            if ($admin->image_path !== 'profile.png') {
                $oldImagePath = public_path('assets/admin/img/admin/'.$admin->image_path);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();

            // Move image to public directory
            $image->move($uploadPath, $imageName);
            $admin->image_path = $imageName;
        }

        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    // Update security settings (password)
    public function updateSecurity(Request $request)
    {

        $admin = Auth::guard('admin')->user();

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', function ($attribute, $value, $fail) use ($admin) {
                if (!Hash::check($value, $admin->password)) {
                    $fail('The current password is incorrect.');
                }
            }],
            'new_password' => [
                'required',
                'different:current_password',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'security')
                ->withInput();
        }

        $admin->password = Hash::make($request->new_password);
        $admin->password_changed_at = now();
        $admin->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }

}
