<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Pemasukan;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePemasukanRequest;
use App\Http\Requests\UpdatePemasukanRequest;
use App\Http\Resources\Admin\PemasukanResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PemasukanApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pemasukan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PemasukanResource(Asset::all());

    }

    public function store(StorePemasukanRequest $request)
    {
        $pemasukan = Pemasukan::create($request->all());

        return (new PemasukanResource($pemasukan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Pemasukan $pemasukan)
    {
        abort_if(Gate::denies('pemasukan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PemasukanResource($pemasukan);

    }

    public function update(UpdatePemasukanRequest $request, Pemasukan $pemasukan)
    {
        $pemasukan->update($request->all());

        return (new PemasukanResource($pemasukan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Pemasukan $pemasukan)
    {
        abort_if(Gate::denies('pemasukan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pemasukan->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
