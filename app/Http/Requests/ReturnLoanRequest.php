<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReturnLoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'laporan' => ['nullable', 'array'],
            'laporan.*.id_barang' => ['required', 'integer'],
            'laporan.*.jumlah_rusak' => ['nullable', 'integer', 'min:0'],
            'laporan.*.jumlah_hilang' => ['nullable', 'integer', 'min:0'],
        ];
    }
}