<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Ventas;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromCollection, ShouldAutoSize, WithHeadings, WithEvents
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $repa = Ventas::all();

        foreach ($repa as $rep) {

            $Users = User::find($rep->Usuario_Id);
            if ($rep->Usuario_Id == $Users->id) {
                $rep->Usuario_Id = $Users->Nombre;
            }
        }
        return $repa;
    }

    public function headings(): array
    {
        return [
            'id',
            'Fecha',
            'Total',
            'Creado',
            'Actualizado',
            'Usuario',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:F1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);
            }
        ];
    }
}
