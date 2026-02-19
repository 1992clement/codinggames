<?php
fscanf(STDIN, "%d",
    $N
);

$test = array();
for ($i = 0; $i < $N; $i++) {
    fscanf(STDIN, "%d",
        $Pi
    );
    $test[] = $Pi;
}

sort($test);
$maxDiff = $test[1] - $test[0];

for ($i = 2; $i < $N; $i++) {
    if($test[$i] - $test[$i - 1] < $maxDiff) {
        $maxDiff = $test[$i] - $test[$i - 1];
    }
}

echo("$maxDiff\n");

?>