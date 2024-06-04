<?php

namespace App\Imports;

use App\Models\Metsltr;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;

class MetsltrImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Metsltr([
            'fecha' => $this->parseDate($row[0]),
            'gg' => $row[1] ?? null,
            'oaci' => $row[2] ?? null,
            'dd' => $row[3] ?? null,
            'ff' => $row[4] ?? null,
            'fmfm' => $row[5] ?? null,
            'vvvv' => $row[6] ?? null,
            'dv' => $row[7] ?? null,
            'ww' => $row[8] ?? null,
            'ww1' => $row[9] ?? null,
            'www' => $row[10] ?? null,
            'ns1' => $row[11] ?? null,
            'hhh1' => $row[12] ?? null,
            'cbtcu1' => $row[13] ?? null,
            'ns2' => $row[14] ?? null,
            'hhh2' => $row[15] ?? null,
            'cbtcu2' => $row[16] ?? null,
            'ns3' => $row[17] ?? null,
            'hhh3' => $row[18] ?? null,
            'cbtcu3' => $row[19] ?? null,
            'ns4' => $row[20] ?? null,
            'hhh4' => $row[21] ?? null,
            'tt' => $row[22] ?? null,
            'tbh' => $row[23] ?? null,
            'td' => $row[24] ?? null,
            'qfe' => $row[25] ?? null,
            'qnh' => $row[26] ?? null,
            'pulg_hg' => $row[27] ?? null,
            'uuu' => $row[28] ?? null,
            'notas' => $row[29] ?? null,
        ]);
    }

    private function parseDate($value)
    {
        try {
            return Carbon::createFromFormat('Y-m-d', $value)->toDateString();
        } catch (\Exception $e) {
            return null; // Manejar el caso en que la fecha no sea válida
        }
    }
}
