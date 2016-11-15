<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Silex\Application;
use Longman\TelegramBot\Commands\UserCommand;

class TweetCommand extends UserCommand
{
    protected $name = 'tweet';
    protected $description = 'Tweet a message :)';
    protected $usage = '/tweet';
    protected $version = '1.0.0';

    public function execute()
    {
        $message = $this->getMessage();

        $chatId = $message->getChat()->getId();

        $data = [
            'chat_id' => $chatId,
            'text' => ''
        ];

        return \Longman\TelegramBot\Request::sendMessage($data);
    }
}
