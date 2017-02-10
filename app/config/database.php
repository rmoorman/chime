<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

/**
 * Update below with your MySQL DB settings (don't change database name unless you updated schema.sql)
 */
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'chime',
    'username' => 'user',
    'password' => 'password',
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci'
]);

// Make this Capsule instance available globally via static methods
$capsule->setAsGlobal();

// Setup the Eloquent ORM
$capsule->bootEloquent();
?>