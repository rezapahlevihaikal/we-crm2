<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Divisi;
use App\Models\CoreBisnis;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $dataDivisi = Divisi::get(['id', 'nama_divisi']);
        $dataCoreBisnis = CoreBisnis::get(['id', 'nama_core_bisnis']);
        $dataRole = Role::get(['id', 'nama_role']);
        $dataUser = User::with(['getDivisiUser', 'getCoreBisnisUser', 'getRole'])->get();
        return view('user.index', compact('dataDivisi','dataCoreBisnis','dataRole','dataUser'));
    }

    public function store(Request $request)
    {
        $dataUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'initial' => $request->initial,
            'id_divisi' => $request->id_divisi,
            'id_core_bisnis' => $request->id_core_bisnis,
            'id_role' => $request->id_role,
            'password' => Hash::make($request->password)
        ]);

        if ($dataUser) {
            return redirect()->route('userManagement')->withStatus('data berhasil diiput');
        }
        else {
            return redirect()->back()->withStatus('data gagal diinput');
        }
    }

    public function edit($id)
    {
        $dataDivisi = Divisi::get(['id', 'nama_divisi']);
        $dataCoreBisnis = CoreBisnis::get(['id', 'nama_core_bisnis']);
        $dataRole = Role::get(['id', 'nama_role']);
        $dataUser = User::findOrFail($id);
        return view('user.edit', compact('dataDivisi','dataCoreBisnis','dataRole','dataUser'));
    }

    public function update(Request $request, $id)
    {
        $dataUser = User::findOrFail($id);
        $dataUser->update([
            'name' => $request->name,
            'email' => $request->email,
            'initial' => $request->initial,
            'id_divisi' => $request->id_divisi,
            'id_core_bisnis' => $request->id_core_bisnis,
            'id_role' => $request->id_role,
            'password' => Hash::make($request->password)
        ]);

        if ($dataUser) {
            return redirect()->route('userManagement')->withStatus('data berhasil diupdate');
        }
        else {
            return redirect()->back()->withStatus('data gagal diupdate');
        }
    }

    public function destroy($id)
    {
        $dataUser = User::findOrFail($id);
        $dataUser->delete();

        return redirect()->back()->with('success', 'data berhasil dihapus');
    }
}
