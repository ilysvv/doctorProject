<x-app-layout>
    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-lg font-bold mb-4">طلبات الحجز الواردة</h3>

                @if($appointments->isEmpty())
                    <div class="text-center py-10 text-gray-500">
                        لا توجد حجوزات حالياً.
                    </div>
                @else
                    <table class="w-full text-right">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="p-3">اسم المريض</th>
                            <th class="p-3">التاريخ</th>
                            <th class="p-3">الملاحظات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appointments as $appointment)
                            <tr class="border-b">
                                <td class="p-3">{{ $appointment->user->name }}</td>
                                <td class="p-3">{{ $appointment->appointment_date }}</td>
                                <td class="p-3">{{ $appointment->notes }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
