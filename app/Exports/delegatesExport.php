<?php

namespace App\Exports;

use App\Models\Delegate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class delegatesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        return Delegate::with(['appUserTrashed','bank','carType','appUserTrashed.citiesTrashed','nationality','year'])->get();
        return  redirect()->back();
//        dd ($delegates->carType->name_en);
    }
    public function map($delegate): array
    {
        return [
            $delegate->id,
            $delegate->appUserTrashed->name ??'',
            $delegate->appUserTrashed?->citiesTrashed?->name_ar,
            $delegate->nationality->name_ar ?? '',
            $delegate->request_employment==0 ?'موظف':'عامل حر',
            $delegate->deliver_carpet==1 ?'نعم':'لا',
            $delegate->id_number,
            $delegate->identity_expiration_date,
            $delegate->bank->name_ar??'',
            $delegate->iban_number,
            $delegate->car_plate_letter.' | '. $delegate->car_plate_number,
            $delegate->carType?->name_ar,
            $delegate->year->name,
            $delegate->license_end_date,
            $delegate->appUserTrashed?->status=='deactivated'?'غير مفعل':'مفعل',
            $delegate->created_at->format('Y-m-d'),
        ];
    }

    public function headings(): array
    {
        return [
            'الرقم التسلسلى',
            'الاسم',
            ' المدينه',
            'الجنسيه',
            'نوع التعاقد',
            'توصيل سجاد ',
            'رقم الهويه الوطنيه/الاقامه  ',
            'تاريخ انتهاء الهويه الوطنيه/الاقامه  ',
            'البنك  ',
            'رقم الحساب البنكى (IBAN) ',
            'بيانات لوحه السياره',
            'نوع السياره ',
            'موديل السياره',
            'تاريخ انتهاء الرخصه',
            'الحاله',
            'تاريخ الالتحاق'
        ];
    }
}
