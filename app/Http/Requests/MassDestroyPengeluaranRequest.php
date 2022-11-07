<?php

namespace App\Http\Requests;

use App\Pengeluaran;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPengeluaranRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pengeluaran_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:pengeluarans,id',
        ];

    }
}
