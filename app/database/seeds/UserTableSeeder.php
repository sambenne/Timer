<?php
    class UserTableSeeder extends Seeder {

        public function run()
        {
            DB::table('users')->delete();

            User::create( [
                'email' => 'foo@bar.com',
                'password' => 'password',
                'name' => 'Foo Bar'
            ] );
        }

    }