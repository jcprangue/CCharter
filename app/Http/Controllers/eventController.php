<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;
use DB;

class eventController extends Controller
{
    public function findAllEvent(){
        $events = Events::JOIN('departments','pg_events.departments','departments.id')
                ->Select(DB::RAW('pg_events.*,departments.department,departments.department_nick'))
                ->whereDate('pg_events.eventStart', '>=',date('Y-m-d'))
                ->orderBy('pg_events.eventStart','ASC')
                ->get();

        return $events;
    }


    public function list(){
        $events = Events::JOIN('departments','pg_events.departments','departments.id')
                ->Select(DB::RAW('pg_events.*,departments.department,departments.department_nick'))
                ->orderBy('pg_events.eventStart','ASC')
                ->with('department')
                ->get()
                ->map->format();

        return $events;
    }

    public function delete($id){
        $events = Events::where('id',$id)->delete();

        return null;

    }

    public function save(Request $r){
        Events::create($this->getForm($r));
    }
    // /event/update/{id}
    public function update(Events $event, Request $r){
        $event->update($this->getForm($r));
    }

    public function getForm($r)
    {
        $collection = $r->validate([
                'events' => 'required',
                'departments' => 'required',
                'description' => 'required',
                'eventStart' => 'required',
                'eventEnd' => 'required',
        ]);
        return $r->only([
            'events',
            'departments',
            'description',
            'eventStart',
            'eventEnd',
        ]);
    }


}
