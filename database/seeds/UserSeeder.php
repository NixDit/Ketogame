<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Superadmin
        $user             = new User;
        $user->name       = 'Superadmin';
        $user->lastname   = 'Administrador';
        $user->email      = 'superadmin_dev@mailer.com';
        $user->password   = Hash::make('superadmindev');
        $user->mobile     = '2386567731';
        $user->country_id = '138';
        $user->assignRole('superadmin');
        $user->save();
        // Moderator
        $user             = new User;
        $user->name       = 'Moderator';
        $user->lastname   = 'Administrador';
        $user->email      = 'moderator_dev@mailer.com';
        $user->password   = Hash::make('moderatordev');
        $user->mobile     = '2386567732';
        $user->country_id = '138';
        $user->assignRole('moderator');
        $user->save();

        //Guest
        // for ($i=0; $i < 250; $i++) {
        $user             = new User;
        $user->name       = 'Guest';
        $user->lastname   = 'Administrador';
        $user->email      = 'guest_dev@mailer.com';
        $user->password   = Hash::make('guestdev');
        $user->mobile     = '2386778172';
        $user->country_id = '138';
        $user->assignRole('guest');
        $user->save();

        $user                   = new User;
        $user->name             = 'E-';
        $user->lastname         = 'Mail';
        $user->email            = 'email@ketogames.com.mx';
        $user->password         = Hash::make('mailerdev');
        $user->mobile           = '1234567890';
        $user->country_id       = '138';
        $user->profile_picture  = 'profile-picture-mail.png';
        $user->assignRole('moderator');
        $user->save();
    }
}
