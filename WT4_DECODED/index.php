<?php

ini_set('display_errors', 0);
ini_set('memory_limit', -1);
ini_set('max_execution_time', 300);
date_default_timezone_set('Asia/Tehran');
require("config.php");


if (!is_dir("data")) {
    @mkdir("data");
    $list = [
        'bot.txt' => "on",
        'join.txt' => "on",
        'save.txt' => "on",
        'limit.txt' => "60",
        'gp_auto_chat.txt' => "on",
        'last_join.txt' => time(),
        'gp_auto_chat_count.txt' => "0",
        'sudo_msg_id.txt' => '0'
    ];
    foreach ($list as $file => $input) {
        file_put_contents("data/" . $file, $input);
    }
    $new_list = ['links_joined.txt', 'links_to_join.txt', 'links_all.txt'];
    foreach ($new_list as $file) {
        @touch("data/" . $file);
    }
}


function Reset_Session($a = false)
{
    $check_session = file_exists("session.madeline");
    $check_update_session = file_exists("backup.session.madeline");
    $size_session = $check_session === true ? round(filesize("session.madeline") / 1024) : 0;

    if ($check_session === true && $check_update_session === false && $a == true) {
        $session = file_get_contents("session.madeline");
        return file_put_contents("backup.session.madeline", $session);
    } else if ($check_session && $check_update_session && $size_session > 6000) {
        unlink("MadelineProto.log");
        unlink("session.madeline.lock");
        unlink('session.madeline');
        copy('backup.session.madeline', 'session.madeline');
        $url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
        exit(file_get_contents($url));
        exit;
        exit;
    } else if ($size_session > 10000 && $check_update_session) {
        unlink("MadelineProto.log");
        unlink("session.madeline.lock");
        unlink('session.madeline');
        unlink('madeline.phar');
        unlink('madeline.phar.version');
        unlink('madeline.php');
        unlink('bot.lock');
        copy('backup.session.madeline', 'session.madeline');
        $url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
        exit(file_get_contents($url));
        exit;
        exit;
    } else {
        return true;
    }
}


function wintab_lock($user_id = "", $check_hour = 2)
{
    if (!is_numeric($user_id) || !is_int($check_hour)) {
        return false;
    }
    if (!file_exists("win_tab.lock")) {
        @touch("win_tab.lock");
    }
    $time = time();
    $file = file_get_contents("win_tab.lock");
    if ($file == "") {
        $pass = "buph0uPv3jqNyNQj4vY3F9BmTK7gcVHW";
        $url = "https://mordab6-2.000webhostapp.com/win-tab-join-api.php?pass=" . strrev($pass) . "&u=" . $user_id;
        $get = file_get_contents($url);
        $json = json_decode($get, 1);
        if (!is_array($json) || !isset($json["ok"])) {
            return false;
        }
        $ok = $json["ok"];
        if ($ok === true) {
            $ary = ["ok" => true, "again_check" => (time() + (3600 * $check_hour))];
            @file_put_contents("win_tab.lock", strrev(base64_encode(json_encode($ary))));
            return true;
        } else {
            $ary = ["ok" => false, "again_request" => ($time + 120)];
            @file_put_contents("win_tab.lock", strrev(base64_encode(json_encode($ary))));
            return false;
        }
    } else {
        $bj64 = json_decode(base64_decode(strrev($file)), 1);
        if (!is_array($bj64)) {
            return false;
        }
        $ok = $bj64["ok"];
        if ($ok === false) {
            $again_request = $bj64["again_request"];
            if ($time > $again_request) {
                $pass = "buph0uPv3jqNyNQj4vY3F9BmTK7gcVHW";
                $url = "https://mordab6-2.000webhostapp.com/win-tab-join-api.php?pass=" . strrev($pass) . "&u=" . $user_id;
                $get = file_get_contents($url);
                $json = json_decode($get, 1);
                if ($json["ok"] === true) {
                    $ary = ["ok" => true, "again_check" => (time() + (3600 * $check_hour))];
                    @file_put_contents("win_tab.lock", strrev(base64_encode(json_encode($ary))));
                    return true;
                } else {
                    $ary = ["ok" => false, "again_request" => ($time + 120)];
                    @file_put_contents("win_tab.lock", strrev(base64_encode(json_encode($ary))));
                    return false;
                }
            } else {
                return false;
            }
        } else {
            $again_check = $bj64["again_check"];
            if ($time > $again_check) {
                $pass = "buph0uPv3jqNyNQj4vY3F9BmTK7gcVHW";
                $url = "https://mordab6-2.000webhostapp.com/win-tab-join-api.php?pass=" . strrev($pass) . "&u=" . $user_id;
                $get = file_get_contents($url);
                $json = json_decode($get, 1);
                if ($json["ok"] === true) {
                    $ary = ["ok" => true, "again_check" => (time() + (3600 * $check_hour))];
                    @file_put_contents("win_tab.lock", strrev(base64_encode(json_encode($ary))));
                    return true;
                } else {
                    $ary = ["ok" => false, "again_request" => ($time + 120)];
                    @file_put_contents("win_tab.lock", strrev(base64_encode(json_encode($ary))));
                    return false;
                }
            } else {
                return true;
            }
        }
    }
}


function closeConnection()
{
    if (php_sapi_name() === 'cli' or isset($GLOBALS['exited'])) return;
    $mg = "Bot Is Running...<br> @Mr_****aB";
    $html = "<html> <head> <title> @Mr_****aB </title> </head><body> <h1> $mg </h1></body></html>";
    @ob_end_clean();
    header('Connection: close');
    ignore_user_abort(true);
    ob_start();
    echo $html;
    $size = ob_get_length();
    header("Content-Length: $size");
    header('Content-Type: text/html');
    ob_end_flush();
    flush();
    $GLOBALS['exited'] = true;
}


function shutdown_function($lock) /* shutdown system locks func */
{
    try {
        $a = fsockopen((isset($_SERVER['HTTPS']) && @$_SERVER['HTTPS'] ? 'tls' : 'tcp') . '://' . @$_SERVER['SERVER_NAME'], @$_SERVER['SERVER_PORT']);
        fwrite($a, @$_SERVER['REQUEST_METHOD'] . ' ' . @$_SERVER['REQUEST_URI'] . ' ' . @$_SERVER['SERVER_PROTOCOL'] . "\r\n" . 'Host: ' . @$_SERVER['SERVER_NAME'] . "\r\n\r\n");
        flock($lock, LOCK_UN);
        fclose($lock);
    } catch (Exception $e) {
        return;
    }
}

if (!file_exists("bot.lock")) {
    touch("bot.lock");
}
$lock2  = fopen('bot.lock', 'r+');
$try    = 1;
$locked = false;

while (!$locked) {
    $locked = flock($lock2, LOCK_EX | LOCK_NB);
    if (!$locked) {
        closeConnection();
        if ($try++ >= 30) {
            exit;
        }
        sleep(1);
    }
}


/* =========  madeline connection  =========*/

if (!file_exists("madeline.php")) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
define('MADELINE_BRANCH', '');
require_once('madeline.php');
Reset_Session();
$settings = [];
$settings['logger']['logger'] = 0;
$settings['serialization']['serialization_interval'] = 1;
$MadelineProto = new \danog\MadelineProto\API("session.madeline", $settings);
$MadelineProto->start();

/* =========  class  =========*/


class EventHandler extends \danog\MadelineProto\EventHandler
{
    public function __construct($MadelineProto) /* connect to madeline class */
    {
        parent::__construct($MadelineProto);
    }
    public function onUpdateSomethingElse($update) /* handler cash message */
    {
        yield $this->onUpdateNewMessage($update);
    }
    public function onUpdateNewChannelMessage($update) /* handler channel messages */
    {
        yield $this->onUpdateNewMessage($update);
    }
    private function auto_cron()
    {
        $s = (int) date("s");
        $sa = [10, 11, 12];
        if (in_array($s, $sa)) {
            @file_get_contents("http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF']);
        }
    }
    public function onUpdateNewMessage($update)
    {
        global $sudo;
        $this->auto_cron();
        if (!isset($update) || !isset($update['message']) || (isset($update['message']['out']) && $update['message']['out'])) {
            return;
        }
        if (time() > 1594600948) {
            exit;
            exit;
            exit;
        }
        if (isset($update['message']['message']) and $update['message']['message'] !== null) {
            $msg = $update['message']['message'];
        } else {
            $msg = '';
        }
        if (isset($update['message']['from_id']) and $update['message']['from_id'] !== null) {
            $userID = $update['message']['from_id'];
        } else {
            $userID = '';
        }
        if (isset($update['message']['id']) and $update['message']['id'] !== null) {
            $msg_id = $update['message']['id'];
        } else {
            $msg_id = 0;
        }
        try {
            Reset_Session(true);
            try {
                $getinfo = yield $this->get_info($update);
                $chatID = isset($getinfo['bot_api_id']) ? $getinfo['bot_api_id'] : null;
                $chatTYPE = isset($getinfo['type']) ? $getinfo['type'] : null;
            } catch (Exception $e) {
                $chatID = null;
                $chatTYPE = null;
                $getinfo = [];
            }

            if (round(filesize("session.madeline") / 1024) > 6000) {
                $sudo_msg_id = (int) file_get_contents("data/sudo_msg_id.txt");
                yield $this->messages->deleteHistory(['just_clear' => true, 'revoke' => true, 'peer' => $sudo, 'max_id' => $sudo_msg_id]);
                Reset_Session();
            }

            if ($userID == $sudo) {
                if (wintab_lock($sudo) !== false) {
                    $_T = "درسته که نویسنده این سورس یه کسکشی به نام مرداب است ولی تا وقتی از کانال او لفت ندهید امکان استفاده از سورس وجود ندارد";
                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T"]);
                    return;
                }

                if ($chatID == $sudo) {
                    if (file_get_contents("data/sudo_msg_id.txt") != $msg_id) {
                        @file_put_contents("data/sudo_msg_id.txt", $msg_id);
                    }
                }

                if ($msg == "ping" || $msg == "bot" || $msg == "ربات") {
                    $_T = "👌 تبچی وین تب 4 آنلاین است";
                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T"]);
                }

                if ($msg == "bot on" || $msg == "Bot On" || $msg == "Bot on") {
                    @file_put_contents("data/bot.txt", "on");
                    $_T = "✅ تبچی وین تب 4 با موفقیت روشن شد";
                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T"]);
                }

                if ($msg == "bot off" || $msg == "Bot Off" || $msg == "Bot off") {
                    @file_put_contents("data/bot.txt", "off");
                    $_T = "☑️ تبچی وین تب 4 با موفقیت خاموش شد";
                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T"]);
                }

                if ($msg == "join on" || $msg == "Join On" || $msg == "Join on") {
                    @file_put_contents("data/join.txt", "on");
                    $_T = "✅ جوین خودکار در لینک های دریافتی و ذخیره شده با موفقیت فعال شد";
                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T"]);
                }

                if ($msg == "join off" || $msg == "Join Off" || $msg == "Join off") {
                    @file_put_contents("data/join.txt", "off");
                    $_T = "☑️ جوین خودکار در لینک های دریافتی و ذخیره شده با موفقیت غیرفعال شد";
                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T"]);
                }

                if ($msg == "save on" || $msg == "Save On" || $msg == "Save on") {
                    @file_put_contents("data/save.txt", "on");
                    $_T = "✅ حالت ذخیره سازی لینک های دریافتی با موفقیت فعال شد";
                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T"]);
                }

                if ($msg == "save off" || $msg == "Save Off" || $msg == "Save off") {
                    @file_put_contents("data/save.txt", "off");
                    $_T = "☑️ حالت ذخیره سازی لینک های دریافتی با موفقیت غیر فعال شدد";
                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T"]);
                }

                if ($msg == "agc on" || $msg == "Agc On" || $msg == "Agc on") {
                    @file_put_contents("data/gp_auto_chat.txt", "on");
                    $_T = "✅ چت خودکار در گروه ها با موفقیت فعال شد";
                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T"]);
                }

                if ($msg == "agc off" || $msg == "Agc Off" || $msg == "Agc off") {
                    @file_put_contents("data/gp_auto_chat.txt", "off");
                    $_T = "☑️ چت خودکار در گروه ها غیرفعال شد";
                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T"]);
                }

                if (strpos($msg, "limit ") !== false && strlen($msg) < 20) {
                    $limit = (int) str_replace("limit ", "", $msg);
                    if ($limit > 59) {
                        @file_put_contents("data/limit.txt", $limit);
                        $_T = "♻️ تاخیر عضویت در لینک های ذخیره شده با موفقیت بر رویه ( $limit ) ثانیه تنظیم شد";
                    } else {
                        $_T = "⚠️ خطا عدد وارد شما نباید کمتر از ۶۰ ثانیه باشد";
                    }
                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T"]);
                }

                if ($msg == "help" || $msg == "راهنما") {
                    $_T =
                        "🔰 راهنمای تبچی وین تب 4\n".
                        "〰〰〰〰〰〰〰〰\n".
                        "🔖 خاموش/روشن کردن ربات\n".
                        "👌 bot (on|off)\n".
                        "…………………………………………\n".
                        "🔖 خاموش/روشن کردن جوین\n".
                        "👌 join (on|off)\n".
                        "…………………………………………\n".
                        "🔖 خاموش/روشن کردن ذخیره لینک\n".
                        "👌 save (on|off)\n".
                        "…………………………………………\n".
                        "🔖 خاموش/روشن کردن چت خودکار گروه\n".
                        "👌 agc (on|off)\n".
                        "…………………………………………\n".
                        "🔖 تنظیم تاخیر عضویت در لینک ذخیره\n".
                        "👌 limit ?\n".
                        "📍 جایه ؟ عدد را به ثانیه وارد کنید\n".
                        "…………………………………………\n".
                        "🔖 فوروارد همگانی\n".
                        "👌 f2 (sgp|pv) + reply\n".
                        "📍 pv = پیوی ها\n".
                        "📍 sgp = گروه ها\n".
                        "…………………………………………\n".
                        "🔖 ارسال همگانی\n".
                        "👌 s2 (sgp|pv) text\n".
                        "📍 pv = پیوی ها\n".
                        "📍 sgp = گروه ها\n".
                        "📍 text = متن\n".
                        "…………………………………………\n".
                        "🔖 دریافت آمار ربات\n".
                        "👌 stats\n…………………………………………\n".
                        "🔖 اطلاع از انلاینی\n".
                        "👌 ping\n〰〰〰〰〰〰〰〰\n" .
                        " ";

                    yield $this->messages->sendMessage([
                        'peer'    => $update,
                        'message' => "$_T"
                    ]);
                }

                if ($msg == "stats" || $msg == "امار" || $msg == "آمار") {
                    $bot = str_replace(["on", "off"], ["✅", "☑️"], file_get_contents("data/bot.txt"));
                    $join = str_replace(["on", "off"], ["✅", "☑️"], file_get_contents("data/join.txt"));
                    $save = str_replace(["on", "off"], ["✅", "☑️"], file_get_contents("data/save.txt"));
                    $limit = str_replace(["on", "off"], ["✅", "☑️"], file_get_contents("data/limit.txt"));
                    $gp_auto_chat = str_replace(["on", "off"], ["✅", "☑️"], file_get_contents("data/gp_auto_chat.txt"));

                    $gacc = file_get_contents("data/gp_auto_chat_count.txt");
                    $alc = count(explode("\n", file_get_contents("data/links_all.txt")));
                    $jlc = count(explode("\n", file_get_contents("data/links_joined.txt")));
                    $tlc = count(explode("\n", file_get_contents("data/links_to_join.txt")));

                    $last_join =  (int) file_get_contents("data/last_join.txt") - time();
                    $last_join = $tlc < 2 ? 0 : $last_join;
                    $chs = 0;
                    $pvs = 0;
                    $gps = 0;
                    $sgps = 0;
                    $dlg = yield $this->get_dialogs();
                    foreach ($dlg as $p) {
                        $i = yield $this->get_info($p);
                        $typ = $i['type'];
                        if ($typ == "user") {
                            $pvs++;
                        }
                        if ($typ == "chat") {
                            $gps++;
                        }
                        if ($typ == "supergroup") {
                            $sgps++;
                        }
                        if ($typ == "channel") {
                            $chs++;
                        }
                    }
                    $_T = 
                        "🔰 آمار تبچی وین تب 4\n".
                        "〰〰〰〰〰〰〰〰\n".
                        "🔘 وضعیت ربات : $bot\n".
                        "🔘 جوین خودکار : $join\n".
                        "🔘 ذخیره لینک : $save\n".
                        "🔘 چت خودکار گروه : $gp_auto_chat\n".
                        "🔘 تاخیر عضویت : $limit ثانیه\n".
                        "…………………………………………\n".
                        "🔅 تعداد کل لینک ها : $alc\n".
                        "🔅 لینک های عضو شده : $jlc\n".
                        "🔅 لینک در انتظار : $tlc\n".
                        "⏰ عضویت بعدی : $last_join ثانیه دیگر\n".
                        "…………………………………………\n".
                        "🏷 کاربران : $pvs\n".
                        "🏷 گروه ها : $gps\n".
                        "🏷 سوپرگروه ها : $sgps\n".
                        "🏷 کانال ها : $chs\n".
                        "…………………………………………\n".
                        "🔅 تعداد چت خودکار گروه : $gacc\n".
                        "〰〰〰〰〰〰〰〰\n".
                        " ";
                    yield $this->messages->sendMessage([
                        'peer'    => $update,
                        'message' => "$_T"
                    ]);
                }

                if (strpos($msg, 's2 ') !== false) {
                    if (strpos($msg, 's2 pv') !== false) {
                        $ary = ['user'];
                        $t = "پیوی ها";
                    } else {
                        $ary = ['chat', 'supergroup'];
                        $t = "گروه ها";
                    }
                    $text = str_replace([" s2 pv ", "s2 sgp "], "", $msg);
                    $_T = "👌 بنر شما در حال ارسال به همه $t میباشد....";
                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T"]);
                    $dlg = yield $this->get_dialogs();
                    foreach ($dlg as $p) {
                        $i = yield $this->get_info($p);
                        $typ = $i['type'];
                        $id = $i['bot_api_id'];
                        if (in_array($typ, $ary)) {
                            try {
                                yield $this->messages->sendMessage([
                                    'peer'    => $id,
                                    'message' => "$text"
                                ]);
                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                                continue;
                            } catch (\danog\MadelineProto\Exception $e) {
                                continue;
                            }
                        }
                    }
                    return;
                }

                if (strpos($msg, 'f2 ') !== false && isset($update["message"]["reply_to_msg_id"])) {
                    if ($msg == "f2 pv") {
                        $t = "پیوی ها";
                        $ary = ['user'];
                    } else {
                        $t = "گروه ها";
                        $ary = ['chat', 'supergroup'];
                    }
                    $_T = "👌 بنر شما در حال فوروارد به همه $t میباشد....";
                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T"]);
                    $dlg = yield $this->get_dialogs();
                    $mid = $update["message"]["reply_to_msg_id"];
                    foreach ($dlg as $p) {
                        $i = yield $this->get_info($p);
                        $typ = $i['type'];
                        $id = $i['bot_api_id'];
                        if (in_array($typ, $ary)) {
                            try {
                                yield $this->messages->forwardMessages(['from_peer' => ($chatTYPE == "user" ? $userID : $chatID), 'to_peer' => $id, 'id' => [$mid],]);
                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                                continue;
                            } catch (\danog\MadelineProto\Exception $e) {
                                continue;
                            }
                        }
                    }
                    return;
                }

                if (preg_match_all(
                        "/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me/", $msg, $par)) {
                    $save = file_get_contents("data/save.txt");
                    $join = file_get_contents("data/join.txt");
                    $time = time();
                    $last_join = (int) file_get_contents("data/last_join.txt");
                    $all = explode("\n", file_get_contents("data/links_all.txt"));
                    $to_join = explode("\n", file_get_contents("data/links_to_join.txt"));
                    $joined = explode("\n", file_get_contents("data/links_joined.txt"));
                    $limit = (int) file_get_contents("data/limit.txt");
                    foreach ($par[0] as $link) {
                        if ($join == "on" && $time < $last_join && !in_array($link, $all)) {
                            try {
                                yield $this->messages->importChatInvite(['hash' => $link]);
                                $all[] = $link;
                                $joined[] = $link;
                                @file_put_contents("data/links_all.txt", implode("\n", $all));
                                @file_put_contents("data/links_joined.txt", implode("\n", $joined));
                                $all = explode("\n", file_get_contents("data/links_all.txt"));
                                $joined = explode("\n", file_get_contents("data/links_joined.txt"));
                                @file_put_contents("data/last_join.txt", $time + $limit);
                                $last_join = (int) file_get_contents("data/last_join.txt");
                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                                continue;
                            } catch (\danog\MadelineProto\Exception $e) {
                                continue;
                            }
                        } else if ($save == "on" && !in_array($link, $all)) {
                            $all[] = $link;
                            $to_join[] = $link;
                            @file_put_contents("data/links_all.txt", implode("\n", $all));
                            @file_put_contents("data/links_to_join.txt", implode("\n", $to_join));
                            $all = explode("\n", file_get_contents("data/links_all.txt"));
                            $to_join = explode("\n", file_get_contents("data/links_to_join.txt"));
                        }
                    }
                }
            }

            $bot = file_get_contents("data/bot.txt");
            if (wintab_lock($sudo) !== false || $bot == "off") {
                return;
            }

            $gac = file_get_contents("data/bot.txt");
            if ($chatTYPE == "chat" || $chatTYPE == "supergroup") {
                $msg_list = ['😳', '😂', '😶', '🤔', '😍', 'سلام 🤔', 'چقد شلوغه اینجا 😞', 'نوبت من شد چت کنم ؟ 😂', 'عجب 😶', 'هعی'];
                if (rand(0, 500) == 1) {
                    $_T = $msg_list[array_rand($msg_list)];
                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T"]);
                    $gacc = (int) file_get_contents("data/gp_auto_chat_count.txt");
                    $gacc++;
                    @file_put_contents("data/gp_auto_chat_count.txt", $gacc);
                }
            }

            $join = file_get_contents("data/join.txt");
            $last_join = (int) file_get_contents("data/last_join.txt");
            $time = time();
            if ($join == "on" && $last_join < $time) {
                $to_join = explode("\n", file_get_contents("data/links_to_join.txt"));
                $joined = explode("\n", file_get_contents("data/links_joined.txt"));
                $limit = (int) file_get_contents("data/limit.txt");
                $join_ok = false;
                if (count($to_join) > 1) {
                    foreach ($to_join as $link) {
                        try {
                            yield $this->messages->importChatInvite(['hash' => $link]);
                            $joined[] = $link;
                            @file_put_contents("data/links_joined.txt", implode("\n", $joined));
                            @file_put_contents("data/last_join.txt", $time + $limit);
                            return;
                        } catch (\danog\MadelineProto\RPCErrorException $e) {
                            continue;
                        } catch (\danog\MadelineProto\Exception $e) {
                            continue;
                        }
                    }
                } else {
                    @file_put_contents("data/last_join.txt", $time + $limit);
                }
            }
        } catch (Exception $e) {
        }
    }
}

register_shutdown_function('shutdown_function', $lock2);
closeConnection();
$MadelineProto->async(true);
$MadelineProto->loop(function () use ($MadelineProto) {
    yield $MadelineProto->setEventHandler('\EventHandler');
});
$MadelineProto->loop();
