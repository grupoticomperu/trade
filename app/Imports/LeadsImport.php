<?php

namespace App\Imports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; // para usar encabezados
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class LeadsImport implements ToModel, WithHeadingRow, WithValidation
{

    public function model(array $row)
    {
        return new Lead([
            'fechaderivacion'     => $this->transformDate($row['fechaderivacion']),
            'fecha'               => $this->transformDate($row['fecha']),
            'nombres'             => $row['nombres'] ?? null,
            'telefono'            => $row['telefono'] ?? null,
            'correoelectronico'   => $row['correoelectronico'] ?? null,
            'marca'               => $row['marca'] ?? null,
            'modelo'              => $row['modelo'] ?? null,
            'anio'                => $row['anio'] ?? null,
            'kilometraje'         => $row['kilometraje'] ?? null,
            'placa'               => $row['placa'] ?? null,
            'state'               => $row['state'] ?? null,
            'user_id'             => $row['user_id'] ?? null,
            'tipomarketing_id'    => $row['tipomarketing_id'] ?? null,
        ]);
    }


    private function transformDate($value)
    {
        try {
            if (is_numeric($value)) {
                return Date::excelToDateTimeObject($value)->format('Y-m-d');
            }
            return \Carbon\Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null; // O lanzar error si prefieres
        }
    }



    public function rules(): array
    {
        return [
            '*.correoelectronico' => 'nullable|email',
            '*.user_id' => 'nullable|exists:users,id',
            '*.tipomarketing_id' => 'nullable|exists:tipomarketings,id',
        ];
    }
}
