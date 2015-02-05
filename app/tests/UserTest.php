<?php

    class UserTest extends TestCase
    {

        public function testCreateUserAndGetUser()
        {
            $user = new User;

            $user->name     = 'John Connor';
            $user->email    = 'john.connor@email.com';
            $user->password = Hash::make( 'password' );

            $user->save();

            $users = User::all()
                ->toArray();

            $this->assertCount( 2, $users );

            $user = User::find( 2 );

            $this->assertEquals( 'John Connor', $user->name );
            $this->assertEquals( 'john.connor@email.com', $user->email );
            $this->assertTrue( Hash::check( 'password', $user->password ) );
        }

        public function testLogin()
        {
            $user           = new User;
            $user->name     = 'joe';
            $user->email    = 'joe@gmail.com';
            $user->password = Hash::make( '123456' );

            if (!( $user->save() )) {
                $this->fail('user is not being saved to database properly - this is the problem');
            }

            if (!( Hash::check( '123456', Hash::make( '123456' ) ) )) {
                $this->fail( 'hashing of password is not working correctly - this is the problem' );
            }

            if (!( Auth::attempt( [ 'email' => 'joe@gmail.com', 'password' => '123456' ] ) )) {
                $this->fail( 'storage of user password is not working correctly - this is the problem' );
            }
        }
    }
