<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
   {
       $cities = [
//           [
//               'id' => '1',
//               'name_ar' => 'الرياض ',
//               'name_en' => 'Riyadh',
//           ],
//       [
//               'id' => '2',
//               'name_ar' => 'المدينة المنورة ',
//               'name_en' => 'Al Madinah Al Munawwarah',
//           ],
//          [
//               'id' => '3',
//               'name_ar' => 'مكه المكرمه',
//               'name_en' => 'Mecca',
//           ],//
//           [
//               'id' => '4',
//               'name_ar' => 'تبوك',
//               'name_en' => 'Tabuk',
//           ],          [
//            'id' => '5',
//            'name_ar' => "الرياض",
//            'name_en' => "Riyadh",
//
//        ],
//        [
//            'id' => '6',
//            'name_ar' => "حميط",
//            'name_en' => "Humayt",
//        ],
          [
            'id' => '7',
            'name_ar' => "الطائف",
            'name_en' => "At Taif",

        ],
           [
            'id' => '8',
            'name_ar' => "مكة المكرمة",
            'name_en' => "Makkah",

        ],
        [
            'id' => 9,
            'name_ar' => "حائل",
            'name_en' => "Hail",
        ],
        [
            'id' => 10,
            'name_ar' => "بريدة",
            'name_en' => "Buraidah",
        ],
        [
            'id' => 11,
            'name_ar' => "الهفوف",
            'name_en' => "Al Hafuf",
        ],
        [
            'id' => 12,
            'name_ar' => "الدمام",
            'name_en' => "Dammam",
        ],
           [
               'id' => '7',
               'name_ar' => "رجم الطيارة",
               'name_en' => "Rajm At Tayarah",
           ],
           [
               'id' => 8,
               'name_ar' => "الثميد",
               'name_en' => "Ath Thumayd",
           ],
           [
               'id' => 9,
               'name_ar' => "عسيلة",
               'name_en' => "'Usaylah",
           ],

           [
               'id' => 14,
               'name_ar' => "المدينة المنورة",
               'name_en' => "Madinah",
           ],
           [
               'id' => 15,
               'name_ar' => "ابها",
               'name_en' => "Abha",
           ],
           [
               'id' => 16,
               'name_ar' => "حالة عمار",
               'name_en' => "Halat Ammar",
           ],
           [
               'id' => 17,
               'name_ar' => "جازان",
               'name_en' => "Jazan",
           ],
           [
               'id' => 18,
               'name_ar' => "جدة",
               'name_en' => "Jeddah",

           ],
           [
               'id' => 19,
               'name_ar' => "الشايب",
               'name_en' => "Ash Shayib",

           ],
           [
               'id' => 20,
               'name_ar' => "الفوهة",
               'name_en' => "Al Fawhah",
           ],
           [
               'id' => 21,
               'name_ar' => "اللوز",
               'name_en' => "Al Lawz",

           ],
           [
               'id' => 22,
               'name_ar' => "عين الأخضر",
               'name_en' => "'Ayn Al Akhdar",

           ],
           [
               'id' => 23,
               'name_ar' => "ذات الحاج",
               'name_en' => "Dhat Al Hajj",

           ],
           [
               'id' => 24,
               'name_ar' => "المجمعة",
               'name_en' => "Al Majma'ah",

           ],
           [
               'id' => 25,
               'name_ar' => "قيال",
               'name_en' => "Qiyal",

           ],
           [
               'id' => 26,
               'name_ar' => "الاخضر",
               'name_en' => "Al Akhdar",

           ],
           [
               'id' => 27,
               'name_ar' => "البديعة",
               'name_en' => "Al Badi'ah",

           ],
           [
               'id' => 28,
               'name_ar' => "مغيرة",
               'name_en' => "Mughayrah",

           ],
           [
               'id' => 29,
               'name_ar' => "الهوجاء",
               'name_en' => "Al Hawja'",

           ],
           [
               'id' => 30,
               'name_ar' => "البديع",
               'name_en' => "Al Badi'",

           ],
           [
               'id' => 31,
               'name_ar' => "الخبر",
               'name_en' => "Al Khobar",

           ],
           [
               'id' => 32,
               'name_ar' => "ابار قنا",
               'name_en' => "Abar Qana",

           ],
           [
               'id' => 33,
               'name_ar' => "الجبعاوية",
               'name_en' => "Al Jab'awiyah",

           ],
           [
               'id' => 34,
               'name_ar' => "الحميضة",
               'name_en' => "Al Humaydah",

           ],
           [
               'id' => 35,
               'name_ar' => "البيانة",
               'name_en' => "Al Bayyanah",

           ],
           [
               'id' => 36,
               'name_ar' => "حقل",
               'name_en' => "Haql",

           ],
           [
               'id' => 37,
               'name_ar' => "الدرة",
               'name_en' => "Ad Durrah",

           ],
           [
               'id' => 38,
               'name_ar' => "الزيتة",
               'name_en' => "Az Zaytah",

           ],
           [
               'id' => 39,
               'name_ar' => "علقان",
               'name_en' => "'Alaqan",

           ],
           [
               'id' => 40,
               'name_ar' => "الوادي الجديد",
               'name_en' => "Al Wadi Al Jadid",

           ],
           [
               'id' => 41,
               'name_ar' => "مليح",
               'name_en' => "Mulayh",

           ],
           [
               'id' => 42,
               'name_ar' => "ابو الحنشان",
               'name_en' => "Abu Al Hinshan",

           ],
           [
               'id' => 43,
               'name_ar' => "مقنا",
               'name_en' => "Maqna",

           ],
           [
               'id' => 44,
               'name_ar' => "ابو قعر",
               'name_en' => "Abu Qa'ar",

           ],
           [
               'id' => 45,
               'name_ar' => "مركز العوجاء",
               'name_en' => "Markaz Al 'Awja",

           ],
           [
               'id' => 46,
               'name_ar' => "مركز العليمة",
               'name_en' => "Markaz Al 'Ulayyimah",

           ],
           [
               'id' => 47,
               'name_ar' => "حفر الباطن",
               'name_en' => "Hafar Al Batin",

           ],
           [
               'id' => 48,
               'name_ar' => "القلت",
               'name_en' => "Al Qalt",

           ],
           [
               'id' => 49,
               'name_ar' => "النظيم",
               'name_en' => "An Nadhim",

           ],
           [
               'id' => 50,
               'name_ar' => "ابن طوالة",
               'name_en' => "Ibn Tuwalah",

           ],
           [
               'id' => 51,
               'name_ar' => "الصداوي",
               'name_en' => "As Sidawi",

           ],
           [
               'id' => 52,
               'name_ar' => "ام قليب",
               'name_en' => "Umm Qulaib",

           ],
           [
               'id' => 53,
               'name_ar' => "عريفج",
               'name_en' => "Urayfij",

           ],
           [
               'id' => 54,
               'name_ar' => "ابن شرار",
               'name_en' => "Ibn Sharar",

           ],
           [
               'id' => 55,
               'name_ar' => "القيصومة",
               'name_en' => "Al Qaysumah",

           ],
           [
               'id' => 56,
               'name_ar' => "الرقعي الجديدة",
               'name_en' => "Ar Ruq'i Al Jadidah",

           ],
           [
               'id' => 57,
               'name_ar' => "ذبحة",
               'name_en' => "Dhabhah",

           ],
           [
               'id' => 58,
               'name_ar' => "الصفيري",
               'name_en' => "As Sufairy",

           ],
           [
               'id' => 59,
               'name_ar' => "الوايلية",
               'name_en' => "Al Wayliyah",

           ],
           [
               'id' => 60,
               'name_ar' => "الفيوان",
               'name_en' => "Al Fiwan",

           ],
           [
               'id' => 61,
               'name_ar' => "الحماطيات",
               'name_en' => "Al Hamatiyat",

           ],
           [
               'id' => 62,
               'name_ar' => "خميس مشيط",
               'name_en' => "Khamis Mushayt",

           ],
           [
               'id' => 63,
               'name_ar' => "الجبو",
               'name_en' => "Al Jabu",

           ],
           [
               'id' => 64,
               'name_ar' => "المسناة",
               'name_en' => "Al Masnah",

           ],
           [
               'id' => 65,
               'name_ar' => "احد رفيده",
               'name_en' => "Ahad Rifaydah",

           ],
           [
               'id' => 66,
               'name_ar' => "ام عشر الشرقية",
               'name_en' => "Umm Ishar Ash Sharqiyyah",

           ],
           [
               'id' => 67,
               'name_ar' => "القطيف",
               'name_en' => "Al Qatif",

           ],
           [
               'id' => 68,
               'name_ar' => "بوهان",
               'name_en' => "Buhan",

           ],
           [
               'id' => 69,
               'name_ar' => "السنانيات",
               'name_en' => "As Sananiyat",

           ],
           [
               'id' => 70,
               'name_ar' => "حزايا",
               'name_en' => "Hazaya",

           ],
           [
               'id' => 71,
               'name_ar' => "أكباد",
               'name_en' => "Akbad",

           ],
           [
               'id' => 72,
               'name_ar' => "بئر الحيز",
               'name_en' => "Bir Al Hayz",

           ],
           [
               'id' => 73,
               'name_ar' => "جريداء",
               'name_en' => "Jurayda",

           ],
           [
               'id' => 74,
               'name_ar' => "تيماء",
               'name_en' => "Tayma'",

           ],
           [
               'id' => 75,
               'name_ar' => "العسافية",
               'name_en' => "Al Assafiyah",

           ],
           [
               'id' => 76,
               'name_ar' => "عردة",
               'name_en' => "'Ardah",

           ],
           [
               'id' => 77,
               'name_ar' => "الكتيب",
               'name_en' => "Al Kutaib",

           ],
           [
               'id' => 78,
               'name_ar' => "بئر فجر",
               'name_en' => "Bi'r Fajr",
           ],
           [
               'id'=>79,
               'name_ar'=>"محافظة الأحساء",
               'name_en'=>"Ahsa Governorate",
           ],[
               'id'=>80,
               'name_ar'=>"أمانة الدمام",
               'name_en'=>"City of Dammam",
           ],[
               'id'=>81,
               'name_ar'=>"محافظة الخبر ",
               'name_en'=>"Khobar Governorate",
           ],[
               'id'=>82,
               'name_ar'=>"محافظة القطيف ",
               'name_en'=>"Qatif Governorate",
           ],[
               'id'=>83,
               'name_ar'=>"محافظة حفر الباطن ",
               'name_en'=>"Hafr Al Batin Governorate",
           ],[
               'id'=>84,
               'name_ar'=>"محافظة الجبيل ",
               'name_en'=>"Jubail Governorate",
           ],

        ];
       City::insert($cities);
}
}
//[
//    'id' => '2',
//    'name_ar' => "نعمي",
//    'name_en' => "Na'mi",
//
//],
//           [
//               'id' => 79,
//
//               'name_ar' => "القليبة",
//               'name_en' => "Al Qalibah",
//
//           ],
//           [
//               'id' => 80,
//               "region_id" => 4,
//               'name_ar' => "عنيزة",
//               'name_en' => "Unayzah",
//
//           ],
//           [
//               'id' => 81,
//
//               'name_ar' => "الرافعية",
//               'name_en' => "Ar Raf'iyah",
//
//           ],
//           [
//               'id' => 82,
//
//               'name_ar' => "الكبريت",
//               'name_en' => "Al Kabarit",
//
//           ],
//           [
//               'id' => 83,
//
//               'name_ar' => "رغوة",
//               'name_en' => "Raghwah",
//
//           ],
//           [
//               'id' => 84,
//
//               'name_ar' => "حمى",
//               'name_en' => "Hima",
//
//           ],
//           [
//               'id' => 85,
//
//               'name_ar' => "الزبر",
//               'name_en' => "Az Zabr",
//
//           ],
//           [
//               'id' => 86,
//
//               'name_ar' => "السفانية",
//               'name_en' => "As Saffaniyah",
//
//           ],
//           [
//               'id' => 87,
//
//               'name_ar' => "المحوى",
//               'name_en' => "Al Mahawa",
//
//           ],
//           [
//               'id' => 88,
//
//               'name_ar' => "أم غور",
//               'name_en' => "Umm Ghawr",
//
//           ],
//           [
//               'id' => 89,
//
//               'name_ar' => "قرية العليا",
//               'name_en' => "Qaryat Al 'Ulya",
//
//           ],
//           [
//               'id' => 90,
//
//               'name_ar' => "الرفيعة",
//               'name_en' => "Ar Rafi'ah",
//
//           ],
//           [
//               'id' => 91,
//
//               'name_ar' => "جرارة",
//               'name_en' => "Jarrarah",
//
//           ],
//           [
//               'id' => 92,
//
//               'name_ar' => "قرية",
//               'name_en' => "Qurayyah",
//
//           ],
//           [
//               'id' => 93,
//
//               'name_ar' => "البويبيات",
//               'name_en' => "Al Buwaybiyat",
//
//           ],
//           [
//               'id' => 94,
//
//               'name_ar' => "السعيرة",
//               'name_en' => "As Su'ayyirah",
//
//           ],
//           [
//               'id' => 95,
//
//               'name_ar' => "مناخ",
//               'name_en' => "Manakh",
//
//           ],
//           [
//               'id' => 96,
//
//               'name_ar' => "الحيرا",
//               'name_en' => "Al Hayra",
//
//           ],
//           [
//               'id' => 97,
//
//               'name_ar' => "ام الشفلح",
//               'name_en' => "Umm Ash Shifallah",
//
//           ],
//           [
//               'id' => 98,
//
//               'name_ar' => "اللهابة",
//               'name_en' => "Al Lahabah",
//
//           ],
//           [
//               'id' => 99,
//
//               'name_ar' => "الفريدة",
//               'name_en' => "Al Farridah",
//
//           ],
//           [
//               'id' => 100,
//
//               'name_ar' => "الشامية",
//               'name_en' => "Ash Shamiyah",
//
//           ],
//           [
//               'id' => 101,
//
//               'name_ar' => "العيطلية",
//               'name_en' => "Al 'Aytaliyah",
//
//           ],
//           [
//               'id' => 102,
//
//               'name_ar' => "سحمة",
//               'name_en' => "Sihmah",
//
//           ],
//           [
//               'id' => 103,
//
//               'name_ar' => "الشملول / ام عقلا",
//               'name_en' => "Ash Shamlul (Umm Aqla)",
//
//           ],
//           [
//               'id' => 104,
//
//               'name_ar' => "ام الهوشات",
//               'name_en' => "Umm Al Hawshat",
//
//           ],
//           [
//               'id' => 105,
//
//               'name_ar' => "الشيط",
//               'name_en' => "Ash Shayyit",
//           ],
//           [
//               'id' => 106,
//
//               'name_ar' => "العاذرية",
//               'name_en' => "Al 'Adhiriyah",
//
//           ],
//           [
//               'id' => 107,
//
//               'name_ar' => "الشيحية",
//               'name_en' => "Ash Shihiyah",
//
//           ],
//           [
//               'id' => 108,
//
//               'name_ar' => "حزوة / العمانية",
//               'name_en' => "Hizwah (Al Umaniyah)",
//
//           ],
//           [
//               'id' => 109,
//
//               'name_ar' => "القرعاء",
//               'name_en' => "Al Qar'a",
//
//           ],
//           [
//               'id' => 110,
//
//               'name_ar' => "اللصافة",
//               'name_en' => "Al Lisafah",
//
//           ],
//           [
//               'id' => 111,
//
//               'name_ar' => "النقيرة",
//               'name_en' => "An Nuqayrah",
//
//           ],
//           [
//               'id' => 112,
//
//               'name_ar' => "هجرة أولاد حثلين",
//               'name_en' => "Hijrat Awlad Hithlin",
//
//           ],
//           [
//               'id' => 113,
//
//               'name_ar' => "الجبيل",
//               'name_en' => "Al Jubail",
//
//           ],
//           [
//               'id' => 114,
//
//               'name_ar' => "فرزان",
//               'name_en' => "Farzan",
//
//           ],
//           [
//               'id' => 115,
//
//               'name_ar' => "النعيرية",
//               'name_en' => "An Nu'ayriyah",
//
//           ],
//           [
//               'id' => 116,
//
//               'name_ar' => "ام ضليع",
//               'name_en' => "Umm Dulay'",
//
//           ],
//           [
//               'id' => 117,
//
//               'name_ar' => "مليجة",
//               'name_en' => "Mulayjah",
//
//           ],
//           [
//               'id' => 118,
//
//               'name_ar' => "الصرار",
//               'name_en' => "As Sarrar",
//
//           ],
//           [
//               'id' => 119,
//
//               'name_ar' => "حنيذ",
//               'name_en' => "Hanidh",
//
//           ],
//           [
//               'id' => 120,
//
//               'name_ar' => "مغطي",
//               'name_en' => "Mughati",
//
//           ],
//           [
//               'id' => 121,
//
//               'name_ar' => "شفية",
//               'name_en' => "Shifiyah",
//
//           ],
//           [
//               'id' => 122,
//
//               'name_ar' => "عتيق",
//               'name_en' => "Utayyiq",
//
//           ],
//           [
//               'id' => 123,
//
//               'name_ar' => "الحسي",
//               'name_en' => "Al Husayy",
//
//           ],
//           [
//               'id' => 124,
//
//               'name_ar' => "ثاج",
//               'name_en' => "Thaj",
//
//           ],
//           [
//               'id' => 125,
//
//               'name_ar' => "الحناة",
//               'name_en' => "Al Hinnah",
//
//           ],
//           [
//               'id' => 126,
//
//               'name_ar' => "الكهفة",
//               'name_en' => "Al Kahafah",
//
//           ],
//           [
//               'id' => 127,
//
//               'name_ar' => "الصحاف",
//               'name_en' => "As Sahaf",
//
//           ],
//           [
//               'id' => 128,
//
//               'name_ar' => "العيينة",
//               'name_en' => "Al Uyainah",
//
//           ],
//           [
//               'id' => 129,
//
//               'name_ar' => "القليب",
//               'name_en' => "Al Qulayyib",
//
//           ],
//           [
//               'id' => 130,
//
//               'name_ar' => "الونان",
//               'name_en' => "Al Wannan",
//
//           ],
//           [
//               'id' => 131,
//
//               'name_ar' => "غنوى",
//               'name_en' => "Ghanwa",
//
//           ],
//           [
//               'id' => 132,
//
//               'name_ar' => "الزغين",
//               'name_en' => "Az Zughayn",
//
//           ],
//           [
//               'id' => 133,
//
//               'name_ar' => "نطاع",
//               'name_en' => "Nita'",
//
//           ],
//           [
//               'id' => 134,
//
//               'name_ar' => "ام الحمام",
//               'name_en' => "Umm Al Hamam",
//
//           ],
//           [
//               'id' => 135,
//
//               'name_ar' => "ام ربيعة",
//               'name_en' => "Umm Rubay'ah",
//
//           ],
//           [
//               'id' => 136,
//
//               'name_ar' => "ابو حدرية",
//               'name_en' => "Abu Hadriyah",
//
//           ],
//           [
//               'id' => 137,
//
//               'name_ar' => "منيفة",
//               'name_en' => "Munifah",
//
//           ],
//           [
//               'id' => 138,
//
//               'name_ar' => "الافلاج",
//               'name_en' => "Al Aflaj",
//
//           ],
//           [
//               'id' => 139,
//               "region_id" => 4,
//               'name_ar' => "خيطان",
//               'name_en' => "Khaitan",
//
//           ],
//           [
//               'id' => 140,
//
//               'name_ar' => "الوسيعة",
//               'name_en' => "Al Wasi'ah",
//
//           ],
//           [
//               'id' => 141,
//
//               'name_ar' => "تمرية",
//               'name_en' => "Tamriyah",
//
//           ],
//           [
//               'id' => 142,
//
//               'name_ar' => "ابو خسيفاء",
//               'name_en' => "Abu Khusayfa",
//
//           ],
//           [
//               'id' => 143,
//
//               'name_ar' => "النخيل",
//               'name_en' => "An Nakhil",
//
//           ],
//           [
//               'id' => 144,
//
//               'name_ar' => "السحيمي",
//               'name_en' => "As Suhaymi",
//
//           ],
//           [
//               'id' => 145,
//
//               'name_ar' => "مصدة",
//               'name_en' => "Masadah",
//
//           ],
//           [
//               'id' => 146,
//
//               'name_ar' => "أم سديرة",
//               'name_en' => "Umm Sudayrah",
//
//           ],
//           [
//               'id' => 147,
//
//               'name_ar' => "التنهاة",
//               'name_en' => "At Tanhah",
//
//           ],
//           [
//               'id' => 148,
//
//               'name_ar' => "قري التويم",
//               'name_en' => "Qura At Tuwaym",
//
//           ],
//           [
//               'id' => 149,
//
//               'name_ar' => "الشحمة",
//               'name_en' => "Ash Shahmah",
//
//           ],
//           [
//               'id' => 150,
//
//               'name_ar' => "الودي",
//               'name_en' => "Al Wuday",
//
//           ],
//           [
//               'id' => 151,
//
//               'name_ar' => "جوي",
//               'name_en' => "Juwayy",
//
//           ],
//           [
//               'id' => 152,
//
//               'name_ar' => "مقبلة",
//               'name_en' => "Muqbilah",
//
//           ],
//           [
//               'id' => 153,
//
//               'name_ar' => "حرمة",
//               'name_en' => "Harmah",
//
//           ],
//           [
//               'id' => 154,
//
//               'name_ar' => "المعظم",
//               'name_en' => "Al Ma'dham",
//
//           ],
//           [
//               'id' => 155,
//
//               'name_ar' => "جراب",
//               'name_en' => "Jirab",
//
//           ],
//           [
//               'id' => 156,
//
//               'name_ar' => "العقلة",
//               'name_en' => "Al 'Uqlah",
//
//           ],
//           [
//               'id' => 157,
//
//               'name_ar' => "النغيق",
//               'name_en' => "An Nughayq",
//
//           ],
//           [
//               'id' => 158,
//
//               'name_ar' => "حويمضة",
//               'name_en' => "Huwaimidah",
//
//           ],
//           [
//               'id' => 159,
//
//               'name_ar' => "البتيراء",
//               'name_en' => "Al Butaira'",
//
//           ],
//           [
//               'id' => 160,
//
//               'name_ar' => "المشاش",
//               'name_en' => "Al Mishash",
//
//           ],
//           [
//               'id' => 161,
//
//               'name_ar' => "الفروثي",
//               'name_en' => "Al Furuthi",
//
//           ],
//           [
//               'id' => 162,
//
//               'name_ar' => "جلاجل",
//               'name_en' => "Jalajil",
//
//           ],
//           [
//               'id' => 163,
//
//               'name_ar' => "الدخيلة",
//               'name_en' => "Ad Dakhilah",
//
//           ],
//           [
//               'id' => 164,
//
//               'name_ar' => "الحصون",
//               'name_en' => "Al Husun",
//
//           ],
//           [
//               'id' => 165,
//
//               'name_ar' => "حوطة سدير",
//               'name_en' => "Hawtat Sudair",
//
//           ],
//           [
//               'id' => 166,
//
//               'name_ar' => "روضة سدير",
//               'name_en' => "Rawdat Sudair",
//
//           ],
//           [
//               'id' => 167,
//
//               'name_ar' => "تمير",
//               'name_en' => "Tumair",
//
//           ],
//           [
//               'id' => 168,
//
//               'name_ar' => "الارطاوية",
//               'name_en' => "Al Artawiyah",
//
//           ],
//           [
//               'id' => 169,
//
//               'name_ar' => "العمار",
//               'name_en' => "Al 'Amar",
//
//           ],
//           [
//               'id' => 170,
//
//               'name_ar' => "الخيس",
//               'name_en' => "Al Khis",
//
//           ],
//           [
//               'id' => 171,
//
//               'name_ar' => "المعشبة",
//               'name_en' => "Al Ma'ashbah",
//
//           ],
//           [
//               'id' => 172,
//
//               'name_ar' => "التويم",
//               'name_en' => "At Tuwaym",
//
//           ],
//           [
//               'id' => 173,
//
//               'name_ar' => "الخطامة",
//               'name_en' => "Al Khutamah",
//
//           ],
//           [
//               'id' => 174,
//
//               'name_ar' => "رويضة بوضاء",
//               'name_en' => "Ruwaydah Buwadaa",
//
//           ],
//           [
//               'id' => 175,
//
//               'name_ar' => "الشعب",
//               'name_en' => "Ash Shi'b",
//
//           ],
//           [
//               'id' => 176,
//
//               'name_ar' => "عشيرة سدير",
//               'name_en' => "Asharat Sudair",
//
//           ],
//           [
//               'id' => 177,
//
//               'name_ar' => "الجنيفي",
//               'name_en' => "Al Junayfi",
//
//           ],
//           [
//               'id' => 178,
//
//               'name_ar' => "العطار",
//               'name_en' => "Al 'Attar",
//
//           ],
//           [
//               'id' => 179,
//
//               'name_ar' => "ام الجماجم",
//               'name_en' => "Umm Al Jamajim",
//
//           ],
//           [
//               'id' => 180,
//
//               'name_ar' => "مشلح",
//               'name_en' => "Mishlah",
//
//           ],
//           [
//               'id' => 181,
//
//               'name_ar' => "ام رجوم",
//               'name_en' => "Umm Rujum",
//
//           ],
//           [
//               'id' => 182,
//
//               'name_ar' => "الرويضة",
//               'name_en' => "Ar Ruwaydah",
//
//           ],
//           [
//               'id' => 183,
//
//               'name_ar' => "الفيصلية",
//               'name_en' => "Al Faysaliyah",
//
//           ],
//           [
//               'id' => 184,
//
//               'name_ar' => "بوضاء",
//               'name_en' => "Bawda'",
//
//           ],
//           [
//               'id' => 185,
//
//               'name_ar' => "الحائر",
//               'name_en' => "Al Hair",
//
//           ],
//           [
//               'id' => 186,
//
//               'name_ar' => "وشي",
//               'name_en' => "Wushayy",
//
//           ],
//           [
//               'id' => 187,
//
//               'name_ar' => "عودة سدير",
//               'name_en' => "'Awdat Sudayr",
//
//           ],
//           [
//               'id' => 188,
//
//               'name_ar' => "مبايض",
//               'name_en' => "Mubayid",
//
//           ],
//           [
//               'id' => 189,
//
//               'name_ar' => "القاعية",
//               'name_en' => "Al Qa'iyah",
//
//           ],
//           [
//               'id' => 190,
//
//               'name_ar' => "دبدبة فضلاء",
//               'name_en' => "Dibdibbat Fudala",
//
//           ],
//           [
//               'id' => 191,
//
//               'name_ar' => "الحجب",
//               'name_en' => "Al Hajab",
//
//           ],
//           [
//               'id' => 192,
//
//               'name_ar' => "الضلفة",
//               'name_en' => "Adh Dhalfah",
//
//           ],
//           [
//               'id' => 193,
//
//               'name_ar' => "أبو طاقة",
//               'name_en' => "Abu Taqah",
//
//           ],
//           [
//               'id' => 194,
//
//               'name_ar' => "العين الجديدة",
//               'name_en' => "Al 'Ayn Al Jadidah",
//
//           ],
//           [
//               'id' => 195,
//
//               'name_ar' => "قعرة الدومة",
//               'name_en' => "Qa'arah Al Daumah",
//
//           ],
//           [
//               'id' => 196,
//
//               'name_ar' => "أم زرب",
//               'name_en' => "Umm Zarb",
//
//           ],
//           [
//               'id' => 197,
//
//               'name_ar' => "هدية",
//               'name_en' => "Hadiyah",
//
//           ],
//           [
//               'id' => 198,
//
//               'name_ar' => "القعرة",
//               'name_en' => "Al Qa'arah",
//
//           ],
//           [
//               'id' => 199,
//
//               'name_ar' => "العلا",
//               'name_en' => "Al Ula",
//
//           ],
//           [
//               'id' => 200,
//
//               'name_ar' => "الجهراء",
//               'name_en' => "Al Jahara",
//
//           ],
//           [
//               'id' => 201,
//
//               'name_ar' => "رحيب",
//               'name_en' => "Ruhayb",
//
//           ],
//           [
//               'id' => 202,
//
//               'name_ar' => "شلال",
//               'name_en' => "Shalal",
//
//           ],
//           [
//               'id' => 203,
//
//               'name_ar' => "ضاعا",
//               'name_en' => "Da'a",
//
//           ],
//           [
//               'id' => 204,
//
//               'name_ar' => "جيدة",
//               'name_en' => "Jaydah",
//
//           ],
//           [
//               'id' => 205,
//
//               'name_ar' => "قلبان عشرة",
//               'name_en' => "Qulban 'Isharah",
//
//           ],
//           [
//               'id' => 206,
//
//               'name_ar' => "النجيل",
//               'name_en' => "An Najil",
//
//           ],
//           [
//               'id' => 207,
//
//               'name_ar' => "الرزيقية",
//               'name_en' => "Ar Ruzayqiyah",
//
//           ],
//           [
//               'id' => 208,
//
//               'name_ar' => "الحميدية",
//               'name_en' => "Al Hamidiyah",
//
//           ],
//           [
//               'id' => 209,
//
//               'name_ar' => "صدر",
//               'name_en' => "Sadr",
//
//           ],
//           [
//               'id' => 210,
//
//               'name_ar' => "مغيراء",
//               'name_en' => "Mughayra'",
//
//           ],
//           [
//               'id' => 211,
//
//               'name_ar' => "قصيب ابو سيال",
//               'name_en' => "Qusayb Abu Siyal",
//
//           ],
//           [
//               'id' => 212,
//
//               'name_ar' => "ابو اراكة",
//               'name_en' => "Abu Arakah",
//
//           ],
//           [
//               'id' => 213,
//
//               'name_ar' => "مدائن الصالح",
//               'name_en' => "Madain As Salih",
//
//           ],
//           [
//               'id' => 214,
//
//               'name_ar' => "عورش",
//               'name_en' => "Awarsh",
//
//           ],
//           [
//               'id' => 215,
//
//               'name_ar' => "النشيفة",
//               'name_en' => "An Nushayfah",
//
//           ],
//           [
//               'id' => 216,
//
//               'name_ar' => "الزباير",
//               'name_en' => "Az Zubayir",
//
//           ],
//           [
//               'id' => 217,
//
//               'name_ar' => "الضليعة",
//               'name_en' => "Ad Dulay'ah",
//
//           ],
//           [
//               'id' => 218,
//
//               'name_ar' => "متان العريقة",
//               'name_en' => "Mitan Al 'Urayqah",
//
//           ],
//           [
//               'id' => 219,
//
//               'name_ar' => "الابرق",
//               'name_en' => "Al Abraq",
//
//           ],
//           [
//               'id' => 220,
//
//               'name_ar' => "اميرة",
//               'name_en' => "Amirah",
//           ],
//           [
//               'id' => 221,
//
//               'name_ar' => "الجديدة",
//               'name_en' => "Al Jadidah",
//
//           ],
//           [
//               'id' => 222,
//
//               'name_ar' => "كتيفة مصادر",
//               'name_en' => "Kutayfat Masadir",
//
//           ],
//           [
//               'id' => 223,
//
//               'name_ar' => "الراس",
//               'name_en' => "Ar Ras",
//
//           ],
//           [
//               'id' => 224,
//
//               'name_ar' => "البيت",
//               'name_en' => "Al Bayt",
//
//           ],
//           [
//               'id' => 225,
//
//               'name_ar' => "بئر بحار",
//               'name_en' => "Bir Bahar",
//
//           ],
//           [
//               'id' => 226,
//
//               'name_ar' => "سبحان",
//               'name_en' => "Sabhan",
//
//           ],
//           [
//               'id' => 227,
//
//               'name_ar' => "الظهران",
//               'name_en' => "Dhahran",
//
//           ],
//           [
//               'id' => 228,
//
//               'name_ar' => "أم الريح",
//               'name_en' => "Umm Ar Rih",
//
//           ],
//           [
//               'id' => 229,
//
//               'name_ar' => "حرم",
//               'name_en' => "Haram",
//
//           ],
//           [
//               'id' => 230,
//
//               'name_ar' => "عكوز",
//               'name_en' => "'Akuz",
//
//           ],
//           [
//               'id' => 231,
//
//               'name_ar' => "السديد",
//               'name_en' => "As Sudayd",
//
//           ],
//           [
//               'id' => 232,
//
//               'name_ar' => "الحفيرة",
//               'name_en' => "Al Hufayrah",
//
//           ],
//           [
//               'id' => 233,
//
//               'name_ar' => "الوجه",
//               'name_en' => "Al Wajh",
//
//           ],
//           [
//               'id' => 234,
//
//               'name_ar' => "النابع",
//               'name_en' => "An Nabi'",
//
//           ],
//           [
//               'id' => 235,
//
//               'name_ar' => "عنتر",
//               'name_en' => "'Antar",
//
//           ],
//           [
//               'id' => 236,
//
//               'name_ar' => "المنجور",
//               'name_en' => "Al Manjur",
//
//           ],
//           [
//               'id' => 237,
//
//               'name_ar' => "ابا القزاز",
//               'name_en' => "Aba Al Qizaz",
//
//           ],
//           [
//               'id' => 238,
//
//               'name_ar' => "بداء",
//               'name_en' => "Bada'",
//
//           ],
//           [
//               'id' => 239,
//
//               'name_ar' => "خرباء",
//               'name_en' => "Khurba'",
//
//           ],
//           [
//               'id' => 240,
//
//               'name_ar' => "الكر",
//               'name_en' => "Al Kurr",
//
//           ],
//           [
//               'id' => 241,
//
//               'name_ar' => "برق الأسيدية",
//               'name_en' => "Burq Al Usaydiyah",
//
//           ],
//           [
//               'id' => 242,
//
//               'name_ar' => "الفاضلي",
//               'name_en' => "Al Fadili",
//
//           ],
//           [
//               'id' => 243,
//
//               'name_ar' => "بقيق",
//               'name_en' => "Buqayq",
//
//           ],
//           [
//               'id' => 244,
//
//               'name_ar' => "قرية",
//               'name_en' => "Qurayyah",
//
//           ],
//           [
//               'id' => 245,
//
//               'name_ar' => "ظلوم",
//               'name_en' => "Dhulum",
//
//           ],
//           [
//               'id' => 246,
//
//               'name_ar' => "عين دار الجديده",
//               'name_en' => "New 'Ayn  Dar",
//
//           ],
//           [
//               'id' => 247,
//
//               'name_ar' => "عين دار القديمة",
//               'name_en' => "Old 'Ayn  Dar",
//
//           ],
//           [
//               'id' => 248,
//
//               'name_ar' => "علاة",
//               'name_en' => "Allat",
//
//           ],
//           [
//               'id' => 249,
//
//               'name_ar' => "فودة",
//               'name_en' => "Fudah",
//
//           ],
//           [
//               'id' => 250,
//
//               'name_ar' => "الكدادية",
//               'name_en' => "Al Kadadiyah",
//
//           ],
//           [
//               'id' => 251,
//
//               'name_ar' => "يكرب",
//               'name_en' => "Yakrub",
//
//           ],
//           [
//               'id' => 252,
//
//               'name_ar' => "الجابرية",
//               'name_en' => "Al Jabiriyah",
//
//           ],
//           [
//               'id' => 253,
//
//               'name_ar' => "صلاصل",
//               'name_en' => "Salasil",
//
//           ],
//           [
//               'id' => 254,
//
//               'name_ar' => "شهيلاء",
//               'name_en' => "Shuhayla'",
//
//           ],
//           [
//               'id' => 255,
//               'name_ar' => "عصيفرات",
//               'name_en' => "Usayfirat",
//           ],
//           [
//               'id' => 256,
//
//               'name_ar' => "طريب",
//               'name_en' => "Tarib",
//
//           ],
//           [
//               'id' => 257,
//
//               'name_ar' => "الدغيمية",
//               'name_en' => "Ad Dughaymiyah",
//
//           ],
//           [
//               'id' => 258,
//
//               'name_ar' => "الروضة",
//               'name_en' => "Ar Rawdah",
//
//           ],
//           [
//               'id' => 259,
//
//               'name_ar' => "المنسف",
//               'name_en' => "Al Mansaf",
//
//           ],
//           [
//               'id' => 260,
//
//               'name_ar' => "منسية الغربية",
//               'name_en' => "Mansiyah Al Gharbiyah",
//
//           ],
//           [
//               'id' => 261,
//
//               'name_ar' => "عشيرة",
//               'name_en' => "'Ushayrah",
//
//           ],
//           [
//               'id' => 262,
//
//               'name_ar' => "الفيصلية",
//               'name_en' => "Al Faysaliyah",
//
//           ],
//           [
//               'id' => 263,
//
//               'name_ar' => "الثوير",
//               'name_en' => "Ath Thuwayr",
//
//           ],
//           [
//               'id' => 264,
//
//               'name_ar' => "زليغف",
//               'name_en' => "Zulayghif",
//
//           ],
//           [
//               'id' => 265,
//
//               'name_ar' => "مزارع الاثلة",
//               'name_en' => "Mazari' Al Athlah",
//
//           ],
//           [
//               'id' => 266,
//
//               'name_ar' => "مزارع الرحية",
//               'name_en' => "Mazari' Ar Ruhayyah",
//
//           ],
//           [
//               'id' => 267,
//
//               'name_ar' => "قصيباء",
//               'name_en' => "Qusayba",
//
//           ],
//           [
//               'id' => 268,
//
//               'name_ar' => "مزرعة بيضاء نثيل",
//               'name_en' => "Mazra'at Bayda Nuthayl",
//
//           ],
//           [
//               'id' => 269,
//
//               'name_ar' => "امارة المستوي",
//               'name_en' => "Imarat Al Mistawi",
//
//           ],
//           [
//               'id' => 270,
//
//               'name_ar' => "الزلفي",
//               'name_en' => "Az Zulfi",
//
//           ],
//           [
//               'id' => 271,
//
//               'name_ar' => "سمنان",
//               'name_en' => "Samnan",
//           ],
//
//           [
//               'id' => 272,
//
//               'name_ar' => "علقة",
//               'name_en' => "'Iliqah",
//               "center" => [
//                   26.33916997,
//                   44.78377995
//               ]
//           ],
//           [
//               'id' => 273,
//
//               'name_ar' => "العين",
//               'name_en' => "Al 'Ayn",
//
//           ],
//           [
//               'id' => 274,
//
//               'name_ar' => "المضاويح",
//               'name_en' => "Al Mudhawih",
//
//           ],
//           [
//               'id' => 275,
//
//               'name_ar' => "ابا البقر",
//               'name_en' => "Aba Al Baqar",
//
//           ],
//           ];
