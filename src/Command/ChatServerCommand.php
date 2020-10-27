<?php


namespace App\Command;


use App\Server\Chat;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ChatServerCommand extends Command
{
    protected static $defaultName = 'chat-server';

    protected function configure()
    {
        $this
            ->setDescription('Start chat server');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $server = IoServer::factory(
            new HttpServer(new WsServer(new Chat())),
            8080,
            '127.0.0.1'
        );
        $server->run();
        return 0;
    }
}