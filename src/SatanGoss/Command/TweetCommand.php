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

            //'jQpeodtWCdqPrrPwCtMt4VTRp',
            //'IpBoheAGmKj5jO25JtHg8Rlu2rskqETENwnVfsRz9FcsPMLd6X',
            //'147370299-CSyzmzVxYCS0F1PoFBcbzccFKJOO0kWgmG8bA3Gx',
            //'18lVPHgYbKac7Vg2tdEz8kw8Q7TOGR6c82Z9buIRmrVGa'
        );
        
        $status = $connection->post(
            'statuses/update',
            [
                'status' => 'TIME IS '.microtime()
            ]
        );

        if ($connection->getLastHttpCode() !== 200) {
            throw new \RuntimeException('Tweet has failed.');
        }

        $update = $this->getUpdate();
        $message = $this->getMessage();

        $chatId = $message->getChat()->getId();

        $data = [
            'chat_id' => $chatId,
            //'text' => 'https://twitter.com/devdrops/status/'.$status->id_str
            'text' => print_r($update, true)
        ];

        return \Longman\TelegramBot\Request::sendMessage($data);
    }
}
