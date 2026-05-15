<x-guest-layout>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap');
            .login-bg {
                font-family: 'Tajawal', sans-serif;
                background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .login-card {
                border: none;
                border-radius: 24px;
                box-shadow: 0 20px 40px rgba(0,0,0,0.06);
                background: #ffffff;
                opacity: 0;
                transform: scale(0.95);
                transition: all 0.5s ease-out;
            }
            .form-floating > .form-control:focus ~ label,
            .form-floating > .form-control:not(:placeholder-shown) ~ label {
                color: #0d6efd;
                transform: scale(.85) translateY(-0.5rem) translateX(0.15rem);
            }
            .btn-login {
                border-radius: 12px;
                padding: 12px;
                font-weight: 700;
                transition: all 0.2s;
            }
            .btn-login:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(13, 110, 253, 0.2);
            }
        </style>
    </head>

    <div class="login-bg py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">

                    <div class="card login-card p-4 p-sm-5" id="loginCard">

                        <div class="text-center mb-4">
                            <div class="text-primary fs-1 mb-2">
                                <i class="bi bi-heart-pulse-fill"></i>
                            </div>
                            <h2 class="fw-bold text-dark h4 mb-1">تسجيل الدخول</h2>
                            <p class="text-muted small">مرحباً بك في عيادات الشفاء الطبية</p>
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

                        <form method="POST" action="{{ route('login') }}" dir="rtl">
                            @csrf

                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control rounded-3" id="emailInput" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                                <label for="emailInput"><i class="bi bi-envelope text-muted me-1"></i> البريد الإلكتروني</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control rounded-3" id="passwordInput" placeholder="Password" required>
                                <label for="passwordInput"><i class="bi bi-lock text-muted me-1"></i> كلمة المرور</label>
                            </div>

                            <div class="form-check text-end mb-4 pe-0">
                                <input class="form-check-input float-end ms-2" type="checkbox" name="remember" id="remember_me">
                                <label class="form-check-label text-secondary small" for="remember_me">
                                    تذكرني على هذا الجهاز
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-login w-100 mb-3 shadow-sm">
                                تسجيل الدخول <i class="bi bi-box-arrow-in-right ms-1"></i>
                            </button>

                            <div class="text-center mt-2">
                                <span class="text-muted small">ليس لديك حساب؟</span>
                                <a href="{{ route('register') }}" class="text-primary small fw-bold text-decoration-none ms-1">إنشاء حساب جديد</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const card = document.getElementById('loginCard');
            setTimeout(() => {
                card.style.opacity = "1";
                card.style.transform = "scale(1)";
            }, 100);
        });
    </script>
</x-guest-layout>
