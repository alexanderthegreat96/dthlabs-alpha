<?php
require __DIR__ . "/../core/AppCli.php";
\LexSystems\Framework\Core\AppCli::boot();
print("Database seeder started...\n");
for($i = 1;$i < 150; $i++)
{
    \LexSystems\Framework\Database\Seeder::run();
    print("Started seeding specified tables: $i \n");
}