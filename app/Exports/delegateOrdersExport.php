<?php

namespace App\Exports;

use App\Models\DeliveryHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class delegateOrdersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }
    public function collection()
    {
         $order=DeliveryHistory::with(['order','order.userTrashed','order.subCategoriesTrashed'])->where('user_id',$this->id)->orderBy('id', 'DESC')->get();
         dd($order);
    }
    public function map($order): array

    {
        return [
          $order->order_id,
          $order->subCategoriesTrashed->name_ar,
          $order->userTrashed->id,
          $order->userTrashed->name,
          $order->direction,
          $order->subCategoriesTrashed->price,
          $order->created_at->format('Y-m-d'),
        ];
    }

    public function headings(): array

    {
       return [
           ' رقم الطلب',
           ' اسم المغسله',
           ' رقم العميل',
           'اسم العميل',
           'اتجاه الطلب',
           'سعر التوصيل',
           'التاريخ',

       ];
    }
}
