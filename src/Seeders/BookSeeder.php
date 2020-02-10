<?php

use Phinx\Seed\AbstractSeed;

class BookSeeder extends AbstractSeed
{
    public function run()
    {
        $books = [
            [
                'ISBN' => '1491978910',
                'name' => 'Learning PHP, MySQL & JavaScript: With jQuery, CSS & HTML5',
                'poster' => 'https://images-na.ssl-images-amazon.com/images/I/51aUTzDIxxL._SX379_BO1,204,203,200_.jpg',
                'url' => 'https://www.amazon.com/Learning-PHP-MySQL-JavaScript-Javascript/dp/1491978910',
                'price' => 8.49,
            ],
            [
                'ISBN' => '1789532019',
                'name' => 'WordPress 5 Complete: Build beautiful and feature-rich websites from scratch',
                'poster' => 'https://images-na.ssl-images-amazon.com/images/I/51mIYYmtBQL._SX404_BO1,204,203,200_.jpg',
                'url' => 'https://www.amazon.com/WordPress-Complete-beautiful-feature-rich-websites/dp/1789532019',
                'price' => 18.21,
            ],
            [
                'ISBN' => '1491936088',
                'name' => 'Laravel: Up and Running',
                'poster' => 'https://images-na.ssl-images-amazon.com/images/I/51bEpBADC%2BL._SX379_BO1,204,203,200_.jpg',
                'url' => 'https://www.amazon.com/Laravel-Up-Running-Matt-Stauffer/dp/1491936088',
                'price' => 13.99,
            ],
            [
                'ISBN' => '1785882813',
                'name' => 'Mastering PHP 7: Design, configure, build, and test professional web applications',
                'poster' => 'https://images-na.ssl-images-amazon.com/images/I/51g-nakCoSL._SX404_BO1,204,203,200_.jpg',
                'url' => 'https://www.amazon.com/Mastering-PHP-configure-professional-applications/dp/1785882813',
                'price' => 20.15,
            ],
            [
                'ISBN' => '1593279280',
                'name' => 'Python Crash Course, 2nd Edition',
                'poster' => 'https://images-na.ssl-images-amazon.com/images/I/510-dE3N1PL._SX376_BO1,204,203,200_.jpg',
                'url' => 'https://www.amazon.com/Python-Crash-Course-2nd-Edition/dp/1593279280',
                'price' => 22.99,
            ],
            [
                'ISBN' => '1491957662',
                'name' => 'Python for Data Analysis: Data Wrangling with Pandas',
                'poster' => 'https://images-na.ssl-images-amazon.com/images/I/51cUNf8zukL._SX379_BO1,204,203,200_.jpg',
                'url' => 'https://www.amazon.com/Python-Data-Analysis-Wrangling-IPython/dp/1491957662',
                'price' => 28.49,
            ],
            [
                'ISBN' => '1491978910',
                'name' => 'PHP 7 in easy steps',
                'poster' => 'https://images-na.ssl-images-amazon.com/images/I/51TgRKFPg2L._SX408_BO1,204,203,200_.jpg',
                'url' => 'https://www.amazon.com/PHP-easy-steps-Mike-McGrath/dp/184078718X',
                'price' => 49.50,
            ],
        ];

        $this->table('books')->insert($books)->saveData();
    }
}
