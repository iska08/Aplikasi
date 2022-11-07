<?php

namespace App\Http\Controllers\Admin;

use App\Pemasukan;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPemasukanRequest;
use App\Http\Requests\StorePemasukanRequest;
use App\Http\Requests\UpdatePemasukanRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PemasukanController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pemasukan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pemasukan = Pemasukan::all();

        return view('admin.pemasukan.index', compact('pemasukan'));
    }

    public function create()
    {
        abort_if(Gate::denies('pemasukan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pemasukan.create');
    }

    public function store(StorePemasukanRequest $request)
    {
        $pemasukan = Pemasukan::create($request->all());

        return redirect()->route('admin.pemasukan.index');

    }

    public function edit(Pemasukan $pemasukan)
    {
        abort_if(Gate::denies('pemasukan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pemasukan.edit', compact('pemasukan'));
    }

    public function update(UpdatePemasukanRequest $request, Pemasukan $pemasukan)
    {
        $pemasukan->update($request->all());

        return redirect()->route('admin.pemasukan.index');

    }

    public function show(Pemasukan $pemasukan)
    {
        abort_if(Gate::denies('pemasukan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pemasukan.show', compact('pemasukan'));
    }

    public function destroy(Pemasukan $pemasukan)
    {
        abort_if(Gate::denies('pemasukan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pemasukan->delete();

        return back();

    }

    public function massDestroy(MassDestroyPemasukanRequest $request)
    {
        Pemasukan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
