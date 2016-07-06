<?php
$comando = $_GET['comando'];

    set_time_limit(0);
    $address = 'localhost';
    $port = 4096;
    $server = array('server' => $address, 'porta' => $port);
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if (!($conn = socket_connect($socket, $server['server'], $server['porta']))) {
        echo "connessione non avvenuta";
        exit;
    }

    socket_write($socket, $comando);

    socket_close($socket);

?>