<?php

    /**
     * Created by PhpStorm.
     * User: Sam
     * Date: 30/01/2015
     * Time: 10:17 AM
     */
    class TimerTest extends TestCase
    {

        public function testNewTimer()
        {
            $time = time();

            $this->createTimer($time);

            $timers = Timer::all()->toArray();

            $this->assertCount( 1, $timers );
        }

        public function testGetTimer()
        {
            $time = time();

            $this->createTimer($time);

            /**
             * @var Timer $timer
             */
            $timer = Timer::find(1);

            $this->assertEquals( 'Test Timer', $timer->name );
            $this->assertEquals( $time, $timer->start );
            $this->assertEquals( NULL, $timer->end );
            $this->assertEquals( 1, $timer->user_id );
            $this->assertEquals( 1, $timer->project_id );
        }

        public function testEndTimer()
        {
            $this->createTimer(time());

            /**
             * @var Timer $timer
             */
            $timer = Timer::find(1);
            $this->assertEquals( NULL, $timer->end );

            $time = $timer->endTimer();

            $this->assertEquals( $time, $timer->end );
        }

        private function createTimer($time, $name = 'Test Timer')
        {
            $timer = new Timer;
            $timer->name = $name;
            $timer->start = $time;
            $timer->user_id = 1;
            $timer->project_id = 1;
            $timer->save();
        }
    }