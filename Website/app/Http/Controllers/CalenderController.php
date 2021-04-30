<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Acaronlex\LaravelCalendar\Calendar;

class CalenderController extends Controller
{
    public function getCalender(){

        $events = [];

        $date = \DateTime::createFromFormat("Y-m-d h:i:s", '2021-04-20 09:00:00');

        $events[] = \Calendar::event(
            "Valentine's Day", //event title
            false, //full day event?
            \DateTime::createFromFormat ("Y-m-d h:i:s", '2021-04-20 09:00:00'),
            \DateTime::createFromFormat ("Y-m-d h:i:s", '2021-04-20 09:30:00'),
        );
        
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
