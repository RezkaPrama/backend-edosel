<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->when(request()->q, function ($users) {
            $users = $users->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|confirmed',
            'cabang'    => 'required',
            'role'          => 'required',
            // 'avatar'    => 'required|image|mimes:jpeg,jpg,png|max:2000',
        ]);

        if ($request->file('avatar') == '') {

            $user = User::create([
                'name'          => $request->input('name'),
                'email'         => $request->input('email'),
                'password'      => bcrypt($request->input('password')),
                'cabang'        => $request->input('cabang'),
                'role'          => $request->input('role')
            ]);

            //assign users
            $user->save();
        } else {
            // upload image
            $avatar = $request->file('avatar');
            $avatar->storeAs('public/users', $avatar->hashName());
            // $avatar->storeAs('public/users', $avatar->getClientOriginalName());

            $user = User::create([
                'name'          => $request->input('name'),
                'email'         => $request->input('email'),
                'password'      => bcrypt($request->input('password')),
                'cabang'        => $request->input('cabang'),
                'avatar'        => $avatar->hashName(),
                'role'          => $request->input('role')
            ]);

            //assign users
            $user->save();
        }

        if ($user) {
            return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('admin.user.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required|email',
            'password'      => 'required|confirmed',
            'cabang'        => 'required',
            'role'          => 'required',
        ]);

        //check jika image kosong
        if ($request->file('avatar') == '') {
            # code...
            $user = User::findOrFail($user->id);
            $user->update([
                'name'          => $request->input('name'),
                'email'         => $request->input('email'),
                'password'      => bcrypt($request->input('password')),
                'cabang'        => $request->input('cabang'),
                'role'          => $request->input('role'),
            ]);
        } else {
            // Hapus foto lama
            Storage::disk('local')->delete('public/users/' . basename($user->avatar));

            //upload image baru
            $avatar = $request->file('avatar');
            $avatar->storeAs('public/users', $avatar->getClientOriginalName());

            $user = User::findOrFail($user->id);
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'password'  => bcrypt($request->input('password')),
                'cabang'    => $request->input('cabang'),
                'avatar'    => $avatar->getClientOriginalName(),
                'role'      => $request->input('role')
            ]);
        }

        if ($user) {
            return redirect()->route('admin.user.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            return redirect()->route('admin.user.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
