<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;

class TweetCommand extends UserCommand
{
    protected $name = 'tweet';
    protected $description = 'Tweet a message :)';
    protected $usage = '/tweet';
    protected $version = '1.0.0';

    public function execute()
    {
        $foo = $app['twitter']->request(
            'https://api.twitter.com/1.1/statuses/update.json',
            'POST',
            [
                'status' => 'TIME IS '.time(),
                'possibly_sensitive' => false
            ]
        );

        $message = $this->getMessage();

        $chatId = $message->getChat()->getId();

        $data = [
            'chat_id' => $chatId,
            'text' => $foo
        ];

        return \Longman\TelegramBot\Request::sendMessage($data);
    }
}
