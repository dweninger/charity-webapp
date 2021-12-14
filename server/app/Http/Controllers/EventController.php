<?php
 /**
  * Controller for manipulating events
  */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\UserEvent;
use App\Models\ProgramEvent;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;


class EventController extends Controller
{
    // Shows all events
    public function index(){
        $events = Event::all();
        $user_events = null;

        if(Auth::user()){
            $user_id = Auth::user()->id;
            $user_events = DB::select('SELECT events.id as events_id, name, date_time, description, status
            FROM user_events
            JOIN users ON users.id = user_events.user_id
            JOIN events ON events.id = user_events.event_id
            WHERE user_events.user_id = ?', [$user_id]);
        }

        return view('events', compact(['events', 'user_events']));
    } 

    // Go to event creation page
    public function create() {
        return view('admin.create-event');
    }

    // Show 1 event's info
    public function show() {

    }

    // Go to volunteer page
    public function volunteer_edit($id) { // localhost/events/1/edit
        $event = Event::find($id);
        return view('user.volunteer', compact('event'));
    }

    // Go to restricted donation page
    public function donate_edit($id) { // localhost/events/1/edit
        $event = Event::find($id);
        return view('user.event-donate', compact('event'));
    }

    // Now unused
    public function update($id) {
        $event = Event::find($id);
        $user_event = new UserEvent();

        $event->volunteer_slots = $event->volunteer_slots - 1;
        
        $event->save();

        $user_event->user_id = Auth::user()->id;
        $user_event->event_id = $id;
        $user_event->volunteer_hours = 0;
        $user_event->donation_amount = 0.0;

        $user_event->save();

        return redirect('/');
    }

    // Confirm voluntter
    public function volunteer_update($id) {
        $event = Event::find($id);
        $user_id = Auth::user()->id;
        $user_event = new UserEvent();
        // Create a new user-event which correlates the logged-in user with the selected event
        $user_events = DB::select('SELECT user_events.id AS id, events.id as events_id, name, date_time, description, status
        FROM user_events
        JOIN users ON users.id = user_events.user_id
        JOIN events ON events.id = user_events.event_id
        WHERE user_events.user_id = ? AND user_events.event_id = ?', [$user_id, $id]);

        if(count($user_events) > 0){
            $user_event = UserEvent::find($user_events[0]->id);
        }
        // Update the voluntter slots
        $event->volunteer_slots = $event->volunteer_slots - 1;
        
        $event->save();

        $user_event->user_id = Auth::user()->id;
        $user_event->event_id = $id;
        $user_event->volunteer_hours = $event->hours;
        $user_event->donation_amount = 0.0;

        $user_event->save();

        return redirect('/my-events');
    }

    // Confirm restricted donation
    public function donate_update($id) {
        $event = Event::find($id);
        $user_event = new UserEvent();
        $user_id = Auth::user()->id;
        // Create new user-event that correlates the loggin-in user to the event selected
        $user_events = DB::select('SELECT user_events.id AS id, events.id as events_id, name, date_time, description, status
        FROM user_events
        JOIN users ON users.id = user_events.user_id
        JOIN events ON events.id = user_events.event_id
        WHERE user_events.user_id = ? AND user_events.event_id = ?', [$user_id, $id]);
        // If the user has already donated to the event, update the corresponding user-event
        if(count($user_events) > 0){
            $user_event->status = "donated";
            $user_event->volunteer_hours = 0;
            
        } else {
            $user_event->status = "donated";
            $user_event->volunteer_hours = 0;
        }

        $user_event->user_id = Auth::user()->id;
        $user_event->event_id = $id;
        $user_event->donation_amount = $user_event->donation_amount + request('donation_amount');

        $user_event->save();
        // Update the event's donation amount
        $event->donated_amount = $event->donated_amount + request('donation_amount');
        $event->save();

        return redirect('/my-donations');
    }
    // Unused
    public function destroy() {

    }
    // Stores new event in the database with information admin fills out in a form
    public function store() {
        $event = new Event();
        $event->name = request('name');
        $event->date_created = request('date_created');
        $event->date_time = request('date_time');
        $event->description = request('description');
        $event->volunteer_slots = request('volunteer_slots');
        $event->donated_amount = request('donated_amount');
        $event->hours = request('hours');
        $event->donation_goal = request('donation_goal');

        $event->save();

        return redirect('/events');
    }

    // Go to event cancel page with selected event
    public function cancelEvent($id){
        $event = Event::find($id);
        return view('admin.cancel-event', compact('event'));
    }

    // Update the event to not be active and also update all user-events such that the status becomes cancelled
    public function cancelEventConfirm($id){
        // Make event inactive
        $event = Event::find($id);
        $event->active = false;
        $event->save();
        // Make user-event's be cancelled
        DB::table('user_events')
            ->where('event_id', $id)
            ->where('status', 'signed_up')
            ->update(['volunteer_hours' => 0, 'status' => 'cancelled']);

        return redirect('/events');
    }
}
