<?php
require 'Boot.php';
\LexSystems\Framework\Boot\Boot::boot();

$limit = 10000;
while( $i++ < $limit )
{
    \LexSystems\Framework\Core\bin\DatabaseSeeder::run();
    print("Seeding database: $i \n");
    $i++;
}
