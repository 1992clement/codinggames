<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%s",
    $LON
);
fscanf(STDIN, "%s",
    $LAT
);
fscanf(STDIN, "%d",
    $N
);
$data = array();
$LON = str_replace(",", ".", $LON);
$LAT = str_replace(",", ".", $LAT);

for ($i = 0; $i < $N; $i++)
{
    $DEFIB = stream_get_line(STDIN, 256 + 1, "\n");
    $data[$i] = explode(";" , $DEFIB);
    $data[$i][4] = str_replace(",", ".", $data[$i][4]);
    $data[$i][5] = str_replace(",", ".", $data[$i][5]);
}

$closest = array(
    'name' => $data[0][1],
    'distance' => getDistance($data[0][4], $data[0][5], $LON, $LAT)
);

for($i = 1; $i < count($data); $i++)
{
    $distance = getDistance($data[$i][4], $data[$i][5], $LON, $LAT);

    if($distance < $closest['distance'])
    {
        $closest = array(
            'name' => $data[$i][1],
            'distance' => $distance
        );
    }
}

// Write an action using echo(). DON'T FORGET THE TRAILING \n
// To debug (equivalent to var_dump): error_log(var_export($var, true));
$name = $closest['name'];
echo("$name\n");

function getDistance($longitudeA, $latitudeA, $longitudeB, $latitudeB){
    $x = ($longitudeB - $longitudeA) * cos(($latitudeB + $latitudeA)/2);
    $y = ($latitudeB - $latitudeA);
    return sqrt(pow($x, 2) + pow($y, 2)) * 6371;
}
?>