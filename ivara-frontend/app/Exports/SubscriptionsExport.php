<?php

namespace App\Exports;

use App\Models\Subscription;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubscriptionsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Subscription::with('user')->get()->map(function($sub) {
            return [
                'ID' => $sub->id,
                'User Name' => $sub->user->name ?? '-',
                'Email' => $sub->email,
                'Plan' => $sub->plan,
                'Price' => $sub->price,
                'Status' => $sub->status,
                'Start Date' => $sub->start_date,
                'End Date' => $sub->end_date,
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'User Name', 'Email', 'Plan', 'Price', 'Status', 'Start Date', 'End Date'];
    }
}
