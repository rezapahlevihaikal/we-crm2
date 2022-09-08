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
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
            $dataDeals = Deals::latest('updated_at')->get();
        }
        else {
            $dataDeals = Deals::where('id_core_bisnis', Auth::user()->id_core_bisnis)
                         ->with(['getCoreBisnis', 'getCompany', 'getSource', 'getStage', 'getProduct'])
                         ->latest('updated_at')->get();
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
        $filename = null;
        $request->validate([
            'file' => 'nullable|mimes:jpg,jpeg,png,doc,docx,xlx,xlsx,pdf|max:5120'
        ]);

        $rules = [
            'file' => 'nullable|mimes:jpg,jpeg,png,doc,docx,xlx,xlsx,pdf|max:5120'
        ];

        $customMessage = [
            
            'max' => 'The :attribute max :value'
        ];

        $this->validate($request, $rules, $customMessage);

        $order = Deals::orderBy('created_at', 'DESC')->first();

        $nameDoc = Carbon::now()->format('ymd');
        $headerNameDoc = 'FileDeals';
        $sourceDoc = Auth::user()->id;

        if ($request->file) {
            
            $filename = $headerNameDoc."_".$nameDoc."_".$sourceDoc."_".str_pad($order->id + 1, 4, "0", STR_PAD_LEFT).".".$request->file->extension();        
            $request->file->move(public_path('uploads'), $filename);
        }        
        
        $defaultHeader = 'WE';
        $dateNow = Carbon::now()->format('y');
        
        
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
        $request->validate([
            'file' => 'nullable|mimes:jpg,jpeg,png,doc,docx,xlx,xlsx,pdf|max:5120'
        ]);

        $dataDeals = Deals::findOrFail($id);

        $order = Deals::orderBy('created_at', 'DESC')->first();

        $nameDoc = Carbon::now()->format('ymd');
        $headerNameDoc = 'FileDeals';
        $sourceDoc = Auth::user()->id;

        if ($request->has('file')) {
            $filename = $headerNameDoc."_".$nameDoc."_".$sourceDoc."_".str_pad($order->id + 1, 4, "0", STR_PAD_LEFT).".".$request->file->getClientOriginalExtension();
            File::delete(public_path('uploads'), $dataDeals->file);
            $request->file->move(public_path('uploads'), $filename);
        }
        else {
            $filename = $dataDeals->file;
        }

        $dataDeals->update([
            'name' => $request->name,
            'size' => $request->size,
            'id_company' => $request->id_company,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'expired_date' => $request->expired_date,
            'id_source' => $request->id_source,
            'id_stage' => $request->id_stage,
            'file' => $filename,
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

    public function downloadFileDeals($id)
    {
        $dataDeals = Deals::where('id', $id)->firstOrFail();
        $filePath = public_path('uploads/'. $dataDeals->file);
        // dd($filePath);
        return response()->download($filePath);
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
