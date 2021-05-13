<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Acaronlex\LaravelCalendar\Calendar;
use Auth;
use DB;
use App\Models\Appointment;

class CalenderController extends Controller
{
    public function getCalender(){

        if(Auth::user()->role == 'Doctor' || Auth::user()->role == 'Admin'){
            $events = [];

            $appointments = DB::table('appointments')->where('doctorID', Auth::user()->id)->get();
    
            foreach($appointments as $appointment){
                $user = DB::table('users')->where('id', $appointment->patientID)->first();

                $events[] = \Calendar::event(
                    $user->name, //event title
                    false, //full day event?
                    $appointment->startDate,
                    $appointment->endDate
                );
            }
        }
        if(Auth::user()->role == 'Patient'){
            $events = [];

            $appointments = DB::table('appointments')->where('patientID', Auth::user()->id)->get();
    
            foreach($appointments as $appointment){
                $user = DB::table('users')->where('id', $appointment->doctorID)->first();

                $events[] = \Calendar::event(
                    $user->name, //event title
                    false, //full day event?
                    $appointment->startDate,
                    $appointment->endDate
                );
            }
        }

        
        $calendar = new Calendar();
                $calendar->addEvents($events)
                ->setOptions([
                    'locale' => 'en',
                    'firstDay' => 1,
                    'displayEventTime' => true,
                    'selectable' => true,
                    'initialView' => 'dayGridMonth',
                    'headerToolbar' => [
                        'end' => 'today prev,next dayGridMonth timeGridWeek timeGridDay'
                    ]
                ]);
                $calendar->setId('1');
                $calendar->setCallbacks([
                    'select' => 'function(selectionInfo){}',
                    'eventClick' => 'function(event){}'
                ]);
        return view('calender', compact('calendar'));
    }
}
