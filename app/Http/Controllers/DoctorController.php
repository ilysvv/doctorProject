<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function index() {
        $doctors = Doctor::all();
        return view('doctors.index', compact('doctors'));
    }

    public function edit() {
        $user = auth()->user();
        $doctor = Doctor::firstOrCreate(
            ['user_id' => $user->id],
            ['name' => $user->name, 'specialization' => 'لم يحدد بعد', 'fees' => 0]
        );
        return view('doctor.profile-edit', compact('doctor'));
    }

    public function update(Request $request) {
        $doctor = auth()->user()->doctor;
        $validated = $request->validate([
            'specialization' => 'required|string|max:255',
            'fees' => 'required|numeric|min:0',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($doctor->photo) { Storage::disk('public')->delete($doctor->photo); }
            $validated['photo'] = $request->file('photo')->store('doctors', 'public');
        }

        $doctor->update($validated);
        return back()->with('success', 'تم تحديث بياناتك بنجاح');
    }
}
