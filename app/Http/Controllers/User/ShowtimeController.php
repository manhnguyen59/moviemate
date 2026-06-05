<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\ShowtimeCalendarService;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    public function index(Request $request, ShowtimeCalendarService $calendar)
    {
        return view('user.showtimes.index', $calendar->data($request));
    }

    public function ajax(Request $request, ShowtimeCalendarService $calendar)
    {
        return view('user.partials.showtime-section', array_merge(
            $calendar->data($request),
            [
                'showtimeAjaxRoute' => 'user.showtimes.ajax',
                'showtimeBaseRoute' => 'user.showtimes.index',
            ]
        ));
    }
}
