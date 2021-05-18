<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment, $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($appointment, $user)
    {
        $this->appointment = $appointment;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $datetime = new \DateTime($this->appointment->startDate);

        return $this->subject('Appointment Created')->view('mails.appointment-created')->with([
                'date' => $datetime->format('m/d/Y'),
                'time' => $datetime->format('H:i')
            ]);
    }
}
