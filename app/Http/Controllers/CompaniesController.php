<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CompaniesController extends Controller
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
        $dataCompanies = Companies::all();
        return view('companies.index', compact('dataCompanies'));
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
        $dataCompanies = Companies::create([
            'company_name' => $request->company_name,
            'author' => Auth::user()->name,
            'phone_number_company' => $request->phone_number_company,
            'address' => $request->address,
            'zipcode' => $request->zipcode,
            'website' => $request->website,
            'nama_dirut' => $request->nama_dirut,
            'note_1' => $request->note_1,
            'note_2' => $request->note_2,
            'note_3' => $request->note_3
        ]);

        if ($dataCompanies) {
            return redirect('companies')->withStatus('data berhasil diinput');
        }
        else {
            return reidirect()->back()->with('error', 'data gagal diinput');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataCompanies = Companies::findOrFail($id);
        return view('companies.edit', compact('dataCompanies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $dataCompanies = Companies::findOrFail($id);
        $dataCompanies->update([
            'company_name' => $request->company_name,
            'author' => Auth::user()->name,
            'phone_number_company' => $request->phone_number_company,
            'address' => $request->address,
            'zipcode' => $request->zipcode,
            'website' => $request->website,
            'nama_dirut' => $request->nama_dirut,
            'note_1' => $request->note_1,
            'note_2' => $request->note_2,
            'note_3' => $request->note_3
        ]);

        if ($dataCompanies) {
            return redirect('companies')->withStatus('data berhasil diupdate');
        }
        else {
            return redirect()->back()->with('error', 'data gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $dataCompanies = Companies::findOrFail($id);
        $dataCompanies->delete();

        return redirect()->back()->with('success', 'data berhasil dihapus');
    }
}
