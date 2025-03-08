<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class EditTeacher extends EditRecord
{
    protected static string $resource = TeacherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['email'] = $this->record->user->email;
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Update user data
        $user = $record->user;
        $user->name = $data['first_name'] . ' ' . $data['last_name'];
        $user->email = $data['email'];
        
        // Only update password if it's provided
        if (isset($data['password']) && filled($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        
        $user->save();

        // Remove user-specific fields from teacher data
        unset($data['email']);
        unset($data['password']);

        // Update teacher data
        $record->update($data);

        return $record;
    }
}
