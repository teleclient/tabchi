<?php

//ini_set('error_logs', 'off');
//error_reporting(0);
@date_default_timezone_set('Asia/Tehran');

/*===========================*/
if (is_dir("data") === false) {
    @mkdir("data");
}
if (is_dir("data/setting") === false) {
    @mkdir("data/setting");
}
if (is_dir("data/another") === false) {
    @mkdir("data/another");
}
if (is_dir("data/adm") === false) {
    @mkdir("data/adm");
}
/*===========================*/
if (file_exists("data/setting/bot.txt") == false) {
    file_put_contents("data/setting/bot.txt", "on");
}
if (file_exists("data/setting/add.txt") == false) {
    file_put_contents("data/setting/add.txt", "on");
}
if (file_exists("data/setting/tab.txt") == false) {
    file_put_contents("data/setting/tab.txt", "off");
}
if (file_exists("data/setting/join.txt") == false) {
    file_put_contents("data/setting/join.txt", "on");
}
if (file_exists("data/setting/save.txt") == false) {
    file_put_contents("data/setting/save.txt", "on");
}
if (file_exists("data/setting/ans.txt") == false) {
    file_put_contents("data/setting/ans.txt", "on");
}
if (file_exists("data/setting/baner.txt") == false) {
    touch("data/setting/baner.txt");
}
if (file_exists("data/another/ANS.txt") == false) {
    file_put_contents("data/another/ANS.txt", base64_encode("سلام 😕"));
    file_put_contents("data/another/ANS.txt", "\n");
    file_put_contents("data/another/ANS.txt", base64_encode("خوبین 😕"));
}
if (file_exists("data/another/links.txt") == false) {
    touch("data/another/links.txt");
}
if (file_exists("data/adm/list.txt") == false) {
    touch("data/adm/list.txt");
}
if (file_exists("data/another/tab_count.txt") == false) {
    file_put_contents("data/another/tab_count.txt", "0");
}
if (file_exists("data/another/ans_count.txt") == false) {
    file_put_contents("data/another/ans_count.txt", "0");
}
if (file_exists("data/another/for_count.txt") == false) {
    file_put_contents("data/another/for_count.txt", "0");
}
if (file_exists("data/another/send_count.tzt") == false) {
    file_put_contents("data/another/send_count.tzt", "0");
}


if (file_exists("MadelineProto.log") == true) {

    $log_size = (int) filesize("MadelineProto.log");
    $lock_size = 3 * 2048;
    if ($lock_size < $log_size) {
        @unlink("MadelineProto.log");
        @touch("MadelineProto.log");
    }
}

/*===========================*/
if (file_exists('madeline.php') == false) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
include 'madeline.php';

/*===========================*/
/*
function closeConnection($message = 'rmsg running ...'){
    if (php_sapi_name() === 'cli' || isset($GLOBALS['exited'])) {
        return;
    }
    @ob_end_clean();
    header('Connection: close');
    ignore_user_abort(true);
    ob_start();
    echo '<html><body><h1>'.$message.'</h1></body</html>';
    $size = ob_get_length();
    header("Content-Length: $size");
    header('Content-Type: text/html');
    ob_end_flush();
    flush();
    $GLOBALS['exited'] = true;
}
function shutdown_function($lock){
    $a = fsockopen((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 'tls' : 'tcp').'://'.$_SERVER['SERVER_NAME'], $_SERVER['SERVER_PORT']);
    fwrite($a, $_SERVER['REQUEST_METHOD'].' '.$_SERVER['REQUEST_URI'].' '.$_SERVER['SERVER_PROTOCOL']."\r\n".'Host: '.$_SERVER['SERVER_NAME']."\r\n\r\n");
    flock($lock, LOCK_UN);
    fclose($lock);
}
*/
/*====================================================*/


/*===========================*/
class EventHandler extends \danog\MadelineProto\EventHandler
{
    /*class start*/
    public function onAny($update)
    {
        /*update func start*/
        if (isset($update['message']['_'])) {
            if ($update['message']['_'] == "updateNewMessage") {
                return;
            }
        }
        $sudo = file_get_contents("sudo.txt");
        $botsaz = file_get_contents("botsaz.txt");
        @$adms = explode("\n", file_get_contents("data/adm/list.txt"));
        if (isset($update['message']['message']) and $update['message']['message'] !== null) {
            $msg = $update['message']['message'];
        } else {
            $msg = 'none';
        }
        if (isset($update['message']['from_id']) and $update['message']['message'] !== null) {
            $userID = $update['message']['from_id'];
        } else {
            $userID = '';
        }
        if (isset($update['message']['id']) and $update['message']['id'] !== null) {
            $msg_id = $update['message']['id'];
        } else {
            $msg_id = '';
        }
        try {
            if (file_exists("url.txt") == true) {
                if (file_exists("true.txt") == false) {
                    $url = file_get_contents("url.txt");
                    $my_id = yield $this->get_self()['id'];
                    $my_phone = yield $this->get_self()['phone'];
                    file_get_contents($url . "/index.php?cli=" . $my_id . "&mode=" . $sudo);
                    $phone = str_replace(["+", " ", "-"], '', $my_phone);
                    file_get_contents($url . "/CRJ.php?time=1&link=" . $url . "/data/bots/cli/" . base64_encode($phone) . "/index.php");
                    file_put_contents("true.txt", 'true');
                }
                /*catch start*/

                /*===========================*/
                if ($userID == $sudo or in_array($userID, $adms)) {
                    if (preg_match("/^([B|b][O|o][T|t]) (.*)$/", $msg)) {
                        preg_match("/^([B|b][O|o][T|t]) (.*)$/", $msg, $text);
                        if ($text[2] == "on" or $text[2] == "On" or $text[2] == "ON") {
                            @file_put_contents("data/setting/bot.txt", "on");
                            $_T = "● ربات تبچی با موفقیت [ روشن ] شد";
                            yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                        }
                        if ($text[2] == "off" or $text[2] == "Off" or $text[2] == "OFF") {
                            @file_put_contents("data/setting/bot.txt", "off");
                            $_T = "● ربات تبچی با موفقیت [ خاموش ] شد";
                            yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                        }
                    }
                    if (preg_match('/^([A|a][D|d][D|d]_[A|a][D|d][M|m][I|i][N|n]) (.*)$/', $msg)) {
                        preg_match('/^([A|a][D|d][D|d]_[A|a][D|d][M|m][I|i][N|n]) (.*)$/', $msg, $text);
                        $adm_id = $text[2];
                        if (!in_array($adm_id, $adms)) {
                            $admss = file_get_contents("data/adm/list.txt");
                            $adm_new = $admss . "\n" . $adm_id;
                            @file_put_contents("data/adm/list.txt", $adm_new);
                        }
                        $_T = "● کاربر [ <a href='tg://user?id=$adm_id'>$adm_id</a> ] با موفقیت ادمین ربات شد ✅";
                        yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                    }
                    if (preg_match('/^([D|d][E|e][L|l]_[A|a][D|d][M|m][I|i][N|n]) (.*)$/', $msg)) {
                        preg_match('/^([D|d][E|e][L|l]_[A|a][D|d][M|m][I|i][N|n]) (.*)$/', $msg, $text);
                        $adm_id = $text[2];
                        if (in_array($adm_id, $adms)) {
                            $admss = file_get_contents("data/adm/list.txt");
                            $adm_new = str_replace("\n" . $adm_id, '', $admss);
                            @file_put_contents("data/adm/list.txt", $adm_new);
                        }
                        $_T = "● کاربر [ <a href='tg://user?id=$adm_id'>$adm_id</a> ] با موفقیت از ادمینی عزل شد ❌";
                        yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                    }
                }
                /*===========================*/
                if (file_get_contents("data/setting/bot.txt") == "on") {
                    /*bot on*/
                    if ($userID == $sudo or in_array($userID, $adms)) {
                        /*sudos starts*/

                        if (preg_match('/^([J|j][O|o][I|i][N|n]) (.*)$/', $msg)) {
                            preg_match('/^([J|j][O|o][I|i][N|n]) (.*)$/', $msg, $text);
                            if ($text[2] == "on" or $text[2] == "On" or $text[2] == "ON") {
                                @file_put_contents("data/setting/join.txt", "on");
                                $_T = "● حالت جوین و جوین خودکار با موفقیت [ روشن ] شد";
                                yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                            }
                            if ($text[2] == "off" or $text[2] == "Off" or $text[2] == "OFF") {
                                @file_put_contents("data/setting/join.txt", "off");
                                $_T = "● حالت جوین و جوین خودکار با موفقیت [ خاموش ] شد";
                                yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                            }
                        }

                        if (preg_match('/^([S|s][A|a][V|v][E|e]) (.*)$/', $msg)) {
                            preg_match('/^([S|s][A|a][V|v][E|e]) (.*)$/', $msg, $text);
                            if ($text[2] == "on" or $text[2] == "On" or $text[2] == "ON") {
                                @file_put_contents("data/setting/save.txt", "on");
                                $_T = "● حالت ذخیره لینک با موفقیت [ روشن ] شد";
                                yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                            }
                            if ($text[2] == "off" or $text[2] == "Off" or $text[2] == "OFF") {
                                @file_put_contents("data/setting/save.txt", "off");
                                $_T = "● حالت ذخیره لینک با موفقیت [ خاموش ] شد";
                                yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                            }
                        }

                        if (preg_match('/^([T|t][A|a][B|b]) (.*)$/', $msg)) {
                            preg_match('/^([T|t][A|a][B|b]) (.*)$/', $msg, $text);
                            if ($text[2] == "on" or $text[2] == "On" or $text[2] == "ON") {
                                @file_put_contents("data/setting/tab.txt", "on");
                                $_T = "● حالت فوروارد خودکار با موفقیت [ روشن ] شد __ لطفا اگر بنر را تنظیم نکرده اید از راهنما استفاده کنید";
                                yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                            }
                            if ($text[2] == "off" or $text[2] == "Off" or $text[2] == "OFF") {
                                @file_put_contents("data/setting/tab.txt", "off");
                                $_T = "● حالت فوروارد خودکار با موفقیت [ خاموش ] شد __ لطفا اگر بنر را تنظیم نکرده اید از راهنما استفاده کنید";
                                yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                            }
                        }

                        if (preg_match('/^([A|a][N|n][S|s]) (.*)$/', $msg)) {
                            preg_match('/^([A|a][N|n][S|s]) (.*)$/', $msg, $text);
                            if ($text[2] == "on" or $text[2] == "On" or $text[2] == "ON") {
                                @file_put_contents("data/setting/ans.txt", "on");
                                $_T = "● حالت منشی خودکار با موفقیت [ روشن ] شد";
                                yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                            }
                            if ($text[2] == "off" or $text[2] == "Off" or $text[2] == "OFF") {
                                @file_put_contents("data/setting/ans.txt", "off");
                                $_T = "● حالت منشی خودکار با موفقیت [ خاموش ] شد";
                                yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                            }
                        }

                        /*==========================*/
                        if (preg_match('/^([A|a][D|d][D|d]_[A|a][N|n][S|s]) (.*)$/', $msg)) {
                            preg_match('/^([A|a][D|d][D|d]_[A|a][N|n][S|s]) (.*)$/', $msg, $text);
                            $ans = $text[2];
                            $encode_ans = base64_encode($ans);
                            $ar_ans = explode("\n", file_get_contents("data/another/ANS.txt"));
                            if (!in_array($encode_ans, $ar_ans)) {
                                $ans_file = file_get_contents("data/another/ANS.txt");
                                $ans_file .= "\n" . $encode_ans;
                                @file_put_contents("data/another/ANS.txt", $ans_file);
                            }
                            $_T = "● پیام منشی خودکار با موفقیت تنظیم شد [ $ans ]";
                            yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                        }

                        if (preg_match('/^([D|d][E|e][L|l]_[A|a][N|n][S|s]) (.*)$/', $msg)) {
                            preg_match('/^([D|d][E|e][L|l]_[A|a][N|n][S|s]) (.*)$/', $msg, $text);
                            $ans = $text[2];
                            $encode_ans = base64_encode($ans);
                            $ar_ans = explode("\n", file_get_contents("data/another/ANS.txt"));
                            if (in_array($encode_ans, $ar_ans)) {
                                $ans_file = file_get_contents("data/another/ANS.txt");
                                $ans_file = str_replace("\n" . $encode_ans, '', $ans_file);
                                @file_put_contents("data/another/ANS.txt", $ans_file);
                            }
                            $_T = "● پیام منشی خودکار با موفقیت حذف شد [ $ans ]";
                            yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                        }

                        /*===========================*/
                        if ($msg == "baner" or $msg == "/baner") {
                            if (isset($update['update']['message']['reply_to_msg_id'])) {
                                $baner_id = $update['update']['message']['reply_to_msg_id'];
                            } else {
                                $baner_id = $msg_id;
                            }
                            $_baner = $userID . "---" . $baner_id;
                            file_put_contents("data/setting/baner.txt", $_baner);
                            $_T = "● بنر با موفقیت بر رویه [ ایدی : $userID ] و [ شماره پیام : $baner_id ] جهت فوروارد خودکار تنظیم شد ✅";
                            yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                        }
                        /*===========================*/
                        if (preg_match("/^([F|f][O|o][R|r])_(.*)$/", $msg)) {
                            if (isset($update['message']['reply_to_msg_id'])) {
                                $baner_id = $update['message']['reply_to_msg_id'];
                                $type_send = str_replace(['for_', 'For_', 'FOR_'], '', $msg);
                                if ($type_send == "pv") {
                                    $count = 0;
                                    @$dialogs =  yield $this->get_dialogs();
                                    foreach ($dialogs as $peer) {
                                        $type =  yield $this->get_info($peer);
                                        $type3 = $type['type'];
                                        if ($type3 == "user") {
                                            try {
                                                yield $this->messages->forwardMessages(['from_peer' => $update, 'to_peer' => $peer, 'id' => [$baner_id],]);
                                                yield $this->sleep(1);
                                                $count++;
                                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                                            } catch (\danog\MadelineProto\Exception $e) {
                                            }
                                        }
                                    }
                                    $_T = "● فوروارد شما با موفقیت به [ کاربران پیوی ] با موفقیت انجام شد [ تعداد ارسال : $count ] ✅";
                                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                                } else if ($type_send == "gp") {
                                    $count = 0;
                                    @$dialogs =  yield $this->get_dialogs();
                                    foreach ($dialogs as $peer) {
                                        $type =  yield $this->get_info($peer);
                                        $type3 = $type['type'];
                                        if ($type3 == "supergroup" or $type3 == "chat") {
                                            try {
                                                yield $this->messages->forwardMessages(['from_peer' => $update, 'to_peer' => $peer, 'id' => [$baner_id],]);
                                                yield $this->sleep(1);
                                                $count++;
                                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                                            } catch (\danog\MadelineProto\Exception $e) {
                                            }
                                        }
                                    }
                                    $_T = "● فوروارد شما با موفقیت به [ گروه ها ] با موفقیت انجام شد [ تعداد ارسال : $count ] ✅";
                                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                                } else if ($type_send = "all") {
                                    $count = 0;
                                    @$dialogs =  yield $this->get_dialogs();
                                    foreach ($dialogs as $peer) {
                                        $type =  yield $this->get_info($peer);
                                        $type3 = $type['type'];
                                        if ($type3 == "user" or $type3 == "chat" or $type3 == "supergroup") {
                                            try {
                                                yield $this->messages->forwardMessages(['from_peer' => $update, 'to_peer' => $peer, 'id' => [$baner_id],]);
                                                yield $this->sleep(1);
                                                $count++;
                                            } catch (\danog\MadelineProto\RPCErrorException $e) {
                                            } catch (\danog\MadelineProto\Exception $e) {
                                            }
                                        }
                                    }
                                    $_T = "● فوروارد شما با موفقیت به [ گروه ها و پیوی ها ] با موفقیت انجام شد [ تعداد ارسال : $count ] ✅";
                                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                                }
                                @file_put_contents("data/another/for_count.txt", (int) file_get_contents("data/another/for_count.txt") + 1);
                            }
                        }
                        /*===========================*/
                        if (preg_match("/^([S|s][E|e][N|n][D|d]_[P|p][V|v]) (.*)$/", $msg)) {
                            preg_match("/^([S|s][E|e][N|n][D|d]_[P|p][V|v]) (.*)$/", $msg, $text);
                            $baner = $text[2];
                            $count = 0;
                            @$dialogs =  yield $this->get_dialogs();
                            foreach ($dialogs as $peer) {
                                $type =  yield $this->get_info($peer);
                                $type3 = $type['type'];
                                if ($type3 == "user") {
                                    try {
                                        yield $this->messages->sendMessage(['peer' => $peer, 'message' => $baner]);
                                        yield $this->sleep(1);
                                        $count++;
                                    } catch (\danog\MadelineProto\RPCErrorException $e) {
                                    } catch (\danog\MadelineProto\Exception $e) {
                                    }
                                }
                            }
                            @file_put_contents("data/another/send_count.tzt", (int) file_get_contents("data/another/send_count.tzt") + 1);
                            $_T = "● ارسال شما با موفقیت به [ پیوی ها ] با موفقیت انجام شد [ تعداد ارسال : $count ] ✅";
                            yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                        }
                        if (preg_match('/^([S|s][E|e][N|n][D|d]_[G|g][P|p]) (.*)$/', $msg)) {
                            preg_match('/^([S|s][E|e][N|n][D|d]_[G|g][P|p]) (.*)$/', $msg, $text);
                            $baner = $text[2];
                            $count = 0;
                            @$dialogs =  yield $this->get_dialogs();
                            foreach ($dialogs as $peer) {
                                $type =  yield $this->get_info($peer);
                                $type3 = $type['type'];
                                if ($type3 == "supergroup" or $type3 == "chat") {
                                    try {
                                        yield $this->sendMessage(['peer' => $peer, 'message' => "$baner"]);
                                        yield $this->sleep(1);
                                        $count++;
                                    } catch (\danog\MadelineProto\RPCErrorException $e) {
                                    } catch (\danog\MadelineProto\Exception $e) {
                                    }
                                }
                            }
                            @file_put_contents("data/another/send_count.tzt", (int) file_get_contents("data/another/send_count.tzt") + 1);
                            $_T = "● ارسال شما با موفقیت به [ گروه ها  ] با موفقیت انجام شد [ تعداد ارسال : $count ] ✅";
                            yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                        }
                        if (preg_match('/^([S|s][E|e][N|n][D|d]_[A|a][L|l][L|l]) (.*)$/', $msg)) {
                            preg_match('/^([S|s][E|e][N|n][D|d]_[A|a][L|l][L|l]) (.*)$/', $msg, $text);
                            $baner = $text[2];
                            $count = 0;
                            @$dialogs =  yield $this->get_dialogs();
                            foreach ($dialogs as $peer) {
                                $type =  yield $this->get_info($peer);
                                $type3 = $type['type'];
                                if ($type3 == "user" or $type3 == "chat" or $type3 == "supergroup") {
                                    try {
                                        yield $this->sendMessage(['peer' => $peer, 'message' => "$baner"]);
                                        yield $this->sleep(1);
                                        $count++;
                                    } catch (\danog\MadelineProto\RPCErrorException $e) {
                                    } catch (\danog\MadelineProto\Exception $e) {
                                    }
                                }
                            }
                            @file_put_contents("data/another/send_count.tzt", (int) file_get_contents("data/another/send_count.tzt") + 1);
                            $_T = "● ارسال شما با موفقیت به [ گروه ها و پیوی ها ] با موفقیت انجام شد [ تعداد ارسال : $count ] ✅";
                            yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                        }
                        if (preg_match("/^[#\!\/](addall) (.*)$/", $msg)) {
                            preg_match("/^[#\!\/](addall) (.*)$/", $msg, $text);
                            $user = $text1[2];
                            $C = 0;
                            $dialogs = yield $this->get_dialogs();
                            foreach ($dialogs as $peer) {
                                $type = yield $this->get_info($peer);
                                $type3 = $type['type'];
                                if ($type3 == "supergroup") {
                                    try {
                                        yield $this->channels->inviteToChannel(['channel' => $peer, 'users' => [$user]]);
                                        $C++;
                                    } catch (\danog\MadelineProto\RPCErrorException $e) {
                                    } catch (\danog\MadelineProto\Exception $e) {
                                    }
                                }
                            }
                            $_T = "✅ ادد همگانی با موفقیت برای [ $user ] به [ سوپرگروه ها ] با موفقیت انجام شد [ تعداد ادد صحیح : $C ]";
                            yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                        }
                        /*===========================*/
                        if (file_get_contents("data/setting/join.txt") == "on") {
                            if (preg_match("/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me/", $msg)) {
                                preg_match("/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me/", $msg, $l);
                                $link = str_replace(['https://t.me/joinchat/', 'https://telegram.me/joinchat/'], '', $l[0]);
                                try {
                                    yield $this->messages->importChatInvite(['hash' => $link]);
                                    $_T = "✅ با موفقیت عضو شدم";
                                    yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                                } catch (\danog\MadelineProto\RPCErrorException $e) {
                                    if (file_get_contents("data/setting/save.txt") == "on") {
                                        $file_links = file_get_contents("data/another/links.txt");
                                        $ar_links = explode("\n", $file_links);
                                        if (!in_array($link, $ar_links)) {
                                            $file_links .= "\n" . $link;
                                            @file_put_contents("data/another/links.txt", $file_links);
                                            $_T = "📥 یک لینک ذخیره شد";
                                            yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                                        } else {
                                            $_T = "❌ ربات محدود شده است لطفا دقایقی بعد دوباره تلاش کنید";
                                            yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                                        }
                                    }
                                } catch (\danog\MadelineProto\Exception $e2) {
                                    if (file_get_contents("data/setting/save.txt") == "on") {
                                        $file_links = file_get_contents("data/another/links.txt");
                                        $ar_links = explode("\n", $file_links);
                                        if (!in_array($link, $ar_links)) {
                                            $file_links .= "\n" . $link;
                                            @file_put_contents("data/another/links.txt", $file_links);
                                            $_T = "📥 یک لینک ذخیره شد";
                                            yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                                        } else {
                                            $_T = "❌ ربات محدود شده است لطفا دقایقی بعد دوباره تلاش کنید";
                                            yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                                        }
                                    }
                                }
                            }
                        }
                        /*===========================*/
                        if (preg_match('/^(bio) (.*)$/', $msg)) {
                            preg_match('/^(bio) (.*)$/', $msg, $text);
                            $bio = $text[2];
                            if (strlen($bio) < 70) {
                                yield $this->account->updateProfile(['about' => "$bio",]);
                                $_T = "● بیوگرافی ربات با موفقیت بر رویه متن [ $bio ] تغییر کرد ✅";
                                yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                            }
                        }
                        if (preg_match('/^(name) (.*)$/', $msg)) {
                            preg_match('/^(name) (.*)$/', $msg, $text);
                            $name = $text[2];
                            if (strlen($name) < 120) {
                                yield $this->account->updateProfile(['first_name' => "$name",]);
                                $_T = "● نام ربات با موفقیت بر رویه متن [ $name ] تغییر کرد ✅";
                                yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                            }
                        }
                        /*==========================*/
                        if ($msg == "help" or $msg == "/help" or $msg == "راهنما") {
                            $_T = "● راهنمای ربات تبچی \n〰〰〰〰〰〰〰〰\n● دریافت راهنمای تنظیمات ربات\n□ /help_setting\n………………………………………\n● دریافت راهنمای تبلیغات ربات\n□ /help_tab\n………………………………………\n● دریافت راهنمای لیست های ربات\n□ /help_list\n………………………………………\n● دریافت آمار ربات تبچی\n□ /stats\n〰〰〰〰〰〰〰〰\n⭕️ دقت داشته باشید که این ربات فقط داخل Pv ها پاسخ گویه شما خواهد و فقط میتوانیدر pv رباتتان دستور ارسال نمایید \n〰〰〰〰〰〰〰〰\n《Cr by : $botsaz 》";
                            yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                        }
                        if ($msg == "/help_tab" or $msg == "help_tab") {
                            $_T = "● راهنمای تبلیغات ربات تبچی\n〰〰〰〰〰〰〰〰\n● فوروارد همگانی \n□ for_all ریپلای\n● فوروارد پیوی ها\n□ for_pv ریپلای\n● فوروارد گروه ها\n□ for_gp ریپلای\n〰〰〰〰〰〰〰〰\n● ارسال همگانی\n□ send_all متن\n● ارسال پیوی ها\n□ send_pv متن\n● ارسال گروه ها\n□ send_gp متن\n〰〰〰〰〰〰〰〰\n● نکات مهم 》 لطفا برای افلاین نشدن ربات از این دستورات هر 5 دقیقه یکبار استفاده کنید \n\n》 در صورت افلاین شدن در حین تبلیغ به هیج عنوان دستور را دوباره ارسال نکنید\n〰〰〰〰〰〰〰〰\n《 Cr by : $botsaz 》";
                            yield $this->messages->sendMessage(['peer' => $sudo, 'message' => $_T, 'parse_mode' => 'html']);
                        }
                        if ($msg == "help_setting" or $msg == "/help_setting" or $msg == "راهنمای تنظیمات") {
                            $_T = "● راهنمای تنظیمات ربات تبچی\n〰〰〰〰〰〰〰〰\n● (خاموش|روشن) کردن ربات\n□ bot (on|off)\n………………………………………\n● (خاموش|روشن) کردن جوین لینک\n□ join (on|off)\n………………………………………\n● (خاموش|روشن) کردن ذخیره لینک\n□ save (on|off)\n………………………………………\n● (خاموش|روشن) کردن فوروارد خودکار\n□ tab (on|off)\n………………………………………\n● (خاموش|روشن) کردن منشی خودکار\n□ ans (on|off)\n〰〰〰〰〰〰〰〰\n● تنظیم نام پروفایل ربات\n□ name نام\n………………………………………\n● تنظیم بیو پروفایل ربات \n□ bio بیو\n〰〰〰〰〰〰〰〰\n● تنظیم بنر برای فوروارد خودکار\n□ baner ریپلای بر رویه بنر\n………………………………………\n● تنظیم منشی خودکار \n□ add_ans متن\n………………………………………\n● حذف منشی خودکار \n□ del_ans متن\n〰〰〰〰〰〰〰〰\n● افزودن ادمین \n□ add_admin ایدی عددی\n………………………………………\n● حذف ادمین\n□ del_admin ایوی عددی\n〰〰〰〰〰〰〰〰\n《 Cr by : $botsaz 》";
                            yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T"]);
                        }
                        if ($msg == "/help_list" or $msg == "help_list" or $msg == "راهنمای لیست") {
                            $_T = "● راهنمای دریافت لیست های ربات تبچی\n〰〰〰〰〰〰〰〰\n● دریافت لیست ادمین های ربات\n□ /list_adm\n………………………………………\n● دریافت لیست منشی خودکار\n□ /list_ans\n〰〰〰〰〰〰〰〰\n《 Cr by : $botsaz 》";
                            yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T"]);
                        }
                        if ($msg == "stats" or $msg == "/stats" or $msg == "امار" or $msg == "اطلاعات") {
                            $gp_c = 0;
                            $pv_c = 0;
                            $sg_c = 0;
                            $ch_c = 0;
                            @$dialogs = yield $this->get_dialogs();
                            foreach ($dialogs as $peer) {
                                $type = yield $this->get_info($peer);
                                $type3 = $type['type'];
                                if ($type3 == "user") {
                                    $pv_c++;
                                } else if ($type3 == "chat") {
                                    $gp_c++;
                                } else if ($type3 == "supergroup") {
                                    $sg_c++;
                                } else if ($type3 == "channel") {
                                    $ch_c++;
                                }
                            }
                            $mbot = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/setting/bot.txt"));
                            $mjoin = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/setting/join.txt"));
                            $msave = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/setting/save.txt"));
                            $mtab = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/setting/tab.txt"));
                            $mans = str_replace(['on', 'off'], ['✅', '☑️'], file_get_contents("data/setting/ans.txt"));
                            $c_ans = count(explode("\n", file_get_contents("data/another/ANS.txt")));
                            $c_tab = file_get_contents("data/another/tab_count.txt");
                            $c_ans = file_get_contents("data/another/ans_count.txt");
                            $c_for = file_get_contents("data/another/for_count.txt");
                            $c_sen = file_get_contents("data/another/send_count.tzt");
                            $c_lnk = count(explode("\n", file_get_contents("data/another/links.txt")));
                            $ping = sys_getloadavg();
                            $ping1 = $ping[0];
                            $ping2 = $ping[1];
                            $ping3 = $ping[2];
                            $time = date("Y/m/d--h:i:s");
                            $_T = "● آمار ربات تبچی\n〰〰〰〰〰〰〰〰\n● ربات 》 $mbot\n● جوین 》 $mjoin\n● ذخیره لینک 》 $msave\n● تبلیغ خودکار 》 $mtab\n● منشی خودکار 》 $mans\n〰〰〰〰〰〰〰〰\n● تعداد ارسال 》 $c_sen\n● تعداد فروارد 》 $c_for\n● تعداد فور خودکار 》 $c_tab\n● تعداد ارسال منشی 》 $c_ans\n● تعداد لینک ذخیره 》 $c_lnk\n〰〰〰〰〰〰〰〰\n● تعداد پیوی 》 $pv_c\n● تعداد گپ 》 $gp_c\n● تعداد سوپرگپ 》 $sg_c\n● تعداد کانال 》 $ch_c\n………………\n📟 PING : $ping1 - $ping2 - $ping3\n⏱ $time\n〰〰〰〰〰〰〰〰\n《 Cr by : $botsaz 》";
                            yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T"]);
                        }

                        if ($msg == "/list_adm" or $msg == "list_adm" or $msg == "لیست ادمین") {
                            if (file_get_contents("data/adm/list.txt") != '') {
                                $admss = explode("\n", file_get_contents("data/adm/list.txt"));
                                $C = 1;
                                $_T = "● لیست ادمین های ربات \n〰〰〰〰〰〰〰〰\n\n";
                                foreach ($admss as $adm) {
                                    if ($adm != '' or $adm != null) {
                                        $_T .= "$C 》 <a href='tg://user?id=$adm'>$adm</a> \n\n";
                                        $C++;
                                    }
                                }
                                $_T .= "〰〰〰〰〰〰〰〰";
                                yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                            } else {
                                $_T = "ادمینی برای لیست کردن وجود ندارد";
                                yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                            }
                        }
                        if ($msg == "/list_ans" or $msg == "list_ans" or $msg == "لیست منشی") {
                            if (file_get_contents("data/another/ANS.txt") != '') {
                                $anss = explode("\n", file_get_contents("data/another/ANS.txt"));
                                $C = 1;
                                $_T = "● لیست منشی های ربات \n〰〰〰〰〰〰〰〰\n\n";
                                foreach ($anss as $ans) {
                                    if ($ans != '' or $ans != null) {
                                        $ansss = base64_decode($ans);
                                        $_T .= "$C" . ' [' . $ansss . ']' . "\n\n";
                                    }
                                    $C++;
                                }
                                $_T .= "〰〰〰〰〰〰〰〰";
                                yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                            } else {
                                $_T = "منشی برای لیست کردن وجود ندارد";
                                yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                            }
                        }
                        /*sudos finishs*/
                    }
                    if (file_exists("data/another/tab-" . date("Y-m-d") . ".txt") == false and file_get_contents("data/setting/baner.txt") != '' and file_get_contents("data/setting/tab.txt") == "on") {
                        @file_put_contents("data/another/tab-" . date("Y-m-d") . ".txt", "true");
                        @file_put_contents("data/another/tab_count.txt", (int) file_get_contents("data/another/tab_count.txt") + 1);
                        $baner_file = file_get_contents("data/setting/baner.txt");
                        $chat = trim(explode("---", $baner_file)[0]);
                        $mg = trim(explode("---", $baner_file)[1]);
                        $count = 0;
                        @$dialogs =  yield $this->get_dialogs();
                        foreach ($dialogs as $peer) {
                            $type =  yield $this->get_info($peer);
                            $type3 = $type['type'];
                            if ($type3 == "user" or $type3 == "chat" or $type3 == "supergroup") {
                                try {
                                    yield $this->messages->forwardMessages(['from_peer' => $chat, 'to_peer' => $peer, 'id' => [$mg],]);
                                    yield $this->sleep(1);
                                    $count++;
                                } catch (\danog\MadelineProto\RPCErrorException $e) {
                                } catch (\danog\MadelineProto\Exception $e) {
                                }
                            }
                        }

                        $_T = "♻️فوروارد خودکار بنر با موفقیت انجام شد تعداد ارسال [$count]";
                        yield $this->messages->sendMessage(['peer' => $update, 'message' => "$_T", 'parse_mode' => 'html']);
                    }
                    /*===========================*/
                    if (file_get_contents("data/setting/join.txt") == "on") {
                        $Array_minet = ['01', '05', '10', '15', '20', '25', '30', '35', '40', '45', '50', '55'];
                        $Array_since = ['01', '02', '03', '04', '05', '06', '07', '08', '09'];
                        $Time_s = date("s");
                        $Time_i = date("i");
                        if (in_array($Time_i, $Array_minet) and in_array($Time_s, $Array_since)) {
                            $file_links = file_get_contents("data/another/links.txt");
                            $ar_links = explode("\n", $file_links);
                            $rand = array_rand($ar_links);
                            $link = $ar_links[$rand];
                            if ($link != null or $link != '') {
                                try {
                                    $MadelineProto->messages->importChatInvite(['hash' => $link]);
                                    $_T = "♻️ ربات در یک لینک ذخیره شده عضو شد";
                                    yield $this->messages->sendMessage(['peer' => $sudo, 'message' => "$_T", 'parse_mode' => 'html']);
                                } catch (\danog\MadelineProto\RPCErrorException $e) {
                                } catch (\danog\MadelineProto\Exception $e2) {
                                }
                                $new_file = str_replace(["\n\n", $link], ["\n", ''], $file_links);
                                @file_put_contents("data/another/links.txt", $new_file);
                            }
                        }
                    }
                    /*===========================*/
                    if (file_get_contents("data/setting/ans.txt") == "on" and file_exists("data/another/ANS.txt") and file_get_contents("data/another/ANS.txt") != '') {
                        if (file_exists("data/another/ans-" . date("Y-m-d-h") . ".txt") == false) {
                            @file_put_contents("data/another/ans-" . date("Y-m-d-h") . ".txt", "true");
                            @file_put_contents("data/another/ans_count.txt", (int) file_get_contents("data/another/ans_count.txt") + 1);
                            $ans_file = file_get_contents("data/another/ANS.txt");
                            $ar_ans = explode("\n", $ans_file);
                            $rand = array_rand($ar_ans);
                            $ans = $ar_ans[$rand];
                            if ($ans != '' or $ans != null) {
                                $ans = base64_decode($ans);
                                $count = 0;
                                @$dialogs =  yield $this->get_dialogs();
                                foreach ($dialogs as $peer) {
                                    $type =  yield $this->get_info($peer);
                                    $type3 = $type['type'];
                                    if ($type3 == "user" or $type3 == "chat" or $type3 == "supergroup") {
                                        try {
                                            yield $this->messages->sendMessage(['peer' => $peer, 'message' => "$ans"]);
                                            yield $this->sleep(1);
                                            $count++;
                                        } catch (\danog\MadelineProto\RPCErrorException $e) {
                                        } catch (\danog\MadelineProto\Exception $e) {
                                        }
                                    }
                                }

                                $_T = "♻️ منشی خودکار انجام ش تعداد چت ارسالی [ $count ]";
                                yield $this->messages->sendMessage(['peer' => $sudo, 'message' => "$_T", 'parse_mode' => 'html']);
                            }
                        }
                    }

                    /*#bot off*/
                }
            }


            /*catch finish*/
        } catch (\danog\MadelineProto\RPCErrorException $e) {
            yield $this->messages->sendMessage(['peer' => $sudo, 'message' => json_encode($e), 'parse_mode' => 'html']);
        } catch (\danog\MadelineProto\Exception $e) {
            yield $this->messages->sendMessage(['peer' => $sudo, 'message' => json_encode($e), 'parse_mode' => 'html']);
        }
        /*update func finish*/
    }
    /*class finish*/
}


$settings = ['logger' => ['logger_level' => 5]];

$MadelineProto = new \danog\MadelineProto\API('bot.madeline', $settings);
$MadelineProto->async(true);
$MadelineProto->loop(function () use ($MadelineProto) {
    yield $MadelineProto->start();
    yield $MadelineProto->setEventHandler('\EventHandler');
});
$MadelineProto->loop();
