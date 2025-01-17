<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
//use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;



class UserExport implements FromCollection, Responsable
{
    use Exportable;
    private $fileName = 'users.xlsx';
    private $writerType = Excel::XLSX;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }
}
