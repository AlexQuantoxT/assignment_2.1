<?php
namespace MyApp\classes;

use Faker\Factory;
use \MyApp\classes\ConnDB;

require_once 'vendor/autoload.php';

$conn = new ConnDB();
$faker = Factory::create();
//Insert users
for ($i = 0; $i < 10; $i++){
    $name = $faker->firstname;
    $lastname = $faker->lastname;
    $role_id = $faker->numberBetween($min = 1, $max = 2);
    $group_id = $faker->numberBetween($min = 1, $max = 2);
    $sql = "INSERT INTO users VALUES(null,'{$name}', '{$lastname}', '{$role_id}', '{$group_id}')";
    $fill = $conn->connect()->prepare($sql);
    $fill->execute();
}
//Insert groups
$faker = Factory::create();
for ($i = 0; $i < 2; $i++){
    $name = "Group_" . $faker->firstname;
    $sql = "INSERT INTO groups VALUES(null,'{$name}')";
    $fill = $conn->connect()->prepare($sql);
    $fill->execute();
}