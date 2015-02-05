<?php

    /**
     * Created by PhpStorm.
     * User: Sam
     * Date: 30/01/2015
     * Time: 10:17 AM
     */
    class ProjectTest extends TestCase
    {
        public function testCreateProject()
        {
            $project = new Project;
            $project->name = 'Another Project';
            $project->user_id = 1;
            $project->save();

            $projects = Project::all()->toArray();

            $this->assertEquals(2, count($projects));
        }
    }