<?php

namespace App\Services;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Builder;
use Phinx\Migration\AbstractMigration;

class Migration extends AbstractMigration
{
    /**
     * @var Capsule $capsule
     */
    public $capsule;
    /**
     * @var Builder $schema
     */
    public $schema;

    public function init()
    {
        $this->capsule = new Capsule;
        $this->capsule->addConnection([
            'driver' => 'mysql',
            'host' => 'mysql',
            'database' => 'workDb',
            'username' => 'root',
            'password' => 'pass',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        // Make this Capsule instance available globally via static methods
        $this->capsule->setAsGlobal();
        // Setup the Eloquent ORM
        $this->capsule->bootEloquent();
        $this->schema = $this->capsule->schema();
    }

    public static function connectToDb()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => 'mysql',
            'database' => 'workDb',
            'username' => 'root',
            'password' => 'pass',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        // Make this Capsule instance available globally via static methods
        $capsule->setAsGlobal();
        // Setup the Eloquent ORM
        $capsule->bootEloquent();
    }
}