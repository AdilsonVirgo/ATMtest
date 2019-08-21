<?php

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $profile = new Profile();
        $adminRole = Role::whereName('Admin')->first();
        $atmAdminRole = Role::whereName('ATM Admin')->first();
        $atmOperatorRole = Role::whereName('ATM Operator')->first();
        $atmCollectorRole = Role::whereName('ATM Collector')->first();
        $userRole = Role::whereName('User')->first();

        // Seed test admin
        $seededAdminEmail = 'admin@admin.com';
        $user = User::where('email', '=', $seededAdminEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'General Admin',
                'first_name'                     => 'General',
                'last_name'                      => 'Admin',
                'email'                          => $seededAdminEmail,
                'password'                       => Hash::make('password'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_confirmation_ip_address' => $faker->ipv4,
                'admin_ip_address'               => $faker->ipv4,
            ]);

            $user->profile()->save($profile);
            $user->attachRole($adminRole);
            $user->save();
        }

        // Seed ATM admin
        $seededAtmAdminEmail = 'atmadmin@admin.com';
        $user = User::where('email', '=', $seededAtmAdminEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'ATM Admin',
                'first_name'                     => 'ATM',
                'last_name'                      => 'Admin',
                'email'                          => $seededAtmAdminEmail,
                'password'                       => Hash::make('password'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_confirmation_ip_address' => $faker->ipv4,
                'admin_ip_address'               => $faker->ipv4,
            ]);

            $user->profile()->save($profile);
            $user->attachRole($atmAdminRole);
            $user->save();
        }

        // Seed ATM operator
        $seededAtmOperatorEmail = 'atmoperator@admin.com';
        $user = User::where('email', '=', $seededAtmOperatorEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'ATM Operator',
                'first_name'                     => 'ATM',
                'last_name'                      => 'Operator',
                'email'                          => $seededAtmOperatorEmail,
                'password'                       => Hash::make('password'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_confirmation_ip_address' => $faker->ipv4,
                'admin_ip_address'               => $faker->ipv4,
            ]);

            $user->profile()->save($profile);
            $user->attachRole($atmOperatorRole);
            $user->save();
        }

        // Seed ATM collector
        $seededAtmCollectorEmail = 'atmcollector@admin.com';
        $user = User::where('email', '=', $seededAtmCollectorEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'ATM Collector',
                'first_name'                     => 'ATM',
                'last_name'                      => 'Collector',
                'email'                          => $seededAtmCollectorEmail,
                'password'                       => Hash::make('password'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_confirmation_ip_address' => $faker->ipv4,
                'admin_ip_address'               => $faker->ipv4,
            ]);

            $user->profile()->save($profile);
            $user->attachRole($atmCollectorRole);
            $user->save();
        }

        // Seed test user
        $user = User::where('email', '=', 'user@user.com')->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => 'ATM User',
                'first_name'                     => 'ATM',
                'last_name'                      => 'User',
                'email'                          => 'user@user.com',
                'password'                       => Hash::make('password'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_ip_address'              => $faker->ipv4,
                'signup_confirmation_ip_address' => $faker->ipv4,
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($userRole);
            $user->save();
        }

        // Seed test users
        // $user = factory(App\Models\Profile::class, 5)->create();
        // $users = User::All();
        // foreach ($users as $user) {
        //     if (!($user->isAdmin()) && !($user->isUnverified())) {
        //         $user->attachRole($userRole);
        //     }
        // }
    }
}
