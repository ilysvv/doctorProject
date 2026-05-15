<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;

class AppointmentController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:today',
            'notes' => 'nullable|string',
        ]);

        $exists = Appointment::where('user_id', auth()->id())
            ->where('doctor_id', $request->doctor_id)
            ->whereDate('appointment_date', $request->appointment_date)
            ->exists();

        if ($exists) { return back()->with('error', 'لديك حجز بالفعل في هذا اليوم!'); }

        Appointment::create([
            'user_id' => auth()->id(),
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('appointments.index')->with('success', 'تم طلب الحجز');
    }

    public function index() {
        $appointments = auth()->user()->appointments()->with('doctor')->latest()->get();
        return view('appointments.index', compact('appointments'));
    }

    public function doctorIndex() {
        $doctor = auth()->user()->doctor;
        $appointments = Appointment::where('doctor_id', $doctor->id)->with('user')->latest()->get();
        return view('doctor.appointments', compact('appointments'));
    }

    public function updateStatus(Request $request, Appointment $appointment) {
        $validated = $request->validate(['status' => 'required|in:accepted,rejected']);
        $appointment->update(['status' => $validated['status']]);
        return back()->with('success', 'تم تحديث حالة الحجز');
    }
    public function create($doctor_id)
    {
        // بنجيب بيانات الدكتور عشان نعرض اسمه في صفحة الحجز
        $doctor = \App\Models\Doctor::findOrFail($doctor_id);

        return view('appointments.create', compact('doctor'));
    }
}
