<?php

namespace App\Http\Controllers;

use App\Models\Time;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Resources\Time\Time as TimeResource;

class TimeController extends Controller
{
    public function getTime()
    {
        $time = Time::where('id', 1)->first();
        return new TimeResource($time);
    }
}
