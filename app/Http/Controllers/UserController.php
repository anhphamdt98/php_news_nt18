<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Controllers\ModelNotFoundException;
use Hash;
use App\Models\User;

class UserController extends Controller
{

    public function create()
    {
        return view('admin.addUser');
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        $user->role_id = config('constains.is_user');
        $user->save();

        return redirect()->route('admin.users')->with('success', trans('admin.add_success'));
    }


    // public function edit($id)
    // {
    //     try {
    //         $user = User::findOrFail($id);
    //     } catch (ModelNotFoundException $exception) {
    //         return view('404');
    //     }

    //     return view('admin_pages.update_user', compact('user'));
    // }

    // public function update(UpdateProfileRequest $request, $id)
    // {
    //     try {
    //         $user = User::findOrFail($id);
    //     } catch (ModelNotFoundException $exception) {
    //         return view('404');
    //     }

    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->password = Hash::make($request->password);
    //     $user->update();

    //     return redirect()->route('users')->with('success', trans('admin.edit_success'));
    // }

}
