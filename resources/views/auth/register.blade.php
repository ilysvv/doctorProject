<x-guest-layout>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap');

            .register-bg {
                font-family: 'Tajawal', sans-serif;
                background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            /* تظبيط الماكس ويدث والكارت عشان يبقى ملموم وشكله شيك */
            .register-card {
                border: none;
                border-radius: 24px;
                box-shadow: 0 20px 40px rgba(0,0,0,0.06);
                background: #ffffff;
                opacity: 0;
                transform: translateY(20px);
                transition: all 0.5s ease-out;
            }
            .btn-register {
                border-radius: 12px;
                padding: 12px;
                font-weight: 700;
                transition: all 0.2s;
            }
            .btn-register:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(13, 110, 253, 0.2);
            }
            /* شكل وابعاد حقول اختيار الحساب */
            .role-selector {
                background-color: #f8fafc;
                border: 1px solid #e2e8f0;
                border-radius: 12px;
                padding: 14px;
            }
        </style>
    </head>

    <div class="register-bg py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-lg-5">

                    <div class="card register-card p-4 p-md-5 my-4" id="registerCard">

                        <div class="text-center mb-4">
                            <div class="text-primary fs-1 mb-2">
                                <i class="bi bi-person-plus-fill"></i>
                            </div>
                            <h2 class="fw-bold text-dark h4 mb-1">إنشاء حساب جديد</h2>
                            <p class="text-muted small">انضم إلى عيادات الشفاء الطبية الآن</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger border-0 rounded-3 small mb-4">
                                <ul class="mb-0 list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li><i class="bi bi-exclamation-circle me-1"></i> {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}" dir="rtl">
                            @csrf

                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control rounded-3" id="nameInput" placeholder="الاسم الكامل" value="{{ old('name') }}" required autofocus>
                                <label for="nameInput"><i class="bi bi-person text-muted me-1"></i> الاسم الكامل</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control rounded-3" id="emailInput" placeholder="name@example.com" value="{{ old('email') }}" required>
                                <label for="emailInput"><i class="bi bi-envelope text-muted me-1"></i> البريد الإلكتروني</label>
                            </div>

                            <div class="mb-3 role-selector">
                                <label class="form-label d-block fw-bold text-secondary small mb-2">
                                    <i class="bi bi-shield-check me-1"></i> نوع الحساب:
                                </label>
                                <div class="d-flex gap-4 justify-content-center">
                                    <div class="form-check">
                                        <input class="form-check-input ms-2 float-end" type="radio" name="role" id="rolePatient" value="patient" checked>
                                        <label class="form-check-label fw-bold text-dark small" for="rolePatient">👤 مريض</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input ms-2 float-end" type="radio" name="role" id="roleDoctor" value="doctor">
                                        <label class="form-check-label fw-bold text-dark small" for="roleDoctor">⚕️ طبيب</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control rounded-3" id="passwordInput" placeholder="Password" required>
                                <label for="passwordInput"><i class="bi bi-lock text-muted me-1"></i> كلمة المرور</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" name="password_confirmation" class="form-control rounded-3" id="confirmPasswordInput" placeholder="Confirm Password" required>
                                <label for="confirmPasswordInput"><i class="bi bi-lock-fill text-muted me-1"></i> تأكيد كلمة المرور</label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-register w-100 mb-3 shadow-sm">
                                تسجيل حساب جديد <i class="bi bi-check-all ms-1"></i>
                            </button>

                            <div class="text-center mt-2">
                                <span class="text-muted small">لديك حساب بالفعل؟</span>
                                <a href="{{ route('login') }}" class="text-primary small fw-bold text-decoration-none ms-1">تسجيل الدخول</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const card = document.getElementById('registerCard');
            setTimeout(() => {
                card.style.opacity = "1";
                card.style.transform = "translateY(0)";
            }, 100);
        });
    </script>
</x-guest-layout>
