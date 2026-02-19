<?php
fscanf(STDIN, "%d",
    $N // Number of elements which make up the association table.
);
fscanf(STDIN, "%d",
    $Q // Number Q of file names to be analyzed.
);

for ($i = 0; $i < $N; $i++) {
    fscanf(STDIN, "%s %s",
        $EXT, // file extension
        $MT // MIME type.
    );
    $exts[strtolower($EXT)] = $MT;
}

for ($i = 0; $i < $Q; $i++) {
    $FNAME = stream_get_line(STDIN, 500 + 1, "\n"); // One file name per line.

    $matches = array();
    preg_match("/([^.]+)$/", $FNAME, $matches);

    if (strpos($FNAME, ".") !== false
        && !empty($matches)
        && array_key_exists(strtolower($matches[0]), $exts)
    ) {
        $tmp = strtolower($matches[0]);
        echo("$exts[$tmp]\n");
    } else {
        echo("UNKNOWN\n");
    }
}
?>