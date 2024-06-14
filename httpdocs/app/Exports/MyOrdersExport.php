<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MyOrdersExport implements FromCollection, WithHeadings
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
        $this->orders = $this->orders->map(function ($order) {
            unset($order['id']);
            $diff = $order->collected === 'yes' ? Carbon::parse($order->collectiontime)->diffForHumans($order->creditcardtime) : '';
            return [
                'order_number' => $order->order_number,
                'items' => $order->itemsName,
                'name' => $order->name,
                'vendorName' => $order->vendorName,
                'vendorState' => $order->vendorState,
                'order_date' => $order->delivery_date . ' ' . $order->delivery_time,
                'payment_type' => $order->payment_type,
                'sales_tax' => '0',
                'total' => $order->total,
                'status' => $order->status,
                'collectionTime' => $order->collectionTime,
                'diff' => $diff
            ];
        });
        return $this->orders;
    }

    public function headings(): array
    {
        return [
            'Order Number',
            'Items',
            'Buyer Name',
            'Vendor Name',
            'Vendor State',
            'Order Date',
            'Payment Type',
            'Sales Tax',
            'Total',
            'Status',
            'Date and Time',
            'Difference between orders and collection',
        ];
    }
}
