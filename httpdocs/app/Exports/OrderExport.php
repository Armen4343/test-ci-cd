<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings
{
    private Collection $orders;

    public function __construct(Collection $orders)
    {
        $this->orders = $orders;
    }

    /**
    * @return Collection
    */
    public function collection(): Collection
    {
        $this->orders->map(function ($order) {
            unset($order['id']);
            return $order;
        });
        return $this->orders;
    }

    public function headings(): array
    {
        return [
            'Order Number',
            'Customer Name',
            'Collection Time',
            'Payment Method',
            'Delivery Date',
            'Delivery Time',
            'Total',
            'Collected',
        ];
    }
}
