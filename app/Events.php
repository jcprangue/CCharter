<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $guarded = [];
    protected $table = "pg_events";

    public function department()
    {
        return $this->hasOne('App\departments', 'id', 'departments');
    }
    public function format()
    {
        return [
            'id' => $this->id,
            'events' => $this->events,
            'department' => $this->department,
            'departments' => $this->departments,
            'description' => $this->description,
            'except' => $this->except,
            'eventStart' => date('Y-m-d',strtotime($this->eventStart)),
            'eventEnd' => date('Y-m-d',strtotime($this->eventEnd)),
            'event_start' => date('F d, Y',strtotime($this->eventStart)),
            'event_end' => date('F d, Y',strtotime($this->eventEnd)),
        ];
    }
}
