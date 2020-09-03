<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use App\Tournament;
use App\Country;
use App\User;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class TournamentsExport implements 
FromCollection,
Responsable,
WithMapping,
WithHeadings,
WithTitle,
ShouldAutoSize,
WithDrawings,
WithStyles,
WithCustomStartCell,
WithCustomValueBinder
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;
    private $rowNumber = 0;

    public function __construct($datos)
    {
        $this->data = $datos;
    }
    public function startCell(): string
    {
        return 'A2';
    }
    // COLUMNAS A DESCARGAR
    public function map($row): array
    {
        $countries = Country::all();
        $pais      = '';
        $epic_id   = null;
        foreach ($countries as $value) {
            if($value->id == $row->country->id) {
                $pais = $value->name;
            }
        }
        (!is_null($row->epic)) ? $epic_id = $row->epic->name : $epic_id = 'SIN EPIC ID REGISTRADO';
        return [
            ++$this->rowNumber,
            $row->name . " " .$row->lastname,
            $epic_id,
            $row->email,
            $pais
        ];
    }
    // HEADINGS
    public function headings(): array
    {
        return [
            'No.',
            'Nombre',
            'EPIC ID',
            'Correo',
            'País'
        ];
    }
    
    // TITULO DE LA PESTAÑA
    public function title(): string
    {
        return 'Reporte de usuarios';
    }
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setPath(public_path('images\logo-white.png'));
        $drawing->setHeight(60)->setWidth(130);
        $drawing->setCoordinates('B1');

        return $drawing;
    }
    // ESTILOS
    public function styles(Worksheet $sheet)
    {
        $sheet->getRowDimension('1')->setRowHeight(45);
        $styleArrayHead = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '000000',
                ]
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '00000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ];
        $styleArrayHeadings = [
            'font' => [
                'bold' => true,
                'color' => [
                    'rgb' => 'ffffff'
                ]
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '007bff',
                ]
            ],
        ];
        $styleArrayRows = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '00000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ]
        ];
        $sheet->mergeCells('A1:E1');
        $sheet->getStyle('A1:E1')->applyFromArray($styleArrayHead);
        $sheet->getStyle('A2:E2')->applyFromArray($styleArrayHeadings);
        $sheet->getStyle(
            'A2:'.
            $sheet->getHighestColumn() . 
            $sheet->getHighestRow()
        )->applyFromArray($styleArrayRows);
        // HORIZONTAL
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    }

    public function bindValue(Cell $cell, $value)
    {
        $cell->setValueExplicit($value, DataType::TYPE_STRING);
        return true;
    }

    public function collection()
    {
        return $this->data;
    }
}
