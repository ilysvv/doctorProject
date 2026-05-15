<x-app-layout>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap');

            .doctors-bg {
                font-family: 'Tajawal', sans-serif;
                background-color: #f8fafc;
                min-height: 90vh;
            }
            .doctor-card {
                border: none;
                border-radius: 20px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
                transition: all 0.3s ease;
                background: #ffffff;
            }
            .doctor-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            }
            .doctor-avatar {
                width: 85px;
                height: 85px;
                object-fit: cover;
                border: 3px solid #f1f5f9;
            }
            .btn-action {
                border-radius: 12px;
                padding: 10px 20px;
                font-weight: 700;
                font-size: 0.9rem;
            }
            .btn-view-appointments {
                transition: all 0.2s ease-in-out;
            }
            .btn-view-appointments:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(13, 110, 253, 0.15);
            }
        </style>
    </head>

    <div class="doctors-bg py-5" dir="rtl">
        <div class="container">

            <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3 mb-5">
                <div>
                    <h2 class="h3 fw-bold text-dark mb-1">الأطباء المتاحون</h2>
                    <p class="text-muted mb-0 small">تصفح نخبة من أفضل الأطباء والاستشاريين واحجز موعدك فوراً.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('appointments.index') }}" class="btn btn-outline-primary btn-view-appointments px-4 py-2 rounded-3 fw-bold small d-inline-flex align-items-center gap-2">
                        <i class="bi bi-calendar-check-fill"></i>
                        <span>متابعة جدول حجوزاتي</span>
                    </a>
                    <div class="bg-primary-subtle text-primary px-3 py-2.5 rounded-3 fw-bold small">
                        <i class="bi bi-shield-plus me-1"></i> بوابة المريض
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 rounded-3 shadow-sm mb-4 d-flex align-items-center gap-2" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <div class="row g-4">
                @forelse($doctors as $doctor)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card doctor-card p-4 h-100 d-flex flex-column justify-content-between">

                            <div class="d-flex align-items-start gap-3 mb-3">
                                <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : 'https://cdn-icons-png.flaticon.com/512/3774/3774299.png' }}"
                                     alt="{{ $doctor->name }}"
                                     class="doctor-avatar rounded-circle">
                                <div>
                                    <h3 class="h5 fw-bold text-dark mb-1">د. {{ $doctor->name }}</h3>
                                    <span class="badge bg-primary-subtle text-primary mb-2 fw-bold" style="font-size: 0.75rem;">
                                        {{ $doctor->specialization ?? 'ممارس عام' }}
                                    </span>
                                    <p class="text-muted small mb-0 text-truncate-2" style="font-size: 0.8rem; max-height: 36px; overflow: hidden;">
                                        {{ $doctor->bio ?? 'لا تتوفر نبذة تعريفية قصيرة حالياً.' }}
                                    </p>
                                </div>
                            </div>

                            <div class="border-top pt-3 mt-2 d-flex align-items-center justify-content-between mb-3">
                                <div class="text-right">
                                    <span class="text-muted d-block small" style="font-size: 0.7rem;">سعر الكشف</span>
                                    <span class="fw-bold text-success fs-5">{{ $doctor->fees }} <small style="font-size: 0.75rem;">ج.م</small></span>
                                </div>
                            </div>

                            <button type="button"
                                    class="btn btn-primary btn-action w-100 d-flex align-items-center justify-content-center gap-2 shadow-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#bookModal-{{ $doctor->id }}">
                                <i class="bi bi-calendar-plus"></i>
                                <span>طلب حجز موعد</span>
                            </button>

                        </div>
                    </div>

                    <div class="modal fade" id="bookModal-{{ $doctor->id }}" tabindex="-1" aria-hidden="true" style="font-family: 'Tajawal', sans-serif;">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 rounded-4 shadow">
                                <div class="modal-header bg-light border-0 py-3">
                                    <h5 class="modal-title fw-bold text-dark h6"><i class="bi bi-file-earmark-medical text-primary me-2"></i> تأكيد بيانات الحجز</h5>
                                    <button type="button" class="btn-close ms-0 me-auto" data-bs-submit="modal" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('appointments.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

                                    <div class="modal-body p-4 text-start" dir="rtl">
                                        <p class="text-muted small mb-4">أنت الآن تقوم بطلب حجز عند <strong>د. {{ $doctor->name }}</strong>. يرجى اختيار الموعد وإضافة ملاحظاتك.</p>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold small text-secondary">اختر تاريخ ووقت الكشف المناسب <span class="text-danger">*</span></label>
                                            <input type="datetime-local" name="appointment_date" class="form-control rounded-3" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold small text-secondary">ملاحظات طبية أو أعراض تشعر بها (اختياري)</label>
                                            <textarea name="notes" class="form-control rounded-3" rows="3" placeholder="مثال: أشعر بآلام في الظهر منذ يومين..."></textarea>
                                        </div>
                                    </div>

                                    <div class="modal-footer bg-light border-0 p-3 d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light border text-secondary rounded-3 px-3" data-bs-dismiss="modal">إلغاء</button>
                                        <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold">تأكيد وإرسال الطلب</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="col-12 text-center py-5 bg-white rounded-4 shadow-sm border">
                        <div class="text-muted mb-3"><i class="bi bi-person-x fs-1 opacity-50"></i></div>
                        <h4 class="h5 fw-bold text-secondary">لا يوجد أطباء متاحون حالياً في هذا التخصص</h4>
                        <p class="text-muted small">يرجى مراجعة لوحة التحكم لاحقاً أو التواصل مع الدعم الفني للعيادة.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
