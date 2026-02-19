<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%s", $BEGIN);
fscanf(STDIN, "%s", $END);

$start = Datetime::createFromFormat('d.m.Y', $BEGIN);
$end = Datetime::createFromFormat('d.m.Y', $END);

$diff = $start->diff($end);

$outputBits = [];

$years = $diff->format("%y");
$yearsOutput = $years > 0 ? $diff->y . ' year' : null;
$yearsOutput .= $years > 1 ? 's' : '';
if (!empty($yearsOutput)) {
    $outputBits[] = $yearsOutput;
}

$months = $diff->format("%m");
$monthsOutput = $months > 0 ? $diff->m . ' month' : null;
$monthsOutput .= $months > 1 ? 's' : '';
if (!empty($monthsOutput)) {
    $outputBits[] = $monthsOutput;
}

$daysOutput = 'total ' . $diff->days. ' days';
$outputBits[] = $daysOutput;

echo(implode(', ', $outputBits)."\n");
?>