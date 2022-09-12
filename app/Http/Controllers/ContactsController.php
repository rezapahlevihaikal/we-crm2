<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Models\Divisi;
use App\Models\CoreBisnis;
use App\Models\Companies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContactsController extends Controller
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
        $dataCompanies = Companies::get(['id', 'company_name']);
        if (Auth::user()->id_role == 1 || Auth::user()->id_role == 4){
            $dataContact = Contacts::all();
        }
        else {
            $dataContact = Contacts::where('id_core_bisnis', Auth::user()->id_core_bisnis)
                           ->with(['getCompany'])
                           ->get();
        }

        return view('contact.index', compact('dataContact', 'dataCompanies'));
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
        $dataContact = Contacts::create([
            'name' => $request->name,
            'author' => Auth::user()->name,
            'id_author'=> Auth::user()->id,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'id_company' => $request->id_company,
            'address' => $request->address,
            'id_divisi' => Auth::user()->id_divisi,
            'id_core_bisnis' => Auth::user()->id_core_bisnis,
            'note' => $request->note
        ]);

        if ($dataContact) {
            return redirect('contacts')->withStatus('Data berhasil diinput');
        }
        else {
            return redirect()->back()->with('error', 'data gagal diinput');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function show(Contacts $contacts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $dataCompanies = Companies::get(['id', 'company_name']);
        $dataContact = Contacts::findOrFail($id);

        return view('contact.edit', compact('dataCompanies', 'dataContact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $dataContact = Contacts::findOrFail($id);
        $dataContact->update([
            'name' => $request->name,
            'author' => Auth::user()->name,
            'id_author'=> Auth::user()->id,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'id_company' => $request->id_company,
            'address' => $request->address,
            'id_divisi' => Auth::user()->id_divisi,
            'id_core_bisnis' => Auth::user()->id_core_bisnis,
            'note' => $request->note
        ]);

        if ($dataContact) {
            return redirect('contacts')->withStatus('data berhasil diupdate');
        }
        else {
            return redirect()->back()->with('error', 'data gagal diinput');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $dataContact = Contacts::findOrFail($id);
        $dataContact->delete();

        return redirect()->back()->withStatus('data berhasil dihapus');
    }
}
