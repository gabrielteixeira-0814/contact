<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../bootstrap.php';

use App\Migrations\User;
use App\Migrations\Phone;
use App\Migrations\Address;
use App\Migrations\Contact;

function runMigration($migrationInstance, $methodName) {
    try {
        if (method_exists($migrationInstance, $methodName)) {
            $migrationInstance->$methodName();
            echo get_class($migrationInstance) . "::$methodName executed successfully.\n";
        } else {
            echo get_class($migrationInstance) . "::$methodName method does not exist.\n";
        }
    } catch (Exception $e) {
        echo "Error executing " . get_class($migrationInstance) . "::$methodName: " . $e->getMessage() . "\n";
    }
}

$user = new User();
$phone = new Phone();
$address = new Address();
$contact = new Contact();

$action = $argv[1] ?? null;

if ($action === 'up') {
    runMigration($user, 'up');
    runMigration($phone, 'up');
    runMigration($address, 'up');
    runMigration($contact, 'up');
} elseif ($action === 'down') {
    runMigration($user, 'down');
    runMigration($phone, 'down');
    runMigration($address, 'down');
    runMigration($contact, 'down');
} else {
    echo "Usage: php migrate.php [up|down]\n";
}
