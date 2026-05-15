<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عيادات الطبيب - الرئيسية</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap');
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f8fafc;
        }
        .hero-section {
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.04) 0%, rgba(13, 110, 253, 0.01) 100%);
            min-height: 85vh;
            display: flex;
            align-items: center;
        }
        .hero-card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.03);
        }
    </style>
</head>
<body>

@include('layouts.navigation')

<div class="hero-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-12 col-lg-6 text-center text-lg-start">
                <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-2 rounded-pill mb-3">🛡️ رعاية طبية متكاملة نثق بها</span>
                <h1 class="display-4 fw-black text-dark mb-3" style="line-height: 1.3;">منصتك الذكية لحجز <span class="text-primary">العيادات الطبية</span> بسهولة</h1>
                <p class="text-muted fs-5 mb-4">احجز موعدك الإلكتروني الآن مع نخبة من أفضل الأطباء والاستشاريين في كافة التخصصات الطبية، وتابع حالة حجزك فورياً ومن أي مكان.</p>

                <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-lg-start gap-3">
                    @auth
                        @if(Auth::user()->role == 'doctor')
                            <a href="{{ route('doctor.appointments') }}" class="btn btn-primary btn-lg rounded-3 px-5 py-3 fw-bold shadow-sm">الانتقال للوحة التحكم <i class="bi bi-arrow-left ms-2"></i></a>
                        @else
                            <a href="{{ route('doctors.index') }}" class="btn btn-primary btn-lg rounded-3 px-5 py-3 fw-bold shadow-sm">تصفح الأطباء واحجز الآن <i class="bi bi-calendar-plus ms-2"></i></a>
                        @endif
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-3 px-5 py-3 fw-bold shadow-sm">ابدأ بإنشاء حسابك <i class="bi bi-arrow-left ms-2"></i></a>
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg rounded-3 px-4 py-3 fw-bold">تسجيل الدخول</a>
                    @endauth
                </div>
            </div>
            <div class="col-12 col-lg-6 text-center">
                <div class="card hero-card bg-white p-4">
                    <img src="https://img.freepik.com/free-vector/doctors-concept-illustration_114360-1515.jpg" alt="Medical Illustration" class="img-fluid rounded-4 mx-auto" style="max-height: 400px;">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
