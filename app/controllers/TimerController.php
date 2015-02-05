<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 30/01/2015
 * Time: 12:05 PM
 */

class TimerController extends \BaseController {
    /**
     * Start Timer
     *
     * @return string
     */
    public function start()
    {
        $time = time();

        $timer = new Timer;
        $timer->name = Input::get('name');
        $timer->project_id = (int)Input::get('project');
        $timer->user_id = Auth::user()->id;
        $timer->start = $time;
        $timer->save();

        return [
           'type' => 'success',
           'data' => [
               'name' => $timer->name,
               'project' => $timer->project->name,
               'start' => $time,
               'id' => $timer->id
           ]
        ];
    }

    /**
     * Stop Timer
     *
     * @param int $id
     *
     * @return string
     */
    public function stop( $id )
    {
        /**
         * @var Timer $timer
         */
        $timer = Timer::find($id);

        if( $timer ) {
            $timer->endTimer();

            return [
                'type' => 'success',
                'data' => [
                    'name' => $timer->name,
                    'project' => $timer->project->name,
                    'start' => $timer->start,
                    'end' => $timer->end,
                    'id' => $timer->id
                ]
            ];
        }

    }
}