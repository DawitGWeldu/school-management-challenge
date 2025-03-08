<?php

namespace App\Observers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */
    public function created(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
        //
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
        if ($student->user) {
            $student->user->delete();
        }
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
        if ($student->user()->withTrashed()->exists()) {
            $student->user()->withTrashed()->restore();
        }
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
        if ($student->user) {
            $student->user->forceDelete();
        }
    }

    public function creating(Student $student): void
    {
        if (!isset($student->user_id)) {
            $user = User::create([
                'name' => $student->first_name . ' ' . $student->last_name,
                'email' => request('email'),
                'password' => Hash::make(request('password')),
            ]);

            $user->assignRole('student');
            $student->user_id = $user->id;
        }
    }

    public function updating(Student $student): void
    {
        if ($student->user) {
            $student->user->update([
                'name' => $student->first_name . ' ' . $student->last_name,
            ]);

            if (request('password')) {
                $student->user->update([
                    'password' => Hash::make(request('password')),
                ]);
            }
        }
    }
}
