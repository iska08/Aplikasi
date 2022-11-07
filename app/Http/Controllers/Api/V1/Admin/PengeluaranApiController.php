<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Pengeluaran;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePengeluaranRequest;
use App\Http\Requests\UpdatePengeluaranRequest;
use App\Http\Resources\Admin\PengeluaranResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PengeluaranApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pengeluaran_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PengeluarantResource(Pengeluaran::all());

    }

    public function store(StorePengeluaranRequest $request)
    {
        $pengeluaran = Pengeluaran::create($request->all());

        return (new PengeluaranResource($pengeluaran))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Pengeluaran $pengeluaran)
    {
        abort_if(Gate::denies('pengeluaran_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new Pengeluaran($pengeluaran);

    }

    public function update(UpdatePengeluaranRequest $request, Pengeluaran $pengeluaran)
    {
        $pengeluaran->update($request->all());

        return (new PengeluaranResource($pengeluaran))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        abort_if(Gate::denies('pengeluaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pengeluaran->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
