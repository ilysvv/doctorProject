<x-app-layout>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap');

            .clinical-bg {
                font-family: 'Tajawal', sans-serif;
                background-color: #f8fafc;
                min-height: 85vh;
            }
            .booking-card {
                border: none;
                border-radius: 20px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
                background: #ffffff;
            }
            .doctor-mini-profile {
                background: linear-gradient(135deg, rgba(13, 110, 253, 0.05) 0%, rgba(13, 110, 253, 0.01) 100%);
                border-radius: 16px;
                padding: 20px;
                border: 1px solid rgba(13, 110, 253, 0.05);
            }
            .form-control:focus {
                border-color: #0d6efd;
                box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            }
            .btn-submit {
                border-radius: 12px;
                padding: 12px 24px;
                font-weight: 600;
                transition: all 0.2s ease;
            }
            .btn-submit:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(13, 110, 253, 0.2);
            }
        </style>
    </head>

    <div class="clinical-bg py-5" dir="rtl">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-7">

                    <div class="card booking-card p-4 p-sm-5">

                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="bg-primary text-white rounded-3 p-3 d-inline-flex justify-content-center align-items-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-calendar-plus fs-4"></i>
                            </div>
                            <div>
                                <h2 class="h4 fw-bold text-dark mb-1">تأكيد حجز الموعد</h2>
                                <p class="text-muted mb-0 small">يرجى مراجعة بيانات الطبيب واختيار التاريخ المناسب للكشف.</p>
                            </div>
                        </div>

                        <div class="doctor-mini-profile d-flex align-items-center gap-4 mb-4">
                            <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : 'https://cdn-icons-png.flaticon.com/512/3774/3774299.png' }}"
                                 alt="{{ $doctor->name }}"
                                 class="rounded-circle object-cover border"
                                 style="width: 70px; height: 70px;">
                            <div>
                                <span class="badge bg-primary-subtle text-primary fw-bold mb-1" style="font-size: 0.75rem;">⚕️ {{ $doctor->specialization ?? 'ممارس عام' }}</span>
                                <h3 class="h5 fw-bold text-slate-800 mb-1">دكتور. {{ $doctor->name }}</h3>
                                <p class="text-success mb-0 small fw-bold">
                                    <i class="bi bi-cash-coin me-1"></i> قيمة الكشف: {{ $doctor->fees }} ج.م
                                </p>
                            </div>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger border-0 rounded-3 shadow-sm d-flex align-items-center gap-2 mb-4" role="alert">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <div>{{ session('error') }}</div>
                            </div>
                        @endif

                        <form action="{{ route('appointments.store') }}" method="POST" id="bookingForm" class="needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

                            <div class="mb-4">
                                <label for="appointment_date" class="form-label fw-bold text-dark mb-2">
                                    <i class="bi bi-calendar-event text-primary me-1"></i> اختر تاريخ الحجز <span class="text-danger">*</span>
                                </label>
                                <input type="date"
                                       name="appointment_date"
                                       id="appointment_date"
                                       class="form-control form-control-lg rounded-3"
                                       required>
                                <div class="invalid-feedback">
                                    يرجى اختيار تاريخ صالح للحجز (ابتداءً من الغد).
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="notes" class="form-label fw-bold text-dark mb-2">
                                    <i class="bi bi-chat-left-text text-primary me-1"></i> ملاحظات إضافية للطبيب (اختياري)
                                </label>
                                <textarea name="notes"
                                          id="notes"
                                          class="form-control rounded-3"
                                          rows="4"
                                          placeholder="اكتب هنا الأعراض التي تشعر بها أو أي تفاصيل تود إطلاع الطبيب عليها..."></textarea>
                            </div>

                            <div class="d-flex flex-column flex-sm-row gap-3 mt-4 pt-2">
                                <button type="submit" class="btn btn-primary btn-submit flex-grow-1 d-inline-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>تأكيد وطلب الحجز</span>
                                </button>
                                <a href="{{ route('doctors.index') }}" class="btn btn-light text-secondary border rounded-3 px-4 py-2.5 d-inline-flex align-items-center justify-content-center text-decoration-none">
                                    إلغاء الطلب
                                </a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const dateInput = document.getElementById('appointment_date');
            const form = document.getElementById('bookingForm');

            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);

            const formattedTomorrow = tomorrow.toISOString().split('T')[0];
            dateInput.setAttribute('min', formattedTomorrow);

            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    </script>
</x-app-layout>
