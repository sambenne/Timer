<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 30/01/2015
 * Time: 11:14 AM
 */

class DashboardController extends \BaseController {
    public function show()
    {
        return View::make('dashboard.show')
            ->with('user', Auth::user())
            ->with('timers', Auth::user()->timers)
            ->with('projects', Auth::user()->projects)
            ->with('running', Auth::user()->getRunningTimer());
    }
}