<?php
$MESSAGE = stream_get_line(STDIN, 100 + 1, "\n");
$result = '';
$binaryStr = '';

// Convert each char in input message to binary
for ($x = 0; $x < strlen($MESSAGE); $x++) {
    $value = ord($MESSAGE[$x]);
    $value = base_convert($value, 10, 2);
    $value = str_pad($value, 7, "0", STR_PAD_LEFT);

    $binaryStr .= $value;
}
for ($i = 0; $i < strlen($binaryStr); $i++) {
    if ($i !== 0) {
        $result .= " ";
    }
    $result .= ($binaryStr[$i] === "1") ? "0 0" : "00 0";

    $j = 0;
    while (strlen($binaryStr) > ($i + $j + 1)
        && $binaryStr[$i + $j] === $binaryStr[$i + $j + 1]) {
        $result .= "0";
        $j++;
    }

    $i += $j;
}
echo("$result\n");

?>