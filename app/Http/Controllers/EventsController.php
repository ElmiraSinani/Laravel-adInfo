<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class EventsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listEvents() {
        $events = Event::paginate(10);       

        return view('frontend.listEvents', ['events'=>$events]);
    }
}
