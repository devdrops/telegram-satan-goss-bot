<?php

namespace SatanGoss\Command;

use Abraham\TwitterOAuth\TwitterOAuth;

class TweetCommand
{
    const COMMAND_NAME = '/tweet';

    public function execute()
    {
        $connection = new TwitterOAuth(
            getenv('TWITTER.CONSUMER_KEY'),
            getenv('TWITTER.CONSUMER_SECRET'),
            getenv('TWITTER.ACCESS_TOKEN'),
            getenv('TWITTER.ACCESS_TOKEN_SECRET')
        );

        $message = $this->getMessage();

        $content = trim(str_replace(self::COMMAND_NAME, '', $message->getText()));

        $status = $connection->post(
            'statuses/update',
            [
                'status' => $content
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
