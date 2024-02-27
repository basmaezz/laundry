<?php

namespace App\Exports;

use App\Enums\userTypesEnum;
use App\Models\AppUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class customersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AppUser::where('user_type',userTypesEnum::Customer)->with('citiesTrashed')->orderBy('id', 'DESC')->get();

//        return redirect()->back();
    }
    public function map($customer): array
    {
        return [
            $customer->id,
            $customer->name,
            $customer->email,
            $customer->mobile,
            $customer->citiesTrashed?->name_ar,
            $customer->gender =='m'?'male':'female',
            $customer->wallet.'ريال',
            $customer->created_at->format('Y-m-d'),
        ];
    }

    public function headings(): array
    {
        return [
            ' رقم العميل',
            'اسم العميل',
            ' البريد الالكترونى',
            'الجوال',
            'المدينه',
            'النوع ',
            'المحفظه',
            'تاريخ الاضافه'
        ];
    }
}
