<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;

class WatCommand extends UserCommand
{
    protected $name = 'wat';
    protected $description = 'Test command.';
    protected $usage = '/wat';
    protected $version = '1.0.0';

    public function execute()
    {
        $message = $this->getMessage();

        $chatId = $message->getChat()->getId();

        $data = [
            'chat_id' => $chatId,
            'text' => 'Ay Caramba!'
        ];

        return \Longman\TelegramBot\Request::sendMessage($data);
    }
}
