<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('لوحة التحكم') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(auth()->user()->role === 'doctor')
                    <!-- واجهة الدكتور -->
                    <h3 class="text-lg font-bold text-blue-500">مرحباً دكتور {{ auth()->user()->name }}</h3>
                    <p class="mt-4 text-gray-600 dark:text-gray-400">هنا ستظهر قائمة الحجوزات المطلوبة منك لإدارتها.</p>
                    <a href="#" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">عرض حجوزات المرضى</a>

                @else
                    <!-- واجهة المريض -->
                    <h3 class="text-lg font-bold text-green-500">مرحباً بك يا {{ auth()->user()->name }}</h3>
                    <p class="mt-4 text-gray-600 dark:text-gray-400">يمكنك البحث عن طبيب وحجز موعد جديد من هنا.</p>
                    <a href="{{ route('doctors.index') }}" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded">بحث عن دكتور</a>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
