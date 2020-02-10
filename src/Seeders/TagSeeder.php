<?php

use Phinx\Seed\AbstractSeed;

class TagSeeder extends AbstractSeed
{
    public function run()
    {
        $tags = [
            ['name' => 'php'],
            ['name' => 'mysql'],
            ['name' => 'jquery'],
            ['name' => 'wordpress'],
            ['name' => 'laravel'],
            ['name' => 'python'],
        ];

        $this->table('tags')->insert($tags)->saveData();
    }
}
