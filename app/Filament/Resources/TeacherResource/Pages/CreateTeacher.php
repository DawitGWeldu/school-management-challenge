<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class CreateTeacher extends CreateRecord
{
    protected static string $resource = TeacherResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Remove password from teacher data
        $password = $data['password'];
        unset($data['password']);
        $data['user_password'] = $password; // Store temporarily
        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        // Create the user first
        $user = User::create([
            'name' => $data['first_name'] . ' ' . $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['user_password']), // Use the stored password
        ]);

        // Assign the Teacher role
        $user->assignRole('Teacher');

        // Remove temporary password field and create teacher
        unset($data['user_password']);
        $teacher = new ($this->getModel())($data);
        $teacher->user()->associate($user);
        $teacher->save();

        return $teacher;
    }
}
