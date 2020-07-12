<?php
declare(strict_types=1);
date_default_timezone_set('Asia/Tehran');

if (!\file_exists('madeline.php')) {
    \copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
require 'madeline.php';

function getBotToId($update): int
{
    if (isset($update['message']['to_id'])) {
        switch ($update['message']['to_id']['_']) {
            case 'peerChannel':
                return intval('-100' . strval($update['message']['to_id']['channel_id']));
            case 'peerChat':
                return -1 * $update['message']['to_id']['chat_id'];
            case 'peerUser':
                return $update['message']['to_id']['user_id'];
        }
    }
    return 0;
}

class EventHandler extends \danog\MadelineProto\EventHandler
{
    const ADMIN = 'joopirus';

    public function getReportPeers()
    {
        return [self::ADMIN];
    }

    function toJSON($var): string
    {
        $json = json_encode($var, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if ($json == '') {
            $json = var_export($var, true);
        }
        return $json;
    }

    public function onUpdateNewChannelMessage(array $update): \Generator
    {
        yield $this->onUpdateNewMessage($update);
    }

    public function onUpdateNewMessage(array $update): \Generator
    {
        if ($update['message']['_'] == 'messageEmpty' || $update['message']['out'] ?? false) {
            return;
        }

        $msg_id   = $update['message']['id']?? 0;
        $msg_text = $update['message']['message']?? null;
        $from_id  = $update['message']['from_id']??0;
        $reply_to_msg_id = $update['message']['reply_to_msg_id']?? 0;
        $peer_type = $update['message']['to_id']['_']?? '';
        $peer      = $update['message']['to_id']?? null;

        if (!empty($msg_text) && strtolower($msg_text) == '/stop') {
            yield $this->messages->sendMessage([
                'peer'            => $from_id,
                'reply_to_msg_id' => $msg_id,
                'message'         => 'Stopping the robot ...',
            ]);
            $this->stop();
            exit();
        }

        try {
            if (!empty($msg_text) &&
                 preg_match_all('@[a-zA-Z\./]+joinchat/([a-zA-Z0-9\-\_]{5,100})@is',
                                 $msg_text, $matches)) {
                $answer_text = '';

                foreach ($matches[1] as $key => $hash) {
                    $ChatInvite = yield $this->messages->checkChatInvite([
                        'hash' => $hash
                    ]);
                    yield $this->messages->sendMessage([
                        'peer'            => $from_id,
                        'reply_to_msg_id' => $msg_id,
                        'message'         => $this->toJSON($ChatInvite)
                    ]);
                    yield $answer_text .= "https://telegram.me/joinchat/{$hash}";
                }
                yield $this->messages->sendMessage([
                    'peer'            => $from_id,
                    'reply_to_msg_id' => $msg_id,
                    'message'         => $answer_text
                ]);
            } elseif (!is_null($msg_text) && strtolower($msg_text) == '/restart') {
                yield $this->messages->sendMessage([
                    'peer'            => $from_id,
                    'reply_to_msg_id' => $msg_id,
                    'message'         => 'Restarting the robot ...',
                ]);
                yield $this->logger('The robot re-started by the owner.');
                $this->restart();
                yield $this->messages->sendMessage([
                    'peer'            => $from_id,
                    'reply_to_msg_id' => $msg_id,
                    'message'         => 'Restarted.',
                ]);
            }
        } catch (\Throwable $e) {
            try {
                exit();
                $e = str_replace('<br>', PHP_EOL, $e);
                $this->logger("Surfaced: $e");
                $this->getEventHandler(['async' => false])->report("Surfaced: $e");
            } catch (\Throwable $e) {
                exit();
            }
        }
    }
}

if (is_file('MadelineProto.log')) {
    unlink('MadelineProto.log');
}

$settings['logger']['logger_level'] = \danog\MadelineProto\Logger::ULTRA_VERBOSE;
$settings['logger']['logger'] = \danog\MadelineProto\Logger::FILE_LOGGER;
$settings['logger']['max_size'] = 10 * 1024;
$settings['app_info']['api_id'] = 6;
$settings['app_info']['api_hash'] = 'eb06d4abfb49dc3eeb1aeb98ae0f581e';

$MadelineProto = new \danog\MadelineProto\API('bot.madeline', $settings);

$MadelineProto->async(true);
$MadelineProto->loop(function () use ($MadelineProto) {
    yield $MadelineProto->start();
    yield $MadelineProto->setEventHandler('\EventHandler');
    yield $MadelineProto->loop();
});
