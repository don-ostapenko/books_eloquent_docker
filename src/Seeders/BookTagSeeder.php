<?php

use Phinx\Seed\AbstractSeed;

class BookTagSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'BookSeeder',
            'TagSeeder'
        ];
    }

    public function run()
    {
        $books = [
            ['id' => 1],
            ['id' => 2],
            ['id' => 3],
            ['id' => 4],
            ['id' => 5],
            ['id' => 6],
            ['id' => 7],
        ];

        foreach ($books as $book) {
            $countRecorder = rand(1, 3);

            for ($i = 0; $i < $countRecorder; $i++) {
                $this->table('book_tag')->insert([
                    'book_id' => $book['id'],
                    'tag_id' => rand(1, 6)
                ])->saveData();
            }
        }
    }
}
