<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Dove prenderemo tutti gli appuntamenti che andranno a finire dentro l'array vuoto
     */
    public function __invoke(Request $request)
    {
        $events = [];

        $appointments = Appointment::with(['client', 'employee'])->get();

        foreach($appointments as $appointment){
            $events[]=[
                'title'=> $appointment->client->name . '('.$appointment->employee->name.')',
                'start'=> $appointment->start_time,
                'end'=> $appointment->finish_time
            ];
        }
        return view('home', compact('events'));
    }
}
