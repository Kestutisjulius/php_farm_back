<?php
require __DIR__.'./db/JsonDb.php';

$animals = ['Sheep', 'Horse', 'Duck', 'Pig', 'Goat', 'Small Donkey', 'Duc', 'Cow'];

$seed = [];
foreach(range(1,11) as $_){
   $seed[] = ['animal' => $animals[rand(0, count($animals)-1)], 'weight' => rand(100, 20000)/100]; 
    // $seed[] = 'animal'=>$animals[rand(1, count($animals))], 'weight' => rand(100, 20000)/100;
}
$db = new JsonDb('farm');
$db->create($seed);

