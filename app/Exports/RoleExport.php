<?php

namespace App\Exports;

//use App\Models\Role;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;

class RoleExport implements FromCollection, Responsable
{
    use Exportable;
    private $fileName = 'roles.xlsx';
    private $writerType = Excel::XLSX;
    
    public function collection()
    {
        return Role::all();
    }
}
