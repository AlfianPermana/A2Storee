<?php

namespace App\Exports;

use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PenjualanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'jumlah',
            'total',
            'created_at',
            'status',
        ];
    }
}
