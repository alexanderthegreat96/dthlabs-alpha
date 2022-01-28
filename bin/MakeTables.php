<?php
require __DIR__ . "/../core/App.php";
\LexSystems\Framework\Core\App::boot();
print("Started migrations for specified table structures \n");
\LexSystems\Framework\Database\Migrations::up();