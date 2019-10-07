<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'start_time', 'end_time','start_date', 'end_date', 'phone', 'address', 'city', 'state', 'zip', 'description', 'image'];
}
