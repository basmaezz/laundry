<?php

namespace App\Exports;

use App\Models\OrderTable;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class subCategoriesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return subCategory::where('categry_id',1)->with('city')->get();
        return redirect()->back();
    }

    public function map($laundry): array
    {
        $ordersCount=OrderTable::select('*')->where('laundry_id',$laundry->id)->count();
        $monthlyOrdersCount=OrderTable::select('*')->where('laundry_id',$laundry->id)->whereMonth('created_at', \Carbon\Carbon::now()->month)->count();
        $monthlyProfit=OrderTable::select('*')->where('laundry_id',$laundry->id)->Where('status_id','!=',10)->whereMonth('created_at', \Carbon\Carbon::now()->month)->sum('laundry_profit');
        return [
            $laundry->name_ar,
            $laundry->name_en,
            $laundry->address,
            $laundry->city?->name_ar,
            $laundry->urgentWash=='1'?'مستعجل':'عادى',
            $laundry->aroundClock =='1'?'طوال ليوم':'وقت محدد',
            $laundry->clock_at,
            $laundry->clock_end,
            $laundry->price,
            $laundry->approximate_duration,
            $laundry->range,
            $ordersCount,
            $monthlyOrdersCount,
            $monthlyProfit,
            $laundry->created_at->format('Y-m-d'),
        ];
    }

    public function headings(): array
    {
        return [
            ' اسم المغسله',
            'اسم المغسله باللغه الانجليزيه',
            ' الحى',
            'المدينه',
            'الغسيل السريع',
            'مده التشغيل ',
            'بدايه من',
            'الى الساعه',
            'قيمه التوصيل',
            'المده التقريبيه للغسيل',
            'نطاق التشغيل',
            'اجمالى الطلبات',
            'اجمالى الطلبات الشهريه',
            'اجمالى الربح للشهر الحالى',
            'تاريخ الاضافه'
        ];
    }

}
