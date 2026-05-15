<x-app-layout>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;900&display=swap');

            .profile-bg {
                font-family: 'Tajawal', sans-serif;
                background-color: #f8fafc;
                min-height: 90vh;
            }
            .profile-card {
                border: none;
                border-radius: 20px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
                background: #ffffff;
            }
            .image-upload-wrapper {
                position: relative;
                width: 120px;
                height: 120px;
                margin: 0 auto 20px auto;
            }
            .preview-avatar {
                width: 120px;
                height: 120px;
                object-fit: cover;
                border: 4px solid #fff;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            }
            .upload-btn-badge {
                position: absolute;
                bottom: 2px;
                left: 2px;
                background-color: #0d6efd;
                color: white;
                width: 34px;
                height: 34px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                border: 3px solid #fff;
                transition: all 0.2s;
            }
            .upload-btn-badge:hover {
                background-color: #0b5ed7;
                transform: scale(1.1);
            }
            .form-label {
                color: #475569;
                font-weight: 700;
                font-size: 0.9rem;
            }
            .form-control:focus {
                border-color: #0d6efd;
                box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
            }
        </style>
    </head>

    <div class="profile-bg py-5" dir="rtl">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">

                    <div class="card profile-card p-4 p-sm-5">

                        <div class="text-center mb-4">
                            <h2 class="h4 fw-bold text-dark mb-1">تعديل ملفك الطبي</h2>
                            <p class="text-muted small">تحديث بيانات العيادة والتخصص ليراها المرضى في صفحة الحجوزات.</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success border-0 rounded-3 shadow-sm d-flex align-items-center gap-2 mb-4" role="alert">
                                <i class="bi bi-check-circle-fill"></i>
                                <div>{{ session('success') }}</div>
                            </div>
                        @endif

                        <form action="{{ route('doctor.profile.update') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="text-center mb-4">
                                <div class="image-upload-wrapper">
                                    <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : 'https://cdn-icons-png.flaticon.com/512/3774/3774299.png' }}"
                                         id="avatarPreview"
                                         class="preview-avatar rounded-circle">

                                    <label for="photo_input" class="upload-btn-badge">
                                        <i class="bi bi-camera-fill"></i>
                                    </label>
                                    <input type="file" name="photo" id="photo_input" class="d-none" accept="image/*">
                                </div>
                                <small class="text-muted d-block">اضغط على الأيقونة لتغيير الصورة الشخصية (JPG, PNG)</small>
                                @error('photo') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="row g-4">
                                <div class="col-12 col-sm-6">
                                    <label for="specialization" class="form-label mb-2">
                                        <i class="bi bi-heart-pulse text-primary me-1"></i> التخصص الطبي <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           name="specialization"
                                           id="specialization"
                                           class="form-control form-control-lg rounded-3"
                                           value="{{ old('specialization', $doctor->specialization) }}"
                                           placeholder="مثال: استشاري جراحة العظام"
                                           required>
                                    <div class="invalid-feedback">يرجى كتابة التخصص الطبي.</div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label for="fees" class="form-label mb-2">
                                        <i class="bi bi-cash-coin text-primary me-1"></i> سعر الكشف (ج.م) <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <input type="number"
                                               name="fees"
                                               id="fees"
                                               class="form-control rounded-start-3"
                                               value="{{ old('fees', $doctor->fees) }}"
                                               min="0"
                                               placeholder="00"
                                               required>
                                        <span class="input-group-text bg-light text-muted border-start-0 rounded-end-3" style="font-size: 0.9rem; font-weight: 600;">ج.م</span>
                                        <div class="invalid-feedback">يرجى تحديد سعر كشف صالح.</div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="bio" class="form-label mb-2">
                                        <i class="bi bi-file-earmark-text text-primary me-1"></i> نبذة تعريفية عن الطبيب (Bio)
                                    </label>
                                    <textarea name="bio"
                                              id="bio"
                                              class="form-control rounded-3"
                                              rows="4"
                                              placeholder="اكتب تفاصيل أكثر عن خبراتك الطبية، الشهادات الحاصل عليها، ومواعيد العيادة الثابتة...">{{ old('bio', $doctor->bio) }}</textarea>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-3 mt-5 pt-2 border-t">
                                <button type="submit" class="btn btn-primary px-5 py-2.5 rounded-3 fw-bold d-inline-flex align-items-center gap-2">
                                    <i class="bi bi-floppy-fill"></i>
                                    <span>حفظ التغييرات</span>
                                </button>
                                <a href="{{ route('doctor.appointments') }}" class="btn btn-light text-secondary border rounded-3 px-4 py-2.5 text-decoration-none">
                                    إلغاء والعودة للوحة التحكم
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
            const photoInput = document.getElementById('photo_input');
            const avatarPreview = document.getElementById('avatarPreview');

            // كود الـ Image Preview (معاينة الصورة فورياً بدون ريفريش)
            if (photoInput) {
                photoInput.addEventListener('change', function () {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            avatarPreview.setAttribute('src', e.target.result);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

            // تفعيل نظام الـ Validation الخاص بـ Bootstrap 5
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        });
    </script>
</x-app-layout>
