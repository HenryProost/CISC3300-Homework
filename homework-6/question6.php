<?php
declare(strict_types = 1);
$car = ["brand"=>"Toyota", "model"=>"4Runner", "year"=>"2013"];

foreach ($car as $x => $y)
{
    echo "$x : $y <br>";
}

function sum(int $a, int $b = 5) : int
{
    $z = $a + $b;
    return $z;
}

echo sum(7);



?>