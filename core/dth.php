<?php
require 'Boot.php';
\LexSystems\Framework\Boot\Bootstrap::boot();

$limit = 500;
while( $i++ < $limit )
{
    \LexSystems\Framework\Core\bin\DatabaseSeeder::run();
    print("Seeding database: $i \n");
    $i++;
}
