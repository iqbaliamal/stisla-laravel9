<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view("pages.user.index", [
            "users" => $users,
            "title" => "Users"
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email|unique:users,email",
        ]);

        if ($request->path != null) {
            $path = $request->path;
            $filename = explode('/', $path);

            $directory = explode('/', $path);
            array_pop($directory);
            $directory = implode('/', $directory);

            if (!File::exists(public_path('images/avatar'))) {
                File::makeDirectory(public_path('images/avatar'), 0777, true, true);
            }

            File::move(storage_path('app/' . $path), public_path('images/avatar/' . $filename[3]));
            File::deleteDirectory(storage_path('app/' . $directory));

            $urlavatarFile = url('images/avatar/' . $filename[3]);
        };

        User::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "password" => bcrypt("password"),
            "avatar" => $urlavatarFile ?? null
        ]);

        return response()->json([
            "status" => "success",
            "message" => "User created successfully",
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);

        return response()->json([
            "status" => "success",
            "message" => "User retrieved successfully",
            "data" => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email|unique:users,email," . $id,
        ]);

        $user = User::find($id);

        if ($request->path != null) {
            $path = $request->path;
            $filename = explode('/', $path);

            $directory = explode('/', $path);
            array_pop($directory);
            $directory = implode('/', $directory);

            if (!File::exists(public_path('images/avatar'))) {
                File::makeDirectory(public_path('images/avatar'), 0777, true, true);
            }

            File::move(storage_path('app/' . $path), public_path('images/avatar/' . $filename[3]));
            File::deleteDirectory(storage_path('app/' . $directory));

            $urlavatarFile = url('images/avatar/' . $filename[3]);
        };

        if ($user->avatar != null) {
            $avatar = explode('/', $user->avatar);
            File::delete(public_path('images/avatar/' . $avatar[3]));
        }

        $user->update([
            "first_name" => $request->input("first_name"),
            "last_name" => $request->input("last_name"),
            "email" => $request->input("email"),
            "avatar" => $urlavatarFile ?? null
        ]);

        return response()->json([
            "status" => "success",
            "message" => "User updated successfully",
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return response()->json([
            "status" => "success",
            "message" => "User deleted successfully",
        ]);
    }
}
