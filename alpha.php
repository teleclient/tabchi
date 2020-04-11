<?php

declare(strict_types=1);
date_default_timezone_set('Asia/Tehran');
if (!\file_exists('madeline.php')) {
    \copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
require 'madeline.php';

class EventHandler extends \danog\MadelineProto\EventHandler
{
    const ADMIN = "AHP_Net";
    private $owner;
    private $start;

    public function __construct(?\danog\MadelineProto\APIWrapper $API)
    {
        parent::__construct($API);
        $this->start = time();
    }
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    public function onUpdateNewChannelMessage($update)
    {
        yield $this->onUpdateNewMessage($update);
    }
    public function onUpdateNewMessage($update)
    {
        if ($update['message']['_'] === 'messageEmpty') {
            return;
        }
        $message = isset($update['message'])                          ? $update['message'] : '';
        $main_msg      = isset($update['message']['message'])         ? trim($update['message']['message']) : null;
        $msg           = $main_msg                                    ? strtolower($main_msg) : null;
        $msg_id        = isset($update['message']['id'])              ? $update['message']['id'] : 0;
        $from_id       = isset($update['message']['from_id'])         ? $update['message']['from_id'] : 0;
        $reply_id      = isset($update['message']['reply_to_msg_id']) ? $update['message']['reply_to_msg_id'] : 0;
        $is_out        = isset($update['message']['out'])             ? $update['message']['out'] : false;
        $type          = isset($update['message']['to_id']['_'])      ? $update['message']['to_id']['_'] : '';
        $chat_id       = isset($update['message']['to_id'])           ? $update['message']['to_id'] : '';
        $MadelineProto = $this;

        //try {
            if ($msg == "آمار" or $msg == "State") {
                $group = 0;
                $pv = 0;
                $ch = 0;
                $bot = 0;
                $dialogs = yield $MadelineProto->get_dialogs();
                foreach ($dialogs as $peer) {
                    $type = yield $MadelineProto->get_info($peer);
                    $type3 = $type['type'];
                    if ($type3 == "supergroup") {
                        $group = $group + 1;
                    }
                    if ($type3 == "user") {
                        $pv = $pv + 1;
                    }
                    if ($type3 == "bot") {
                        $bot = $bot + 1;
                    }
                    if ($type3 == "channel") {
                        $ch = $ch + 1;
                    }
                }
                $al = $group + $pv + $ch + $bot;
                yield $MadelineProto->messages->sendMessage([
                    'peer'    => $chat_id,
                    'message' =>
                                "🔺آمار ربات تبچے آلفا (نسخه 7.3)<br>".
                                "<br>".
                                "- ڪل چت ها: `$al`<br>".
                                "- تعداد سوپرگروه ها: `$group`<br>".
                                "- تعداد ڪانال ها: `$ch`<br>".
                                "- تعداد ربات ها: `$bot`<br>".
                                "- تعداد پیوے ها: `$pv`<br>".
                                "<br>".
                                "بررسے خروج<br>".
                                "`Channel Left`",
                    'parse_mode' => 'HTML'
                ]);
            }
            if (preg_match('/^(For all)$/i', $msg) && isset($message['reply_to_msg_id'])) {
                yield $MadelineProto->messages->sendMessage([
                    'peer'       => $chat_id,
                    'message'    => "ربات درحال فروارد پیام است...",
                    'parse_mode' => 'html'
                ]);
                $dialogs = yield $MadelineProto->get_dialogs();
                foreach ($dialogs as $peer) {
                    try {
                        $type = yield $MadelineProto->get_info($peer);
                        $type3 = $type['type'];
                        if ($type3 == "user" || $type3 == "supergroup") {
                            yield $MadelineProto->messages->forwardMessages([
                                'from_peer' => $chat_id,
                                'to_peer'   => $peer,
                                'id'        => [$message['reply_to_msg_id']]
                            ]);
                        }
                    } catch (\danog\MadelineProto\RPCErrorException $e) {
                    }
                }
                $MadelineProto->messages->sendMessage([
                    'peer'       => $chat_id,
                    'message'    => "فروارد به تمام چت ها انجام شد!",
                    'parse_mode' => 'html']);
            }
        //} catch (RPCErrorException $e) {
        //} catch (Exception $e) {
        //}
    }
}

if (file_exists('MadelineProto.log')) {unlink('MadelineProto.log');}
$settings['logger']['logger_level'] = \danog\MadelineProto\Logger::ULTRA_VERBOSE;
$settings['logger']['logger'] = \danog\MadelineProto\Logger::FILE_LOGGER;
$MadelineProto = new \danog\MadelineProto\API('session.madeline', $settings);

$genLoop = new \danog\MadelineProto\Loop\Generic\GenericLoop(
    $MadelineProto,
    function () use ($MadelineProto) {
        $MadelineProto->logger('Time is ' . date('H:i:s') . '!');
        return 60;
    },
    'Repeating Loop'
);

while (true) {
    try {
        $MadelineProto->async(true);
        $MadelineProto->loop(function () use ($MadelineProto) {
            $owner = yield $MadelineProto->start();
            yield $MadelineProto->setEventHandler('\EventHandler');
            yield $MadelineProto->getEventHandler('\EventHandler')->setOwner($owner);
        });
        $genLoop->start();
        $MadelineProto->loop();
    } catch (\Throwable $e) {
        try {
            $MadelineProto->logger("Surfaced: $e");
            $MadelineProto->getEventHandler(['async' => false])->report("Surfaced: $e");
        } catch (\Throwable $e) {
        }
    }
}
