<?php

namespace App\Http\Controllers\Admin;

use App\Pengeluaran;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPengeluaranRequest;
use App\Http\Requests\StorePengeluaranRequest;
use App\Http\Requests\UpdatePengeluaranRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PengeluaranController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pengeluaran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengeluaran = Pengeluaran::all();

        return view('admin.pengeluaran.index', compact('pengeluaran'));
    }

    public function create()
    {
        abort_if(Gate::denies('pengeluaran_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pengeluaran.create');
    }

    public function store(StorePengeluaranRequest $request)
    {
        $pengeluaran = Pengeluaran::create($request->all());

        return redirect()->route('admin.pengeluaran.index');

    }

    public function edit(Pengeluaran $pengeluaran)
    {
        abort_if(Gate::denies('pengeluaran_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pengeluaran.edit', compact('pengeluaran'));
    }

    public function update(UpdatePengeluaranRequest $request, Pengeluaran $pengeluaran)
    {
        $pengeluaran->update($request->all());

        return redirect()->route('admin.pengeluaran.index');

    }

    public function show(Pengeluaran $pengeluaran)
    {
        abort_if(Gate::denies('pengeluaran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pengeluaran.show', compact('pengeluaran'));
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        abort_if(Gate::denies('pengeluaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengeluaran->delete();

        return back();

    }

    public function massDestroy(MassDestroyPengeluaranRequest $request)
    {
        Pengeluaran::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
