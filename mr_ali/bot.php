<?php declare(strict_types = 1);

//if (!is_dir("data")){ mkdir ("data");}
if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
include 'madeline.php';

if (!file_exists('data.json')) {
    file_put_contents('data.json','{"bot": "on", "id" :"", "msgid" :""}');
}

function is_english($str) {
	return strlen($str) == mb_strlen($str,'utf-8');
}

class EventHandler extends \danog\MadelineProto\EventHandler
{
    const ADMIN = 157887279;  // <<== Put your userid here

    public function __construct($MadelineProto)
    {
        parent::__construct($MadelineProto);
    }

    public function onStart() {
        $this->messages->sendMessage([
            'peer'    => self::ADMIN,
            'message' => 'Robot started!'
        ]);
    }

    public static function toJSON($var) {
        $json = json_encode($var, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        if ($json == '') {
            $json = var_export($var, true);
        }
        return $json;
    }

    public function onUpdateNewChannelMessage($update)
    {
        yield $this->onUpdateNewMessage($update);
    }

    public function onUpdateNewMessage($update)
    {
        if(!isset($update['message']) ||
                  $update['message']['_'] === 'messageEmpty') {
            return;
        }
        if ($update['message']['out']??false === true) {
            //return;
        }

        $msg     = $update['message']['message']?? '';
        $msgID   = $update['message']['id'];
        $userID  = $update['message']['from_id']?? 0;
        $replyID = $update['message']['reply_to_msg_id']?? 0;
        $info    = $this->getInfo($update['message']['to_id']);
        $chatID  = $info['bot_api_id'];

        $this->logger("userID:'$userID'  chatID:'$chatID'  msgID:'$msgID  msg:'$msg' ");
        $this->echo  ("userID:'$userID'  chatID:'$chatID'  msgID:'$msgID  msg:'$msg' ".PHP_EOL);

        /*try*/ {
			$data = json_decode(file_get_contents('data.json'), true);
            if ($userID === self::ADMIN) {
                if ($msg === '/ping') {
                    $this->messages->sendMessage([
                        'peer'            => $chatID,
                        'reply_to_msg_id' => $msgID,
                        'message'         => 'Lᴍ Oɴʟɪɴᴇ 🇩🇪'
                    ]);
                } elseif ($msg === '/help') {
                    $this->messages->sendMessage([
                        'peer'            => $chatID,
                        'reply_to_msg_id' => $msgID,
                        'message'         => "Hᴇʟʟᴏ Bᴏss Wᴇʟʟᴄᴏᴍᴇ Tᴏ Hᴇʟᴘ Bᴏᴛ ⚘<br>".
                                            "┄┅┄┅┄┄┅┄┅┄┄┅┄┅┄<br>".
                                            "🧩پیکربندی<br>".
                                            "/Cᴏɴғɪɢ<br>".
                                            "🎯دریافت وضعیت ربات<br>".
                                            "/Pɪɴɢ<br>".
                                            "🏆لفت از تمامی کانال ها<br>".
                                            "/Lᴇᴀᴠᴇ<br>".
                                            "🎪دریافت راهنمای ربات<br>".
                                            "/Hᴇʟᴘ<br>".
                                            "┄┅┄┅┄┄┅┄┅┄┄┅┄┅┄<br>".
                                            "<br>",
                        'parse_mode' => "html"
                    ]);
                } elseif ($msg === '/config') {
                    $this->messages->sendMessage([
                        'peer'    => '@Memberspeed_bot',
                        'message' => '/start'
                    ]);
                    $this->channels->joinChannel([
                        'channel' => 'https://t.me/speedmemberok'
                    ]);
                    $this->messages->sendMessage([
                        'peer'            => $chatID,
                        'reply_to_msg_id' => $msgID,
                        'message'         => 'Dᴏɴᴇ!'
                    ]);
                } elseif ($msg === '/leave') {
                    foreach ($this->getDialogs() as $id) {
                        if ($this->getInfo($id)['type'] === 'channel') {
                            $this->channels->leaveChannel([
                                'channel' => $id
                            ]);
                        }
                    }
                    $this->messages->sendMessage([
                        'peer'    => $chatID,
                        'message' => 'Oᴋ Bᴏss🇲🇫!'
                    ]);
                }
            }
            if ($chatID === -1001470141197) {
                foreach ($update['message']['reply_markup']['rows'] as $row) {
                    foreach ($row['buttons'] as $button) {
                        $url = $button['url'];
                        if ($url != null) {
                            $this->channels->joinChannel(['channel' => $url]);
                        }
                        $mn = $button['text'];
                        if (strpos($mn, 'عضو شدم✅') !== false) {
                            $button->click(true);
                        }
                    }
                }
            }
        }
        /*
        catch (\danog\MadelineProto\RPCErrorException $e) {
            yield $this->messages->sendMessage([
                'peer'    => self::ADMIN,
                'message' => $e
            ]);
        }
        catch (\danog\MadelineProto\Exception $e) {
            $this->messages->sendMessage([
                'peer'    => self::ADMIN,
                'message' => $e->getCode().': '.$e->getMessage().PHP_EOL.$e->getTraceAsString()
            ]);
        }
        */
    }
}

if (file_exists('MadelineProto.log')) {unlink('MadelineProto.log');}
$settings['logger']['max_size'] = 100 * 1024 *1024;
$settings['logger']['logger_level'] = \danog\MadelineProto\Logger::ULTRA_VERBOSE;
$settings['logger']['logger']       = \danog\MadelineProto\Logger::FILE_LOGGER;

$MadelineProto = new \danog\MadelineProto\API('session.madeline', $settings);
$MadelineProto->start();
$MadelineProto->setEventHandler(EventHandler::class);
$MadelineProto->loop();
?>