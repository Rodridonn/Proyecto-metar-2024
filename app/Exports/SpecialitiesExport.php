<?php

namespace App\Exports;

use App\Models\Speciality;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Facades\Excel;

class SpecialitiesExport implements FromCollection
{
    use Exportable;

    public function collection()
    {
        return Speciality::all();
    }

    public function exportExcel($fileName)
    {
        return Excel::download($this, $fileName);
    }
}