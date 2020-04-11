<?php
ini_set('memory_limit', '2048M');
if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
include 'madeline.php';

/*
function closeConnection($message = 'SelfOghab Is Runinng...<br>@Oghab_Tm')
{
    if (php_sapi_name() === 'cli' || isset($GLOBALS['exited'])) {
        return;
    }
    @ob_end_clean();
    header('Connection: close');
    ignore_user_abort(true);
    ob_start();
    echo '<html><body><h1 style="margin-top:50px; text-align:center; color:white; text-shadow:1px 1px 15px black;">' . $message . '</h1></body</html>';
    $size = ob_get_length();
    header("Content-Length: $size");
    header('Content-Type: text/html');
    ob_end_flush();
    flush();
    $GLOBALS['exited'] = true;
}
//closeConnection();
*/

/*
function shutdown_function($lock)
{
    $a = fsockopen((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 'tls' : 'tcp') . '://' . $_SERVER['SERVER_NAME'], $_SERVER['SERVER_PORT']);
    fwrite($a, $_SERVER['REQUEST_METHOD'] . ' ' . $_SERVER['REQUEST_URI'] . ' ' . $_SERVER['SERVER_PROTOCOL'] . "\r\n" . 'Host: ' . $_SERVER['SERVER_NAME'] . "\r\n\r\n");
    flock($lock, LOCK_UN);
    fclose($lock);
}
if (!file_exists('bot.lock')) {
    touch('bot.lock');
}
//register_shutdown_function('shutdown_function', $lock);
*/

$lock = fopen('bot.lock', 'r+');
$try = 1;
$locked = false;
while (!$locked) {
    $locked = flock($lock, LOCK_EX | LOCK_NB);
    if (!$locked) {
        closeConnection();
        if ($try++ >= 10) {
            exit;
        }
        sleep(1);
    }
}
if (!file_exists('data.json')) {
    file_put_contents('data.json', '{"count":0,"Admin":[],"Channel":[],"seen":"0","Id":100,"Chat":100}');
}

class EventHandler extends \danog\MadelineProto\EventHandler
{
    const DEV = 609406239;

    public function __construct($MadelineProto)
    {
        parent::__construct($MadelineProto);
    }
    public function onUpdateSomethingElse($update)
    {
        if (isset($update['_'])) {
            if ($update['_'] == 'updateNewMessage') {
                onUpdateNewMessage($update);
            } else if ($update['_'] == 'updateNewChannelMessage') {
                onUpdateNewChannelMessage($update);
            }
        }
    }

    public function onUpdateNewChannelMessage($update)
    {
        yield $this->onUpdateNewMessage($update);
    }
    public function onUpdateNewMessage($update)
    {
        $userID = $update['message']['from_id'] ?? null;
        try {
            if (isset($update['message']['message'])) {

                $msg_id        = $update['message']['id']?? 0;
                $msg           = $update['message']['message']?? '';
                $message       = isset($update['message'])?? '';
                $me            = yield $this->get_self();
                $admin         = $me['id'];
                $phone         = $me['phone'];
                $info          = yield $this->get_info($update);
                $chatID        = $info['bot_api_id'];
                $type          = $info['type'];
                $mem_using     = round(memory_get_usage() / 1024 / 1024, 1);
                $MadelineProto = $this;
                $data          = json_decode(file_get_contents("data.json"), true);

                if ($userID == Self::DEV || in_array($userID, $data['Admin'])) {
                    if ($userID == Self::DEV) {
                        if (preg_match('/^(Add Admin (.*))$/i', $msg)) {
                            preg_match('/^(Add Admin (.*))$/i', $msg, $match);
                            $data['Admin'][] = $match[2];
                            file_put_contents("data.json", json_encode($data));
                            $MadelineProto->messages->sendMessage([
                                'peer'    => $chatID,
                                'message' => "Admin has added!"
                            ]);
                        }
                        if (preg_match('/^(Del Admin (.*))$/i', $msg)) {
                            preg_match('/^(Del Admin (.*))$/i', $msg, $match);
                            if (in_array($match[2], $data['Admin'])) {
                                $k = array_search($match[2], $data['Admin']);
                                unset($data['Admin'][$k]);
                                file_put_contents("data.json", json_encode($data));
                                $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' => "Admin has deleted!"
                                ]);
                            }
                        }
                    }
                    if ($msg == "ping" || $msg == "پینگ" || $msg == "Ping") {
                        $MadelineProto->messages->sendMessage([
                            'peer' => $chatID,
                            'message' => 'Alpha Tabchi is Online!', 'parse_mode' => 'MarkDown']);
                    }
                    if ($msg == "Help" || $msg == "راهنما") {
                        $MadelineProto->messages->sendMessage([
                            'peer' => $chatID,
                            'message' =>
'➕ راهنما ربات تبچے آلفا (نسخه 7.3)


🔺 فروارد پیام

فروارد به سوپرگروه ها
`For Sp (Reply)`
فروارد به پے وے ها
`For Pv (Reply)`
فروارد به همه
`For All (Reply)`

🔺 ارسال پیام

ارسال به سوپرگروه ها
`Send Sp (Text)`
ارسال به پے وے ها
`Send Pv (Text)`
ارسال به همه
`Send All (Text)`

🔺 تنظیمات اڪانت

مشاهده پیام ها
`Seen On | Off`
ذخیره مخاطب
`Contact On | Off`
اضافه ڪردن عضو
`Add Pv (Id)`
اضافه ڪردن به گروه ها
`Add Gp (Id)`
خروج از ڪانال ها
`Left Channel`
آمار ربات (تعداد چت ها)
`State`

🔺 پروفایل

تنظیم نام
`Set (FN | LN | Bio)`
تنظیم عڪس
`Profile (Url)`
اطلاعات
`Info`

© برنامه نویسے شده: @EditP
- ڪانال تلگرام: @Alpha_TS', 
        'parse_mode' => 'MarkDown']);
                    }
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
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "🔺آمار ربات تبچے آلفا (نسخه 7.3)


- ڪل چت ها: `$al`
- تعداد سوپرگروه ها: `$group`
- تعداد ڪانال ها: `$ch`
- تعداد ربات ها: `$bot`
- تعداد پیوے ها: `$pv`
- مصرف : $mem_using
بررسے خروج
`Channel Left`",
                            'parse_mode' => 'MarkDown'
                        ]);
                    }
                    if (preg_match('/^(Clean Mute)$/i', $msg)) {
                        $left = 0;
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "لطفا کمی صبر کنید...", 'parse_mode' => 'html']);
                        preg_match('/^(Clean Mute)$/i', $msg, $txt);
                        $dialogs = yield $MadelineProto->get_dialogs();
                        foreach ($dialogs as $peer) {
                            $type = yield $MadelineProto->get_info($peer);
                            $type3 = $type['type'];
                            if ($type3 == "supergroup") {
                                try {
                                    $check = yield $MadelineProto->channels->getChannels(['id' => [$peer],]);
                                    if ($check['chats'][0]['banned_rights']['send_messages'] == true) {
                                        yield $MadelineProto->channels->leaveChannel(['channel' => $peer]);
                                        $left = $left + 1;
                                    }
                                } catch (\danog\MadelineProto\RPCErrorException $e) {
                                }
                            }
                        }
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "تعداد $left گروه به علت سکوت شدن پاکسازی شد!", 'parse_mode' => 'html']);
                    }
                    if (preg_match('/^(For Sp)$/i', $msg) and isset($message['reply_to_msg_id'])) {
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "ربات درحال فروارد پیام است...", 'parse_mode' => 'html']);
                        preg_match('/^(For Sp)$/i', $msg, $txt);
                        $dialogs = yield $MadelineProto->get_dialogs();
                        foreach ($dialogs as $peer) {
                            $type = yield $MadelineProto->get_info($peer);
                            $type3 = $type['type'];
                            if ($type3 == "supergroup") {
                                try {
                                    yield $MadelineProto->messages->forwardMessages(['from_peer' => $chatID, 'to_peer' => $peer, 'id' => [$message['reply_to_msg_id']]]);
                                } catch (\danog\MadelineProto\RPCErrorException $e) {
                                }
                            }
                        }
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "فروارد به سوپرگروه ها انجام شد!", 'parse_mode' => 'html']);
                    }
                    if (preg_match('/^(For Pv)$/i', $msg) and isset($message['reply_to_msg_id'])) {
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "ربات درحال فروارد پیام است...", 'parse_mode' => 'html']);
                        preg_match('/^(For Pv)$/i', $msg, $txt);
                        $dialogs = yield $MadelineProto->get_dialogs();
                        foreach ($dialogs as $peer) {
                            try {
                                $type = yield $MadelineProto->get_info($peer);
                                $type3 = $type['type'];
                                if ($type3 == "user") {
                                    yield $MadelineProto->messages->forwardMessages(['from_peer' => $chatID, 'to_peer' => $peer, 'id' => [$message['reply_to_msg_id']]]);
                                }
                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                            }
                        }
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "فروارد به پیوی ها انجام شد!", 'parse_mode' => 'html']);
                    }
                    if (preg_match('/^(For all)$/i', $msg) and isset($message['reply_to_msg_id'])) {
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "ربات درحال فروارد پیام است...", 'parse_mode' => 'html']);
                        preg_match('/^(For all)$/i', $msg, $txt);
                        $dialogs = yield $MadelineProto->get_dialogs();
                        foreach ($dialogs as $peer) {
                            try {
                                $type = yield $MadelineProto->get_info($peer);
                                $type3 = $type['type'];
                                if ($type3 == "user" || $type3 == "supergroup") {
                                    yield $MadelineProto->messages->forwardMessages(['from_peer' => $chatID, 'to_peer' => $peer, 'id' => [$message['reply_to_msg_id']]]);
                                }
                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                            }
                        }
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "فروارد به تمام چت ها انجام شد!", 'parse_mode' => 'html']);
                    }
                    if (preg_match('/^(Send Sp (.*))$/i', $msg)) {
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "ربات درحال ارسال پیام است...", 'parse_mode' => 'html']);
                        preg_match('/^(Send Sp (.*))$/i', $msg, $txt);
                        $dialogs = yield $MadelineProto->get_dialogs();
                        foreach ($dialogs as $peer) {
                            try {
                                $type = yield $MadelineProto->get_info($peer);
                                $type3 = $type['type'];
                                if ($type3 == "supergroup") {
                                    $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $txt[2], 'parse_mode' => 'html']);
                                }
                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                            }
                        }
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "ارسال به سوپرگروه ها انجام شد!", 'parse_mode' => 'html']);
                    }
                    if (preg_match('/^(Send Pv (.*))$/i', $msg)) {
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "ربات درحال ارسال پیام است...", 'parse_mode' => 'html']);
                        preg_match('/^(Send Pv (.*))$/i', $msg, $txt);
                        $dialogs = yield $MadelineProto->get_dialogs();
                        foreach ($dialogs as $peer) {
                            try {
                                $type = yield $MadelineProto->get_info($peer);
                                $type3 = $type['type'];
                                if ($type3 == "user") {
                                    $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $txt[2], 'parse_mode' => 'html']);
                                }
                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                            }
                        }
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "ارسال به پیوی ها انجام شد!", 'parse_mode' => 'html']);
                    }
                    if (preg_match('/^(Send all (.*))$/i', $msg)) {
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "ربات درحال ارسال پیام است...", 'parse_mode' => 'html']);
                        preg_match('/^(Send all (.*))$/i', $msg, $txt);
                        $dialogs = yield $MadelineProto->get_dialogs();
                        foreach ($dialogs as $peer) {
                            try {
                                $type = yield $MadelineProto->get_info($peer);
                                $type3 = $type['type'];
                                if ($type3 == "supergroup" or $type3 == "user") {
                                    $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $txt[2], 'parse_mode' => 'html']);
                                }
                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                            }
                        }
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "ارسال به تمام چت هاانجام شد!", 'parse_mode' => 'html']);
                    }
                    if (preg_match('/^(Add Pv (.*))$/i', $msg)) {
                        $add = 0;
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "ربات درحال افزودن است...", 'parse_mode' => 'html']);
                        preg_match('/^(Add Pv (.*))$/i', $msg, $txt);
                        $dialogs = yield $MadelineProto->get_dialogs();
                        foreach ($dialogs as $peeer) {
                            try {
                                $peer_info = yield $MadelineProto->get_info($peeer);
                                $peer_type = $peer_info['type'];
                                if ($peer_type == "user") {
                                    yield $MadelineProto->channels->inviteToChannel(['channel' => $txt[2], 'users' => [$peeer]]);
                                    $add = $add + 1;
                                }
                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                            }
                        }
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "تعداد $add کاربر اضافه شد."]);
                    }
                    if (preg_match('/^(Add Gp (.*))$/i', $msg)) {
                        preg_match('/^(Add Gp (.*))$/i', $msg, $m);
                        $dialogs = yield $MadelineProto->get_dialogs();
                        foreach ($dialogs as $peeer) {
                            try {
                                $peer_info = yield $MadelineProto->get_info($peeer);
                                $peer_type = $peer_info['type'];
                                if ($peer_type == "supergroup") {
                                    yield $MadelineProto->channels->inviteToChannel(['channel' => $peeer, 'users' => [$m[2]]]);
                                }
                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                            }
                        }
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "Added To All SuperGroups"]);
                    }
                    if (preg_match('/^(Set (.*) - (.*) - (.*))$/i', $msg)) {
                        preg_match('/^(Set (.*) - (.*) - (.*))$/i', $msg, $m);
                        yield $MadelineProto->account->updateProfile(['first_name' => $m[2], 'last_name' => $m[3], 'about' => $m[4]]);
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "پروفایل با موفقیت آپدیت شد!"]);
                    }
                    if (preg_match('/^(Info)$/i', $msg)) {
                        $ad = count($data['Admin']);
                        $Channel = count($data['Channel']);
                        $MadelineProto->messages->sendMessage([
                            'peer' => $chatID,
                            'message' =>
"➖ مشخصات اڪانت تبچے آلفا (پروفایل)

شناسه عددی: $admin
شماره موبایل: $phone
تعداد مدیران فرعی: $ad
تعداد ڪانال هاے فروارد: $Channel"]);
                    }
                    if (preg_match('/^(Left Channel)$/i', $msg) or preg_match('/^(Channel Left)$/i', $msg)) {
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "ربات درحال خروج از کانال ها است...", 'parse_mode' => 'html']);
                        $dialogs = yield $MadelineProto->get_dialogs();
                        foreach ($dialogs as $peer) {
                            try {
                                $type = yield $MadelineProto->get_info($peer);
                                $type3 = $type['type'];
                                if ($type3 == "channel") {
                                    yield $MadelineProto->channels->leaveChannel(['channel' => $peer]);
                                }
                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                            }
                        }
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "پاکسازی کانال ها انجام شد!", 'parse_mode' => 'html']);
                    }
                    if (preg_match("/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me/", $msg)) {
                        yield $MadelineProto->channels->joinChannel(['channel' => "$msg"]);
                        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "عضویت انجام شد!", 'parse_mode' => 'html']);
                    }
                }
                if (preg_match("/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me/", $msg) and $type == "channel") {
                    yield $MadelineProto->channels->joinChannel(['channel' => "$msg"]);
                }
            }
        } catch (\danog\MadelineProto\RPCErrorException $e) {
        }
    }
}

$settings = [];
$settings['logger']['max_size'] = 5 * 1024 * 1024;
$MadelineProto = new \danog\MadelineProto\API('oghab.madeline', $settings);
$MadelineProto->start();

if (file_get_contents('online.txt') == 'on') {
    $MadelineProto->account->updateStatus(['offline' => false]);
}

$MadelineProto->async(true);
$MadelineProto->loop(function () use ($MadelineProto) {
    yield $MadelineProto->setEventHandler('\EventHandler');
});
$MadelineProto->loop();
?>