<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $dataRole = Role::all();
        return view('role.index', compact('dataRole'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $dataRole = Role::create([
            'nama_role' => $request->nama_role
        ]);

        if ($dataRole) {
            return redirect('role')->with('success','data berhasil diinput');
        }
        else{
            return redirect()->back()->with('error', 'data gagal diinput');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function show(Divisi $divisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $dataRole = Role::findOrFail($id);
        return view('role.edit', compact('dataRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $dataRole = Role::findOrFail($id);
        $dataRole->update([
            'nama_role' => $request->nama_role
        ]);

        if($dataRole)
        {
            return redirect()->route('role')->with('succes', 'Data Berhasil Diinput');
        }
        else
        {
            return redirect()->back()->with('error', 'Data Gagal Diinput');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Divisi  $divisi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $dataRole = Role::findOrFail($id);
        $dataRole->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

}
