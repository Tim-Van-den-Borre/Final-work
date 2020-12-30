<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Carbon\Carbon;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        error_log($input['birthdate']);
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'role' => ['string'],
            'birthdate' => ['required', 'date'],
            'privacy_policy' => ['accepted'], 
        ])->validate();

        error_log($input['birthdate']);
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'role' => $input['role'],
            'birthdate' => $input['birthdate'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
