<?php

use App\Team;
use App\User;
use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team = Team::factory()->create([
            'name' => "Cabang 1",
        ]);

        $karyawan = User::factory()->create([
            'name'           => "Andi",
            'email'          => "Andi@gmail.com",
            'password'       => bcrypt('password'),
            'team_id'        => $team->id,
            'remember_token' => null,
        ]);
        $karyawan->roles()->sync(2);
    }
}
