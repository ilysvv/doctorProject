<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:patient,doctor'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        // إذا كان المستخدم دكتور، نقوم بإنشاء سجل له في جدول الدكاترة
        if ($user->role === 'doctor') {
            \App\Models\Doctor::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'specialization' => 'لم يحدد بعد',
                'bio' => 'طبيب جديد في المنصة',
                'fees' => 0,
            ]);
        }

        // تسجيل الدخول والتحويل للداش بورد (للكل سواء دكتور أو مريض)
        Auth::login($user);

        if (auth()->user()->role === 'doctor') {
            return redirect()->route('doctor.appointments');
        }
        return redirect()->route('doctors.index');
    }
}
