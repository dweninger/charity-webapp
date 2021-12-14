@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Manual</div>
                <div id="accordion">
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                          <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
                            All Users
                          </button>
                        </h5>
                      </div>
                  
                      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">All users are able to view the home screen any time by clicking the Theaters R Us icon on the top nav-bar. </li>
                                <li class="list-group-item">All users are able to view the list of programs. Navigate to this by clicking "Programs" and then "Programs List" on the top nav-bar. </li>
                                <li class="list-group-item">All users are able to view the list of events. Navigate to this by clicking "Events" and then "Events List" on the top nav-bar.</li>
                            </ul>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Registering/Logging In
                          </button>
                        </h5>
                      </div>
                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">New users may register as with the "Register" button on the top nav-bar.</li>
                                <li class="list-group-item">Users must fill out all information on the form in order to register to the site.</li>
                                <li class="list-group-item">Registering with the User Type of "Donor" will allow you to both make donations and volunteer for events.</li>
                                <li class="list-group-item">Registering with the User Type of "Volunteer" will allow you to volunteer for events but will not allow you to make donations.</li>
                                <li class="list-group-item">If you would like to change any of your user information including your User Type, please contact your system administrator.</li>
                                <li class="list-group-item">The email of the registered user must be unique.</li>
                                <li class="list-group-item">Returning users may log in with their username and password by clicking the "Login" button on the top nav-bar.</li>
                                <li class="list-group-item">To log out, simply click your name on the top nav-bar and select "Logout".</li>
                            </ul>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                          <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Volunteers
                            </button>
                          </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                          <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">Volunteers may sign up to volunteer for an event using the events list page (Events->Events List).</li>
                                <li class="list-group-item">A volunteer may not sign up for two events that happen at the same time.</li>
                                <li class="list-group-item">You may look at the events that you are involved in by going to your "My-Events" page (Events->My Events).</li>
                                <li class="list-group-item">you may cancel a volunteering appointment from your "My-Events" page by selecting "Cancel" next to the event that you wish to cancel.</li>
                                <li class="list-group-item">Once you have cancelled an event, you must re-sign-up for that event if you wish to volunteer for it again via the "Events List" page.</li>
                                <li class="list-group-item">If an event is cancelled by the admin, the volunteer hours for that event will not get logged and the event will appear as "Cancelled" on your "My-Events" page.</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="headingFour">
                          <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                              Donors
                            </button>
                          </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                          <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">Donors may make both restricted and unrestricted donations.</li>
                                <li class="list-group-item">Restricted donations involve donating to a particular event which can be done via the "Events List" page (Events->Events List).</li>
                                <li class="list-group-item">Unrestricted donations are a donation to Theaters R Us and not a particular event. To make an unrestricted donation, navigate to the unrestricted donation page (Donations->Unrestricted Donations).</li>
                                <li class="list-group-item">View your donation contributions via the "My Donations" page (Donations->My Donations).</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="headingFive">
                          <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                              Admins
                            </button>
                          </h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                          <div class="card-body">
                            <ul class="list-group">
                              <li class="list-group-item">Create a new program by navigating to the "Create Program" page (Administration->Create Program).</li>
                                <li class="list-group-item">Create a new event by navigating to the "Create Event" page (Administration->Create Event).</li>
                                <li class="list-group-item">Cancel an event by navigating to the "Events List" page (Events->Event List) and selecting "Cancel" next to the event that you wish to cancel. Then confirm cancellation on the next page.</li>
                                <li class="list-group-item">View user information via the "Manage Users" page (Administration->Manage Users). From there, you may view the events and donations that the user is involved in via the "Stats" button next to the selected user. </li>
                                <li class="list-group-item">From the "Manage Users" page, you may view the events and donations that the user is involved in via the "Stats" button next to the selected user.</li>
                                <li class="list-group-item">A user account can also be disabled or enabled on the "Manage Users" page via the "Deactivate/Activate" button next to the user.</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                  </div>
                <div class="card-body">
                    Theaters R Us is a non-profit organization dedicated to supporting local theaters and productions.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
