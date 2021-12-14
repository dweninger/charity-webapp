<?php
/**
 * Controller for manipulating user events
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\UserEvent;
use App\Models\Event;
use App\Models\UnrestrictedDonation;
use Illuminate\Support\Facades\Auth;


class UserEventController extends Controller
{
    // Show the user's volunteer appointments on their my-events page
    public function index(){
        // Get user ID from the logged-in user
        $user_id = Auth::user()->id;
        // Search for the user-events that the user is associated with
        $user_events = DB::select('SELECT user_events.id, name, date_time, description, status, donation_amount, event_id, user_id, hours
        FROM user_events
        JOIN users ON users.id = user_events.user_id
        JOIN events ON events.id = user_events.event_id
        WHERE user_events.user_id = ?', [$user_id]);

        return view('user.my-events', compact('user_events'));
    }

    // Show the donations that the user is associated with
    public function donation_index(){
        // Get user ID from the logged-in user
        $user_id = Auth::user()->id;
        // Get the restricted donations associated with the user
        $user_events = DB::select('SELECT user_events.id, name, date_time, description, status, user_events.created_at AS date, donation_amount, event_id, user_id 
        FROM user_events
        JOIN users ON users.id = user_events.user_id
        JOIN events ON events.id = user_events.event_id
        WHERE user_events.user_id = ?', [$user_id]);
        // Get the unrestricted donations associated with the user
        $u_donations = DB::select('SELECT user_id, donation_amount, unrestricted_donations.created_at AS date
        FROM unrestricted_donations
        JOIN users ON users.id = unrestricted_donations.user_id
        WHERE unrestricted_donations.user_id = ?', [$user_id]);

        return view('user.my-donations', compact('user_events', 'u_donations'));
    }

    // Go to the create event page
    public function create() {
        return view('admin.create-event');
    }

    public function show() {

    }

    // User cancels volunteering for an event. ids contains user_id and event_id
    public function edit($ids) {
        // Get the logged-in user id
        $user_id = Auth::user()->id;
        // Get the event id from the id's by splitting on ','
        $event_id = explode(",", $ids)[2];
        // Get the user-event associated with the user-id and event-id
        $user_events = DB::select('SELECT user_events.id, name, date_time, description, status, volunteer_slots, event_id, user_id
        FROM user_events
        JOIN users ON users.id = user_events.user_id
        JOIN events ON events.id = user_events.event_id
        WHERE user_events.user_id = ? AND user_events.event_id = ?', [$user_id, $event_id]);
        // Go to the cancel_volunteer page
        return view('user.cancel_volunteer', compact('user_events'));
    }
    
    // User to update the status of the event
    public function update($ids) {
        // Get the user-event-id from the ids passed in and splitting on ','
        $user_event_id = explode(",", $ids)[0];
        $user_id = Auth::user()->id;
        // Get the event_id by splitting on ','
        $event_id = explode(",", $ids)[2];
        // Get the event by event_id
        $event = Event::find($event_id);
        // Get the user-event by user_event_id
        $user_event = UserEvent::find($user_event_id);

        if($user_event->status == "signed_up"){
            $user_event->status = "cancelled";
            // No longer signed up to volunteer so set the hours to 0
            $user_event->volunteer_hours = 0;
            // No longer signed up to volunteer so add a slot to the event
            $event->volunteer_slots = $event->volunteer_slots + 1;
            $event->save();
        } else {
            // Un-cancel the event -> not implemented
            $user_event->status = "signed_up";
        }

        $user_event->save();

        return redirect('/my-events');
    }
    // Now unused
    public function destroy() {
        
    }
    // Create new user-event -> unused
    public function store() {
        $user_event = new UserEvent();
        $user_event->user_id = request('user_id');
        $user_event->event_id = request('event_id');
        $user_event->save();

        return redirect('/');
    }
    // Create new volunteer user-event
    public function volunteer_store() {
        $user_event = new UserEvent();
        // Get user_event info from page and store in database
        $user_event->user_id = request('user_id');
        $user_event->event_id = request('event_id');
        $user_event->volunteer_hours = request('volunteer_hours');
        $user_event->status = 'signed_up';
        $user_event->save();

        return redirect('/');
    }
    // Create new donate user-event
    public function donate_store() {
        $user_event = new UserEvent();
        // Get user_event info from page and store in database
        $user_event->user_id = request('user_id');
        $user_event->event_id = request('event_id');
        $user_event->donation_amount = request('donation_amount');
        $user_event->status = 'donated';
        $user_event->save();
        // Update the event so that the donated amount increases by the user's restricted donation
        $event = Event::find($user_event->event_id);
        $event->donated_amount = $event->donated_amount + request('donation_amount');

        return redirect('/');
    }
}
