<?php
return [
    'vat' => env('VAT_VALUE', 0.15),
    'max_order' => env('MAX_ORDER', 3),
    'distance'=>[
        'in_area' => 10,
        'away_area' => 20,
        'out_area' => 30
    ],
    'delete_reason' => [
        ['id'=> '1', 'title'=>'أواجه مشكلة في التعامل مع واجة التطبيق'],
        ['id'=> '2', 'title'=>'يوجد مشكلة مع تقديم الخدمة من قبل المندوب'],
        ['id'=> '3', 'title'=>'يواجه مشكلة في التواصل مع المندوب'],
        ['id'=> '4', 'title'=>'اسباب أخري'],
    ],
    'rejection_reason' => [
        ['id'=> '1', 'title'=>'ليس لدي الوقت لتنفيذ الطلب'],
        ['id'=> '2', 'title'=>'المكان غير مناسب'],
        ['id'=> '3', 'title'=>'اسباب أخري'],
    ]
];
