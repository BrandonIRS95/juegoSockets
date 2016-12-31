<?php
use Ratchet\Server\IoServer;
use App\Http\Controllers\Chat;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require dirname(__DIR__) . '/brandonirs.com/vendor/autoload.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    5512
);

$server->run();