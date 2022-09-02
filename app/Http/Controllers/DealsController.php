<?php

namespace App\Http\Controllers;

use App\Models\Deals;
use App\Models\CoreBisnis;
use App\Models\Companies;
use App\Models\Source;
use App\Models\Stages;
use App\Models\Product;
use App\Models\Priority;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealsController extends Controller
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
        if (Auth::user()->id_role == 4 || Auth::user()->id_role == 1 ) {
            $dataDeals = Deals::all();   
        }
        else {
            $dataDeals = Deals::where('id_core_bisnis', Auth::user()->id_core_bisnis)
                         ->with(['getCoreBisnis', 'getCompany', 'getSource', 'getStage', 'getProduct'])
                         ->get();
        }

        return view('deals.index', compact('dataDeals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $dataCoreBisnis = CoreBisnis::get(['id', 'nama_core_bisnis']);
        $dataCompany = Companies::get(['id', 'company_name']);
        $dataSource = Source::get(['id', 'nama_source']);
        $dataStage = Stages::get(['id', 'nama_stage']);
        $dataProduct = Product::get(['id', 'name']);
        $dataPriority = Priority::get(['id', 'nama_priority']);
    
        return view('deals.create', compact('dataCoreBisnis', 'dataCompany', 'dataSource', 'dataStage', 'dataProduct', 'dataPriority'));
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
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,doc,docx,xlx,xlsx,pdf|max:2048'
        ]);

        $rules = [
            'file' => 'required|mimes:jpg,jpeg,png,doc,docx,xlx,xlsx,pdf|max:2048'
        ];

        $customMessage = [
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute max :value'
        ];

        $this->validate($request, $rules, $customMessage);


        $filename = Carbon::now().'.'.$request->file->extension();
        // dd($filename);
        $request->file->move(public_path('uploads'), $filename);
        
        $defaultHeader = 'WE';
        $dateNow = Carbon::now()->format('y');
        
        $order = Deals::orderBy('created_at', 'DESC')->first();
        $dataDeals = Deals::create([
            'name' => $request->name,
            'size' => $request->size,
            'ppn' => $request->input('ppn') ? $request->size * 11 /100 : 0,
            'author' => Auth::user()->name,
            'id_core_bisnis' => Auth::user()->id_core_bisnis,
            'id_company' => $request->id_company,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'expired_date' => $request->expired_date,
            'file'=> $filename,
            'id_source' => $request->id_source,
            'id_stage' => $request->id_stage,
            'id_product' => $request->id_product,
            'priority_id' => $request->priority_id,
            'invoice_number' => $defaultHeader . $dateNow ."E". str_pad($order->id + 1, 4, "0", STR_PAD_LEFT),
            'description' => $request->description
        ]);

        if ($dataDeals) {
            return redirect()->route('deals')->withStatus('data berhasil diinput');
        }
        else {
            return redirect()->back()->withErrors('data gagal diinput');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deals  $deals
     * @return \Illuminate\Http\Response
     */
    public function show(Deals $deals)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deals  $deals
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $dataCompany = Companies::get(['id', 'company_name']);
        $dataSource = Source::get(['id', 'nama_source']);
        $dataStage = Stages::get(['id', 'nama_stage']);
        $dataProduct = Product::get(['id', 'name']);
        $dataDeals = Deals::findOrFail($id);

        return view('deals.edit', compact('dataCompany', 'dataSource', 'dataStage', 'dataProduct', 'dataDeals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deals  $deals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $dataDeals = Deals::findOrFail($id);
        $dataDeals->update([
            'name' => $request->name,
            'size' => $request->size,
            'id_company' => $request->id_company,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'expired_date' => $request->expired_date,
            'id_source' => $request->id_source,
            'id_stage' => $request->id_stage,
            'id_product' => $request->id_product,
            'description' => $request->description
        ]);

        if ($dataDeals) {
            return redirect()->route('deals')->withStatus('data berhasil diupdate');
        }
        else {
            return redirect()->back()->withErrors('data gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deals  $deals
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataDeals = Deals::findOrFail($id);
        $dataDeals->delete();

        return redirect()->back()->withStatus('data berhasil dihapus');
    }
}
