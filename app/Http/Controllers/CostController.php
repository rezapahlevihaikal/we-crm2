<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubTipe;
use App\Models\TipeCost;
use Illuminate\Support\Facades\Auth;


class CostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // ================================= TIPE COST ========================================

    public function indexTipe()
    {
        $dataTipe = TipeCost::all();
        return view('cost.indexTipe', compact('dataTipe'));
    }

    public function storeTipe(Request $request)
    {
        $dataTipe = TipeCost::create([
            'nama' => $request->nama
        ]);

        if ($dataTipe) {
            return redirect()->route('tipeCost')->withStatus('data berhasil diinput');
        } else {
            return redirect()->back()->withErrors('data gagal diinput');
        }
        
    }

    public function editTipe($id)
    {
        $dataTipe = TipeCost::find($id);
        return view('cost.editTipe', compact('dataTipe'));
    }

    public function updateTipe(Request $request, $id)
    {
        $dataTipe = TipeCost::find($id);
        $dataTipe->update([
            'nama' => $request->nama
        ]);

        if ($dataTipe) {
            return redirect()->route('tipeCost')->withStatus('data berhasil diupdate');
        }
        else {
            return redirect()->back()->withErrors('data gagal diupdate');
        }   
    }

    public function destroyTipe($id)
    {
        $dataTipe = TipeCost::find($id);
        $dataTipe->delete();

        return redirect()->back()->withStatus('data berhasil dihapus');
    }



    // ============================ SUB TIPE =====================================

    public function indexSub()
    {
        $dataTipe = TipeCost::get(['id', 'nama']);
        $dataSub = SubTipe::with(['getTipeCost'])->get();

        return view('cost.indexSub', compact('dataTipe', 'dataSub'));
    }

    public function storeSub(Request $request)
    {
        $dataSub = SubTipe::create([
            'name' => $request->name,
            'tipe_id' => $request->tipe_id
        ]);

        if ($dataSub) {
            return redirect()->route('subTipe')->withStatus('data berhasil diinput');
        } else {
            return redirect()->back()->withErrors('data gagal diinput');
        }
    }

    public function editSub($id)
    {
        $dataTipe = TipeCost::get(['id', 'nama']);
        $dataSub = SubTipe::find($id);

        return view('cost.editSub', compact('dataTipe', 'dataSub'));
    }


    public function updateSub(Request $request, $id)
    {
        $dataSub = SubTipe::find($id);
        $dataSub->update([
            'name' => $request->name,
            'tipe_id' => $request->tipe_id
        ]);

        if ($dataSub) {
            return redirect()->route('subTipe')->withStatus('data berhasil diupdate');
        }
        else {
            return redirect()->back()->withErrors('data gagal diupdate');
        }   
    }

    public function destroySub($id)
    {
        $dataSub = SubTipe::find($id);
        $dataSub->delete();

        return redirect()->back()->withStatus('data berhasil dihapus');
    }
}
