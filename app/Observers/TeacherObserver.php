<?php

namespace App\Observers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeacherObserver
{
    /**
     * Handle the Teacher "created" event.
     */
    public function created(Teacher $teacher): void
    {
        //
    }

    /**
     * Handle the Teacher "updated" event.
     */
    public function updated(Teacher $teacher): void
    {
        //
    }

    /**
     * Handle the Teacher "deleted" event.
     */
    public function deleted(Teacher $teacher): void
    {
        if ($teacher->user) {
            $teacher->user->delete();
        }
    }

    /**
     * Handle the Teacher "restored" event.
     */
    public function restored(Teacher $teacher): void
    {
        if ($teacher->user()->withTrashed()->exists()) {
            $teacher->user()->withTrashed()->restore();
        }
    }

    /**
     * Handle the Teacher "force deleted" event.
     */
    public function forceDeleted(Teacher $teacher): void
    {
        if ($teacher->user) {
            $teacher->user->forceDelete();
        }
    }

    public function creating(Teacher $teacher): void
    {
        if (!isset($teacher->user_id)) {
            $user = User::create([
                'name' => $teacher->first_name . ' ' . $teacher->last_name,
                'email' => request('email'),
                'password' => Hash::make(request('password')),
            ]);

            $user->assignRole('teacher');
            $teacher->user_id = $user->id;
        }
    }

    public function updating(Teacher $teacher): void
    {
        if ($teacher->user) {
            $teacher->user->update([
                'name' => $teacher->first_name . ' ' . $teacher->last_name,
                'email' => request('email'),
            ]);

            if (request('password')) {
                $teacher->user->update([
                    'password' => Hash::make(request('password')),
                ]);
            }
        }
    }
}
