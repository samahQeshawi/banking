<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ProfileRequest;
use App\Models\Admin;
use App\Traits\ImageTrait;

class ProfileController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('permission:profile display', ['only' => ['show']]);
        $this->middleware('permission:profile update', ['only' => ['update']]);
    }

    public function show()
    {
        $userId = auth('admin')->user()->id;
        $user = Admin::find($userId);

        return view('dashboard.admin.profile', compact('user'));
    }

    // update
    public function update(ProfileRequest $request)
    {
        $userId = auth('admin')->user()->id;
        $user = Admin::find($userId);
        $data = $request->except(['old_password', 'password_confirmation', 'photo']);

        if ($request->has('photo')) {
            $user->deleteImg($user->image);
            $user->update(['image' => $this->SaveFile($request->photo, 'admins')]);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح');
    }
}
