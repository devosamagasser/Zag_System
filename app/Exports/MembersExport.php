<?php

namespace App\Exports;

use App\Traits\MembersTrait;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MembersExport implements FromView ,WithStyles
{
    use MembersTrait;

    public function view(): View
    {
        $members = $this->filterConditions();
        return view('members.export',compact('members'));
    }

    public function styles(Worksheet $sheet)
    {
        // Apply styles to the first row (header)
        $sheet->getStyle('1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 20,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '000000'],
            ],
            'alignment' => [
                'horizontal' => 'center',
            ],
        ]);

        // Loop through rows to apply striped effect
        $highestRow = $sheet->getHighestRow();
        for ($row = 2; $row <= $highestRow; $row++) { // Start from the second row
            if ($row % 2 == 0) { // Apply style to every even row
                $sheet->getStyle($row)->applyFromArray([
                    'fill' => [
                        'fillType' => 'solid',
                        'startColor' => ['rgb' => 'F0F0F0'], // Light grey color for stripe
                    ],
                ]);
            }
        }

        return [];
    }
}
