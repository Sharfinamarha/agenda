<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\event as Event;
use Illuminate\Support\Facades\Auth;

class FullCalenderController extends Controller
{
    public function home()
    {
        $todayEvent = Event::whereDate('start', '=', date('Y-m-d'))->get();
        $upcomingEvent = Event::whereDate('start', '>', date('Y-m-d'))->get();
        $totalAgenda = $todayEvent->count() + $upcomingEvent->count();
		return view('home', compact('todayEvent', 'upcomingEvent', 'totalAgenda'));
    }

	public function showHome(Request $request)
	{
        $sort = $request->sort ?? null;
        $keyword = $request->q ?? null;

        $query = Event::query();

        if($keyword !=null){
            $query->where('title', 'like', '%'.$keyword.'%');
        }

        if($sort == null || $sort == 'newest' || $sort == 'all'){
            $query->orderBy('created_at', 'desc');
        } elseif ($sort == 'oldest'){
            $query->orderBy('created_at', 'asc');
        }

		$eventdata = $query->get();
		return view('list', compact('eventdata'));
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
			$data = Event::whereDate('start', '>=', $request->start)
				->whereDate('end',   '<=', $request->end)
				->get(['id', 'title', 'location', 'peserta', 'penyelenggara', 'start', 'end']);
			return response()->json($data);
		}
		return view('agenda');
	}

	public function action(Request $request)
	{
		if ($request->ajax()) {
			if ($request->type == 'add') {
				$event = Event::create([
					'title'		=>	$request->title,
					'location'	=> $request->location,
                    'penyelenggara' => $request->penyelenggara,
					'peserta'	=> $request->peserta,
					'start'		=>	$request->start,
					'end'		=>	$request->end,
                    'user'      => Auth::user()->name,
				]);

				return response()->json($event);
			}

			if ($request->type == 'update') {
				$event = Event::find($request->id)->update([
					'title'		=>	$request->title,
					'location'	=> $request->location,
                    'penyelenggara' => $request->penyelenggara,
					'peserta'	=> $request->peserta,
					'start'		=>	$request->start,
					'end'		=>	$request->end,
                    'user'      => Auth::user()->name,
				]);

				return response()->json($event);
			}

			if ($request->type == 'delete') {
				$event = Event::find($request->id)->delete();

				return response()->json($event);
			}
			if ($request->type == 'edit') {
				$event = Event::find($request->id)->edit();

				return response()->json($event);
			}
		}
	}
}
