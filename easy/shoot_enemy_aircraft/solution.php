<?php
function getPlanesPositionsInLine(string $planeChar, string $line) {
    $planesPositions = [];
    $pos = strpos($line, $planeChar);
    $offset = 0;

    while ($pos !== false) {
        $planesPositions[] = $pos;
        $offset = $pos + 1;
        $pos = strpos($line, $planeChar, $offset);
    }

    return $planesPositions;
}

fscanf(STDIN, "%d", $height);

$planesFacingRightPositions = [];
$planesFacingLeftPositions = [];

for ($i = 0; $i < $height; $i++)
{
    fscanf(STDIN, "%s", $line);
    $planesFacingRightPositions[$i] = getPlanesPositionsInLine('>', $line);
    $planesFacingLeftPositions[$i] = getPlanesPositionsInLine('<', $line);
}

$launcherPosition = strpos($line, '^');
$turnsBeforeShoot = [];

for ($lineIndex = 0; $lineIndex < $height; $lineIndex++) {
    $planeAltitude = $height - $lineIndex;
    for ($i = 0; $i < count($planesFacingRightPositions[$lineIndex]); $i++) {
        $planePosition = $planesFacingRightPositions[$lineIndex][$i];
        $turnsBeforeShoot[] = $launcherPosition - $planePosition - $planeAltitude;
    }
    
    for ($i = 0; $i < count($planesFacingLeftPositions[$lineIndex]); $i++) {
        $planePosition = $planesFacingLeftPositions[$lineIndex][$i];
        $turnsBeforeShoot[] = $planePosition - $launcherPosition - $planeAltitude;
    } 
}

sort($turnsBeforeShoot);
$shootNb = 0; 
$turnNb = 0;

while ($shootNb < count($turnsBeforeShoot)) {
    if ($turnsBeforeShoot[$shootNb] - $turnNb === 0) {
        echo "SHOOT\n";
        $shootNb++;
    } else {
        echo "WAIT\n";
    }

    $turnNb++;
}

?>