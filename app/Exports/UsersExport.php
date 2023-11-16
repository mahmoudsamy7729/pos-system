<?php

namespace App\Exports;

use App\Models\PosInvoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class UsersExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        return PosInvoice::all();
    }
    public function headings(): array
    {
        return ["your", "headings", "here"];
    }
}