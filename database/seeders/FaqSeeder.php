<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faqs = [
            [
                'question' => 'ما هو تطبيق المغاسل',
                'answer' => 'هو خدمة لطلب الغسيل من خلال الانترنت، بامكانك الطلب خلال بضع خطوات جداً بسيطة و سريعة بخلاف الطريقة التقليدية بالهاتف'
            ],[
                'question' => 'ما هي ساعات عمل؟',
                'answer' => 'نحن متواجدين 7/24 كما تعتمد أوقات التوصيل على الاوقات التي يتم تحديدها من قبل إدارات المطاعم.‎'
            ],[
                'question' => 'ما هي طريقة الدفع؟',
                'answer' => 'يمكنك الدفع عند الاستلام (نقدا) او من خلال البطاقة الإئتمانية او بطاقة مدى او من خلال المحفظة الالكترونية المتوفرة في التطبيق ‎'
            ],
        ];

        foreach ($faqs as $faq){
            Faq::create([
                'question_ar' => $faq['question'],
                'question_en' => $faq['question'],
                'answer_ar' => $faq['answer'],
                'answer_en' => $faq['answer'],
            ]);
        }
    }
}
