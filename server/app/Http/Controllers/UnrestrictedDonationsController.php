<?php
/**
 * Controller for manipulating unrestricted donations
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UnrestrictedDonation;
use Illuminate\Support\Facades\Auth;
use App\Models\UserEvent;
use App\Models\Event;

class UnrestrictedDonationsController extends Controller
{
    // Go to the unrestricted donation page
    public function index(){
        
        return view('user.donate');
    } 
    // Now unused
    public function create() {
        return view('admin.create-event');
    }

    public function show() {

    }
    // Now unused
    public function edit($id) { // localhost/events/1/edit
        $event = Event::find($id);
        return view('user.volunteer', compact('event'));
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

    public function destroy() {

    }
    // Store a new unrestricted donation in the database
    public function store() {
        $donation = new UnrestrictedDonation();
        $donation->donation_amount = request('donation_amount');
        $donation->user_id = Auth::user()->id;

        $donation->save();

        return redirect('/my-donations');
    }
}
