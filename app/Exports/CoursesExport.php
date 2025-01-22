<?php

namespace App\Exports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class CoursesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
     * Mengambil data dari database
     */
    public function collection()
    {
        return Course::withCount('students')->get(); // Ambil data kursus beserta jumlah mahasiswa
    }

    /**
     * Header kolom di Excel
     */
    public function headings(): array
    {
        return [
            'No',          // Nomor urut
            'Name',        // Nama kursus
            'Description', // Deskripsi kursus
            'Price',       // Harga kursus
            'Status',      // Status kursus
            'Students',    // Jumlah mahasiswa
        ];
    }

    /**
     * Mapping data untuk setiap baris
     */
    public function map($course): array
    {
        static $rowNumber = 0; 
        return [
            ++$rowNumber,              
            $course->name,             
            $course->description,      
            $course->price,            
            $course->status,           
            $course->student_count ?? 0, 
        ];
    }

    /**
     * Styling untuk worksheet
     */
    public function styles(Worksheet $sheet)
    {
        // Styling heading
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['argb' => '90EE90'], 
            ],
        ]);

        // Membuat border untuk seluruh tabel
        $sheet->getStyle('A1:F' . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'], 
                ],
            ],
        ]);

        // Kolom B dan C ga rata kiri
        $sheet->getStyle('A:F')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('C')->getAlignment()->setHorizontal('left'); 
        $sheet->getStyle('B')->getAlignment()->setHorizontal('left'); 
    }
}
