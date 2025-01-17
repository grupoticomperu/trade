<?php

namespace App\Exports;

//use App\Models\Permission;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
//use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;

class PermissionExport implements FromCollection, Responsable
{
    
    use Exportable;
    private $fileName = 'permissions.xlsx';
    private $writerType = Excel::XLSX;

    public function collection()
    {
        return Permission::all();
    }
}
