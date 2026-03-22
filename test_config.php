<?php
foreach (glob(__DIR__ . '/config/*.php') as $file) {
    $res = include $file;
    if (!is_array($res)) {
        echo "BAD CONFIG: " . basename($file) . " returns " . gettype($res) . "\n";
    }
}
echo "Done\n";
