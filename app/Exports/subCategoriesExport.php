<?php

namespace App\Exports;

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

//        $result = subCategory::with('city:id,name_en As cityName')->select('name_ar','name_en','city_id','address',DB::raw('(CASE
//                        WHEN subcategories.urgentWash = "0" THEN "عادى"
//                        WHEN subcategories.urgentWash = "1" THEN "مستعجل"
//                        END) AS urgentWash'),DB::raw('(CASE
//                        WHEN subcategories.around_clock = "1" THEN "طوال اليوم"
//                        WHEN subcategories.around_clock = "0" THEN "وقت محدد"
//                        END) AS aroundClock'),'price','approximate_duration','range','created_at')->get();

        return subCategory::with('city')->get();
        return redirect()->back();
    }

    public function map($laundry): array
    {
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
            'تاريخ الاضافه'
        ];
    }

}
