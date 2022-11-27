<?php

namespace App\Http\Controllers;

use App\Models\Reques;
use App\Models\RequesDetail;
use App\Models\Produk;
use App\Models\Setting;
use Illuminate\Http\Request;
use PDF;

class RequesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reques.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data()
    {
        $reques = Reques::with('member')->orderBy('id_reques', 'desc')->get();

        return datatables()
            ->of($reques)
            ->addIndexColumn()
            ->addColumn('total_item', function ($reques) {
                return format_uang($$reques->total_item);
            })
            ->addColumn('tanggal', function ($reques) {
                return tanggal_indonesia($reques->created_at, false);
            })
            ->addColumn('kode_member', function ($reques) {
                $member = $reques->member->kode_member ?? '';
                return '<span class="label label-success">'. $member .'</spa>';
            })
            ->editColumn('petugas', function ($reques) {
                return $reques->user->name ?? '';
            })
            ->addColumn('aksi', function ($reques) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('reques.show', $reques->id_reques) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
                    <button onclick="deleteData(`'. route('reques.destroy', $reques->id_reques) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'kode_member'])
            ->make(true);
    }

    public function create()
    {
        $reques = new Reques();
        $reques->id_member = null;
        $reques->total_item = 0;
        $reques->id_user = auth()->id();
        $reques->save();

        session(['id_reques' => $reques->id_reques]);
        return redirect()->route('permintaan.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reques = Reques::findOrFail($request->id_reques);
        $reques->id_member = $request->id_member;
        $reques->total_item = $request->total_item;
        $reques->update();

        $detail = RequesDetail::where('id_reques', $request->id_reques)->get();
        foreach ($detail as $item) {
            $item->diskon = $request->diskon;
            $item->update();

            $produk = Produk::find($item->id_produk);
            $produk->stok -= $item->jumlah;
            $produk->update();
        }

        return redirect()->route('permintaan.selesai');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = RequesDetail::with('produk')->where('id_reques', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_produk', function ($detail) {
                return '<span class="label label-success">'. $detail->produk->kode_produk .'</span>';
            })
            ->addColumn('nama_produk', function ($detail) {
                return $detail->produk->nama_produk;
            })
            ->addColumn('harga_jual', function ($detail) {
                return 'Rp. '. format_uang($detail->harga_jual);
            })
            ->addColumn('jumlah', function ($detail) {
                return format_uang($detail->jumlah);
            })
            ->addColumn('subtotal', function ($detail) {
                return 'Rp. '. format_uang($detail->subtotal);
            })
            ->rawColumns(['kode_produk'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reques = Reques::find($id);
        $detail    = RequesDetail::where('id_reques', $reques->id_reques)->get();
        foreach ($detail as $item) {
            $produk = Produk::find($item->id_produk);
            if ($produk) {
                $produk->stok += $item->jumlah;
                $produk->update();
            }

            $item->delete();
        }

        $reques->delete();

        return response(null, 204);
    }

    public function selesai()
    {
        $setting = Setting::first();

        return view('reques.selesai', compact('setting'));
    }
    
    public function notaKecil()
    {
        $setting = Setting::first();
        $reques = Reques::find(session('id_reques'));
        if (! $reques) {
            abort(404);
        }
        $detail = RequesDetail::with('produk')
            ->where('id_reques', session('id_reques'))
            ->get();
        
        return view('reques.nota_kecil', compact('setting', 'reques', 'detail'));
    }

    public function notaBesar()
    {
        $setting = Setting::first();
        $reques = Reques::find(session('id_reques'));
        if (! $reques) {
            abort(404);
        }
        $detail = RequesDetail::with('produk')
            ->where('id_reques', session('id_reques'))
            ->get();

        $pdf = PDF::loadView('reques.nota_besar', compact('setting', 'reques', 'detail'));
        $pdf->setPaper(0,0,609,440, 'potrait');
        return $pdf->stream('Permintaan-'. date('Y-m-d-his') .'.pdf');
    }

}
