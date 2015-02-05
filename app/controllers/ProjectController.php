<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 30/01/2015
 * Time: 11:49 AM
 */

class ProjectController extends \BaseController {
    public function show()
    {
        return View::make( 'dashboard.projects' )
            ->with('projects', Project::all());
    }

    public function create()
    {
        $rules = [
            'name'    => 'required|min:4'
        ];

        // run the validation rules on the inputs from the form
        $validator = Validator::make( Input::all(), $rules );

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to( 'projects' )
                ->withErrors( $validator )// send back all errors to the login form
                ->withInput(); // send back the input (not the password) so that we can repopulate the form
        } else {

            $project = new Project;
            $project->name = Input::get('name');
            $project->user_id = Auth::user()->id;
            $project->save();

        }
        return Redirect::to( 'projects' );
    }
}