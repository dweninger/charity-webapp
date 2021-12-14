<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{   
    // Create the initial admin
    public function index() {
        $data = [
            'first' => 'admin',
            'last' => 'admin',
            'dob' => '2002-04-15',
            'date_joined' => '2021-10-16',
            'email' => 'admin@test.com',
            'password' => bcrypt('12345'),
            'type' => 'admin',
        ];
        User::create($data);

        $user = User::all();
        return $user;
        return view('welcome');
    }

    // Give list of users
    public function getAllUsers(){
        $users = User::all();

        return view('admin.check-users', compact(['users']));
    } 

    // Go to user activation page with selected user
    public function activateUser($id){
        $user = User::find($id);
        return view('admin.activate-user', compact('user'));
    }

    // Go to user deactivation page with selected user
    public function deactivateUser($id){
        $user = User::find($id);
        return view('admin.deactivate-user', compact('user'));
    }

    // Activate selected user
    public function activateUserConfirm($id){
        $user = User::find($id);
        $user->active = true;
        $user->save();
        return redirect('/users');
    }

    // Deactivate selected user
    public function deactivateUserConfirm($id){
        $user = User::find($id);
        $user->active = false;
        $user->save();
        return redirect('/users');
    }

    // Get one user's information
    public function userInfo($id){
        $user = User::find($id);
        // Get the events that the user is involved in for both their restricted donations and volunteer hours
        $user_events = DB::select('SELECT user_events.id, name, date_time, description, donation_amount, event_id, user_id, hours, volunteer_slots, user_events.status AS status, user_events.created_at AS date
        FROM user_events
        JOIN users ON users.id = user_events.user_id
        JOIN events ON events.id = user_events.event_id
        WHERE user_events.user_id = ?', [$id]);
        // Get the unrestricted donations that the selected user has made
        $u_donations = DB::select('SELECT user_id, donation_amount, unrestricted_donations.created_at AS date
        FROM unrestricted_donations
        JOIN users ON users.id = unrestricted_donations.user_id
        WHERE unrestricted_donations.user_id = ?', [$id]);
        // Send queried information to the user-info page
        return view('admin.user-info', compact('user', 'user_events', 'u_donations'));
    }
}
