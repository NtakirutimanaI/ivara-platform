<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Booking;

class BookingsExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of bookings for Excel export.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Booking::with('client', 'service', 'technician')
            ->get()
            ->map(function($booking) {
                return [
                    'ID' => $booking->id,
                    'Client' => $booking->client->name ?? 'N/A',
                    'Service' => $booking->service->name ?? 'N/A',
                    'Price (RWF)' => $booking->service->price ?? 0,
                    'Status' => $booking->status,
                    'Technician' => $booking->technician->name ?? '-',
                    'Created At' => $booking->created_at->format('d M Y H:i'),
                ];
            });
    }

    /**
     * Define the headings for the Excel sheet.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Client',
            'Service',
            'Price (RWF)',
            'Status',
            'Technician',
            'Created At'
        ];
    }
}
