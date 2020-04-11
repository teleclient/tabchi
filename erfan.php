<?php
// Creator: @Source_Eliya     Channel: @Source_Eliya
// Creator: @Erfan_Saadatnia  Channel: @Erfan_Saadatnia'

//error_reporting(0);
date_default_timezone_set('Asia/Tehran');

$sudo = 938537607;

if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
include 'madeline.php';

$settings['logger']['max_size'] = 5 * 1024 * 1024;
$MadelineProto = new \danog\MadelineProto\API('Source_Eliya.madeline', $settings);
$MadelineProto->start();

/*
function closeConnection($message = "Tabchi is runinng...")
{
    if (php_sapi_name() === 'cli' || isset($GLOBALS['exited'])) {
        return;
    }
    define('MADELINE_BRANCH', 'deprecated');
    include "madeline.php";
}
*/

function closeConnection($message = "Tabchi Is Running 🇮🇷 ")
{
    if (php_sapi_name() === 'cli' || isset($GLOBALS['exited'])) {
        return;
    }
    @ob_end_clean();
    header('Connection: close');
    ignore_user_abort(true);
    ob_start();
    echo "$message";
    $size = ob_get_length();
    header("Content-Length: $size");
    header('Content-Type: text/html');
    ob_end_flush();
    flush();
    $GLOBALS['exited'] = true;
}

function shutdown_function($lock)
{
    $a = fsockopen((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 'tls' : 'tcp').'://'.$_SERVER['SERVER_NAME'], $_SERVER['SERVER_PORT']);
    fwrite($a, $_SERVER['REQUEST_METHOD'].' '.$_SERVER['REQUEST_URI'].' '.$_SERVER['SERVER_PROTOCOL']."\r\n".'Host: '.$_SERVER['SERVER_NAME']."\r\n\r\n");
    flock($lock, LOCK_UN);
    fclose($lock);
}

if (!file_exists('bot.lock')) {
    touch('bot.lock');
}
$lock = fopen('bot.lock', 'r+');
$try = 1;
$locked = false;
while (!$locked) {
    $locked = flock($lock, LOCK_EX | LOCK_NB);
    if (!$locked) {
        closeConnection();
        if ($try++ >= 30) {
            exit;
        }
        sleep(1);
    }
}

if (!file_exists('on.txt')) {
    file_put_contents('on.txt', 'on');
}
if (!file_exists('moves.txt')) {
    file_put_contents('moves.txt', 0);
}

class EventHandler extends \danog\MadelineProto\EventHandler
{
    public function __construct($MadelineProto)
    {
        parent::__construct($MadelineProto);
    }

    public function onUpdateNewChannelMessage($update)
    {
        yield $this->onUpdateNewMessage($update);
    }
    public function onUpdateNewMessage($update){
        try {
            $userID = isset($update['message']['from_id']) ? $update['message']['from_id']:'';
            if(isset($update['message']['message'])) {
                $msg = $update['message']['message'];
                $msg_id = $update['message']['id'];
                $MadelineProto = $this;
                $chID = yield $MadelineProto->get_info($update);
                $chatID = $chID['bot_api_id'];
            }
        } catch (\danog\MadelineProto\RPCErrorException $e2) {
        }

        if ($userID === $sudo or isset($data["data"]["Adms"][$userID]) and $state === "انلاین") {

            if (preg_match("/^[#\!\/](f2all) (.*)$/", $msg)) {
                if ($msg == "!f2all" or $msg == "/f2all") {
                    $rid =  $update['update']['message']['reply_to_msg_id'];
                    $dialogs = $MadelineProto->get_dialogs();

                    foreach ($dialogs as $peer) {
                        $type = $MadelineProto->get_info($peer);
                        $type3 = $type['type'];
                        if ($type3 == "supergroup" || $type3 == "user" || $type3 == "supergroup") {
                            try {
                                $MadelineProto->messages->forwardMessages([
                                    'from_peer' => $chatID,
                                    'to_peer'   => $peer,
                                    'id'        => [$rid]
                                ]);
                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                            } catch (\danog\MadelineProto\RPCErrorException $e2) {
                            }
                        }
                        sleep(1);
                    }
                    $MadelineProto->messages->sendMessage([
                        'peer' => $chatID,
                        'message' => "♻️ پست شما به همه پیوی ها ارسال خواهد شد!<br>".
                                     "⏰ تاخیر بین هر ارسال 5 ثانیه",
                        'parse_mode' => 'html'
                    ]);
                } else if ($msg == "f2sgps" || $msg == "/f2sgps") {
                    $rid =  $update['update']['message']['reply_to_msg_id'];
                    $dialogs = $MadelineProto->get_dialogs();

                    foreach ($dialogs as $peer) {
                        $type = $MadelineProto->get_info($peer);
                        $type3 = $type['type'];
                        if ($type3 == "supergroup") {
                            try {
                                $MadelineProto->messages->forwardMessages([
                                    'from_peer' => $chatID,
                                    'to_peer' => $peer,
                                    'id' => [$rid]
                                ]);
                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                            } catch (\danog\MadelineProto\RPCErrorException $e2) {
                            }
                            sleep(1);
                        }
                    }
                    $MadelineProto->messages->sendMessage([
                        'peer'      => $chatID,
                        'message'   => "♻️ پست شما به همه سوپرگروه ها ارسال خواهد شد!<br>".
                                       "⏰ تاخیر بین هر ارسال 5 ثانیه",
                        'parse_mode' => 'html'
                    ]);
                } else if ($msg === "/f2gps"|| $msg === "!f2gps") {
                    $rid     =  $update['update']['message']['reply_to_msg_id'];
                    $dialogs = $MadelineProto->get_dialogs();

                    foreach ($dialogs as $peer) {
                        $type = $MadelineProto->get_info($peer);
                        $type3 = $type['type'];
                        if ($type3 == "supergroup") {
                            try {
                                $MadelineProto->messages->forwardMessages([
                                    'from_peer' => $chatID,
                                    'to_peer'   => $peer,
                                    'id'        => [$rid]
                                ]);
                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                            } catch (\danog\MadelineProto\RPCErrorException $e2) {
                            }
                            sleep(1);
                        }
                    }
                    $MadelineProto->messages->sendMessage([
                        'peer'       => $chatID,
                        'message'    => "♻️ پست شما به همه گروه ها ارسال خواهد شد!<br>".
                                        "⏰ تاخیر بین هر ارسال 5 ثانیه",
                        'parse_mode' => 'html'
                    ]);
                } else if ($msg == "!f2pv" || $msg == "/f2pv") {
                    $rid     =  $update['update']['message']['reply_to_msg_id'];
                    $dialogs = $MadelineProto->get_dialogs();

                    foreach ($dialogs as $peer) {
                        $type = $MadelineProto->get_info($peer);
                        $type3 = $type['type'];
                        if ($type3 == "user") {
                            try {
                                $MadelineProto->messages->forwardMessages([
                                    'from_peer' => $chatID,
                                    'to_peer' => $peer,
                                    'id' => [$rid],
                                ]);
                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                            } catch (\danog\MadelineProto\RPCErrorException $e2) {
                            }
                            sleep(1);
                        }
                    }
                    $MadelineProto->messages->sendMessage([
                        'peer' => $chatID,
                        'message' => "♻️ پست شما به همه پیوی ها ارسال خواهد شد!<br>".
                                     "⏰ تاخیر بین هر ارسال 5 ثانیه",
                        'parse_mode' => 'html'
                    ]);
                } else if ($msg == "/f2all" || $msg == "!f2all") {
                    $rid     =  $update['update']['message']['reply_to_msg_id'];
                    $dialogs = $MadelineProto->get_dialogs();

                    foreach ($dialogs as $peer) {
                        $type = $MadelineProto->get_info($peer);
                        $type3 = $type['type'];
                        if ($type3 == "user" || $type3 == "supergroup") {
                            try {
                                $MadelineProto->messages->forwardMessages([
                                    'from_peer' => $chatID,
                                    'to_peer'   => $peer,
                                    'id'        => [$rid]
                                ]);
                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                            } catch (\danog\MadelineProto\RPCErrorException $e2) {
                            }
                            sleep(1);
                        }
                    }
                    $MadelineProto->messages->sendMessage([
                        'peer'       => $chatID, 
                        'message'    => '♻️ پست شما به همه گروه ها سوپر گروه ها و پیوی ها ارسال خواهد شد!<br>'.
                                        '⏰ تاخیر بین هر ارسال 5 ثانیه ',
                        'parse_mode' => 'html'
                    ]);
                }
                if (preg_match("/^[#\!\/](addall) (.*)$/", $msg)) {
                    preg_match("/^[#\!\/](addall) (.*)$/", $msg, $text1);
                    $user = $text1[2];
                    $dialogs = $MadelineProto->get_dialogs();
                    foreach ($dialogs as $peer) {
                        $type = $MadelineProto->get_info($peer);
                        $type3 = $type['type'];
                        if ($type3 == "supergroup") {
                            $MadelineProto->channels->inviteToChannel([
                                'channel' => $peer,
                                'users'   => [$user]
                            ]);
                        }
                    }
                    $MadelineProto->messages->sendMessage([
                        'peer'       => $chatID, 
                        'message'    => '♻️ کاربر مورد نظر به همه گروه ها ادد خواهد شد! '.
                                        'Creator:@Source_Eliya /n Channel : @Source_Eliya ',
                        'parse_mode' => 'HTML'
                    ]);
                }
            }
        }
        if ($userID === $sudo) {
            if ($state === "انلاین") {
                if (preg_match("/^[#\!\/](addadmin) (.*)$/", $msg)) {
                    preg_match("/^[#\!\/](addadmin) (.*)$/", $msg, $text1);
                    $Username = $text1[2];
                    $Array = $MadelineProto->get_full_info($Username);
                    $user_iD = $Array['bot_api_id'];
                    if (!isset($data["data"]["Adms"][$user_iD])) {
                        $data["data"]["Adms"][$user_iD] = $Username;
                        file_put_contents("data.json", json_encode($data));
                        $MadelineProto->messages->sendMessage([
                            'peer'      => $chatID,
                            'message'   => "📣کاربر $Username ادمین ربات تنظیم شد ".
                                         "Creator:@Erfan_Saadatnia /n Channel : @Erfan_Saadatnia ",
                            'parse_mode' => 'html'
                        ]);
                    } else {
                        $MadelineProto->messages->sendMessage([
                            'peer' => $chatID,
                            'message' => "📌 کاربر $Username از قبل ادمین بوده است".
                                         "Creator:@Erfan_Saadatnia /n Channel : @Erfan_Saadatnia ",
                            'parse_mode' => 'html'
                        ]);
                    }
                }
                if (preg_match("/^[#\!\/](deladmin) (.*)$/", $msg)) {
                    preg_match("/^[#\!\/](deladmin) (.*)$/", $msg, $text1);
                    $Username = $text1[2];
                    $Array = $MadelineProto->get_full_info($Username);
                    $user_iD = $Array['bot_api_id'];
                    if (isset($data["data"]["Adms"][$user_iD])) {
                        unset($data["data"]["Adms"][$user_iD]);
                        file_put_contents("data.json", json_encode($data));
                        $MadelineProto->messages->sendMessage([
                            'peer'       => $chatID,
                            'message'    => "📣کاربر $Username از ادمینی عزل شد",
                            'parse_mode' => 'html'
                        ]);
                    } else {
                        $MadelineProto->messages->sendMessage([
                            'peer'       => $chatID,
                            'message'    => "📌 کاربر $Username جزو ادمین های ربات نیست",
                            'parse_mode' => 'html'
                        ]);
                    }
                }
                if ($userID === $sudo) {
                    if ($state === "انلاین") {
                        if (preg_match("/^[#\!\/](addadmin) (.*)$/", $msg)) {
                            preg_match("/^[#\!\/](addadmin) (.*)$/", $msg, $text1);
                            $Username = $text1[2];
                            $Array = $MadelineProto->get_full_info($Username);
                            $user_iD = $Array['bot_api_id'];
                            if (!isset($data["data"]["Adms"][$user_iD])) {
                                $data["data"]["Adms"][$user_iD] = $Username;
                                file_put_contents("data.json", json_encode($data));
                                $MadelineProto->messages->sendMessage([
                                    'peer'       => $chatID, 
                                    'message'    => "📣کاربر $Username ادمین ربات تنظیم شد ".
                                                    "Creator:@Source_Eliya /n Channel : @Source_Eliya ", 
                                    'parse_mode' => 'html'
                                ]);
                            } else {
                                $MadelineProto->messages->sendMessage([
                                    'peer'        => $chatID,
                                    'message'     => "📌 کاربر $Username از قبل ادمین بوده است".
                                                     "Creator: @Erfan_Saadatnia /n Channel :@Erfan_Saadatnia ",
                                     'parse_mode' => 'html'
                                ]);
                            }
                        }
                        if (preg_match("/^[#\!\/](deladmin) (.*)$/", $msg)) {
                            preg_match("/^[#\!\/](deladmin) (.*)$/", $msg, $text1);
                            $Username = $text1[2];
                            $Array = $MadelineProto->get_full_info($Username);
                            $user_iD = $Array['bot_api_id'];
                            if (isset($data["data"]["Adms"][$user_iD])) {
                                unset($data["data"]["Adms"][$user_iD]);
                                file_put_contents("data.json", json_encode($data));
                                $MadelineProto->messages->sendMessage([
                                    'peer'       => $chatID, 
                                    'message'    => "📣کاربر $Username از ادمینی عزل شد",
                                    'parse_mode' => 'html'
                                ]);
                            } else {
                                $MadelineProto->messages->sendMessage([
                                    'peer' => $chatID,
                                    'message' => "📌 کاربر $Username جزو ادمین های ربات نیست",
                                    'parse_mode' => 'html'
                                ]);
                            }
                        }
                        if ($msg === "/adminlist" || $msg === "!adminlist") {
                            $T  = "📃 لیست همه ادمین ها";
                            $cc = 1;
                            foreach ($data['data']['Adms'] as $k => $u) {
                                $T .= "🗣 $cc ⇨ <a href='tg://user?id=$k'>$k</a>\n";
                                $cc++;
                            }
                            $MadelineProto->messages->sendMessage([
                                'peer'       => $chatID,
                                'message'    => "$T",
                                'parse_mode' => 'html'
                            ]);
                        }
                    }
                }
                if ($msg == "/adminlist" or $msg == "!adminlist") {
                    $T = "📃 لیست همه ادمین ها";
                    $cc = 1;
                    foreach ($data['data']['Adms'] as $k => $u) {
                        $T .= "🗣 $cc ⇨ <a href='tg://user?id=$k'>$k</a>\n";
                        $cc++;
                    }
                    $MadelineProto->messages->sendMessage([
                        'peer'       => $chatID,
                        'message'    => "$T",
                        'parse_mode' => 'html'
                    ]);
                }
            }
        }

        $A_SLM    = [
    "سلام😇",
"سلام 🙃",      "سلام 😶"    ,      "دلام"    ,
"شلوم😵"    ,      "سلام"    ,      "slm"    ,
"Slm😛"    ,      "سلام چطوری 😒"    ,      "😑😑😑😑"    ,
"☹س"    ,      "😐صلام"    ,      "🙄"    ,
"شلام 😸"    ,      "سلام 😿"    ,      "دلام دوبی 🤕"    ,
"salam"    ,      "slm khobi 😶"    ,      "چطوری 🙄"    ,
"خوبی ؟ ☹"    ,      "صلوم 🙃"    ,      "slm",
];

$A_KHOBI = [
    "خوبم مرسی تو خوبی",
"ممنون تو خوبی 😶"    ,      "🙄"    ,      "چطوری 😵"    ,
"mmnon to khobi ? 🙄"    ,      "فدات "    ,      "مرسی "    ,
"mrc 🌸"    ,      "فدای داری 😛"    ,      "slm"    ,

];

$A_FADAT = [   "😻"    ,      
"😘"    ,      "😃"    ,      "💛"    ,      
"💚"    ,      "🙂"    ,      "🙃"    ,      
"اصل میدی"    ,      "😋"    ,      "اصل ؟"    ,      
"😉"    ,      "🤗"    ,      "slm"    ,      
"😦"    ,      "☹"    ,      "🙁"    ,      
"😯"    ,      "😑"    ,      "slm"    ,      
"اasl🙃"    ,      
  ];
  

$A_ASL     = [   "slm"    ,      
"18 teh"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"

  ];

$A_EMOJI= [   "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,      
"slm"    ,      "slm"    ,      "slm"    ,
"slm"    ,      "slm"    ,      "slm"    ,
"slm"    ,      "slm"    ,      "slm"

  ];

        $slm_r = array_rand($A_SLM);
        $R_SLM = $A_SLM[$slm_r];

        $khobi_r = array_rand($A_KHOBI);
        $R_KHOBI = $A_KHOBI[$khobi_r];

        $fadat_r = array_rand($A_FADAT);
        $R_FADAT = $A_FADAT[$fadat_r];

        $asl_r = array_rand($A_ASL);
        $R_ASL = $A_ASL[$asl_r];

        $emoji_r = array_rand($A_EMOJI);
        $R_EMOJI = $A_EMOJI[$emoji_r];

        if ($userID !== $sudo or !isset($data["data"]["Adms"][$userID])) {
            if ($type == "supergroup" or $type3 == "chat") {
                if ($ANS_GP === "انلاین") {
                    if (preg_match("([د|ش|س|ث|ص][ل|لل|للل][ا|اا|ااا|اااا|آ|آآ|آآآ][م|مم|ممم|مممم|ممممم])", $msg) ||
                        preg_match("([s|S|][l|ll|lll|L|LL|LLL][m|mm|mmm])|([s|S|][a|A|aa|AA][l|ll|lll|L|LL|LLL][m|mm|mmm])", $msg)) {
                        if ($Reed === "انلاین") {
                            $MadelineProto->channels->readMessageContents([
                                'channel' => $chatID,
                                'id'      => [$msg_id]
                            ]);
                        }
                        if ($Typing === "انلاین") {
                            $m = $MadelineProto->messages->setTyping([
                                'peer'   => $chatID,
                                'action' => ['_' => 'sendMessageTypingAction']
                            ]);
                        }
                        sleep(1.3);
                        $MadelineProto->messages->sendMessage(['
                            peer'             => $chatID,
                            'reply_to_msg_id' => $msg_id,
                            'message'         => "$R_SLM",
                            'parse_mode'      => 'MarkDown'
                        ]);
                    } else if (preg_match("([د|خ|ح][و|وو|ووو][ب|بب|ببب][ی|یی|ییی])", $msg) ||
                               preg_match("([چ|ج|ش][ط|ت|طط|تت][و|وو|ووو][ر|رر|ررر|رررر][ی|یی|یییی])", $msg) ||
                               preg_match("([K|k][o|oo|ooo|O|OO|OOO][b|B|bb|BB][i|I|ii|II|iii|III])||([ch|CH|Ch][T|t|TT|tt][R|r|RR|rr][i|I|ii|II|iii|III])", $msg)) {
                        if ($Reed === "انلاین") {
                            $MadelineProto->channels->readMessageContents([
                                'channel' => $chatID,
                                'id' => [$msg_id]
                            ]);
                        }
                        if ($Typing === "انلاین") {
                            $sendMessageTypingAction = ['_' => 'sendMessageTypingAction'];
                            $m = $MadelineProto->messages->setTyping([
                                'peer'   => $chatID,
                                'action' => $sendMessageTypingAction
                            ]);
                        }
                        sleep(1.3);
                        $MadelineProto->messages->sendMessage([
                            'peer'            => $chatID,
                            'reply_to_msg_id' => $msg_id,
                            'message'         => "$R_KHOBI",
                            'parse_mode'      => 'MarkDown'
                        ]);
                    } else if (preg_match("([ف|فف|ففف][د|دد|ددد][ا|اا|ااا|آ|آآ|آآآ][ت|تت|تتت])([مم|م|ممم|مممم]) ([ت|ط][و|وو|ووو][خ|خخ|خخ|د|دد][و|وو|وو][ب|بب|بب][ی|یی|ییی|یییی])", $msg)) {
                        if ($Reed === "انلاین") {
                            $MadelineProto->channels->readMessageContents([
                                'channel' => $chatID,
                                'id' => [$msg_id]
                            ]);
                        }
                        if ($Typing === "انلاین") {
                            $sendMessageTypingAction = ['_' => 'sendMessageTypingAction'];
                            $m = $MadelineProto->messages->setTyping([
                                'peer' => $chatID, 
                                'action' => $sendMessageTypingAction
                            ]);
                        }
                        sleep(1.3);
                        $MadelineProto->messages->sendMessage([
                            'peer' => $chatID, 
                            'reply_to_msg_id' => $msg_id, 
                            'message' => "$R_FADAT",
                            'parse_mode' => 'MarkDown'
                        ]);
                    }
                }
            } else if ($type == "user") {
                if ($ANS_PV === "انلاین") {
                    if (preg_match("([د|ش|س|ث|ص][ل|لل|للل][ا|اا|ااا|اااا|آ|آآ|آآآ][م|مم|ممم|مممم|ممممم])", $msg) ||
                        preg_match("([s|S|][l|ll|lll|L|LL|LLL][m|mm|mmm])|([s|S|][a|A|aa|AA][l|ll|lll|L|LL|LLL][m|mm|mmm])", $msg)) {
                        if ($Reed === "انلاین") {
                            $MadelineProto->channels->readMessageContents([
                                'channel' => $chatID, 
                                'id'      => [$msg_id]
                            ]);
                        }
                        if ($Typing === "انلاین") {
                            $m = $MadelineProto->messages->setTyping([
                                'peer'   => $chatID, 
                                'action' => ['_' => 'sendMessageTypingAction']
                            ]);
                        }
                        sleep(1.3);
                        $MadelineProto->messages->sendMessage([
                            'peer'            => $chatID, 
                            'reply_to_msg_id' => $msg_id, 
                            'message'         => "$R_SLM", 
                            'parse_mode'      => 'MarkDown'
                        ]);
                    } else if (preg_match("([د|خ|ح][و|وو|ووو][ب|بب|ببب][ی|یی|ییی])", $msg) ||
                               preg_match("([چ|ج|ش][ط|ت|طط|تت][و|وو|ووو][ر|رر|ررر|رررر][ی|یی|یییی])", $msg) ||
                               preg_match("([K|k][o|oo|ooo|O|OO|OOO][b|B|bb|BB][i|I|ii|II|iii|III])||([ch|CH|Ch][T|t|TT|tt][R|r|RR|rr][i|I|ii|II|iii|III])", $msg)) {
                        if ($Reed === "انلاین") {
                            $MadelineProto->channels->readMessageContents([
                                'channel' => $chatID,
                                'id'      => [$msg_id]
                            ]);
                        }
                        if ($Typing === "انلاین") {
                            $m = $MadelineProto->messages->setTyping([
                                'peer'   => $chatID,
                                'action' => ['_' => 'sendMessageTypingAction']
                            ]);
                        }
                        sleep(1.3);
                        $MadelineProto->messages->sendMessage([
                            'peer'            => $chatID,
                            'reply_to_msg_id' => $msg_id,
                            'message'         => "$R_KHOBI",
                            'parse_mode'      => 'MarkDown'
                        ]);
                    } else if (preg_match("([ف|فف|ففف][د|دد|ددد][ا|اا|ااا|آ|آآ|آآآ][ت|تت|تتت])([مم|م|ممم|مممم]) ([ت|ط][و|وو|ووو][خ|خخ|خخ|د|دد][و|وو|وو][ب|بب|بب][ی|یی|ییی|یییی])", $msg)) {
                        if ($Reed === "انلاین") {
                            $MadelineProto->channels->readMessageContents([
                                'channel' => $chatID,
                                'id'      => [$msg_id]
                            ]);
                        }
                        if ($Typing === "انلاین") {
                            $m = $MadelineProto->messages->setTyping([
                                'peer'   => $chatID,
                                'action' => ['_' => 'sendMessageTypingAction']
                            ]);
                        }
                        sleep(1.3);
                        $MadelineProto->messages->sendMessage([
                            'peer'            => $chatID,
                            'reply_to_msg_id' => $msg_id,
                            'message'         => "$R_FADAT",
                            'parse_mode'      => 'MarkDown'
                        ]);
                    }
                }
                if (strpos($msg, "/setanswer") !== false) {
                    if ($word["on"] == "on") {
                        if ($userID == $sudo) {
                            $txt = trim("t");
                            $ans = trim("r");
                            if (!isset($word["word"]["$txt"])) {
                                $word["word"]["$txt"] = "$ans";
                                file_put_contents("wordjson", json_encode($word));
                                $MadelineProto->messages->sendMessage([
                                    'peer' => $chatID,
                                    'reply_to_msg_id' => $msg_id,
                                    'message' => "♻️ربات از این به بعد در جواب کلمه ($txt) جواب ($ans) را خواهد داد",
                                    'parse_mode' => 'html'
                                ]);
                            }
                        }
                    }
                }
                if (strpos($msg, "/delanswer") !== false) {
                    if ($word["on"] == "on") {
                        if ($userID == $sudo) {
                            $txt = trim("t");
                            $ans = trim("r");
                            if (isset($word["word"]["$txt"])) {
                                unset($word["word"]["$txt"]);
                                file_put_contents("wordjson", json_encode($word));
                                $MadelineProto->messages->sendMessage([
                                    'peer'            => $chatID,
                                    'reply_to_msg_id' => $msg_id,
                                    'message'         => "♻️کلمه ($txt) با موفقیت حذف شد!",
                                    'parse_mode'      => 'html'
                                ]);
                            }
                        }
                    }
                }
                if ($msg == "/answerlist" || $msg == "!answerlist") {
                    if ($word["on"] == "on") {
                        if ($userID == $sudo) {
                            if ($word["word"] != null) {
                                $num = 1;
                                foreach ($word["word"] as $txt => $ans) {
                                    $list = $list . "**$num** - کلمه : **$txt** ›› جواب : **$ans** \n";
                                    $num++;
                                }
                                $MadelineProto->messages->sendMessage([
                                    'peer' => $chatID,
                                    'reply_to_msg_id' => $msg_id ,
                                    'message' =>
"♻️لیست کلماتی که در ربات ذخیره است و ربات به انها پاسخ میدهد :
$list
Creator:@Erfan_Saadatnia /n Channel : @Erfan_Saadatnia " ,
                                    'parse_mode' => 'markdown'
                                ]);}
                        }
                    }
                }
            }
        }
        if ($msg == "امار") {
            $CL = file_get_contents('CL.txt');
            $CH = file_get_contents('CH.txt');
            $Gps = file_get_contents('Gps.txt');
            $Pvs = file_get_contents('Pvs.txt');
            $CL_m = explode("", $CL);
            $CH_m = explode("", $CH);
            $Gps_m = explode("", $Gps);
            $Pvs_m = explode("", $Pvs);

            if (file_exists('CL.txt')) {
                $CL_c = count($CL_m);
            } else {
                $CL_c = 0;
            }
            if (file_exists('CH.txt')) {
                $CH_c = count($CH_m);
            } else {
                $CH_c = 0;
            }
            if (file_exists('Gps.txt')) {
                $Gps_c = count($Gps_m);
            } else {
                $Gps_c = 0;
            }
            if (file_exists('Pvs.txt')) {
                $Pvs_c = count($Pvs_m);
            } else {
                $Pvs_c = 0;
            }
            $link_c = count($data["data"]["links"]);
            $Lt = $link_c * 5;
            $cccc = count($data["data"]["channels"]);
            $aaaa = count($data["data"]["Adms"]);
            $mem_using = round(memory_get_usage() / 1024 / 1024, 1);
            $MadelineProto->messages->sendMessage([
                'peer'    => $chatID,
                'message' =>
"
📊 وضعیت آمار تبچی : $Pvs_c

🔻 کانال ها : $Cl_c
→ → →
👥 تعداد سوپرگروه ها : $CH_s
→ → →
👣 تعداد گروه ها : $Gps
→ → →
📩 تعداد پیوی ها : $pvs_c
→ → →
📢 تعداد کانال ها : $CL_c
→ → →
☎️ چت خودکار : $ANS_pv
→ → →
♻️ مقدار رم درحال استفاده : $mem_using مگابایت

Creator:@Erfan_Saadatnia /n Channel : @Erfan_Saadatnia
",
                'parse_mode' => 'html'
            ]);
        }
        if ($msg == "راهنما تبلیغات") {
            $MadelineProto->messages->sendMessage([
                'peer'    => $chatID,
                'message' => "⁉️ راهنماے تبچے 𝔼𝕣𝕗𝕒𝕟 :

انلاین
✅ دریافت وضعیت ربات
——————
امار
📊 دریافت آمار گروه ها و کاربران
——————
/addall [UserID]
⏬ ادد کردن یڪ کاربر به همه گروه ها
——————
/addpvs [IDGroup]
⬇️ ادد کردن همه ے افرادے که در پیوے هستن به یڪ گروه
——————
adduser [UserID][IDGroup]
▶️ ادد کردن یه کاربر به گروه موردنظر
——————
f2all [reply]
〽️ فروارد کردن پیام ریپلاے شده به همه گروه ها و کاربران
——————
f2pv [reply]
🔆 فروارد کردن پیام ریپلاے شده به همه کاربران
——————
f2gps [reply]
🔊 فروارد کردن پیام ریپلاے شده به همه گروه ها
——————
f2sgps [reply]
🌐 فروارد کردن پیام ریپلاے شده به همه سوپرگروه ها
——————
/setFtime [reply],[time-min]
♻️ فعالسازے فروارد خودکار زماندار
——————
/delFtime
🌀 حذف فروارد خودکار زماندار
——————
ست ایدی [text]
⚙️ تنظیم نام کاربرے (آیدے)ربات
——————
profile [نام]|[فامیل]|[بیوگرافی]
💎 تنظیم نام اسم ,فامےلو بیوگرافے ربات
——————
/join [@ID]or[LINK]
🎉 عضویت در یڪ کانال یا گروه
——————
ورژن ربات
📜 نمایش نسخه سورس تبچے شما
——————
پاکسازی
📮 خرج از گروه هایے که مسدود کردند
——————
🆔 شناسه
📎 دریافت ایدی‌عددے ربات تبچی
——————
/delchs
🥇خروج از همه ے کانال ها
——————
/setanswer [TEXT]|[ANSWER]
🎖 افزودن جواب سریع (متناولمتن دریافتے از کاربر و ددوم جوابے که ربات بدهد)
——————
/delanswer [TEXT]
❌حذف جواب سریع
——————
/clean answers
👌 حذف همه جواب سریع ها
——————
/answerlist
📖 لیست همه جواب سریع ها
——————
📌 این دستورات فقط براے ادمین اصلے قابل استفاده هستند :
/addadmin [ایدی‌عددی]
➕ افزودن ادمین جدید
——————
/deladmin [ایدی‌عددی]
➖ حذف ادمین
——————
/clean admins
✖️ حذف همه ادمین ها
——————
/adminlist
📃 لیست همه ادمین ها
",
                'parse_mode' => 'html'
            ]);
        }
        if ($state === "انلاین") {
            if ($userID === $sudo or isset($data["data"]["Adms"][$userID])) {
                if (preg_match("/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me/", $msg)) {
                    preg_match("/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me/", $msg, $l);
                    $link = $l[0];

                    if ($Join === "انلاین") {
                        try {
                            $MadelineProto->messages->importChatInvite([
                                'hash' =>  str_replace('https://t.me/joinchat/', '', $link),
                            ]);
                            $MadelineProto->messages->sendMessage([
                                'peer'       => $chatID,
                                'message'    => "تبچی 𝔼𝕣𝕗𝕒𝕟 در یک لینک عضو شد♻️",
                                'parse_mode' => 'html'
                            ]);
                        } catch (\danog\MadelineProto\RPCErrorException $e) {
                            if ($Save === "انلاین") {
                                if (!isset($data["data"]["data"][$link])) {
                                    $data["data"]["links"][] = $link;
                                    file_put_contents("data.json", json_encode($data));
                                    $MadelineProto->messages->sendMessage([
                                        'peer'      => $chatID,
                                        'message'    => "♻️به دلیل محدودیت یک لینک ذخیره شد",
                                        'parse_mode' => 'html'
                                    ]);
                                } else {
                                    $MadelineProto->messages->sendMessage([
                                        'peer'       => $chatID,
                                        'message'    => "♻️به دلیل محدودیت یک لینک ذخیره شد",
                                        'parse_mode' => 'html'
                                    ]);
                                }
                            }
                        } catch (\danog\MadelineProto\Exception $e2) {
                            if ($Save === "انلاین") {
                                if (!isset($data["data"]["data"][$link])) {
                                    $data["data"]["links"][] = $link;
                                    file_put_contents("data.json", json_encode($data));
                                    $MadelineProto->messages->sendMessage([
                                        'peer'       => $chatID,
                                        'message'    => "♻️به دلیل محدودیت یک لینک ذخیره شد",
                                        'parse_mode' => 'html'
                                    ]);
                                } else {
                                    $MadelineProto->messages->sendMessage([
                                        'peer'       => $chatID,
                                        'message'    => "♻️به دلیل محدودیت یک لینک ذخیره شد",
                                        'parse_mode' => 'html'
                                    ]);
                                }
                            }
                        }
                    }
                }
                if ($msg == "/67") {
                    $links_pack = $data["data"]["links"];
                    $fadat_r = array_rand($links_pack);
                    $link = $links_pack[$fadat_r];
                    $MadelineProto->messages->sendMessage([
                        'peer'       => $chatID,
                        'message'    => "$link",
                        'parse_mode' => 'html'
                    ]);
                }
            }
        }
        $Array_minet = [1, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55];
        $Array_since = ['01', '02', '03', '04', '05', '06', '07', '08', '09'];
        if ($msg !== null) {
            if ($Join === "انلاین") {
                if ($JoinSave === "انلاین") {
                    if (in_array($Time_i, $Array_minet) && in_array($Time_s, $Array_since)) {
                        $links_pack = $data["data"]["links"];
                        $fadat_r    = array_rand($links_pack);
                        $link1      = $links_pack[$fadat_r];
                        $link       = str_replace('https://t.me/joinchat/', '', $link1);
                        try {
                            $MadelineProto->messages->importChatInvite([
                                'hash' => $link
                            ]);
                            $MadelineProto->messages->sendMessage([
                                'peer'       => $me_id, 
                                'message'    => "♻️تبچی 𝔼𝕣𝕗𝕒𝕟 در یک لینک عضو شد",
                                'parse_mode' => 'html'
                            ]);
                        } catch (\danog\MadelineProto\RPCErrorException $e) {
                            $MadelineProto->messages->sendMessage([
                                'peer'       => $me_id,
                                'message'    => "♦️1\n$link \n $link1",
                                'parse_mode' => 'html'
                            ]);
                        } catch (\danog\MadelineProto\Exception $e2) {
                            $MadelineProto->messages->sendMessage([
                                'peer'       => $me_id,
                                'message'    => "♦️2",
                                'parse_mode' => 'html'
                            ]);
                        }
                        unset($data["data"]["links"][$fadat_r]);
                        file_put_contents("data.json", json_encode($data));
                        sleep(1.2);
                    }
                }
            }
        }

        if ($msg !== null) {
            $Array_since2 = ['01', '02', '03'];
            $Array_minet2 = [3, 7, 11, 13, 19, 22, 26, 29, 31, 34, 39, 41, 43, 47, 49, 52];
            if (in_array($Time_i, $Array_minet2) && in_array($Time_s, $Array_since2)) {
                $MadelineProto->messages->sendMessage([
                    'peer'       => $me_id,
                    'message'    => "ربات در حال بروز رسانی ",
                    'parse_mode' => 'html'
                ]);
                sleep(0.9);
            }
        }
        $Array_minet3 = [2, 17, 28, 33, 42, 51];
        if (in_array($Time_i, $Array_minet3) and in_array($Time_s, $Array_since)) {
            if ($msg !== null) {
                $MadelineProto->channels->deleteHistory([
                    'channel' => $chatID,
                    'max_id'  => $msg_id
                ]);
                $MadelineProto->messages->sendMessage([
                    'peer'    => $me_id,
                    'message' => "فلاش انجام شد ایدی چت $chatID",
                    'parse_mode' => 'html'
                ]);
            }
        }

        if ($userID === $sudo or isset($data["data"]["Adms"][$userID])) {
            if ($msg == "آنلاین" or $msg == "انلاین") {
                $data["data"]["state"] = "انلاین";
                file_put_contents("data.json", json_encode($data));
                $MadelineProto->messages->sendMessage([
                    'peer'       => $chatID,
                    'message'    => "♻️ربات روشن است Creator:@Erfan_Saadatnia /n Channel : @Erfan_Saadatnia",
                    'parse_mode' => "html"
                ]);
                sleep(1);
            }

            if ($state === "انلاین") {
                if ($msg == "!typon" or $msg == "!typingon") {
                    $data["data"]["Typing"] = "انلاین";
                    file_put_contents("data.json", json_encode($data));
                    $MadelineProto->messages->sendMessage([
                        'peer' => $chatID,
                        'message' => "♻️حالت تایپینگ تبچی روشن شد",
                        'parse_mode' => "html"
                    ]);
                    sleep(1);
                }

                if ($msg == "typingoff" or $msg == "/typeoff") {
                    $data["data"]["Typing"] = "خاموش❌";
                    file_put_contents("data.json", json_encode($data));
                    $MadelineProto->messages->sendMessage([
                        'peer'       => $chatID,
                        'message'    => "♻️حالت تایپینگ خاموش شد",
                        'parse_mode' => "html"]);
                    sleep(1);
                }

                if ($msg == "!typingpvon" or $msg == "/typingpvon") {
                    $data["data"]["ANS_PV"] = "انلاین";
                    file_put_contents("data.json", json_encode($data));
                    $MadelineProto->messages->sendMessage([
                        'peer'       => $chatID,
                        'message'    => "♻️پاسخ خودکار در پیوی ها روشن شد",
                        'parse_mode' => "html"
                    ]);
                    sleep(1);
                }

                if ($msg == "!typingpvoff" or $msg == "/typingpvoff") {
                    $data["data"]["ANS_PV"] = "خاموش❌";
                    file_put_contents("data.json", json_encode($data));
                    $MadelineProto->messages->sendMessage([
                        'peer'       => $chatID,
                        'message'    => "♻️پاسخ خودکار در پیوی ها خاموش شد",
                        'parse_mode' => "html"
                    ]);
                    sleep(1);
                }
                if ($msg == "/joinon" || $msg == "!joinon") {
                    $data["data"]["Join"] = "انلاین";
                    file_put_contents("data.json", json_encode($data));
                    $MadelineProto->messages->sendMessage([
                        'peer' => $chatID, 
                        'message' => "♻️جوین تبچی 𝔼𝕣𝕗𝕒𝕟 روشن شد", 
                        'parse_mode' => "html"
                    ]);
                    sleep(1);
                }

                if ($msg == "/joinoff" or $msg == "!joinoff") {
                    $data["data"]["Join"] = "خاموش❌";
                    file_put_contents("data.json", json_encode($data));
                    $MadelineProto->messages->sendMessage([
                        'peer'       => $chatID,
                        'message'    => "♻️جوین تبچی 𝔼𝕣𝕗𝕒𝕟 خاموش شد!",
                        'parse_mode' => "html"
                    ]);
                    sleep(1);
                }
                if ($msg == "!/delchs" or $msg == "/delchs") {
                    file_put_contents("data.json", json_encode($data));
                    $MadelineProto->channels->deleteChannel([
                        'channel' => $text
                    ]);
                    $MadelineProto->messages->sendMessage([
                        'peer'       => $chatID,
                        'message'    => "♻️تبچی 𝔼𝕣𝕗𝕒𝕟 از همه کانالا لفت داد",
                        'parse_mode' => "html"]);
                }
                if ($Reed === "انلاین") {
                    $msg_id = $update['update']['message']['id'];
                    $MadelineProto->channels->readMessageContents([
                        'channel' => $chatID,
                        'id'      => [$msg_id]
                    ]);
                }

                if ($Typing === "انلاین") {
                    $m = $MadelineProto->messages->setTyping([
                        'peer'   => $chatID,
                        'action' => ['_' => 'sendMessageTypingAction']
                    ]);
                }

                if (preg_match("/^[#\!\/](set) (.*)$/", $msg)) {
                    preg_match("/^[#\!\/](set) (.*)$/", $msg, $text1);
                    $text = $text1[2];
                    if (!isset($data["data"]["me_id"])) {
                        $data["data"]["me_id"][$text] = $text;
                        file_put_contents("data.json", json_encode($data));
                        $MadelineProto->messages->sendMessage([
                            'peer'       => $chatID, 
                            'message'    => "Ok>$text", 
                            'parse_mode' => "html"
                        ]);
                    }
                    if ($msg == 'انلاین' and $userID == $admin) {
                        file_put_contents('on.txt', 'on');
                        $MadelineProto->messages->sendMessage([
                            'peer' => $chatID,
                            'message' => 'تبچی 𝔼𝕣𝕗𝕒𝕟 انلاین است',
                            'reply_to_msg_id' => $msg_id
                        ]);
                    }
                    if (preg_match("/^[\/\#\!]?(شناسه) (.*)$/i", $msg)) {
                        preg_match("/^[\/\#\!]?(شناسه) (.*)$/i", $msg, $text);
                        $mee       = $MadelineProto->get_full_info($text[2]);
                        $me        = $mee['User'];
                        $me_id     = $me['id'];
                        $me_status = $me['status']['_'];
                        $me_bio    = $mee['full']['about'];
                        $me_common = $mee['full']['common_chats_count'];
                        $me_name   = $me['first_name'];
                        $me_uname  = $me['username'];
                        $MadelineProto->messages->editMessage([
                            'peer'       => $chatID,
                            'id'         => $msg_id,
                            'message'    => "<b>$me_id</b> ",
                            'parse_mode' => 'HTML'
                        ]);
                    }
                    if (strpos($msg, "profile ") !== false) {
                        $ip = trim(str_replace("profile ", "", $msg));
                        $ip = explode("|", $ip . "|||||");
                        $id1 = trim($ip[0]);
                        $id2 = trim($ip[1]);
                        $id3 = trim($ip[2]);
                        $User = $MadelineProto->account->updateProfile([
                            'first_name' => "$id1",
                            'last_name'  => "$id2",
                            'about'      => "$id3",
                        ]);
                        $ed = $MadelineProto->messages->editMessage([
                            'peer'    => $chatID,
                            'id'      => $msg_id,
                            'message' => "
 #ғɪʀsᴛ ɴᴀᴍᴇ ✅ : $id1

#ʟᴀsᴛ ɴᴀᴍᴇ ✅ : $id2

#ʙɪᴏ ✅ : $id3

Creator:@Erfan_Saadatnia /n Channel : @Erfan_Saadatnia
️",
                            'parse_mode' => 'MarkDown'
                        ]);
                    }
                }

                if ((int) json_decode(file_get_contents('Config.json'))->Typing == 1) {
                    $m = $MadelineProto->messages->setTyping([
                        'peer'   => $chatID,
                        'action' => ['_' => 'sendMessageTypingAction']
                    ]);
                }
            }
            try {
            } catch (Exception $e) {
            } catch (\danog\MadelineProto\RPCErrorException $e) {
            } catch (\danog\MadelineProto\Exception $e) {
            } catch (\danog\MadelineProto\TL\Conversion\Exception $e) {
            }
        }
    }
}
