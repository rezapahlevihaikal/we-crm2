<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Deals;
use App\Models\InvStatus;
use App\Models\Companies;
use App\Models\Product;
use App\Models\User;
use App\Models\StatusTax;
use App\Models\StatusPph;
use DB;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InvoiceController extends Controller
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
        $dataInvoice = Invoice::latest('id')->get();
        return view('invoice.index', compact('dataInvoice'));
        
    }

    public function requestInvoice()
    {
        $dataDealsIn = Deals::where('id_stage', 3)->where('created_at','>=','2022-01-01')->latest('id')->get();
        return view('invoice.indexRequest', compact('dataDealsIn'));
    }
    
    public function detailInvoice($id)
    {
        $dataDealsIn = Deals::findOrFail($id);
        return view('invoice.detailInvoice', compact('dataDealsIn'));
    }

    //---------------------- Generate data deals ke invoice --------------------------
    public function createInvoice(Request $request, $id)
    {
        
        $dataDealsIn = Deals::find($id);
        $dataDealsIn->update([
            'id_stage' => 5,
        ]);

        //==== deklarasi format nomor invoice====
            //------------------ Deklarasi format header invoice --------------
            if ($dataDealsIn->getUser->id_divisi == 1) {
                $formatHeader = 'WE';
            }
            elseif ($dataDealsIn->getUser->id_divisi == 2) {
                $formatHeader = 'HS';
            }
            elseif ($dataDealsIn->getUser->id_divisi == 3) {
                $formatHeader = 'PP';
            }
            elseif ($dataDealsIn->getUser->id_divisi == 4) {
                $formatHeader = 'Q1';
            }
            elseif ($dataDealsIn->getUser->id_divisi == 6) {
                $formatHeader = 'FF';
            }
            //================================================================

            //------------------ Deklarasi format subhead invoice ------------
            if ($dataDealsIn->getUser->id_core_bisnis == 1) {
                $subHeader = 'ADSWE';
            }
            elseif ($dataDealsIn->getUser->id_core_bisnis == 2) {
                $subHeader = 'ADSHS';
            }
            elseif ($dataDealsIn->getUser->id_core_bisnis == 3) {
                $subHeader = 'AWDWE';
            }
            elseif ($dataDealsIn->getUser->id_core_bisnis == 4) {
                $subHeader = 'AWDHS';
            }
            elseif ($dataDealsIn->getUser->id_core_bisnis == 5) {
                $subHeader = 'PRGWE';
            }
            elseif ($dataDealsIn->getUser->id_core_bisnis == 6) {
                $subHeader = 'PRGHS';
            }
            elseif ($dataDealsIn->getUser->id_core_bisnis == 7) {
                $subHeader = 'PRGPP';
            }
            elseif ($dataDealsIn->getUser->id_core_bisnis == 8) {
                $subHeader = 'SMNHS';
            }
            elseif ($dataDealsIn->getUser->id_core_bisnis == 9) {
                $subHeader = 'SMNBF';
            }
            elseif ($dataDealsIn->getUser->id_core_bisnis == 10) {
                $subHeader = 'WEA';
            }
            elseif ($dataDealsIn->getUser->id_core_bisnis == 11) {
                $subHeader = 'YT';
            }
            elseif ($dataDealsIn->getUser->id_core_bisnis == 12) {
                $subHeader = 'IDE';
            }
            elseif ($dataDealsIn->getUser->id_core_bisnis == 13) {
                $subHeader = 'REV';
            }
            elseif ($dataDealsIn->getUser->id_core_bisnis == 14) {
                $subHeader = 'WEBWE';
            }
        
        $dateNow = Carbon::now()->format('y');
        $order = Deals::orderBy('created_at', 'desc')->first();
        //=======================================

        //======== Deklarasi Kode Sales ==========
        $midSalesAttribute = $dataDealsIn->getUser->initial;
        $endSalesAttribute = $dataDealsIn->getUser->id;
        //========================================

        //======== Deklarasi Nomor Order =========
        $headerOrder = $dataDealsIn->id_author;
        $attOrder = $dataDealsIn->id;
        //========================================

        //=============== Pengkondsian Nilai Based Value/Harga Pokok ===============
        if($dataDealsIn->ppn == 1)
        {
            $dataBasedValue = $dataDealsIn->amount_po * (100/111);
        }
        else {
            $dataBasedValue = $dataDealsIn->amount_po;
        }
        //==========================================================================

        //=================== Pengkondisian Nilai PPH 23 ===========================
        if ($dataDealsIn->pph_23 == 1) 
        {
            $dataPph23 = $dataBasedValue * 2 /100;
        }
        else 
        {
            $dataPph23 = 0;
        }
        //=========================================================================
        

        $dataCreateIn = Invoice::create([
            'deals_id' => $dataDealsIn->id,
            'inv_date' => $request->inv_date,
            'exp_inv_date' => $request->exp_inv_date,
            'product_id' => $dataDealsIn->id_product,
            'size' => $dataDealsIn->size,
            'sales_code' => $midSalesAttribute . $endSalesAttribute,
            // 'no_order' => $headerOrder . $attOrder,
            'author' => $dataDealsIn->id_author,
            'amount_po' => $dataDealsIn->amount_po,
            'faktur_pajak' => $request->faktur_pajak,
            'based_value' => $dataBasedValue,
            'ppn' => $dataBasedValue * 11 / 100,
            'pph_23' => $dataPph23,
            'ppn_id' => $dataDealsIn->ppn,
            'pph_id' => $dataDealsIn->pph_23,
            'inv_status_id' => 1, //==> status inv auto new ===
            'pic_inv' => $request->pic_inv,
            // 'inv_number' => $formatHeader . $dateNow . $subHeader . str_pad($order->id + 1, 4, "0", STR_PAD_LEFT),
            'company_id' => $dataDealsIn->id_company,
            'inv_desc' => $request->inv_desc,
        ]);

        if ($dataCreateIn) {
            return redirect()->route('requestInvoice')->withStatus('data berhasil di generate');
        } else {
            return redirect()->back()->withErrors('data gagal di generate');
        }
        
    }

    

    public function downloadMediaOrder($id)
    {
        $dataDealsIn = Deals::where('id', $id)->firstOrFail();
        $filePath = public_path('uploads/'. $dataDealsIn->file);
        
        return response()->download($filePath);
    }

    public function editRequest($id)
    {
        $dataCompany = Companies::get(['id', 'company_name']);
        $dataProduct = Product::get(['id', 'name']);
        $dataPpn = StatusTax::get(['id', 'name', 'value']);
        $dataPph = StatusPph::get(['id', 'name', 'value']);
        $dataStatusInv = InvStatus::get(['id', 'name']);
        $dataInvoice = Invoice::findOrFail($id);
        return view('invoice.edit', compact('dataInvoice', 'dataStatusInv', 'dataCompany', 'dataProduct', 'dataPpn', 'dataPph'));
    }



    public function updateRequest(Request $request, $id)
    {
        $dataInvoice = Invoice::findOrFail($id);

        // $ppnvalue = 0;

        // if ($request->ppn_id == 1) {
        //     $dataBasedValue = $dataInvoice->amount_po * (100/111);
        //     $ppnvalue = $dataInvoice->amount_po - $dataBasedValue;
        // }
        // else {
        //     $dataBasedValue = $dataInvoice->amount_po;
        //     $ppnvalue = $dataBasedValue * (11/100);
        // }

        // if ($request->pph_23 == 1) 
        // {
        //     $dataPph23 = $dataBasedValue * 2 /100;
        // }
        // else 
        // {
        //     $dataPph23 = 0;
        // }

        
        $dataInvoice->update([
            // 'amount_po' => str_replace('.', '', $request->amount_po),
            'inv_number' => $request->inv_number,
            // 'based_value' => $dataBasedValue,
            'company_id' => $request->company_id,
            'no_order' => $request->no_order,
            'product_id' => $request->product_id,
            'company_id' => $request->company_id,
            'address_npwp' => $request->address_npwp,
            'based_value' => str_replace('.', '', $request->based_value),
            'ppn' => str_replace('.', '', $request->ppn),
            'pph_23' => str_replace('.', '', $request->pph_23),
            'ppn_id' => $request->ppn_id,
            'pph_id' => $request->pph_id,
            'faktur_pajak' => $request->faktur_pajak,
            'inv_date' => $request->inv_date,
            'exp_inv_date' => $request->exp_inv_date,
            'inv_status_id' => $request->inv_status_id,
            'pic_inv' => $request->pic_inv,
            'inv_desc' => $request->inv_desc
        ]);
        
        if($dataInvoice)
        {
            return redirect()->route('invoice')->withStatus('data berhasil diinput');
        }
        else {
            return redirect()->back()->withErrors('data gagal diinput');
        }
    }



    public function generateDeals(Request $request,$id)
    {
        $dataInvoice = Invoice::findOrFail($id);

        //---------------- Deklarasi Format Receipt-Number dan TF-Number ---------------
        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        
        $order = $dataInvoice->id;
        $attrFr = 'WE';
        $attrTF = 'Q1-KEU';
        $attrReceipt = Carbon::now()->format('Y');
        //------------------------------------------------------------------------------

        $dataInvoice->update([
            'receipt_number' => "000".$order."/".$attrFr."/".$bulanRomawi[date('n')]."/".$attrReceipt,
            'tf_number' => "000".$order."/".$attrTF."/".$bulanRomawi[date('n')]."-".$attrReceipt
        ]);

        //=============== Generate ke lampiran PDF ==========================
        $headerName = $dataInvoice->inv_number;
        $pdf = Pdf::loadView('invoice.invoice_page', compact('dataInvoice'));
        return $pdf->stream('INVOICE-'.$headerName.'.pdf');
        //===================================================================
    }

    public function createSingleInvoice()
    { //===> gajadi dipake
        $dataCompany = Companies::get(['id', 'company_name']);
        $dataProduct = Product::get(['id', 'name']);
        $dataStatusInv = InvStatus::get(['id', 'name']);
        return view('invoice.create', compact('dataCompany', 'dataProduct', 'dataStatusInv'));
    }

    public function postCreateInvoice(Request $request)
    { //===> gajadi dipake
        $dataDealsIn = Deals::with('getUser')->first();
        

        //==== deklarasi format nomor invoice====
        $formatHeader = 'FF';
        $subHeader = 'FIN';
        $dateNow = Carbon::now()->format('y');
        $order = Invoice::orderBy('created_at', 'desc')->first();
        //=======================================

        //======== Deklarasi Kode Sales ==========
        $midSalesAttribute = Auth::user()->initial;
        $endSalesAttribute = Auth::user()->id;
        //========================================

        //======== Deklarasi Nomor Order =========
        $headerOrder = Auth::user()->id;
        $attOrder = $dataDealsIn->id;
        //========================================

        $dataInvoice = Invoice::create([
            'inv_date' => $request->inv_date,
            'exp_inv_date' => $request->exp_inv_date,
            'billed_value' => $request->billed_value,
            'product_id' => $dataDealsIn->id_product,
            'size' => $dataDealsIn->size,
            'sales_code' => $midSalesAttribute . $endSalesAttribute,
            'no_order' => $headerOrder . $attOrder,
            'author' => $dataDealsIn->id_author,
            'faktur_pajak' => $request->faktur_pajak,
            // 'ppn' => $request->input('ppn') ? $request->billed_value * 11 / 100 : 0,
            'inv_status_id' => $request->inv_status_id,
            'pic_inv' => $request->pic_inv,
            'inv_number' => $formatHeader . $dateNow . $subHeader . str_pad($order->id + 1, 4, "0", STR_PAD_LEFT),
            'company_id' => $dataDealsIn->id_company,
            'inv_desc' => $request->inv_desc,
        ]);
        
        if($dataInvoice)
        {
            return redirect()->route('invoice')->withStatus('data berhasil diinput');
        }
        else {
            return redirect()->back()->withErrors('data gagal diinput');
        }
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
