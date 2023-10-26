<?php

namespace App\Exports;

use App\Models\OrderTable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ordersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return OrderTable::with(['payments', 'histories','subCategoriesTrashed','userTrashed','userTrashed.citiesTrashed'])
            ->with('orderDetails')
            ->with(['orderDetails.productService:id,commission'])
            ->orderBy('id', 'DESC')
            ->get();

    }
    public function map($order): array
    {
        return [
            $order->id,
            $order->subCategoriesTrashed->name_ar,
            $order->userTrashed->id,
            $order->userTrashed->name,
            $order->urgent=='1'?'مستعجل':'عادى',
            $order->total_price,
            $order->sum_price-($order->sum_price *$order->subCategoriesTrashed->percentage)/100,
            ($order->sum_price *$order->subCategoriesTrashed->percentage)/100,
            $order->total_commission,
            $order->subCategoriesTrashed->price,
            $order->delivery_type=='1' ? 'استلام بواسطه العميل':'استلام بواسطه المندوب',
            $order->userTrashed->citiesTrashed->name_ar,
            $order->created_at->format('Y-m-d')??'',
        ];
    }

    public function headings(): array
    {
        return [
            'رقم الطلب',
            'اسم المغسله',
            ' رقم العميل',
            ' اسم العميل',
            ' نوع الطلب',
            'القيمه الاجماليه',
            ' ربح المغسلهه',
            ' ربح التطبيق',
            'العموله',
            'قيمه التوصيل',
            ' نوع التوصيل',
            'المدينه',
            'تاريخ الطلب',
        ];
    }
}
