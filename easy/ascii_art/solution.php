<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d",
    $L
);
fscanf(STDIN, "%d",
    $H
);
$T = strtoupper(stream_get_line(STDIN, 256 + 1, "\n"));

$asciiStr = array();
for ($j = 0; $j < strlen($T); $j++) {
    $asciiStr[] = ord($T[$j]) - 65;
    if (ord($T[$j]) < 65 || ord($T[$j]) > 90) {
        $asciiStr[$j] = 26;
    }
}

$result = '';
for ($i = 0; $i < $H; $i++) {
    $ROW = stream_get_line(STDIN, 1024 + 1, "\n");
    for ($x = 0; $x < count($asciiStr); $x++) {
        $startingChar = ($asciiStr[$x]) * $L;
        $result .= substr($ROW, $startingChar, $L);
    }
    $result .= "\n";
}

echo($result . "\n");

?>