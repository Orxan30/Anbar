<?php

namespace App\Exports;

use App\Models\planner;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportPlanner implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return planner::all();
    }
}
