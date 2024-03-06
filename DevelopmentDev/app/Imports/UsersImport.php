<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel
{
    public function model(array $row)
    {
        $userData = [
            'name' => $row[0],
            'lastname' => $row[1],
            'phone_number' => $row[2],
            'document_type' => $row[3],
            'document_number' => $row[4],
            'email' => $row[5],
            'password' => Hash::make(6),
        ];

        try {
            $user = User::create($userData);
            $user->assignRole('Cliente');
            print_r($userData);

            return $user;
        } catch (\Exception $e) {
            dd('Error, dato duplicado', $e);
        }
    }
}
