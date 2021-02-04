<?php

namespace App\Actions\Jetstream;

use Laravel\Jetstream\Contracts\DeletesUsers;
use DB;
use App\Models\Appointment;
use App\Models\User;
use App\Models\MedicalHistory;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        $appointments = Appointment::where('patientID', $user->id)->get();

        foreach ($appointments as $appointment){
            MedicalHistory::where('appointmentID', $appointment->id)->get()->each->delete();
        }

        Appointment::where('patientID', $user->id)->get()->each->delete();

        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}
