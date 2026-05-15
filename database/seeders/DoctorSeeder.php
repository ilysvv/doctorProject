<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        // بيانات الدكاترة (مرة واحدة فقط لكل دكتور)
        Doctor::updateOrCreate(['name' => 'د. أحمد رضا'], [
            'specialization' => 'علاج طبيعي',
            'bio' => 'استشاري العلاج الطبيعي بمستشفيات جامعة المنصورة.',
            'fees' => 300.00,
        ]);

        Doctor::updateOrCreate(['name' => 'د. علي هشام'], [
            'specialization' => 'طب الأنف والأذن والحنجرة',
            'bio' => 'استشاري طب الأنف والأذن والحنجرة.',
            'fees' => 200.00,
        ]);

        Doctor::updateOrCreate(['name' => 'د. أحمد حسين'], [
            'specialization' => 'طب المخ والأعصاب',
            'bio' => 'استشاري جراحة المخ والأعصاب.',
            'fees' => 250.00,
        ]);
    }
}
