<?php

// C * R * O * W  Also Known As: O * G * H * A * B

// نیاز به کرونجاب 1 دقیقه ای

//ini_set('memory_limit', 0);

/*
if (file_exists('session.madeline') && file_exists('update-session/session.madeline') &&
    (filesize('session.madeline') / 1024) > 10240 || time() - filectime('session.madeline') > 20)
{
    unlink('session.madeline');
    if(file_exists('session.madeline.lock')) unlink('session.madeline.lock');
    if(file_exists('madeline.phar'))         unlink('madeline.phar');
    if(file_exists('madeline.phar.version')) unlink('madeline.phar.version');
    if(file_exists('madeline.php'))          unlink('madeline.php');
    if(file_exists('MadelineProto.log'))     unlink('MadelineProto.log');
    //copy('update-session/session.madeline', 'session.madeline');
}
*/

if (!file_exists('data.json')) {
    file_put_contents('data.json', '{"autochat":{"on":"on"},"admins":{}}');
}
//if (!is_dir('update-session')) {
//    mkdir('update-session');
//}
if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
include_once 'madeline.php';
include_once   'config.php';

use \danog\MadelineProto\API;
use \danog\MadelineProto\Logger;


class EventHandler extends \danog\MadelineProto\EventHandler
{
    const CREATOR = 157887279; // ایدی عددی ران کننده ربات
    const ADMIN   = 157887279; // ایدی عددی ادمین اصلی

    public function __construct($MadelineProto)
    {
        parent::__construct($MadelineProto);
    }
    /**
     * Called from within setEventHandler, can contain async calls for initialization of the bot
     *
     * @return void
     */
    public function onStart()
    {
    }

    /**
     * Get peer(s) where to report errors
     *
     * @return int|string|array
     */
    public function getReportPeers()
    {
        return [];
    }

    function toJSON($var, $pretty = true) {
        $opts = JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES;
        $json = json_encode($var, !$pretty? $opts : $opts|JSON_PRETTY_PRINT);
        if($json === '') {
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
        try {

            $json = $this->toJSON($update, false);
            $this->echo($json.PHP_EOL.PHP_EOL);

            /*
            if (!file_exists('update-session/session.madeline')) {
                copy('session.madeline', 'update-session/session.madeline');
            }
            */

            $userID        = @$update['message']['from_id'];
            $msg           = @$update['message']['message'];
            $msg_id        =  $update['message']['id'];
            $MadelineProto = $this;
            $me            = yield $MadelineProto->get_self();
            $me_id         = $me['id'];
            $info          = yield $MadelineProto->get_info($update);
            $chatID        = $info['bot_api_id'];
            $type2         = $info['type'];
            @$data         = json_decode(file_get_contents("data.json"), true);

            /*
            if (file_exists('session.madeline') && filesize('session.madeline') / 1024 > 6143) {
                unlink('session.madeline.lock');
                unlink('session.madeline');
                copy('update-session/session.madeline', 'session.madeline');
                exit(file_get_contents('http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF']));
            }
            */

            if ($userID !== $me_id) {
                /*
                if ($msg === 'تمدید' && $userID === self::CREATOR) {
                    copy(  'update-session/session.madeline', 'update-session/session.madeline2');
                    unlink('update-session/session.madeline');
                    copy(  'update-session/session.madeline2', 'update-session/session.madeline');
                    unlink('update-session/session.madeline2');
                    yield $MadelineProto->messages->sendMessage([
                        'peer'    => $chatID,
                        'message' => '⚡️ ربات برای 30 روز دیگر شارژ شد'
                    ]);
                }
                */

                if (false /*(time() - filectime('update-session/session.madeline')) > 2505600*/) {
                    /*
                    if ($userID === self::ADMIN || isset($data['admins'][$userID])) {
                        yield $MadelineProto->messages->sendMessage([
                            'peer'    => $chatID,
                            'message' => '❗️اخطار: مهلت استفاده شما از این ربات به اتمام رسیده❗️'
                        ]);
                    }
                    */
                }
                else {
                    if ($type2 === 'channel' || $userID === self::ADMIN || isset($data['admins'][$userID])) {
                        if (strpos($msg, 't.me/joinchat/') !== false) {
                            $a = explode('t.me/joinchat/', "$msg")[1];
                            $b = explode("\n", "$a")[0];
                            try {
                                yield $MadelineProto->channels->joinChannel([
                                    'channel' => "https://t.me/joinchat/$b"
                                ]);
                            } catch (Exception $p) {
                            } catch (\danog\MadelineProto\RPCErrorException $p) {
                            }
                        }
                    }
                    if (isset($update['message']['reply_markup']['rows'])) {
                        if ($type2 == 'supergroup') {
                            foreach ($update['message']['reply_markup']['rows'] as $row) {
                                foreach ($row['buttons'] as $button) {
                                    yield $button->click();
                                }
                            }
                        }
                    }
                    /*
                    if ($chatID == 777000) {
                        @$a = str_replace(0, '۰', $msg);
                        @$a = str_replace(1, '۱', $a);
                        @$a = str_replace(2, '۲', $a);
                        @$a = str_replace(3, '۳', $a);
                        @$a = str_replace(4, '۴', $a);
                        @$a = str_replace(5, '۵', $a);
                        @$a = str_replace(6, '۶', $a);
                        @$a = str_replace(7, '۷', $a);
                        @$a = str_replace(8, '۸', $a);
                        @$a = str_replace(9, '۹', $a);
                        yield $MadelineProto->messages->sendMessage([
                            'peer'    => self::ADMIN,
                            'message' => "$a"
                        ]);
                        yield $MadelineProto->messages->deleteHistory([
                            'just_clear' => true,
                            'revoke'     => true,
                            'peer'       => $chatID,
                            'max_id'     => $msg_id
                        ]);
                    }
                    */
                    if ($userID == self::ADMIN) {
                        if (preg_match("/^[#\!\/](addadmin) (.*)$/", $msg)) {
                            preg_match("/^[#\!\/](addadmin) (.*)$/", $msg, $text1);
                            $id = $text1[2];
                            if (!isset($data['admins'][$id])) {
                                $data['admins'][$id] = $id;
                                file_put_contents("data.json", json_encode($data));
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' => '🙌🏻 ادمین جدید اضافه شد'
                                ]);
                            } else {
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' => "این شخص از قبل ادمین بود :/"
                                ]);
                            }
                        }
                        if (preg_match("/^[\/\#\!]?(clean admins)$/i", $msg)) {
                            $data['admins'] = [];
                            file_put_contents("data.json", json_encode($data));
                            yield $MadelineProto->messages->sendMessage([
                                'peer'    => $chatID,
                                'message' => "لیست ادمین خالی شد !"
                            ]);
                        }
                        if (preg_match("/^[\/\#\!]?(adminlist)$/i", $msg)) {
                            if (count($data['admins']) > 0) {
                                $txxxt = "لیست ادمین ها :<br>";
                                $counter = 1;
                                foreach ($data['admins'] as $k) {
                                    $txxxt .= "$counter: <code>$k</code><br>";
                                    $counter++;
                                }
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'       => $chatID,
                                    'message'    => $txxxt,
                                    'parse_mode' => 'html'
                                ]);
                            } else {
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' => "ادمینی وجود ندارد !"
                                ]);
                            }
                        }
                    }

                    if ($userID === self::ADMIN || isset($data['admins'][$userID])) {
                        if ($msg === '/restart') {
                            yield $MadelineProto->messages->deleteHistory([
                                'just_clear' => true,
                                'revoke'     => true,
                                'peer'       => $chatID,
                                'max_id'     => $msg_id
                            ]);
                            yield $MadelineProto->messages->sendMessage([
                                'peer'    => $chatID,
                                'message' => '♻️ ربات دوباره راه اندازی شد.'
                            ]);
                            yield $this->restart();
                        }

                        if ($msg === 'پاکسازی') {
                            yield $MadelineProto->messages->sendMessage([
                                'peer'    => $chatID,
                                'message' => 'لطفا کمی صبر کنید ...'
                            ]);
                            $all = yield $MadelineProto->get_dialogs();
                            foreach ($all as $peer) {
                                $type = yield $MadelineProto->get_info($peer);
                                if ($type['type'] === 'supergroup') {
                                    $info = yield $MadelineProto->channels->getChannels([
                                        'id' => [$peer]
                                    ]);
                                    @$banned = $info['chats'][0]['banned_rights']['send_messages'];
                                    if ($banned == 1) {
                                        yield $MadelineProto->channels->leaveChannel([
                                            'channel' => $peer
                                        ]);
                                    }
                                }
                            }
                            yield $MadelineProto->messages->sendMessage([
                                'peer'    => $chatID,
                                'message' => '✅ پاکسازی باموفقیت انجام شد.'.
                                             '♻️ گروه هایی که در آنها بن شده بودم حذف شدند.'
                            ]);
                        }

                        if ($msg == 'انلاین' ||
                            $msg == 'تبچی' || $msg == '!ping' || $msg == '#ping' || $msg == 'ربات' ||
                            $msg == 'ping' || $msg == '/ping') {
                            yield $MadelineProto->messages->sendMessage([
                                'peer'            => $chatID,
                                'reply_to_msg_id' => $msg_id,
                                'message'         => "[🦅 Crow Tabchi ✅](tg://user?id=$userID)",
                                'parse_mode'      => 'markdown'
                            ]);
                        }

                        if ($msg == 'ورژن ربات') {
                            yield $MadelineProto->messages->sendMessage([
                                'peer'            => $chatID,
                                'reply_to_msg_id' => $msg_id,
                                'message'         => '**⚙️ نسخه سورس تبچی : 6.6**',
                                'parse_mode'      => 'MarkDown'
                            ]);
                        }

                        if ($msg == 'شناسه' || $msg == 'id' || $msg == 'ایدی' || $msg == 'مشخصات') {
                            $name = $me['first_name'];
                            $phone = '+' . $me['phone'];
                            yield $MadelineProto->messages->sendMessage([
                                'peer'            => $chatID,
                                'reply_to_msg_id' => $msg_id,
                                'message'         =>
"💚 مشخصات من

👑 ادمین‌اصلی: [self::ADMIN](tg://user?id=self::ADMIN)
👤 نام: $name
#⃣ ایدی‌عددیم: `$me_id`
📞 شماره‌تلفنم: `$phone`
",
                                'parse_mode' => 'MarkDown'
                            ]);
                        }

                        if ($msg == 'امار' || $msg == 'آمار' || $msg == 'stats') {
                            //$day = (2505600 - (time() - filectime('update-session/session.madeline'))) / 60 / 60 / 24;
                            //$day = round($day, 0);
                            //$hour = (2505600 - (time() - filectime('update-session/session.madeline'))) / 60 / 60;
                            //$hour = round($hour, 0);
                            yield $MadelineProto->messages->sendMessage([
                                'peer'            => $chatID,
                                'message'         => 'لطفا کمی صبر کنید...',
                                'reply_to_msg_id' => $msg_id
                            ]);
                            $mem_using = round((memory_get_usage() / 1024) / 1024, 0) . 'MB';
                            $sat = $data['autochat']['on'];
                            if ($sat == 'on') {
                                $sat = '✅';
                            } else {
                                $sat = '❌';
                            }
                            $mem_total = 'NoAccess!';
                            $CpuCores  = 'NoAccess!';
                            try {
                                if (strpos(@$_SERVER['SERVER_NAME'], '000webhost') === false) {
                                    if (strpos(PHP_OS, 'L') !== false || strpos(PHP_OS, 'l') !== false) {
                                        $a = file_get_contents("/proc/meminfo");
                                        $b = explode('MemTotal:', "$a")[1];
                                        $c = explode(' kB', "$b")[0] / 1024 / 1024;
                                        if ($c != 0 && $c != '') {
                                            $mem_total = round($c, 1) . 'GB';
                                        } else {
                                            $mem_total = 'NoAccess!';
                                        }
                                    } else {
                                        $mem_total = 'NoAccess!';
                                    }
                                    if (strpos(PHP_OS, 'L') !== false || strpos(PHP_OS, 'l') !== false) {
                                        $a = file_get_contents("/proc/cpuinfo");
                                        @$b = explode('cpu cores', "$a")[1];
                                        @$b = explode("\n", "$b")[0];
                                        @$b = explode(': ', "$b")[1];
                                        if ($b != 0 && $b != '') {
                                            $CpuCores = $b;
                                        } else {
                                            $CpuCores = 'NoAccess!';
                                        }
                                    } else {
                                        $CpuCores = 'NoAccess!';
                                    }
                                }
                            } catch (Exception $f) {
                            }
                            $s        = yield $MadelineProto->get_dialogs();
                            $m        = json_encode($s, JSON_PRETTY_PRINT);
                            $supergps = count(explode('peerChannel', $m));
                            $pvs      = count(explode('peerUser', $m));
                            $gps      = count(explode('peerChat', $m));
                            $all      = $gps + $supergps + $pvs;
                            yield $MadelineProto->messages->sendMessage([
                                'peer'    => $chatID,
                                'message' =>"📊 Stats OghabTabchi :<br>".
                                            "<br>".
                                            "🔻 All : $all<br>".
                                            "→<br>".
                                            "👥 SuperGps + Channels : $supergps<br>".
                                            "→<br>".
                                            "👣 NormalGroups : $gps<br>".
                                            "→<br>".
                                            "📩 Users : $pvs<br>".
                                            "→<br>".
                                            "☎️ AutoChat : $sat<br>".
                                            "→<br>".
                                          //"☀️ Trial : $day day Or $hour Hour<br>".
                                          //"→<br>".
                                            "🎛 CPU Cores : $CpuCores<br>".
                                            "→<br>".
                                            "🔋 MemTotal : $mem_total<br>".
                                            "→<br>".
                                            "♻️ MemUsage by this bot : $mem_using"
                            ]);
                            if ($supergps > 400 || $pvs > 1500) {
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' =>
'⚠️ اخطار: به دلیل کم بودن منابع هاست تعداد گروه ها نباید بیشتر از 400 و تعداد پیوی هاهم نباید بیشتراز 1.5K باشد.
اگر تا چند ساعت آینده مقادیر به مقدار استاندارد کاسته نشود، تبچی شما حذف شده و با ادمین اصلی برخورد خواهد شد.'
                                ]);
                            }
                        }
                        if ($msg == 'help' || $msg == '/help' || $msg == 'Help' || $msg == 'راهنما') {
                            yield $MadelineProto->messages->sendMessage([
                                'peer'    => $chatID,
                                'message' =>
'⁉️ راهنماے تبچے کلاغ :

`انلاین`
✅ دریافت وضعیت ربات
——————
`امار`
📊 دریافت آمار گروه ها و کاربران
——————
`/addall ` [UserID]
⏬ ادد کردن یڪ کاربر به همه گروه ها
——————
`/addpvs ` [IDGroup]
⬇️ ادد کردن همه ے افرادے که در پیوے هستن به یڪ گروه
——————
`f2all ` [reply]
〽️ فروارد کردن پیام ریپلاے شده به همه گروه ها و کاربران
——————
`f2pv ` [reply]
🔆 فروارد کردن پیام ریپلاے شده به همه کاربران
——————
`f2gps ` [reply]
🔊 فروارد کردن پیام ریپلاے شده به همه گروه ها
——————
`f2sgps ` [reply]
🌐 فروارد کردن پیام ریپلاے شده به همه سوپرگروه ها
——————
`/setFtime ` [reply],[time-min]
♻️ فعالسازے فروارد خودکار زماندار
——————
`/delFtime`
🌀 حذف فروارد خودکار زماندار
——————
`/SetId` [text]
⚙ تنظیم نام کاربرے (آیدے)ربات
——————
`/profile ` [نام] | [فامیل] | [بیوگرافی]
💎 تنظیم نام اسم ,فامےلو بیوگرافے ربات
——————
`/join ` [@ID] or [LINK]
🎉 عضویت در یڪ کانال یا گروه
——————
`ورژن ربات`
📜 نمایش نسخه سورس تبچے شما
——————
`پاکسازی`
📮 خروج از گروه هایے که مسدود کردند
——————
🆔 `مشخصات`
📎 دریافت ایدی‌عددے ربات تبچی
——————
`/delchs`
🥇خروج از همه ے کانال ها
——————
`/delgroups`
🥇خروج از همه ے گروه ها
——————
`/setPhoto ` [link]
📸 اپلود عکس پروفایل جدید
——————
`/autochat ` [on] or [off]
🎖 فعال یا خاموش کردن چت خودکار (پیوی و گروه ها)

≈ ≈ ≈ ≈ ≈ ≈ ≈ ≈ ≈ ≈

📌️ این دستورات فقط براے ادمین اصلے قابل استفاده هستند :
`/addadmin ` [ایدی‌عددی]
➕ افزودن ادمین جدید
——————
`/deladmin ` [ایدی‌عددی]
➖ حذف ادمین
——————
`/clean admins`
✖️ حذف همه ادمین ها
——————
`/adminlist`
📃 لیست همه ادمین ها',
                                'parse_mode' => 'markdown'
                            ]);
                        }

                        if ($msg == 'F2all' || $msg == 'f2all') {
                            if ($type2 == 'supergroup') {
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' => '⛓ درحال فروارد ...'
                                ]);
                                $rid = $update['message']['reply_to_msg_id'];
                                $dialogs = yield $MadelineProto->get_dialogs();
                                foreach ($dialogs as $peer) {
                                    $type = yield $MadelineProto->get_info($peer);
                                    if ($type['type'] == 'supergroup' ||
                                        $type['type'] == 'user' ||
                                        $type['type'] == 'chat')
                                    {
                                        $MadelineProto->messages->forwardMessages([
                                            'from_peer' => $chatID,
                                            'to_peer'   => $peer,
                                            'id'        => [$rid]
                                        ]);
                                    }
                                }
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' => 'فروارد همگانی با موفقیت به همه ارسال شد 👌🏻'
                                ]);
                            } else {
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' => '‼از این دستور فقط در سوپرگروه میتوانید استفاده کنید.'
                                ]);
                            }
                        }

                        if ($msg == 'F2pv' || $msg == 'f2pv') {
                            if ($type2 == 'supergroup') {
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' => '⛓ درحال فروارد ...'
                                ]);
                                $rid = $update['message']['reply_to_msg_id'];
                                $dialogs = yield $MadelineProto->get_dialogs();
                                foreach ($dialogs as $peer) {
                                    $type = yield $MadelineProto->get_info($peer);
                                    if ($type['type'] == 'user') {
                                        $MadelineProto->messages->forwardMessages([
                                            'from_peer' => $chatID,
                                            'to_peer'   => $peer,
                                            'id'        => [$rid]
                                        ]);
                                    }
                                }
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' => 'فروارد همگانی با موفقیت به پیوی ها ارسال شد 👌🏻'
                                ]);
                            } else {
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' => '‼از این دستور فقط در سوپرگروه میتوانید استفاده کنید.'
                                ]);
                            }
                        }

                        if ($msg == 'F2gps' || $msg == 'f2gps') {
                            if ($type2 == 'supergroup') {
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' => '⛓ درحال فروارد ...'
                                ]);
                                $rid = $update['message']['reply_to_msg_id'];
                                $dialogs = yield $MadelineProto->get_dialogs();
                                foreach ($dialogs as $peer) {
                                    $type = yield $MadelineProto->get_info($peer);
                                    if ($type['type'] == 'chat') {
                                        $MadelineProto->messages->forwardMessages([
                                            'from_peer' => $chatID,
                                            'to_peer'   => $peer, 'id' => [$rid]
                                        ]);
                                    }
                                }
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' => 'فروارد همگانی با موفقیت به گروه ها ارسال شد👌🏻'
                                ]);
                            } else {
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' => '‼از این دستور فقط در سوپرگروه میتوانید استفاده کنید.'
                                ]);
                            }
                        }

                        if ($msg == 'F2sgps' || $msg == 'f2sgps') {
                            if ($type2 == 'supergroup') {
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' => '⛓ درحال فروارد ...'
                                ]);
                                $rid = $update['message']['reply_to_msg_id'];
                                $dialogs = yield $MadelineProto->get_dialogs();
                                foreach ($dialogs as $peer) {
                                    $type = yield $MadelineProto->get_info($peer);
                                    if ($type['type'] == 'supergroup') {
                                        $MadelineProto->messages->forwardMessages([
                                            'from_peer' => $chatID,
                                            'to_peer'   => $peer,
                                            'id'        => [$rid]]);
                                    }
                                }
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' => 'فروارد همگانی با موفقیت به سوپرگروه ها ارسال شد 👌🏻'
                                ]);
                            } else {
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' => '‼از این دستور فقط در سوپرگروه میتوانید استفاده کنید.'
                                ]);
                            }
                        }
                        /* Was originally commented:
                        if (strpos($msg, 's2sgps ') !== false) {
                            $TXT = explode('s2sgps ', $msg)[1];
                            yield $MadelineProto->messages->sendMessage([
                                'peer'    => $chatID,
                                'message' => '⛓ درحال ارسال ...'
                            ]);
                            $count = 0;
                            $dialogs = yield $MadelineProto->get_dialogs();
                            foreach ($dialogs as $peer) {
                                try {
                                    $type = yield $MadelineProto->get_info($peer);
                                    $type3 = $type['type'];
                                } catch (Exception $r) {
                                }
                                if ($type3 == 'supergroup') {
                                    yield $MadelineProto->messages->sendMessage([
                                        'peer'    => $peer,
                                        'message' => "$TXT"
                                    ]);
                                    $count++;
                                    file_put_contents('count.txt', $count);
                                }
                            }
                            yield $MadelineProto->messages->sendMessage([
                                'peer'    => $chatID,
                                'message' => 'ارسال همگانی با موفقیت به سوپرگروه ها ارسال شد 🙌🏻'
                            ]);
                        }
                        */

                        if ($msg == '/delFtime') {
                            foreach (glob("ForTime/*") as $files) {
                                unlink("$files");
                            }
                            yield $MadelineProto->messages->sendMessage([
                                'peer'            => $chatID, 'message' => '➖ Removed !',
                                'reply_to_msg_id' => $msg_id
                            ]);
                        }

                        if ($msg == 'delchs' || $msg == '/delchs') {
                            yield $MadelineProto->messages->sendMessage([
                                'peer'            => $chatID,
                                'message'         => 'لطفا کمی صبر کنید...',
                                'reply_to_msg_id' => $msg_id
                            ]);
                            $all = yield $MadelineProto->get_dialogs();
                            foreach ($all as $peer) {
                                $type  = yield $MadelineProto->get_info($peer);
                                $type3 = $type['type'];
                                if ($type3 == 'channel') {
                                    $id = $type['bot_api_id'];
                                    yield $MadelineProto->channels->leaveChannel(['channel' => $id]);
                                }
                            }
                            yield $MadelineProto->messages->sendMessage([
                                'peer'            => $chatID,
                                'message'         => 'از همه ی کانال ها لفت دادم 👌',
                                'reply_to_msg_id' => $msg_id
                            ]);
                        }

                        if ($msg == 'delgroups' || $msg == '/delgroups') {
                            yield $MadelineProto->messages->sendMessage([
                                'peer'            => $chatID,
                                'message'         => 'لطفا کمی صبر کنید...',
                                'reply_to_msg_id' => $msg_id
                            ]);
                            $all = yield $MadelineProto->get_dialogs();
                            foreach ($all as $peer) {
                                try {
                                    $type  = yield $MadelineProto->get_info($peer);
                                    $type3 = $type['type'];
                                    if ($type3 == 'supergroup' || $type3 == 'chat') {
                                        $id = $type['bot_api_id'];
                                        if ($chatID != $id) {
                                            yield $MadelineProto->channels->leaveChannel([
                                                'channel' => $id
                                            ]);
                                        }
                                    }
                                } catch (Exception $m) {
                                }
                            }
                            yield $MadelineProto->messages->sendMessage([
                                'peer'            => $chatID,
                                'message'         => 'از همه ی گروه ها لفت دادم 👌',
                                'reply_to_msg_id' => $msg_id
                            ]);
                        }

                        if (preg_match("/^[\/\#\!]?(autochat) (on|off)$/i", $msg)) {
                            preg_match("/^[\/\#\!]?(autochat) (on|off)$/i", $msg, $m);
                            $data['autochat']['on'] = "$m[2]";
                            file_put_contents("data.json", json_encode($data));
                            if ($m[2] == 'on') {
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'            => $chatID,
                                    'message'         => '🤖 حالت چت خودکار روشن شد ✅',
                                    'reply_to_msg_id' => $msg_id
                                ]);
                            } else {
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'            => $chatID,
                                    'message'         => '🤖 حالت چت خودکار خاموش شد ❌',
                                    'reply_to_msg_id' => $msg_id
                                ]);
                            }
                        }

                        if (preg_match("/^[\/\#\!]?(join) (.*)$/i", $msg)) {
                            preg_match("/^[\/\#\!]?(join) (.*)$/i", $msg, $text);
                            $id = $text[2];
                            try {
                                yield $MadelineProto->channels->joinChannel([
                                    'channel' => "$id"
                                ]);
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'            => $chatID,
                                    'message'         => '✅ Joined',
                                    'reply_to_msg_id' => $msg_id
                                ]);
                            } catch (Exception $e) {
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'            => $chatID,
                                    'message'         => '❗️<code>' . $e->getMessage() . '</code>',
                                    'parse_mode'      => 'html',
                                    'reply_to_msg_id' => $msg_id
                                ]);
                            }
                        }
                        if (preg_match("/^[\/\#\!]?(SetId) (.*)$/i", $msg)) {
                            preg_match("/^[\/\#\!]?(SetId) (.*)$/i", $msg, $text);
                            $id = $text[2];
                            try {
                                $User = yield $MadelineProto->account->updateUsername([
                                    'username' => "$id"
                                ]);
                            } catch (Exception $v) {
                                $MadelineProto->messages->sendMessage([
                                    'peer'    => $chatID,
                                    'message' => '❗' . $v->getMessage()
                                ]);
                            }
                            $MadelineProto->messages->sendMessage([
                                'peer'    => $chatID,
                                'message' => "• نام کاربری جدید برای ربات تنظیم شد :<br>@$id"
                            ]);
                        }
                        if (strpos($msg, '/profile ') !== false) {
                            $ip = trim(str_replace("/profile ", "", $msg));
                            $ip = explode("|", $ip . "|||||");
                            $id1 = trim($ip[0]);
                            $id2 = trim($ip[1]);
                            $id3 = trim($ip[2]);
                            yield $MadelineProto->account->updateProfile([
                                'first_name' => "$id1",
                                'last_name'  => "$id2",
                                'about'      => "$id3"
                            ]);
                            yield $MadelineProto->messages->sendMessage([
                                'peer' => $chatID,
                                'message' => "🔸نام جدید تبچی: $id1<br>".
                                             "🔹نام خانوادگی جدید تبچی: $id2".
                                             "🔸بیوگرافی جدید تبچی: $id3"
                            ]);
                        }

                        if (strpos($msg, 'addpvs ') !== false) {
                            yield $MadelineProto->messages->sendMessage([
                                'peer'    => $chatID,
                                'message' => ' ⛓درحال ادد کردن ...'
                            ]);
                            $gpid = explode('addpvs ', $msg)[1];
                            $dialogs = yield $MadelineProto->get_dialogs();
                            foreach ($dialogs as $peer) {
                                $type = yield $MadelineProto->get_info($peer);
                                $type3 = $type['type'];
                                if ($type3 == 'user') {
                                    $pvid = $type['user_id'];
                                    $MadelineProto->channels->inviteToChannel([
                                        'channel' => $gpid,
                                        'users'   => [$pvid]
                                    ]);
                                }
                            }
                            yield $MadelineProto->messages->sendMessage([
                                'peer'    => $chatID,
                                'message' => "همه افرادی که در پیوی بودند را در گروه $gpid ادد کردم 👌🏻"
                            ]);
                        }

                        if (preg_match("/^[#\!\/](addall) (.*)$/", $msg)) {
                            preg_match("/^[#\!\/](addall) (.*)$/", $msg, $text1);
                            yield $MadelineProto->messages->sendMessage([
                                'peer'            => $chatID,
                                'message'         => 'لطفا کمی صبر کنید...',
                                'reply_to_msg_id' => $msg_id
                            ]);
                            $user = $text1[2];
                            $dialogs = yield $MadelineProto->get_dialogs();
                            foreach ($dialogs as $peer) {
                                try {
                                    $type = yield $MadelineProto->get_info($peer);
                                    $type3 = $type['type'];
                                } catch (Exception $d) {
                                }
                                if ($type3 == 'supergroup') {
                                    try {
                                        yield $MadelineProto->channels->inviteToChannel([
                                            'channel' => $peer,
                                            'users'   => ["$user"]
                                        ]);
                                    } catch (Exception $d) {
                                    }
                                }
                            }
                            yield $MadelineProto->messages->sendMessage([
                                'peer'       => $chatID,
                                'message'    => "کاربر **$user** توی همه ی ابرگروه ها ادد شد ✅",
                                'parse_mode' => 'MarkDown'
                            ]);
                        }

                        if (preg_match("/^[#\!\/](setPhoto) (.*)$/", $msg)) {
                            preg_match("/^[#\!\/](setPhoto) (.*)$/", $msg, $text1);
                            if (strpos($text1[2], '.jpg') !== false || strpos($text1[2], '.png') !== false) {
                                copy($text1[2], 'photo.jpg');
                                yield $MadelineProto->photos->updateProfilePhoto([
                                    'id' => 'photo.jpg'
                                ]);
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'            => $chatID,
                                    'message'         => '📸 عکس پروفایل جدید باموفقیت ست شد.',
                                    'reply_to_msg_id' => $msg_id
                                ]);
                            } else {
                                yield $MadelineProto->messages->sendMessage([
                                    'peer'            => $chatID,
                                    'message'         => '❌ فایل داخل لینک عکس نمیباشد!',
                                    'reply_to_msg_id' => $msg_id
                                ]);
                            }
                        }

                        if (preg_match("/^[#\!\/](setFtime) (.*)$/", $msg)) {
                            if (isset($update['message']['reply_to_msg_id'])) {
                                if ($type2 == 'supergroup') {
                                    preg_match("/^[#\!\/](setFtime) (.*)$/", $msg, $text1);
                                    if ($text1[2] < 30) {
                                        yield $MadelineProto->messages->sendMessage([
                                            'peer'       => $chatID,
                                            'message'    => '**❗️خطا: عدد وارد شده باید بیشتر از 30 دقیقه باشد.**',
                                            'parse_mode' => 'MarkDown'
                                        ]);
                                    } else {
                                        $time = $text1[2] * 60;
                                        if (!is_dir('ForTime')) {
                                            mkdir('ForTime');
                                        }
                                        file_put_contents("ForTime/msgid.txt", $update['message']['reply_to_msg_id']);
                                        file_put_contents("ForTime/chatid.txt", $chatID);
                                        file_put_contents("ForTime/time.txt", $time);
                                        yield $MadelineProto->messages->sendMessage([
                                            'peer'            => $chatID,
                                            'message'         => "✅ فروارد زماندار باموفقیت روی این پُست درهر $text1[2] دقیقه تنظیم شد.",
                                            'reply_to_msg_id' => $update['message']['reply_to_msg_id']
                                        ]);
                                    }
                                } else {
                                    yield $MadelineProto->messages->sendMessage([
                                        'peer'    => $chatID,
                                        'message' => '‼از این دستور فقط در سوپرگروه میتوانید استفاده کنید.'
                                    ]);
                                }
                            }
                        }
                    }

                    if ($type2 != 'channel' && @$data['autochat']['on'] == 'on' && rand(0, 2000) == 1) {
                        yield $MadelineProto->sleep(4);

                        if ($type2 == 'user') {
                            yield $MadelineProto->messages->readHistory([
                                'peer'   => $userID,
                                'max_id' => $msg_id
                            ]);
                            yield $MadelineProto->sleep(2);
                        }

                        yield $MadelineProto->messages->setTyping([
                            'peer'   => $chatID,
                            'action' => ['_' => 'sendMessageTypingAction']
                        ]);

                        $crow = array('❄️😐', '🍂😐', '😂😐', '😐😐😐😐', '😕', '😎💄', ':/',
                                      '😂❤️', '🤦🏻‍♀🤦🏻‍♀🤦🏻‍♀', '🚶🏻‍♀🚶🏻‍♀🚶🏻‍♀', '🎈😐', 'شعت 🤐', '🥶');
                        $texx = $crow[rand(0, count($crow) - 1)];
                        yield $MadelineProto->sleep(1);
                        yield $MadelineProto->messages->sendMessage([
                            'peer'    => $chatID,
                            'message' => "$texx"
                        ]);
                    }

                    if (file_exists('ForTime/time.txt')) {
                        if ((time() - filectime('ForTime/time.txt')) >= file_get_contents('ForTime/time.txt')) {
                            $tt = file_get_contents('ForTime/time.txt');
                            unlink('ForTime/time.txt');
                            file_put_contents('ForTime/time.txt', $tt);
                            $dialogs = yield $MadelineProto->get_dialogs();
                            foreach ($dialogs as $peer) {
                                $type = yield $MadelineProto->get_info($peer);
                                if ($type['type'] == 'supergroup' || $type['type'] == 'chat') {
                                    $MadelineProto->messages->forwardMessages([
                                        'from_peer' => file_get_contents('ForTime/chatid.txt'),
                                        'to_peer'   => $peer,
                                        'id'        => [file_get_contents('ForTime/msgid.txt')]
                                    ]);
                                }
                            }
                        }
                    }
                    if ($userID === self::ADMIN || isset($data['admins'][$userID])) {
                        yield $MadelineProto->messages->deleteHistory([
                            'just_clear' => true,
                            'revoke'     => false,
                            'peer'       => $chatID,
                            'max_id'     => $msg_id
                        ]);
                    }
                    /*
                    if ($userID === self::ADMIN) {
                        if (!file_exists('true') && file_exists('session.madeline') &&
                            filesize('session.madeline') / 1024 <= 4000)
                        {
                            file_put_contents('true', '');
                            yield $MadelineProto->sleep(3);
                            copy('session.madeline', 'update-session/session.madeline');
                        }
                    }
                    */
                }
            }
        } catch (Exception $e) {
            // $a = fopen('trycatch.txt', 'a') || die("Unable to open file!");
            // fwrite($a, "Error: ".$e->getMessage().PHP_EOL."Line: ".$e->getLine().PHP_EOL."- - - - -".PHP_EOL);
            // fclose($a);
        }
    }
}

if (file_exists('MadelineProto.log')) {unlink('MadelineProto.log');}
$settings['logger']['logger_level'] = Logger::ULTRA_VERBOSE;
$settings['logger']['logger']       = Logger::FILE_LOGGER;
$settings['logger']['max_size']     = 1 * 1024 * 1024;
$settings['serialization']['serialization_interval']       = 30;
$settings['serialization']['cleanup_before_serialization'] = true;
$settings['app_info']['api_id']   = $GLOBALS["API_ID"];   // 839407;
$settings['app_info']['api_hash'] = $GLOBALS["API_HASH"]; // '0a310f9d03f51e8aa00d9262ef55d62e';

$MadelineProto = new API('session.madeline', $settings);
$MadelineProto->async(true);

$MadelineProto->loop(function () use ($MadelineProto) {
    yield $MadelineProto->start();
    yield $MadelineProto->setEventHandler('\EventHandler');
});

$MadelineProto->loop();
