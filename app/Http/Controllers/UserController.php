<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $users = User::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'ilike', "%{$search}%");
            })
            ->latest()
            ->simplePaginate(5);
        return inertia('User/IndexView', [
            'users' => $users
        ]);
    }
    public function create()
    {
        return inertia('User/CreateView');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required'
        ]);
        $tempPassword = Str::random(8);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->password = Hash::make($tempPassword);
        //todo: send email password.
        $user->save();
        return redirect()->route('users.index')->with('success', 'Data berhasil disimpan');
    }

    public function show($id)
    {
        // cek apakah $id adalah integer
        if (filter_var($id, FILTER_VALIDATE_INT)) {
            $user = User::findOrFail($id); // cari user berdasarkan id
        } else {
            $user = User::query()->where('ulid', $id)->first(); // cari user berdasarkan ulid
        }
        return inertia('User/ShowView', [
            'user' => $user
        ]);
    }
}
