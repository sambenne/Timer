<?php
    class ProjectTableSeeder extends Seeder {

        public function run()
        {
            DB::table('projects')->delete();

            Project::create( [
                'name' => 'My Project',
                'user_id' => 1
            ] );
        }

    }