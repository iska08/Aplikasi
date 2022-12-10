<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use App\Models\Menu;
use PDF;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis = Jenis::all()->pluck('nama_jenis', 'id_jenis');

        return view('menu.index', compact('jenis'));
    }

    public function data()
    {
        $menu = Menu::leftJoin('jenis', 'jenis.id_jenis', 'menu.id_jenis')
            ->select('menu.*', 'nama_jenis')
            // ->orderBy('kode_produk', 'asc')
            ->get();

        return datatables()
            ->of($menu)
            ->addIndexColumn()
            ->addColumn('select_all', function ($menu) {
                return '
                    <input type="checkbox" name="id_menu[]" value="'. $menu->id_menu .'">
                ';
            })
            ->addColumn('kode_menu', function ($menu) {
                return '<span class="label label-success">'. $menu->kode_menu .'</span>';
            })
            ->addColumn('harga_jual', function ($menu) {
                return format_uang($menu->harga_jual);
            })
            ->addColumn('aksi', function ($menu) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('menu.update', $menu->id_menu) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('menu.destroy', $menu->id_menu) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'kode_menu', 'select_all'])
            ->make(true);
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
        $menu = Menu::latest()->first() ?? new Menu();
        $request['kode_menu'] = 'M'. tambah_nol_didepan((int)$menu->id_menu +1, 6);

        $menu = Menu::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::find($id);

        return response()->json($menu);
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
        $menu = Menu::find($id);
        $menu->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_menu as $id) {
            $menu = Menu::find($id);
            $menu->delete();
        }

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
        $dataMenu = array();
        foreach ($request->id_menu as $id) {
            $menu = Menu::find($id);
            $dataMenu[] = $menu;
        }

        $no  = 1;
        $pdf = PDF::loadView('menu.barcode', compact('dataMenu', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('menu.pdf');
    }
}
