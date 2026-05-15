<x-app-layout>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap');

            .patient-bg {
                font-family: 'Tajawal', sans-serif;
                background-color: #f8fafc;
                min-height: 90vh;
            }
            .appointment-card {
                border: none;
                border-radius: 18px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
                transition: all 0.2s ease-in-out;
                background: #ffffff;
            }
            .appointment-card:hover {
                transform: scale(1.01);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.04);
            }
            .doctor-img-placeholder {
                width: 60px;
                height: 60px;
                object-fit: cover;
                border: 2px solid #e2e8f0;
            }
            .badge-status-lg {
                padding: 8px 16px;
                border-radius: 50px;
                font-weight: 700;
                font-size: 0.85rem;
            }
        </style>
    </head>

    <div class="patient-bg py-5" dir="rtl">
        <div class="container">

            <div class="d-flex align-items-center justify-content-between mb-5">
                <div>
                    <h2 class="h3 fw-bold text-dark mb-1">حجوزاتي الطبية</h2>
                    <p class="text-muted mb-0 small">تابع حالة طلبات الحجز الخاصة بك ومواعيد الكشف الحالية.</p>
                </div>
                <a href="{{ route('doctors.index') }}" class="btn btn-outline-primary rounded-3 btn-sm fw-bold px-3 py-2">
                    <i class="bi bi-plus-lg me-1"></i> حجز موعد جديد
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 rounded-3 shadow-sm mb-4 d-flex align-items-center gap-2" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <div class="row g-4">
                @forelse($appointments as $app)
                    <div class="col-12 col-lg-10 mx-auto">
                        <div class="card appointment-card p-4">
                            <div class="row align-items-center g-3">

                                <div class="col-12 col-md-5 d-flex align-items-center gap-3">
                                    <img src="{{ $app->doctor->photo ? asset('storage/' . $app->doctor->photo) : 'https://cdn-icons-png.flaticon.com/512/3774/3774299.png' }}"
                                         alt="{{ $app->doctor->name }}"
                                         class="doctor-img-placeholder rounded-circle">
                                    <div>
                                        <h4 class="h6 fw-bold text-dark mb-1">دكتور. {{ $app->doctor->name }}</h4>
                                        <span class="text-muted small d-block"><i class="bi bi-tags me-1"></i> {{ $app->doctor->specialization ?? 'ممارس عام' }}</span>
                                    </div>
                                </div>

                                <div class="col-6 col-md-3">
                                    <small class="text-muted d-block mb-1" style="font-size: 0.75rem;">تاريخ وموعد الكشف</small>
                                    <span class="fw-bold text-secondary" style="font-size: 0.95rem;">
                                        <i class="bi bi-calendar-check me-1 text-primary"></i> {{ $app->appointment_date }}
                                    </span>
                                </div>

                                <div class="col-6 col-md-2">
                                    <small class="text-muted d-block mb-1" style="font-size: 0.75rem;">قيمة الكشف</small>
                                    <span class="fw-bold text-emerald text-success" style="font-size: 0.95rem;">
                                        {{ $app->doctor->fees }} ج.م
                                    </span>
                                </div>

                                <div class="col-12 col-md-2 text-md-center">
                                    @if($app->status == 'accepted')
                                        <span class="badge-status-lg bg-success-subtle text-success d-inline-block w-100 text-center">
                                            <i class="bi bi-check-circle-fill me-1"></i> تم القبول
                                        </span>
                                    @elseif($app->status == 'rejected')
                                        <span class="badge-status-lg bg-danger-subtle text-danger d-inline-block w-100 text-center">
                                            <i class="bi bi-x-circle-fill me-1"></i> تم الرفض
                                        </span>
                                    @else
                                        <span class="badge-status-lg bg-warning-subtle text-warning d-inline-block w-100 text-center">
                                            <i class="bi bi-hourglass-split me-1"></i> قيد الانتظار
                                        </span>
                                    @endif
                                </div>

                            </div>

                            @if($app->notes)
                                <div class="mt-3 pt-3 border-top opacity-75">
                                    <small class="text-muted d-block mb-1" style="font-size: 0.75rem;">ملاحظاتك للطبيب:</small>
                                    <p class="text-secondary small mb-0 bg-light p-2 rounded-3" style="font-size: 0.85rem;">
                                        <i class="bi bi-chat-right-quote me-1 text-secondary"></i> {{ $app->notes }}
                                    </p>
                                </div>
                            @endif

                        </div>
                    </div>
                @empty
                    <div class="col-12 col-lg-10 mx-auto text-center py-5 bg-white rounded-4 shadow-sm border">
                        <div class="text-muted mb-3"><i class="bi bi-emoji-neutral fs-1 opacity-50"></i></div>
                        <h4 class="h5 fw-bold text-secondary">لا توجد لديك أي حجوزات بعد</h4>
                        <p class="text-muted small">يمكنك تصفح قائمة الأطباء المتميزين والبدء في حجز موعدك الأول الآن.</p>
                        <a href="{{ route('doctors.index') }}" class="btn btn-primary rounded-3 px-4 mt-2 fw-bold">
                            تصفح الأطباء الآن
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
