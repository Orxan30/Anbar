<?php

namespace App\Exports;

use App\Models\clients;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportClient implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return clients::all();
    }
}
