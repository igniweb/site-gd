<?php

use App\Events\UserWasRegistered;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $user = User::create([
            'role' => 'super_admin',
            'email' => 'smuller@tequilarapido.com',
            'password' => Hash::make('azerty'),
            'first_name' => 'Sébastien',
            'last_name' => 'Muller',
        ]);
        event(new UserWasRegistered($user));
    }
}
