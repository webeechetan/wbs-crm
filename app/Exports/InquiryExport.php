<?php

namespace App\Exports;

use App\Models\Inquiry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class InquiryExport implements FromCollection , WithHeadings, withstyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $inquiries;
    public function collection()
    {

        //dd('collection');
        // $inquiries = Inquiry::all(); // Fetch all inquiries

        $inquiries = Inquiry::select('inquiries.*') 
            ->whereIn('id', function($query) {
                $query->selectRaw('MAX(id)')
                      ->from('inquiries')
                      ->groupBy('email'); 
            })
            ->orderBy('created_at', 'desc') 
            ->get();

        $data = [];

        foreach($inquiries as $inquiry){

            // $createdAtFormatted = Carbon::parse($inquiry->created_at)
            // ->format('j F Y h:i A');

            $createdAtFormatted = Carbon::parse($inquiry->created_at)->format('j F Y');
            $rowData = [
                'created_at' => $createdAtFormatted,  
                'first_name' => $inquiry->first_name,
                'company_name' => $inquiry->company_name,
                'requirements' => $inquiry->requirements,
                'budget' => $inquiry->budget,
                'L1' => $inquiry->L1,
                'lead_status' => $inquiry->lead_status,
                'lead_source' => $inquiry->lead_source,
                'phone' => $inquiry->phone,
                'email' => $inquiry->email,
                'L1_minutes' => $inquiry->L1_minutes,             
            ];

            $data[] = $rowData;
        }

        return collect($data);

         
    }

    public function headings(): array
    {
        return [
            
            'Date',
            'Name',
            'Company',
            'Requirements',
            'Budget',
            'L1',
            'Status',
            'Source',
            'Contact',
            'Email',
            'L1 Minutes',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:ZZ1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}
