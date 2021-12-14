<?php
/**
 * Controller for manipulating programs
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Program;

class ProgramController extends Controller
{
    // Show all programs
    public function index(){
        $programs = Program::all();
        return view('programs', compact('programs'));
    } 
    // Go to program creation page
    public function create() {
        return view('admin.create-program');
    }

    public function show() {

    }

    public function edit() {

    }

    public function update() {

    }

    public function destroy() {
        
    }
    // Store a new program from the admin's creation form
    public function store() {
        $program = new Program();
        $program->name = request('name');
        $program->date_created = request('date_created');
        $program->description = request('description');
        $program->total_volunteers = request('total_volunteers');
        $program->total_donations = request('total_donations');

        $program->save();

        return redirect('/');
    }
}
