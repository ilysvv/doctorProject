<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 sticky-top" dir="rtl" style="font-family: 'Tajawal', sans-serif;">
    <div class="container">

        <a class="navbar-brand fw-bold text-primary d-flex align-items-center gap-2" href="/">
            <i class="bi bi-heart-pulse-fill fs-4"></i>
            <span class="fw-black">{{ config('app.name', 'عيادات  الطبيب') }}</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 pe-0 gap-2">
                @auth
                    @if(Auth::user()->role == 'doctor')
                        <li class="nav-item">
                            <a class="nav-link fw-bold px-3 rounded-3 {{ request()->routeIs('doctor.appointments') ? 'bg-primary text-white active' : 'text-secondary' }}" href="{{ route('doctor.appointments') }}">
                                <i class="bi bi-grid-1x2-fill me-1"></i> لوحة التحكم والحجوزات
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold px-3 rounded-3 {{ request()->routeIs('doctor.profile.edit') ? 'bg-primary text-white active' : 'text-secondary' }}" href="{{ route('doctor.profile.edit') }}">
                                <i class="bi bi-person-bounding-box me-1"></i> تعديل ملفي الطبي
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link fw-bold px-3 rounded-3 {{ request()->routeIs('doctors.index') ? 'bg-primary text-white active' : 'text-secondary' }}" href="{{ route('doctors.index') }}">
                                <i class="bi bi-people-fill me-1"></i> تصفح الأطباء
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold px-3 rounded-3 {{ request()->routeIs('appointments.index') ? 'bg-primary text-white active' : 'text-secondary' }}" href="{{ route('appointments.index') }}">
                                <i class="bi bi-calendar-check-fill me-1"></i> جدول حجوزاتي
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-secondary px-3" href="/">الرئيسية</a>
                    </li>
                @endauth
            </ul>

            <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                @auth
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle small fw-bold px-3 py-2 rounded-3 d-flex align-items-center gap-2" type="button" id="userMenuBtn" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>مرحباً، {{ Auth::user()->name }}</span>
                            <span class="badge bg-primary" style="font-size: 0.7rem;">
                                {{ Auth::user()->role == 'doctor' ? 'طبيب' : 'مريض' }}
                            </span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 text-end mt-2" aria-labelledby="userMenuBtn" style="min-width: 200px;">

                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 fw-bold text-secondary d-flex align-items-center justify-content-between">
                                        <span>تسجيل الخروج</span>
                                        <i class="bi bi-box-arrow-left text-danger"></i>
                                    </button>
                                </form>
                            </li>

                            <li><hr class="dropdown-divider opacity-50"></li>

                            <li>
                                <form method="POST" action="{{ route('profile.destroy') }}" class="m-0" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف حسابك الطبي نهائياً؟ لا يمكن التراجع عن هذا الإجراء.');">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="dropdown-item py-2 fw-bold text-danger d-flex align-items-center justify-content-between">
                                        <span>حذف الحساب نهائياً</span>
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-light btn-sm rounded-pill px-4 fw-bold text-secondary">تسجيل الدخول</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm rounded-pill px-4 fw-bold shadow-sm">إنشاء حساب جديد</a>
                @endauth
            </div>

        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bundle.min.js"></script>
