<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Abraham\TwitterOAuth\TwitterOAuth;
use Longman\TelegramBot\Commands\UserCommand;

class TweetCommand extends UserCommand
{
    protected $name = 'tweet';
    protected $description = 'Tweet a given <link>';
    protected $usage = '/tweet <link>';
    protected $version = '1.0.0';

    public function execute()
    {
        $connection = new TwitterOAuth(
            getenv('TWITTER.CONSUMER_KEY'),
            getenv('TWITTER.CONSUMER_SECRET'),
            getenv('TWITTER.ACCESS_TOKEN'),
            getenv('TWITTER.ACCESS_TOKEN_SECRET')
        );

        $message = $this->getMessage();

        $raw = explode(' ', $message->getText());

        $status = $connection->post(
            'statuses/update',
            [
                'status' => $raw[1]
            ]
        );

        if ($connection->getLastHttpCode() !== 200) {
            throw new \RuntimeException('Tweet has failed.');
        }

        $chatId = $message->getChat()->getId();

        $data = [
            'chat_id' => $chatId,
            'text' => 'https://twitter.com/devdrops/status/'.$status->id_str
        ];

        return \Longman\TelegramBot\Request::sendMessage($data);
    }
}
