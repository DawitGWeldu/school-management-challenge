<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Remove password from student data
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

        // Assign the Student role
        $user->assignRole('Student');

        // Remove temporary password field and create student
        unset($data['user_password']);
        $student = new ($this->getModel())($data);
        $student->user()->associate($user);
        $student->save();

        return $student;
    }
}
