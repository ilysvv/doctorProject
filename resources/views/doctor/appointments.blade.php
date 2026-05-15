<x-app-layout>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap');

            .dashboard-bg {
                font-family: 'Tajawal', sans-serif;
                background-color: #f8fafc;
                min-height: 90vh;
            }
            .stat-card {
                border: none;
                border-radius: 16px;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
                transition: transform 0.2s;
            }
            .stat-card:hover {
                transform: translateY(-3px);
            }
            .table-card {
                border: none;
                border-radius: 20px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            }
            .custom-table th {
                background-color: #f1f5f9;
                color: #475569;
                font-weight: 700;
                padding: 16px;
                border: none;
            }
            .custom-table td {
                padding: 16px;
                vertical-align: middle;
                color: #334155;
            }
            .badge-status {
                padding: 6px 14px;
                border-radius: 50px;
                font-weight: 700;
                font-size: 0.8rem;
            }
            .action-btn {
                padding: 6px 16px;
                border-radius: 50px;
                font-weight: 600;
                font-size: 0.85rem;
                transition: all 0.2s;
            }
            .btn-edit-profile {
                transition: all 0.2s ease-in-out;
            }
            .btn-edit-profile:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(13, 110, 253, 0.15);
            }
        </style>
    </head>

    <div class="dashboard-bg py-5" dir="rtl">
        <div class="container">

            <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3 mb-5">
                <div>
                    <h2 class="h3 fw-bold text-dark mb-1">طلبات الحجز الواردة</h2>
                    <p class="text-muted mb-0 small">إدارة مواعيد الكشف والتحكم في طلبات المرضى الحالية.</p>
                </div>
                <div class="d-flex align-items-center gap-2 shared-actions">
                    <a href="{{ route('doctor.profile.edit') }}" class="btn btn-outline-primary btn-edit-profile px-4 py-2 rounded-3 fw-bold small d-inline-flex align-items-center gap-2">
                        <i class="bi bi-gear-fill"></i>
                        <span>تعديل الملف الطبي</span>
                    </a>
                    <div class="bg-primary-subtle text-primary px-3 py-2.5 rounded-3 fw-bold small">
                        <i class="bi bi-clock-history me-1"></i> لوحة الطبيب
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-12 col-sm-4">
                    <div class="card stat-card p-3 bg-white border-start border-primary border-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted d-block mb-1">إجمالي الحجوزات</small>
                                <span class="fs-3 fw-bold text-dark">{{ $appointments->count() }}</span>
                            </div>
                            <div class="bg-primary-subtle text-primary rounded-3 p-2 fs-4 d-inline-flex">
                                <i class="bi bi-calendar3"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card stat-card p-3 bg-white border-start border-success border-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted d-block mb-1">المقبولة</small>
                                <span class="fs-3 fw-bold text-success">{{ $appointments->where('status', 'accepted')->count() }}</span>
                            </div>
                            <div class="bg-success-subtle text-success rounded-3 p-2 fs-4 d-inline-flex">
                                <i class="bi bi-check2-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="card stat-card p-3 bg-white border-start border-warning border-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <small class="text-muted d-block mb-1">قيد الانتظار</small>
                                <span class="fs-3 fw-bold text-warning">{{ $appointments->where('status', 'pending')->count() }}</span>
                            </div>
                            <div class="bg-warning-subtle text-warning rounded-3 p-2 fs-4 d-inline-flex">
                                <i class="bi bi-hourglass-split"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card table-card p-4 bg-white">
                @if($appointments->isEmpty())
                    <div class="text-center py-5">
                        <div class="text-muted mb-3"><i class="bi bi-calendar-x fs-1 opacity-50"></i></div>
                        <h4 class="h5 fw-bold text-secondary">لا توجد طلبات حجز حالياً</h4>
                        <p class="text-muted small">سيتم عرض أي حجز جديد يتم طلبه من المرضى هنا فوراً.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table custom-table align-middle text-right mb-0">
                            <thead>
                            <tr>
                                <th><i class="bi bi-person me-1"></i> اسم المريض</th>
                                <th><i class="bi bi-calendar-event me-1"></i> تاريخ الكشف</th>
                                <th><i class="bi bi-chat-square-text me-1"></i> ملاحظات الأعراض</th>
                                <th class="text-center"><i class="bi bi-shield-check me-1"></i> الحالة والتحكم</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($appointments as $app)
                                <tr class="border-bottom">
                                    <td class="fw-bold text-dark">{{ $app->user->name }}</td>
                                    <td>
                                        <span class="text-dark"><i class="bi bi-clock me-1 text-secondary"></i> {{ $app->appointment_date }}</span>
                                    </td>
                                    <td class="text-muted small" style="max-width: 250px;">
                                        {{ $app->notes ?? 'لا توجد ملاحظات إضافية' }}
                                    </td>
                                    <td class="text-center">
                                        @if($app->status == 'pending')
                                            <div class="d-flex justify-content-center gap-2">
                                                <form action="{{ route('appointments.updateStatus', $app) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button type="submit" class="btn btn-outline-success action-btn d-inline-flex align-items-center gap-1">
                                                        <i class="bi bi-check-lg"></i> قبول
                                                    </button>
                                                </form>

                                                <form action="{{ route('appointments.updateStatus', $app) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="btn btn-outline-danger action-btn d-inline-flex align-items-center gap-1">
                                                        <i class="bi bi-x-lg"></i> رفض
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            @if($app->status == 'accepted')
                                                <span class="badge-status bg-success-subtle text-success d-inline-block">
                                                        <i class="bi bi-check-circle-fill me-1"></i> تم القبول
                                                    </span>
                                            @else
                                                <span class="badge-status bg-danger-subtle text-danger d-inline-block">
                                                        <i class="bi bi-x-circle-fill me-1"></i> تم الرفض
                                                    </span>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
