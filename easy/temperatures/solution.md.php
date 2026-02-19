<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d",
    $n // the number of temperatures to analyse
);
$temperatures = stream_get_line(STDIN, 256 + 1, "\n"); // the n temperatures expressed as integers ranging from -273 to 5526
$temperatures = explode(' ', $temperatures);

if (empty($temperatures[0])) {
    echo "0\n";
    return;
}

$closest = $temperatures[0];

for ($i = 1; $i < count($temperatures); $i++) {
    if ((abs($temperatures[$i]) < abs($closest))
        || (abs($temperatures[$i]) === abs($closest) && $closest < $temperatures[$i])) {
        $closest = $temperatures[$i];
    }
}

echo $closest."\n";

?>