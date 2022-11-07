<?php

namespace App\Http\Requests;

use App\Pemasukan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPemasukanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pemasukan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:pemasukans,id',
        ];

    }
}
