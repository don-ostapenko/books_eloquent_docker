<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        $faker = Faker\Factory::create();
        $users = [];

        for ($i = 0; $i < 2; $i++) {
            if ($i == 0) {
                $users[] = [
                    'nickname' => $faker->name,
                    'email' => 'admin@gmail.com',
                    'role' => ($i == 0) ? 1 : 0,
                    'password_hash' => password_hash('pass', PASSWORD_DEFAULT),
                    'auth_token' => $faker->sha1,
                    'created_at' => date('Y-m-d H:i:s')
                ];
            } else {
                $users[] = [
                    'nickname' => $faker->name,
                    'email' => 'user@gmail.com',
                    'role' => ($i == 0) ? 1 : 0,
                    'password_hash' => password_hash('pass', PASSWORD_DEFAULT),
                    'auth_token' => $faker->sha1,
                    'created_at' => date('Y-m-d H:i:s')
                ];
            }
        }

        $this->table('users')->insert($users)->saveData();
    }
}
