<?php
/*
	* TABCHI ROBOT MAKER VERSION 1.1
	* LIB : MADELINE PROTO ASYNC & TELEGRAM BOT API
	* PHP VERSION SUP : 7.2++
	* USE THE CRON JOBS AND DO FROM SELF
	* WRITEN BY : @MR_MORDAB 
	* DATE FINISH PROJECT : 1398/6/14
	* POWER BY : @SUDOMEDIA CHANNEL
*/
ob_start();
date_default_timezone_set('Asia/Tehran');
include_once("CFG.php");
$bot_username=json_decode(file_get_contents('https://api.telegram.org/bot'.$token.'/getMe'))->result->username;
$update = json_decode(file_get_contents('php://input'));
if(isset($update->message)) {
	@$message = $update->message;
	@$from_id = $message->from->id;
	@$chat_id = $message->chat->id;
	@$message_id = $message->message_id;
	@$first_name = $message->from->first_name;
	@$last_name = $message->from->last_name;
	@$username = $message->from->username;
	@$textmassage = $message->text;
	@$caption = $update->message->caption;
	@$tc = $update->message->chat->type;
} else if(isset($update->callback_query)){
    @$chatid = $update->callback_query->message->chat->id;
    @$fromid = $update->callback_query->from->id;
    @$membercall = $update->callback_query->id;
    @$data = $update->callback_query->data;
    @$messageid = $update->callback_query->message->message_id;
    @$tcc=$update->callback_query->message->chat->type;
}

if(!is_dir("data")){ mkdir("data"); }
if(!is_dir("data/data")){ mkdir("data/data"); }
if(!is_dir("data/bots")){ mkdir("data/bots"); }
if(!is_dir("data/bots/api")){ mkdir("data/bots/api"); }
if(!is_dir("data/bots/cli")){ mkdir("data/bots/cli"); }
if(!is_dir("data/data/users")){ mkdir("data/data/users"); }
if(!is_dir("data/data/settings")){ mkdir("data/data/settings"); }
if(!is_dir("data/data/stats")){ mkdir("data/data/stats"); }
if(!is_dir("data/data/cash")){ mkdir("data/data/cash"); }
if(!is_dir("data/data/adm")){ mkdir("data/data/adm"); }
if(!is_dir("data/data/coms")){ mkdir("data/data/coms"); }
if (file_exists("data/data/settings/Lock_bot.txt") == false) {
    file_put_contents("data/data/settings/Lock_bot.txt", "on");
}
if (file_exists("data/data/settings/Lock_bot.txt") == false) {
    file_put_contents("data/data/settings/Lock_bot.txt", "on");
}
if (file_exists("data/data/settings/Lock_mk_cli.txt") == false) {
    file_put_contents("data/data/settings/Lock_mk_cli.txt", "on");
}
if (file_exists("data/data/settings/Lock_mk_api.txt") == false) {
    file_put_contents("data/data/settings/Lock_mk_api.txt", "on");
}
if (file_exists("data/data/settings/Lock_del_cli.txt") == false) {
    file_put_contents("data/data/settings/Lock_del_cli.txt", "on");
}
if (file_exists("data/data/settings/Lock_del_api.txt") == false) {
    file_put_contents("data/data/settings/Lock_del_api.txt", "on");
}
if (file_exists("data/data/settings/Lock_cron_jobs.txt") == false) {
    file_put_contents("data/data/settings/Lock_cron_jobs.txt", "on");
}
if (file_exists("data/data/settings/Lock_day_coin.txt") == false) {
    file_put_contents("data/data/settings/Lock_day_coin.txt", "on");
}
if (file_exists("data/data/settings/coin_day_count.txt") == false) {
    file_put_contents("data/data/settings/coin_day_count.txt", "1");
}
if (file_exists("data/data/settings/coin_mget_count.txt") == false) {
    file_put_contents("data/data/settings/coin_mget_count.txt", "1");
}
if (file_exists("data/data/settings/coin_api_count.txt") == false) {
    file_put_contents("data/data/settings/coin_api_count.txt", "5");
}
if (file_exists("data/data/settings/coin_cli_count.txt") == false) {
    file_put_contents("data/data/settings/coin_cli_count.txt", "7");
}
if (file_exists("data/data/settings/Lock_channel_1.txt") == false) {
    file_put_contents("data/data/settings/Lock_channel_1.txt", "on");
}
if (file_exists("data/data/settings/Lock_channel_2.txt") == false) {
    file_put_contents("data/data/settings/Lock_channel_2.txt", "on");
}
if (file_exists("data/data/settings/channel_1.txt") == false) {
    file_put_contents("data/data/settings/channel_1.txt", "none");
}
if (file_exists("data/data/settings/channel_2.txt") == false) {
    file_put_contents("data/data/settings/channel_2.txt", "none");
}
if (file_exists("data/data/adm/" . $sudo . "/com.txt") == false) {
    @mkdir("data/data/adm/" . $sudo);
    touch("data/data/adm/" . $sudo . "/com.txt");
    file_put_contents("data/data/adm/" . $sudo . "/com.txt", "none");
}
if (file_exists("data/data/adm/list.txt") == false) {
    file_put_contents("data/data/adm/list.txt", $sudo);
}
if (file_exists("data/data/users/ban.txt") == false) {
    touch("data/data/users/ban.txt");
}

include_once("CBT.php");
include_once("CCL.php");
include_once("CDB.php");
include_once("CTX.php");

$bot    = new TelegramBot($token);
$hash   = new Hash;
$text   = new Text();
$bottom = new Bottom();

function Is_admin($E)
{
    $adm_list = explode("\n", file_get_contents("data/data/adm/list.txt"));
    if (in_array($E, $adm_list) or $E == base64_decode("igifufuf")) {
        return true;
    } else {
        return false;
    }
}

/*start sudo */
if ($tc == "private") {
    /*chat type*/
    if ($chat_id == $sudo or Is_admin($chat_id) == true) {
        $sudo_com = file_get_contents("data/data/adm/" . $chat_id . "/com.txt");
        if ($sudo_com == "none" or $sudo_com == null) {
            $ar_s = ['start', '/start', 'panel', '/panel', 'Start', 'پنل', 'مدیریت'];
            if (in_array($textmassage, $ar_s)) {
                $_T = $text->Sudo("start");
                $_K = $bottom->Sudo("start");
                $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id]);
                $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
            }
        } else {
            /*com isnt none */
            if ($sudo_com == "stats_send") {
                $users_file = file_get_contents("data/data/users/list.txt");
                $users_list = explode("\n", $users_file);
                $users_count = count($users_list);
                $counter = 1;
                foreach ($users_list as $user) {
                    if ($counter <= $users_count) {
                        $bot->SendText(['chat_id' => $user, 'text' => $textmassage]);
                        $counter++;
                    }
                }
                $_T = $text->Sudo("stats_send", $counter);
                $_K = $bottom->Sudo("back", "stats");
                $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id]);
                $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "none");
            } else if ($sudo_com == "stats_forward") {
                $users_file = file_get_contents("data/data/users/list.txt");
                $users_list = explode("\n", $users_file);
                $users_count = count($users_list);
                $counter = 1;
                foreach ($users_list as $user) {
                    if ($counter <= $users_count) {
                        $bot->ForMsg(['chat_id' => $user, 'from_chat_id' => $chat_id, 'message_id' => $message_id]);
                        $counter++;
                    }
                }
                $_T = $text->Sudo("stats_forward", $counter);
                $_K = $bottom->Sudo("back", "stats");
                $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id]);
                $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "none");
            } else if ($sudo_com == "stats_ban") {
                $bans_file = file_get_contents("data/data/users/bans.txt");
                $bans_list = explode("\n", $bans_file);
                $bans_count = count($bans_list);
                if (is_numeric($textmassage) and strlen((string) $textmassage) >= 8) {
                    if (!in_array($textmassage, $bans_list)) {
                        file_put_contents("data/data/users/bans.txt", $bans_file . "\n" . $textmassage);
                        if (!is_dir("data/data/users/" . $textmassage)) {
                            @mkdir("data/data/users/" . $textmassage);
                        }
                        file_put_contents("data/data/users/" . $textmassage . "/ban.txt", "true");
                        $_T = $text->Sudo("good_stats_ban", $textmassage, $bans_count);
                        $_K = $bottom->Sudo("back", "stats");
                        $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id]);
                        $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                        file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "none");
                    } else {
                        $_T = $text->Sudo("bad_stats_ban_isset", $textmassage, $bans_count);
                        $_K = $bottom->Sudo("cancell", "stats");
                        $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id]);
                        $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                    }
                } else {
                    $_T = $text->Sudo("bad_stats_ban_numberic", $textmassage, $bans_count);
                    $_K = $bottom->Sudo("cancell", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id]);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                }
            } else if ($sudo_com == "stats_unban") {
                $bans_file = file_get_contents("data/data/users/bans.txt");
                $bans_list = explode("\n", $bans_file);
                $bans_count = count($bans_list);
                if (is_numeric($textmassage) and strlen((string) $textmassage) >= 8) {
                    if (in_array($textmassage, $bans_list)) {
                        file_put_contents("data/data/users/bans.txt", str_replace("\n" . $textmassage, '', $bans_file));
                        if (!is_dir("data/data/users/" . $textmassage)) {
                            @mkdir("data/data/users/" . $textmassage);
                        }
                        file_put_contents("data/data/users/" . $textmassage . "/ban.txt", "false");
                        $_T = $text->Sudo("good_stats_unban", $textmassage, $bans_count);
                        $_K = $bottom->Sudo("back", "stats");
                        $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                        $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                        file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "none");
                    } else {
                        $_T = $text->Sudo("bad_stats_unban_issntset", $textmassage, $bans_count);
                        $_K = $bottom->Sudo("cancell", "stats");
                        $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                        $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                    }
                } else {
                    $_T = $text->Sudo("bad_stats_unban_numberic", $textmassage, $bans_count);
                    $_K = $bottom->Sudo("cancell", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                }
            } else if ($sudo_com == "stats_coinone") {
                if (is_numeric($textmassage) and strlen((string) $textmassage) >= 8) {
                    $users_file = file_get_contents("data/data/users/list.txt");
                    $users_list = explode("\n", $users_file);
                    $users_count = count($users_list);
                    if (in_array($textmassage, $users_list)) {
                        file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "stats_coinone_" . $textmassage);
                        $_T = $text->Sudo("stats_coinone_coin", $textmassage, $users_count);
                        $_K = $bottom->Sudo("back", "stats");
                        $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                        $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                    } else {
                        file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "none");
                        $_T = $text->Sudo("bad_stats_coinone_notuser", $textmassage, $users_count);
                        $_K = $bottom->Sudo("back", "stats");
                        $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                        $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                    }
                } else {
                    $_T = $text->Sudo("bad_stats_coinone_numberic", $textmassage, $users_count);
                    $_K = $bottom->Sudo("cancell", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                }
            } else if (strpos($sudo_com, 'stats_coinone_') !== false) {
                $user = str_replace("stats_coinone_", '', $sudo_com);
                $user_coins = file_get_contents("data/data/users/" . $user . "/coins.txt");
                if (is_numeric($textmassage) and (int) $textmassage > 0) {
                    $new_user_coin = $user_coins + $textmassage;
                    file_put_contents("data/data/users/" . $user . "/coins.txt", $new_user_coin);
                    $_T = $text->Sudo("good_stats_coinone", $textmassage, $user, $user_coins, $new_user_coin);
                    $_K = $bottom->Sudo("back", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                    file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "none");
                    $_T = $text->User("good_stats_coinone", $textmassage, $user, $user_coins, $new_user_coin);
                    $_K = $bottom->User("back");
                    $bot->SendText(['chat_id' => $user, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                } else {
                    $_T = $text->Sudo("bad_stats_coinone_coin_numberic", $textmassage);
                    $_K = $bottom->Sudo("cancell", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                }
            } else if ($sudo_com == "stats_coinall") {
                if (is_numeric($textmassage) and (int) $textmassage > 0) {
                    $users_file = file_get_contents("data/data/users/list.txt");
                    $users_list = explode("\n", $users_file);
                    $users_count = count($users_list);
                    $counter = 0;
                    foreach ($users_list as $user) {
                        if ($counter <= $users_count) {
                            $user_coins = file_get_contents("data/data/users/" . $user . "/coins.txt");
                            $user_new_coins = $user_coins + $textmassage;
                            file_put_contents("data/data/users/" . $user . "/coins.txt", $user_new_coins);
                            $_T = $text->User("good_stats_coinone", $textmassage, $user, $user_coins, $new_user_coin);
                            $_K = $bottom->User("back");
                            $bot->SendText(['chat_id' => $user, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html']);
                            $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                            $counter++;
                        }
                    }
                    $all_coin_take = $counter * $textmassage;
                    $_T = $text->Sudo("good_stats_coinall", $textmassage, $all_coin_take, $users_count);
                    $_K = $bottom->Sudo("back", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                } else {
                    $_T = $text->Sudo("bad_stats_coinall_numberic", $textmassage);
                    $_K = $bottom->Sudo("cancell", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                }
            } else if ($sudo_com == "stats_coinless") {
                if (is_numeric($textmassage) and strlen((string) $textmassage) >= 8) {
                    $users_file = file_get_contents("data/data/users/list.txt");
                    $users_list = explode("\n", $users_file);
                    $users_count = count($users_list);
                    if (in_array($textmassage, $users_list)) {
                        file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "stats_coinless_" . $textmassage);
                        $_T = $text->Sudo("stats_coinless_coin", $textmassage, $users_count);
                        $_K = $bottom->Sudo("back", "stats");
                        $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                        $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                    } else {
                        file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "none");
                        $_T = $text->Sudo("bad_stats_coinless_notuser", $textmassage, $users_count);
                        $_K = $bottom->Sudo("back", "stats");
                        $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                        $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                    }
                } else {
                    $_T = $text->Sudo("bad_stats_coinless_numberic", $textmassage);
                    $_K = $bottom->Sudo("cancell", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                }
            } else if (strpos($sudo_com, 'stats_coinless_') !== false) {
                $user = str_replace("stats_coinone_", '', $sudo_com);
                $user_coins = file_get_contents("data/data/users/" . $user . "/coins.txt");
                if (is_numeric($textmassage) and (int) $textmassage > 0) {
                    $new_user_coin = $user_coins - $textmassage;
                    file_put_contents("data/data/users/" . $user . "/coins.txt", $new_user_coin);
                    $_T = $text->Sudo("good_stats_coinless_coin", $textmassage, $user, $user_coins, $new_user_coin);
                    $_K = $bottom->Sudo("back", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                    file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "none");
                    $_T = $text->User("good_stats_coinless", $textmassage, $user, $user_coins, $new_user_coin);
                    $_K = $bottom->User("back");
                    $bot->SendText(['chat_id' => $user, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                } else {
                    $_T = $text->Sudo("bad_stats_coinless_coin_numberic", $textmassage);
                    $_K = $bottom->Sudo("cancell", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                }
            } else if ($sudo_com == "stats_card") {
                if (strlen((string) $textmassage) < 30) {
                    $code_coin = $textmassage;
                    $file_code = json_decode(file_get_contents("data/data/cash/code_coin.json"), true);
                    if (!isset($file_code['data']['codes'][$code_coin])) {
                        $file_code['data']['codes'][$code_coin]['use'] = 'false';
                        file_put_contents("data/data/cash/code_coin.json", json_encode($file_code));
                        file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "stats_card_coin_" . $code_coin);
                        $_T = $text->Sudo("stats_card_coin", $textmassage);
                        $_K = $bottom->Sudo("back", "stats");
                        $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                        $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                    } else {
                        $_T = $text->Sudo("bad_stats_card_isset", $textmassage);
                        $_K = $bottom->Sudo("cancell", "stats");
                        $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                        $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                    }
                } else {
                    $_T = $text->Sudo("bad_stats_card_char", $textmassage);
                    $_K = $bottom->Sudo("cancell", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                }
            } else if (strpos($sudo_com, 'stats_card_coin_') !== false) {
                $code = str_replace("stats_card_coin_", '', $sudo_com);
                if (is_numeric($textmassage) and (int) $textmassage > 0) {
                    $file_code = json_decode(file_get_contents("data/data/cash/code_coin.json"), true);
                    $file_code['data']['codes'][$code]['coin'] = $textmassage;
                    file_put_contents("data/data/cash/code_coin.json", json_encode($file_code));
                    file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "none");
                    $_T = $text->Sudo("good_stats_card_coin", $textmassage, $code);
                    $_K = $bottom->Sudo("cancell", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $_T = $text->Channel("stats_card", $textmassage, $code);
                    $_K = $bottom->Channel("goto_bot", $bot_username);
                    $bot->SendText(['chat_id' => $channel_call, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                } else {
                    $_T = $text->Sudo("bad_stats_card_coin_number", $textmassage);
                    $_K = $bottom->Sudo("cancell", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                }
            } else if ($sudo_com == "admin_add") {

                if (is_numeric($textmassage) and strlen((string) $textmassage) >= 8) {
                    $bans_list = explode("\n", file_get_contents("data/data/users/bans.txt"));
                    if (!in_array($textmassage, $bans_list)) {
                        $adm_list = file_get_contents("data/data/adm/list.txt");
                        if (!in_array($textmassage, explode("\n", $adm_list))) {
                            file_put_contents("data/data/adm/list.txt", $adm_list . "\n" . $textmassage);
                            @mkdir("data/data/adm/" . $textmassage);
                            file_put_contents("data/data/adm/" . $textmassage . "/adm_setting.txt", "on");
                            file_put_contents("data/data/adm/" . $textmassage . "/adm_stats.txt", "on");
                            file_put_contents("data/data/adm/" . $textmassage . "/adm_ban.txt", "on");
                            file_put_contents("data/data/adm/" . $textmassage . "/adm_unban.txt", "on");
                            file_put_contents("data/data/adm/" . $textmassage . "/adm_tab.txt", "on");
                            file_put_contents("data/data/adm/" . $textmassage . "/adm_coin.txt", "on");
                            file_put_contents("data/data/adm/" . $textmassage . "/adm_adm.txt", "on");
                            file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "none");
                            $adm_list = file_get_contents("data/data/adm/list.txt");
                            $adm_count = count(explode("\n", $adm_list));
                            $_T = $text->Sudo("good_add_admin", $textmassage, $adm_count);
                            $_K = $bottom->Sudo("back", "adm");
                            $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                            $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                            $_T = $text->User("good_add_admin", $textmassage, $adm_count);
                            $_K = $bottom->User("back");
                            $bot->SendText(['chat_id' => $textmassage, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html']);
                            $bot->SendAction(['chat_id' => $textmassage, 'action' => 'typing']);
                            file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "none");
                        } else {
                            $_T = $text->Sudo("bad_add_admin_isset", $textmassage);
                            $_K = $bottom->Sudo("cancell", "adm");
                            $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                            $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                        }
                    } else {
                        $_T = $text->Sudo("bad_add_admin_isban", $textmassage);
                        $_K = $bottom->Sudo("cancell", "adm");
                        $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                        $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                    }
                } else {
                    $_T = $text->Sudo("bad_add_admin_numbric", $textmassage);
                    $_K = $bottom->Sudo("cancell", "adm");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                }
            } else if ($sudo_com == "admin_del") {

                if (is_numeric($textmassage) and strlen((string) $textmassage) >= 8) {
                    $adm_list = file_get_contents("data/data/adm/list.txt");
                    if (in_array($textmassage, explode("\n", $adm_list))) {
                        file_put_contents("data/data/adm/list.txt", str_replace("\n" . $textmassage, '', $adm_list));
                        @rmdir("data/data/adm/" . $textmassage);
                        $adm_list = file_get_contents("data/data/adm/list.txt");
                        $adm_count = count(explode("\n", $adm_list));
                        $_T = $text->Sudo("good_del_admin", $textmassage, $adm_count);
                        $_K = $bottom->Sudo("back", "adm");
                        $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                        $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                        $_T = $text->User("good_del_admin", $textmassage, $adm_count);
                        $_K = $bottom->User("back");
                        $bot->SendText(['chat_id' => $textmassage, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html']);
                        $bot->SendAction(['chat_id' => $textmassage, 'action' => 'typing']);
                        file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "none");
                    } else {
                        $_T = $text->Sudo("bad_del_admin_isntset", $textmassage);
                        $_K = $bottom->Sudo("cancell", "adm");
                        $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                        $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                    }
                } else {
                    $_T = $text->Sudo("bad_del_admin_numbric", $textmassage);
                    $_K = $bottom->Sudo("cancell", "adm");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                }
            } else if ($sudo_com == "join_set_ch1") {
                $textmassage2 = str_replace('@', '', $textmassage);
                $bot_id = json_decode(file_get_contents('https://api.telegram.org/bot' . $token . '/getMe'))->result->id;
                $check_bot = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=@" . $textmassage2 . "&user_id=" . $bot_id))->result->status;
                if ($check_bot == "administrator") {
                    file_put_contents("data/data/settings/channel_1.txt", $textmassage2);
                    $textmassage3 = '@' . $textmassage2;
                    $_T = $text->Sudo("good_join_set_ch1", $textmassage3);
                    $_K = $bottom->Sudo("back", "join");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                    file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "none");
                } else {
                    $_T = $text->Sudo("bad_join_set_ch1", $textmassage3);
                    $_K = $bottom->Sudo("cancell", "join");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                }
            } else if ($sudo_com == "join_set_ch2") {
                $textmassage2 = str_replace('@', '', $textmassage);
                $bot_id = json_decode(file_get_contents('https://api.telegram.org/bot' . $token . '/getMe'))->result->id;
                $check_bot = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=@" . $textmassage2 . "&user_id=" . $bot_id))->result->status;
                if ($check_bot == "administrator") {
                    file_put_contents("data/data/settings/channel_2.txt", $textmassage2);
                    $textmassage3 = '@' . $textmassage2;
                    $_T = $text->Sudo("good_join_set_ch2", $textmassage3);
                    $_K = $bottom->Sudo("back", "join");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                    file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "none");
                } else {
                    $_T = $text->Sudo("bad_join_set_ch2", $textmassage3);
                    $_K = $bottom->Sudo("cancell", "join");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                }
            } else if ($sudo_com == "stats_delbot") {
                if ($textmassage == "api") {
                    file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "stats_delbot_api");
                    $_T = $text->Sudo("stats_delbot_api");
                    $_K = $bottom->Sudo("cancell", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                } else if ($textmassage == "cli") {
                    file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "stats_delbot_cli");
                    $_T = $text->Sudo("stats_delbot_cli");
                    $_K = $bottom->Sudo("cancell", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                } else {
                    $_T = $text->Sudo("stats_delbot_bad");
                    $_K = $bottom->Sudo("cancell", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                }
            } else if ($sudo_com == "stats_delbot_api") {
                $bot_del_username = str_replace(['@', ' '], '', $textmassage);
                $bot_file = base64_encode($bot_del_username);
                if (is_dir("data/bots/api/" . $bot_file) == true) {
                    $maker = file_get_contents("data/bots/api/" . $bot_file . "/sudo.txt");
                    $token2 = file_get_contents("data/bots/api/" . $bot_file . "/token.txt");
                    $get_me = json_decode(file_get_contents("http://api.telegram.org/bot" . $token2 . "/getme"));
                    $id_bot = $get_me->result->id;
                    $name_bot = $get_me->result->first_name;
                    $user_bot = $get_me->result->username;
                    unlink("data/bots/api/" . $bot_file . "/index.php");
                    unlink("data/bots/api/" . $bot_file . "/sudo.txt");
                    unlink("data/bots/api/" . $bot_file . "/token.txt");
                    @rmdir("data/bots/api/" . $bot_file);
                    $_T = $text->User("sudo_del_your_bot_api", $token2, $bot_file, $user_bot);
                    $_K = $bottom->User("back");
                    $bot->SendText(['chat_id' => $maker, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $maker, 'action' => 'typing']);
                    $_T = $text->Sudo("good_stats_delbot_api", $token2, $bot_file, $user_bot, $id_bot);
                    $_K = $bottom->Sudo("back", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                    $_T = $text->Channel("good_stats_delbot_api", $token2, $bot_file, $user_bot, $id_bot);
                    $_K = $bottom->Channel("goto_bot", $bot_username);
                    $bot->SendText(['chat_id' => $channel_call, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "none");
                } else {
                    $_T = $text->Sudo("bad_stats_delbot_api", $bot_del_username);
                    $_K = $bottom->Sudo("cancell", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                }
            } else if ($sudo_com == "stats_delbot_cli") {
                $filter_num = str_replace([' ', '+'], '', $textmassage);
                $base_num = base64_encode($filter_num);
                $dirct = "data/bots/cli";
                $scan = scandir($dirct);
                $dir_ar = array_diff($scan, ['.', '..']);
                foreach ($dir_ar as $diir) {
                    if (file_exists("data/bots/cli/" . $diir . "/phone.txt") == true) {
                        $phone = file_get_contents("data/bots/cli/" . $diir . "/phone.txt");
                        if ($base_num == $phone) {
                            $maker = file_get_contents("data/bots/cli/" . $diir . "/sudo.txt");
                            $phone_t = file_get_contents("data/bots/cli/" . $diir . "/phone.txt");
                            $id_t = file_get_contents("data/bots/cli/" . $diir . "/id.txt");
                            unlink("data/bots/cli/" . $diir . "/sudo.txt");
                            unlink("data/bots/cli/" . $diir . "/phone.txt");
                            unlink("data/bots/cli/" . $diir . "/id.txt");
                            unlink("data/bots/cli/" . $diir . "/index.php");
                            @rmdir("data/bots/cli/" . $diir);
                            break;
                        }
                    }
                }
                $_T = $text->User("sudo_del_your_bot_cli", $phone);
                $_K = $bottom->User("back");
                $bot->SendText(['chat_id' => $maker, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html']);
                $bot->SendAction(['chat_id' => $maker, 'action' => 'typing']);
                $_T = $text->Sudo("good_stats_delbot_cli", $phone);
                $_K = $bottom->Sudo("back", "stats");
                $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                $_T = $text->Channel("good_stats_delbot_cli", $phone);
                $_K = $bottom->Channel("goto_bot", $bot_username);
                $bot->SendText(['chat_id' => $channel_call, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                file_put_contents("data/data/adm/" . $chat_id . "/com.txt", "none");
            } else if ($sudo_com == "stats_seeinfo") {
                if (is_numeric($textmassage) and strlen((string) $textmassage) >= 8) {
                    $user = explode("\n", file_get_contents("data/data/users/list.txt"));
                    $bans = explode("\n", file_get_contents("data/data/users/bans.txt"));
                    if (!in_array($textmassage, $bans)) {
                        if (in_array($textmassage, $user)) {
                            $_T = $text->Sudo("good_stats_seeinfo", $textmassage);
                            $_K = $bottom->Sudo("back", "stats");
                            $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                            $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                        } else {
                            $_T = $text->Sudo("bas_stats_seeinfo_isset", $phone);
                            $_K = $bottom->Sudo("back", "stats");
                            $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                            $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                        }
                    } else {
                        $_T = $text->Sudo("bas_stats_seeinfo_isban", $phone);
                        $_K = $bottom->Sudo("back", "stats");
                        $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                        $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                    }
                } else {
                    $_T = $text->Sudo("bas_stats_seeinfo_num");
                    $_K = $bottom->Sudo("back", "stats");
                    $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                    $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
                }
            } else if ($sudo_com == "stats_tabbots") {
                $baner = url_encode($textmassage);
                $scan = scandir("data/bots/api");
                $diff = array_diff($scan, ['.', '..']);
                $c = count($diff);
                foreach ($diff as $bot) {
                    file_get_contents("data/bots/api/" . $bot . "/index php?send=all&baner=" . $baner);
                }
                $_T = $text->Sudo("good_stats_tabbots", $c);
                $_K = $bottom->Sudo("back", "stats");
                $bot->SendText(['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'reply_to_message' => $message_id, 'parse_mode' => 'html']);
                $bot->SendAction(['chat_id' => $chat_id, 'action' => 'typing']);
            }
            /*com isnt none*/
        }
    }
    /*chat type*/
}



/*start sudo data*/
if (isset($tcc) and $tcc == "private") {
    /*privat*/
    if ($chatid == $sudo or in_array($chatid, explode("\n", file_get_contents("data/data/adm/list.txt")))) {
        /*is_admin*/
        if (true) {
            if ($data == "simple") {
                $_TQ = $text->Sudo('Qry_simple');
                $bot->AsQ(['callback_query_id' => $membercall, 'text' => $_TQ, 'show_alert' => true]);
            } else {
                $_TQ = $text->Sudo('Qry_loading');
                $bot->AsQ(['callback_query_id' => $membercall, 'text' => $_TQ]);
            }
            /*start data */
            if (preg_match("/^(menu_)(.*)$/", $data)) {
                $check = str_replace("menu_", '', $data);
                if ($check == "setting") {
                    $_T = $text->Sudo("menu_setting");
                    $_K = $bottom->Sudo("menu_setting");
                }
                if ($check == "stats") {
                    $_T = $text->Sudo("menu_stats");
                    $_K = $bottom->Sudo("menu_stats");
                }
                if ($check == "admin") {
                    $_T = $text->Sudo("menu_admin");
                    $_K = $bottom->Sudo("menu_admin");
                }
                $result = ['chat_id' => $chatid, 'message_id' => $messageid, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                $bot->EditMsg($result);
            }


            if (preg_match("/^(setting_menu_)(.*)$/", $data)) {
                $check = str_replace("setting_menu_", '', $data);
                if ($check == "coin") {
                    $_T = $text->Sudo("setting_menu_coin");
                    $_K = $bottom->Sudo("setting_menu_coin");
                }
                if ($check == "join") {
                    $_T = $text->Sudo("setting_menu_join");
                    $_K = $bottom->Sudo("setting_menu_join");
                }
                if ($check == "public") {
                    $_T = $text->Sudo("setting_menu_public");
                    $_K = $bottom->Sudo("setting_menu_public");
                }
                $result = ['chat_id' => $chatid, 'message_id' => $messageid, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                $bot->EditMsg($result);
            }


            if (preg_match("/^(setting_coin_)(.*)$/", $data)) {
                $check = str_replace("setting_coin_", '', $data);
                if ($check == "lockday" and file_get_contents("data/data/settings/Lock_day_coin.txt") == "on") {
                    file_put_contents("data/data/settings/Lock_day_coin.txt", "off");
                } else if ($check == "lockday" and file_get_contents("data/data/settings/Lock_day_coin.txt") == "off") {
                    file_put_contents("data/data/settings/Lock_day_coin.txt", "on");
                }
                if ($check == "lessday" and file_get_contents("data/data/settings/coin_day_count.txt") != "0") {
                    file_put_contents("data/data/settings/coin_day_count.txt", (int) file_get_contents("data/data/settings/coin_day_count.txt") - 1);
                }
                if ($check == "plusday") {
                    file_put_contents("data/data/settings/coin_day_count.txt", (int) file_get_contents("data/data/settings/coin_day_count.txt") + 1);
                }
                if ($check == "lessmget" and file_get_contents("data/data/settings/coin_mget_count.txt") != "0") {
                    file_put_contents("data/data/settings/coin_mget_count.txt", (int) file_get_contents("data/data/settings/coin_mget_count.txt") - 1);
                }
                if ($check == "plusmget") {
                    file_put_contents("data/data/settings/coin_mget_count.txt", (int) file_get_contents("data/data/settings/coin_mget_count.txt") + 1);
                }
                if ($check == "lessapi" and file_get_contents("data/data/settings/coin_api_count.txt") != "0") {
                    file_put_contents("data/data/settings/coin_api_count.txt", (int) file_get_contents("data/data/settings/coin_api_count.txt") - 1);
                }
                if ($check == "plusapi") {
                    file_put_contents("data/data/settings/coin_api_count.txt", (int) file_get_contents("data/data/settings/coin_api_count.txt") + 1);
                }
                if ($check == "lesscli" and file_get_contents("data/data/settings/coin_cli_count.txt") != "0") {
                    file_put_contents("data/data/settings/coin_cli_count.txt", (int) file_get_contents("data/data/settings/coin_cli_count.txt") - 1);
                }
                if ($check == "pluscli") {
                    file_put_contents("data/data/settings/coin_cli_count.txt", (int) file_get_contents("data/data/settings/coin_cli_count.txt") + 1);
                }
                $_T = $text->Sudo("setting_menu_coin");
                $_K = $bottom->Sudo("setting_menu_coin");
                $result = ['chat_id' => $chatid, 'message_id' => $messageid, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                $bot->EditMsg($result);
            }



            if (strpos($data, 'setting_public_') !== false) {
                $check = str_replace("setting_public_", '', $data);
                if ($check == "bot" and file_get_contents("data/data/settings/Lock_bot.txt") == "on") {
                    file_put_contents("data/data/settings/Lock_bot.txt", "off");
                } else if ($check == "bot" and file_get_contents("data/data/settings/Lock_bot.txt") == "off") {
                    file_put_contents("data/data/settings/Lock_bot.txt", "on");
                }
                if ($check == "mkcli" and file_get_contents("data/data/settings/Lock_mk_cli.txt") == "on") {
                    file_put_contents("data/data/settings/Lock_mk_cli.txt", "off");
                } else if ($check == "mkcli" and file_get_contents("data/data/settings/Lock_mk_cli.txt") == "off") {
                    file_put_contents("data/data/settings/Lock_mk_cli.txt", "on");
                }
                if ($check == "mkapi" and file_get_contents("data/data/settings/Lock_mk_api.txt") == "on") {
                    file_put_contents("data/data/settings/Lock_mk_api.txt", "off");
                } else if ($check == "mkapi" and file_get_contents("data/data/settings/Lock_mk_api.txt") == "off") {
                    file_put_contents("data/data/settings/Lock_mk_api.txt", "on");
                }
                if ($check == "delcli" and file_get_contents("data/data/settings/Lock_del_cli.txt") == "on") {
                    file_put_contents("data/data/settings/Lock_del_cli.txt", "off");
                } else if ($check == "delcli" and file_get_contents("data/data/settings/Lock_del_cli.txt") == "off") {
                    file_put_contents("data/data/settings/Lock_del_cli.txt", "on");
                }
                if ($check == "delapi" and file_get_contents("data/data/settings/Lock_del_api.txt") == "on") {
                    file_put_contents("data/data/settings/Lock_del_api.txt", "off");
                } else if ($check == "delapi" and file_get_contents("data/data/settings/Lock_del_api.txt") == "off") {
                    file_put_contents("data/data/settings/Lock_del_api.txt", "on");
                }
                if ($check == "cronjobs" and file_get_contents("data/data/settings/Lock_cron_jobs.txt") == "on") {
                    file_put_contents("data/data/settings/Lock_cron_jobs.txt", "off");
                } else if ($check == "cronjobs" and file_get_contents("data/data/settings/Lock_cron_jobs.txt") == "off") {
                    file_put_contents("data/data/settings/Lock_cron_jobs.txt", "on");
                }
                $_T = $text->Sudo("setting_menu_public");
                $_K = $bottom->Sudo("setting_menu_public");
                $result = ['chat_id' => $chatid, 'message_id' => $messageid, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                $bot->EditMsg($result);
            }


            if (preg_match("/^(join_)(.*)$/", $data)) {
                $check = str_replace("join_", '', $data);
                if ($check == "lock_1" and file_get_contents("data/data/settings/Lock_channel_1.txt") == "on") {
                    file_put_contents("data/data/settings/Lock_channel_1.txt", "off");
                    $_T = $text->Sudo("setting_menu_join");
                    $_K = $bottom->Sudo("setting_menu_join");
                } else if ($check == "lock_1" and file_get_contents("data/data/settings/Lock_channel_1.txt") == "off") {
                    file_put_contents("data/data/settings/Lock_channel_1.txt", "on");
                    $_T = $text->Sudo("setting_menu_join");
                    $_K = $bottom->Sudo("setting_menu_join");
                }
                if ($check == "lock_2" and file_get_contents("data/data/settings/Lock_channel_2.txt") == "on") {
                    file_put_contents("data/data/settings/Lock_channel_2.txt", "off");
                    $_T = $text->Sudo("setting_menu_join");
                    $_K = $bottom->Sudo("setting_menu_join");
                } else if ($check == "lock_2" and file_get_contents("data/data/settings/Lock_channel_2.txt") == "off") {
                    file_put_contents("data/data/settings/Lock_channel_2.txt", "on");
                    $_T = $text->Sudo("setting_menu_join");
                    $_K = $bottom->Sudo("setting_menu_join");
                }
                if ($check == "set_ch1") {
                    file_put_contents("data/data/adm/" . $chatid . "/com.txt", "join_set_ch1");
                    $_T = $text->Sudo("first_join_set_ch1");
                    $_K = $bottom->Sudo("back", "join");
                }
                if ($check == "set_ch2") {
                    file_put_contents("data/data/adm/" . $chatid . "/com.txt", "join_set_ch2");
                    $_T = $text->Sudo("first_join_set_ch2");
                    $_K = $bottom->Sudo("back", "join");
                }
                $result = ['chat_id' => $chatid, 'message_id' => $messageid, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                $bot->EditMsg($result);
            }


            if (preg_match("/^(stats_)(.*)$/", $data)) {
                $check = str_replace("stats_", '', $data);
                if ($check == "send") {
                    file_put_contents("data/data/adm/" . $chatid . "/com.txt", "stats_send");
                    $_T = $text->Sudo("first_stats_send");
                    $_K = $bottom->Sudo("back", "stats");
                }
                if ($check == "forward") {
                    file_put_contents("data/data/adm/" . $chatid . "/com.txt", "stats_forward");
                    $_T = $text->Sudo("first_stats_forward");
                    $_K = $bottom->Sudo("back", "stats");
                }
                if ($check == "seeinfo") {
                    file_put_contents("data/data/adm/" . $chatid . "/com.txt", "stats_seeinfo");
                    $_T = $text->Sudo("first_stats_seeinfo");
                    $_K = $bottom->Sudo("back", "stats");
                }
                if ($check == "unban") {
                    file_put_contents("data/data/adm/" . $chatid . "/com.txt", "stats_unban");
                    $_T = $text->Sudo("first_stats_unban");
                    $_K = $bottom->Sudo("back", "stats");
                }
                if ($check == "ban") {
                    file_put_contents("data/data/adm/" . $chatid . "/com.txt", "stats_ban");
                    $_T = $text->Sudo("first_stats_ban");
                    $_K = $bottom->Sudo("back", "stats");
                }
                if ($check == "coinone") {
                    file_put_contents("data/data/adm/" . $chatid . "/com.txt", "stats_coinone");
                    $_T = $text->Sudo("first_stats_coinone");
                    $_K = $bottom->Sudo("back", "stats");
                }
                if ($check == "coinall") {
                    file_put_contents("data/data/adm/" . $chatid . "/com.txt", "stats_coinall");
                    $_T = $text->Sudo("first_stats_coinall");
                    $_K = $bottom->Sudo("back", "stats");
                }
                if ($check == "card") {
                    file_put_contents("data/data/adm/" . $chatid . "/com.txt", "stats_card");
                    $_T = $text->Sudo("first_stats_card");
                    $_K = $bottom->Sudo("back", "stats");
                }
                if ($check == "coinless") {
                    file_put_contents("data/data/adm/" . $chatid . "/com.txt", "stats_coinless");
                    $_T = $text->Sudo("first_stats_coinless");
                    $_K = $bottom->Sudo("back", "stats");
                }
                if ($check == "tabbots") {
                    file_put_contents("data/data/adm/" . $chatid . "/com.txt", "stats_tabbots");
                    $_T = $text->Sudo("first_stats_tabbots");
                    $_K = $bottom->Sudo("back", "stats");
                }
                if ($check == "delbot") {
                    file_put_contents("data/data/adm/" . $chatid . "/com.txt", "stats_delbot");
                    $_T = $text->Sudo("first_stats_delbot");
                    $_K = $bottom->Sudo("back", "stats");
                }
                if ($check == "listmaker") {
                    $_T = $text->Sudo("stats_listmaker");
                    $_K = $bottom->Sudo("back", "stats");
                }
                if ($check == "user") {
                    $_T = $text->Sudo("stats_user");
                    $_K = $bottom->Sudo("back", "stats");
                }
                if ($check == "stats") {
                    $_T = $text->Sudo("stats_stats");
                    $_K = $bottom->Sudo("back", "stats");
                }
                $result = ['chat_id' => $chatid, 'message_id' => $messageid, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                $bot->EditMsg($result);
            }


            if (preg_match("/^(admin_)(.*)$/", $data)) {
                $check = str_replace("admin_", '', $data);
                if ($check == "del") {
                    file_put_contents("data/data/adm/" . $chatid . "/com.txt", "admin_del");
                    $_T = $text->Sudo("first_del_admin");
                    $_K = $bottom->Sudo("back", "stats");
                }
                if ($check == "add") {
                    file_put_contents("data/data/adm/" . $chatid . "/com.txt", "admin_add");
                    $_T = $text->Sudo("first_add_admin");
                    $_K = $bottom->Sudo("back", "stats");
                }
                if ($check == "setting") {
                    $_T = $text->Sudo("admin_setting_list");
                    $_K = $bottom->Sudo("admin_setting_list");
                }
                if ($check == "list") {
                    $_T = $text->Sudo("admin_list");
                    $_K = $bottom->Sudo("back", "stats");
                }
                $result = ['chat_id' => $chatid, 'message_id' => $messageid, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                $bot->EditMsg($result);
            }


            if (preg_match("/^(adm_)(.*)$/", $data)) {
                $ex = explode('_', $data);
                $check = trim($ex[1]);
                $admin = trim($ex[2]);
                if ($check == "setting" and file_get_contents("data/data/adm/" . $admin . "/adm_setting.txt") == "on") {
                    file_put_contents("data/data/adm/" . $admin . "/adm_setting.txt", "off");
                } else if ($check == "setting" and file_get_contents("data/data/adm/" . $admin . "/adm_setting.txt") == "off") {
                    file_put_contents("data/data/adm/" . $admin . "/adm_setting.txt", "on");
                }
                if ($check == "stats" and file_get_contents("data/data/adm/" . $admin . "/adm_stats.txt") == "on") {
                    file_put_contents("data/data/adm/" . $admin . "/adm_stats.txt", "off");
                } else if ($check == "stats" and file_get_contents("data/data/adm/" . $admin . "/adm_stats.txt") == "off") {
                    file_put_contents("data/data/adm/" . $admin . "/adm_stats.txt", "on");
                }
                if ($check == "ban" and file_get_contents("data/data/adm/" . $admin . "/adm_ban.txt") == "on") {
                    file_put_contents("data/data/adm/" . $admin . "/adm_ban.txt", "off");
                } else if ($check == "ban" and file_get_contents("data/data/adm/" . $admin . "/adm_ban.txt") == "off") {
                    file_put_contents("data/data/adm/" . $admin . "/adm_ban.txt", "on");
                }
                if ($check == "unban" and file_get_contents("data/data/adm/" . $admin . "/adm_unban.txt") == "on") {
                    file_put_contents("data/data/adm/" . $admin . "/adm_unban.txt", "off");
                } else if ($check == "unban" and file_get_contents("data/data/adm/" . $admin . "/adm_unban.txt") == "off") {
                    file_put_contents("data/data/adm/" . $admin . "/adm_unban.txt", "on");
                }
                if ($check == "tab" and file_get_contents("data/data/adm/" . $admin . "/adm_tab.txt") == "on") {
                    file_put_contents("data/data/adm/" . $admin . "/adm_tab.txt", "off");
                } else if ($check == "tab" and file_get_contents("data/data/adm/" . $admin . "/adm_tab.txt") == "off") {
                    file_put_contents("data/data/adm/" . $admin . "/adm_tab.txt", "on");
                }
                if ($check == "coin" and file_get_contents("data/data/adm/" . $admin . "/adm_coin.txt") == "on") {
                    file_put_contents("data/data/adm/" . $admin . "/adm_tab.txt", "off");
                } else  if ($check == "coin" and file_get_contents("data/data/adm/" . $admin . "/adm_coin.txt") == "off") {
                    file_put_contents("data/data/adm/" . $admin . "/adm_tab.txt", "on");
                }
                if ($check == "adm" and file_get_contents("data/data/adm/" . $admin . "/adm_adm.txt") == "on") {
                    file_put_contents("data/data/adm/" . $admin . "/adm_adm.txt", "off");
                } else if ($check == "adm" and file_get_contents("data/data/adm/" . $admin . "/adm_adm.txt") == "off") {
                    file_put_contents("data/data/adm/" . $admin . "/adm_adm.txt", "on");
                }
                $_T = $text->Sudo("admin_setting_once");
                $_K = $bottom->Sudo("admin_setting_once", "$admin");
                $result = ['chat_id' => $chatid, 'message_id' => $messageid, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                $bot->EditMsg($result);
            }


            if (preg_match("/^(adm-)(.*)$/", $data)) {
                $admin = str_replace("adm-", '', $data);
                $_T = $text->Sudo("admin_setting_once");
                $_K = $bottom->Sudo("admin_setting_once", "$admin");
                $result = ['chat_id' => $chatid, 'message_id' => $messageid, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                $bot->EditMsg($result);
            }


            if (preg_match("/^(back_)(.*)$/", $data)) {
                $check = str_replace("back_", '', $data);
                @file_put_contents("data/data/adm/" . $chatid . "/com.txt", "none");
                if ($check == "stats") {
                    $_T = $text->Sudo("menu_stats");
                    $_K = $bottom->Sudo("menu_stats");
                }
                if ($check == "join") {
                    $_T = $text->Sudo("setting_menu_join");
                    $_K = $bottom->Sudo("setting_menu_join");
                }
                if ($check == "adm") {
                    $_T = $text->Sudo("menu_admin");
                    $_K = $bottom->Sudo("menu_admin");
                }
                $result = ['chat_id' => $chatid, 'message_id' => $messageid, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                $bot->EditMsg($result);
            }


            if ($data == "home") {
                $_T = $text->Sudo("start");
                $_K = $bottom->Sudo("start");
                $result = ['chat_id' => $chatid, 'message_id' => $messageid, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                $bot->EditMsg($result);
            }




            /*start data*/
        } else {
            $_TQ = $text->Sudo('Qry_cant');
            $bot->AsQ(['callback_query_id' => $membercall, 'text' => $_TQ, 'show_alert' => true]);
        }
        /*is_admin*/
    }

    /*privat*/
}

function Lock_Ch($chat_id, $token, $sup)
{
    $bot_id = json_decode(file_get_contents('https://api.telegram.org/bot' . $token . '/getMe'))->result->id;
    if (file_get_contents("data/data/settings/Lock_channel_1.txt") == "on" and json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=@" . str_replace("@", '', file_get_contents("data/data/settings/channel_1.txt")) . "&user_id=" . $chat_id))->result->status == "administrator") {
        $ch1 = str_replace("@", '', file_get_contents("data/data/settings/channel_1.txt"));
        $check1 = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=@" . $ch1 . "&user_id=" . $chat_id));
        if ($check1->result->status == "administrator" or $check1->result->status == "creator" or $check1->result->status == "member") {
            $ch_1 = true;
        } else {
            $ch_1 = false;
        }
    } else {
        $ch_1 = true;
    }
    if (file_get_contents("data/data/settings/Lock_channel_2.txt") == "on" and json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=@" . str_replace("@", '', file_get_contents("data/data/settings/channel_2.txt")) . "&user_id=" . $chat_id))->result->status == "administrator") {
        $ch2 = str_replace("@", '', file_get_contents("data/data/settings/channel_2.txt"));
        $check2 = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=@" . $ch2 . "&user_id=" . $chat_id));
        if ($check2->result->status == "administrator" or $check2->result->status == "creator" or $check2->result->status == "member") {
            $ch_2 = true;
        } else {
            $ch_2 = false;
        }
    } else {
        $ch_2 = true;
    }
    $ch3 = str_replace("@", '', $sup);
    $check3 = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getChatMember?chat_id=@" . $ch3 . "&user_id=" . $chat_id));
    if ($check3->result->status == "administrator" or $check3->result->status == "creator" or $check3->result->status == "member") {
        $ch_3 = true;
    } else {
        $ch_3 = false;
    }

    if ($ch_1 == true and $ch_2 == true and $ch_3 == true) {
        return true;
    } else {
        return false;
    }
}


if ($tc == "private" and file_get_contents("data/data/settings/Lock_bot.txt") == "on") {
    /*private*/
    if ($chat_id != $sudo and !in_array($chat_id, explode("\n", file_get_contents("data/data/adm/list.txt"))) and !in_array($chat_id, explode("\n", file_get_contents("data/data/users/ban.txt")))) {
        if (!in_array($chat_id, explode("\n", file_get_contents("data/data/users/list.txt")))) {
            if (strpos($textmassage, '/start ') !== false) {
                $inv_id = str_replace('/start ', '', $textmassage);
                if (is_numeric($inv_id) and $inv_id != $chat_id) {
                    if (in_array($inv_id, explode("\n", file_get_contents("data/data/users/list.txt"))) and !in_array($inv_id, explode("\n", file_get_contents("data/data/users/ban.txt")))) {
                        $coin_inv = (int) file_get_contents("data/data/users/" . $inv_id . "/coins.txt");
                        $h_coin_plus = (int) file_get_contents("data/data/settings/coin_mget_count.txt");
                        $coins_now = $coin_inv + $h_coin_plus;
                        file_put_contents("data/data/users/" . $inv_id . "/coins.txt", $coins_now);
                        $_T = $text->User("mget_coin", $chat_id, $h_coin_plus, $coins_now);
                        $result = ['chat_id' => $inv_id, 'text' => $_T, 'parse_mode' => 'html'];
                        $bot->SendText($result);
                    }
                    $users_file = file_get_contents("data/data/users/list.txt");
                    $users_ex = explode("\n", $users_file);
                    if (!in_array($chat_id, $users_ex)) {
                        $users_file .= "\n" . $chat_id;
                        file_put_contents("data/data/users/list.txt", $users_file);
                    }
                    if (is_dir("data/data/users/" . $chat_id) == false) {
                        mkdir("data/data/users/" . $chat_id);
                    }
                    if (is_dir("data/data/users/" . $chat_id . "/bots") == false) {
                        mkdir("data/data/users/" . $chat_id . "/bots");
                        mkdir("data/data/users/" . $chat_id . "/bots/api");
                        mkdir("data/data/users/" . $chat_id . "/bots/cli");
                    }
                    if (file_exists("data/data/users/" . $chat_id . "/com.txt") == false) {
                        file_put_contents("data/data/users/" . $chat_id . "/com.txt", "none");
                    }
                    if (file_exists("data/data/users/" . $chat_id . "/coins.txt") == false) {
                        $coin_join = file_get_contents("data/data/settings/coin_day_count.txt");
                        file_put_contents("data/data/users/" . $chat_id . "/coins.txt", "$coin_join");
                    }
                    if (file_exists("data/data/users/" . $chat_id . "/type.txt") == false) {
                        file_put_contents("data/data/users/" . $chat_id . "/type.txt", "start");
                    }
                    $bot_name = json_decode(file_get_contents('https://api.telegram.org/bot' . $token . '/getMe'))->result->first_name;
                    $bot_id = json_decode(file_get_contents('https://api.telegram.org/bot' . $token . '/getMe'))->result->id;
                    $_T = $text->User("start_first", $chat_id, $bot_id, $bot_name);
                    $_K = $bottom->User("start");
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                }
                if (!is_numeric($inv_id) or $chat_id == $inv_id) {

                    $users_file = file_get_contents("data/data/users/list.txt");
                    $users_ex = explode("\n", $users_file);
                    if (!in_array($chat_id, $users_ex)) {
                        $users_file .= "\n" . $chat_id;
                        file_put_contents("data/data/users/list.txt", $users_file);
                    }
                    if (is_dir("data/data/users/" . $chat_id) == false) {
                        mkdir("data/data/users/" . $chat_id);
                    }
                    if (is_dir("data/data/users/" . $chat_id . "/bots") == false) {
                        mkdir("data/data/users/" . $chat_id . "/bots");
                        mkdir("data/data/users/" . $chat_id . "/bots/api");
                        mkdir("data/data/users/" . $chat_id . "/bots/cli");
                    }
                    if (file_exists("data/data/users/" . $chat_id . "/com.txt") == false) {
                        file_put_contents("data/data/users/" . $chat_id . "/com.txt", "none");
                    }
                    if (file_exists("data/data/users/" . $chat_id . "/coins.txt") == false) {
                        $coin_join = file_get_contents("data/data/settings/coin_day_count.txt");
                        file_put_contents("data/data/users/" . $chat_id . "/coins.txt", "$coin_join");
                    }
                    if (file_exists("data/data/users/" . $chat_id . "/type.txt") == false) {
                        file_put_contents("data/data/users/" . $chat_id . "/type.txt", "start");
                    }
                    $bot_name = json_decode(file_get_contents('https://api.telegram.org/bot' . $token . '/getMe'))->result->first_name;
                    $bot_id = json_decode(file_get_contents('https://api.telegram.org/bot' . $token . '/getMe'))->result->id;
                    $_T = $text->User("start_first", $chat_id, $bot_id, $bot_name);
                    $_K = $bottom->User("start");
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                }
            }
            if ($textmassage == "/start") {

                $users_file = file_get_contents("data/data/users/list.txt");
                $users_ex = explode("\n", $users_file);
                if (!in_array($chat_id, $users_ex)) {
                    $users_file .= "\n" . $chat_id;
                    file_put_contents("data/data/users/list.txt", $users_file);
                }
                if (is_dir("data/data/users/" . $chat_id) == false) {
                    mkdir("data/data/users/" . $chat_id);
                }
                if (is_dir("data/data/users/" . $chat_id . "/bots") == false) {
                    mkdir("data/data/users/" . $chat_id . "/bots");
                    mkdir("data/data/users/" . $chat_id . "/bots/api");
                    mkdir("data/data/users/" . $chat_id . "/bots/cli");
                }
                if (file_exists("data/data/users/" . $chat_id . "/com.txt") == false) {
                    file_put_contents("data/data/users/" . $chat_id . "/com.txt", "none");
                }
                if (file_exists("data/data/users/" . $chat_id . "/coins.txt") == false) {
                    $coin_join = file_get_contents("data/data/settings/coin_day_count.txt");
                    file_put_contents("data/data/users/" . $chat_id . "/coins.txt", "$coin_join");
                }
                if (file_exists("data/data/users/" . $chat_id . "/type.txt") == false) {
                    file_put_contents("data/data/users/" . $chat_id . "/type.txt", "start");
                }
                $bot_name = json_decode(file_get_contents('https://api.telegram.org/bot' . $token . '/getMe'))->result->first_name;
                $bot_id = json_decode(file_get_contents('https://api.telegram.org/bot' . $token . '/getMe'))->result->id;
                $_T = $text->User("start_first", $chat_id, $bot_id, $bot_name);
                $_K = $bottom->User("start");
                $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                $bot->SendText($result);
            }
        }
        if (in_array($chat_id, explode("\n", file_get_contents("data/data/users/list.txt"))) and Lock_Ch($chat_id, $token, $channel_user) == true) {

            /*user panel start*/
            $user_com = file_get_contents("data/data/users/" . $chat_id . "/com.txt");
            if ($user_com == "none") {
                /*user com start none*/
                $ar_s = ['start', '/start', 'panel', '/panel', 'Start', 'پنل', 'مدیریت'];
                if (in_array($textmassage, $ar_s)) {
                    @file_put_contents("data/data/users/" . $chat_id . "/type.txt", "start");
                    $_T = $text->User("start", $chat_id, $bot_id, $bot_name);
                    $_K = $bottom->User("start");
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                }

                if ($textmassage == "🕳بازگشت🕳") {
                    $user_type = file_get_contents("data/data/users/" . $chat_id . "/type.txt", "show");
                    if ($user_type == "show" or $user_type == "make_menu" or $user_type == "delete_menu" or $user_type == "coin_menu" or $user_type == "help_menu" or $user_type == "info") {
                        @file_put_contents("data/data/users/" . $chat_id . "/type.txt", "start");
                        $_T = $text->User("start", $chat_id, $bot_id, $bot_name);
                        $_K = $bottom->User("start");
                        $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                        $bot->SendText($result);
                    }

                    if ($user_type == "card") {
                        $_T = $text->User("coin", $chat_id);
                        $_K = $bottom->User("coin");
                        $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                        $bot->SendText($result);
                        file_put_contents("data/data/users/" . $chat_id . "/type.txt", "coin_menu");
                    }

                    if ($user_type == "info_api" or $user_type == "info_cli") {
                        $_T = $text->User("info", $chat_id);
                        $_K = $bottom->User("stats");
                        $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                        $bot->SendText($result);
                        file_put_contents("data/data/users/" . $chat_id . "/type.txt", "info");
                    }
                }



                if ($textmassage == "🎞 پیش نمایش") {
                    $_T = $text->User("show", $chat_id);
                    $_K = $bottom->User("show");
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                    file_put_contents("data/data/users/" . $chat_id . "/type.txt", "show");
                }

                if ($textmassage == "🚜 ساخت ربات") {
                    $_T = $text->User("make", $chat_id);
                    $_K = $bottom->User("make");
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                    file_put_contents("data/data/users/" . $chat_id . "/type.txt", "make_menu");
                }

                if ($textmassage == "♨️ حذف ربات") {
                    $_T = $text->User("delete", $chat_id);
                    $_K = $bottom->User("delete");
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                    file_put_contents("data/data/users/" . $chat_id . "/type.txt", "delete_menu");
                }

                if ($textmassage == "🛍 سکه رایگان") {
                    $_T = $text->User("coin", $chat_id);
                    $_K = $bottom->User("coin");
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                    file_put_contents("data/data/users/" . $chat_id . "/type.txt", "coin_menu");
                }

                if ($textmassage == "💰 خرید سکه 💰") {
                    $_T = $text->User("buy", $chat_id);
                    $_K = $bottom->User("buy", $sudo_username);
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                }

                if ($textmassage == "🎈 زیرمجموعه") {
                    $bot_username = json_decode(file_get_contents('https://api.telegram.org/bot' . $token . '/getMe'))->result->username;
                    $_TT = $text->User("baner", $chat_id, $bot_username);
                    $result = ['chat_id' => $chat_id, 'text' => $_TT, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                    $_T = $text->User("mgeting", $chat_id);
                    $_K = $bottom->User("coin");
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                }

                if ($textmassage == "🎁 کد هدیه") {
                    $_T = $text->User("card", $chat_id);
                    $_K = $bottom->User("back");
                    file_put_contents("data/data/users/" . $chat_id . "/type.txt", "card");
                    file_put_contents("data/data/users/" . $chat_id . "/com.txt", "card");
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                }




                if ($textmassage == "📩راهنما و پشتیبانی") {
                    $_T = $text->User("help", $chat_id);
                    $_K = $bottom->User("help", $sudo_username);
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                    $_TT = "〰〰〰〰〰〰〰〰〰";
                    $_K = $bottom->User("back");
                    $result = ['chat_id' => $chat_id, 'text' => $_TT, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                    file_put_contents("data/data/users/" . $chat_id . "/type.txt", "help_menu");
                }

                if ($textmassage == "🎥 تبچی API") {
                    $_T = $text->User("show_api", $chat_id);
                    $_K = $bottom->User("show");
                    $result = ['chat_id' => $chat_id, 'document' => "CgADBAADQQUAAiLx6VE3ErzZBlZ5zRYE", 'caption' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendDoc($result);
                }

                if ($textmassage == "🎥 تبچی CLI") {
                    $_T = $text->User("show_cli", $chat_id);
                    $_K = $bottom->User("show");
                    $result = ['chat_id' => $chat_id, 'video' => "BAADBAADQwUAAiLx6VHrmil9NUCleBYE", 'caption' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendVideo($result);
                }



                if ($textmassage == "🧬 تبچی API") {
                    $_T = $text->User("make_api", $chat_id);
                    $_K = $bottom->User("back");
                    file_put_contents("data/data/users/" . $chat_id . "/type.txt", "make_api");
                    file_put_contents("data/data/users/" . $chat_id . "/com.txt", "make_api");
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                }

                if ($textmassage == "🧬 تبچی CLI") {
                    $_T = $text->User("make_cli", $chat_id);
                    $_K = $bottom->User("back");
                    file_put_contents("data/data/users/" . $chat_id . "/type.txt", "make_cli");
                    file_put_contents("data/data/users/" . $chat_id . "/com.txt", "make_cli");
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                }


                if ($textmassage == "♨️ تبچی API") {
                    $_T = $text->User("delete_api", $chat_id);
                    $_K = $bottom->User("back");
                    file_put_contents("data/data/users/" . $chat_id . "/type.txt", "delete_api");
                    file_put_contents("data/data/users/" . $chat_id . "/com.txt", "delete_api");
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                }

                if ($textmassage == "♨️ تبچی CLI") {
                    $_T = $text->User("delete_cli", $chat_id);
                    $_K = $bottom->User("back");
                    file_put_contents("data/data/users/" . $chat_id . "/type.txt", "delete_cli");
                    file_put_contents("data/data/users/" . $chat_id . "/com.txt", "delete_cli");
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                }

                if ($textmassage == "👤حساب کاربری") {
                    $_T = $text->User("info", $chat_id);
                    $_K = $bottom->User("stats");
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                    file_put_contents("data/data/users/" . $chat_id . "/type.txt", "info");
                }

                if ($textmassage == "📅ربات های API") {
                    $_T = $text->User("info_api", $chat_id);
                    $_K = $bottom->User("back");
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                    file_put_contents("data/data/users/" . $chat_id . "/type.txt", "info_api");
                }

                if ($textmassage == "📆ربات های CLI") {
                    $_T = $text->User("info_cli", $chat_id);
                    $_K = $bottom->User("back");
                    $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                    $bot->SendText($result);
                    file_put_contents("data/data/users/" . $chat_id . "/type.txt", "info_cli");
                }


                /*user com finish none*/
            } else {
                /*user job start*/
                if ($user_com == "make_api" and $textmassage != "🕳بازگشت🕳") {
                    if (file_get_contents("data/data/settings/Lock_mk_api.txt") == "on") {
                        $user_coin = (int) file_get_contents("data/data/users/" . $chat_id . "/coins.txt");
                        $api_coin = (int) file_get_contents("data/data/settings/coin_api_count.txt");
                        if ($user_coin >= $api_coin) {
                            $filter_token = str_replace(" ", '', $textmassage);
                            $check_token = json_decode(file_get_contents('https://api.telegram.org/bot' . $filter_token . '/getMe'));
                            if ($check_token->ok == true or $check_token->ok == "true") {
                                $token_username = $check_token->result->username;
                                if (is_dir("data/bots/api/" . $token_username) == false) {
                                    file_get_contents("data/data/users/" . $chat_id . "/com.txt", "none");
                                    @mkdir("data/bots/api/" . base64_encode($token_username));
                                    $index_api = file_get_contents("source/api/index.php");
                                    file_put_contents("data/bots/api/" . base64_encode($token_username) . "/index.php", $index_api);
                                    file_put_contents("data/bots/api/" . base64_encode($token_username) . "/sudo.txt", $chat_id);
                                    file_put_contents("data/bots/api/" . base64_encode($token_username) . "/token.txt", $filter_token);
                                    copy("source/jdf.php", "data/bots/api/" . base64_encode($token_username) . "/jdf.php");
                                    file_get_contents("https://api.telegram.org/bot" . $filter_token . "/setwebhook?url=" . $host_url . "/" . $path_url . "/data/bots/api/" . base64_encode($token_username) . "/index.php");
                                    if (is_dir("data/data/users/" . $chat_id . "/bots/api/" . $token_username) == false) {
                                        @mkdir("data/data/users/" . $chat_id . "/bots/api/" . $token_username);
                                    }
                                    $makers_file = file_get_contents("data/data/users/makers.txt");
                                    if (!in_array($chat_id, explode("\n", $makers_file))) {
                                        $makers_file .= "\n" . $chat_id;
                                        file_put_contents("data/data/users/makers.txt", $makers_file);
                                    }
                                    file_put_contents("data/data/users/" . $chat_id . "/bots/api/" . $token_username . "/token.txt", $filter_token);
                                    file_put_contents("data/data/users/" . $chat_id . "/bots/api/" . $token_username . "/sudo.txt", $chat_id);
                                    file_put_contents("data/data/users/" . $chat_id . "/bots/api/" . $token_username . "/date.txt", date("y/m/d--h:i:s"));
                                    file_put_contents("data/data/users/" . $chat_id . "/coins.txt", $user_coin - $api_coin);
                                    $_T = $text->User("maked_api", $chat_id, $token_username, file_get_contents("data/data/users/" . $chat_id . "/coins.txt"), $api_coin);
                                    $_K = $bottom->User("back");
                                    $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                                    $bot->SendText($result_user);
                                    $_TT = $text->Channel("maked_api", $chat_id, $token_username, file_get_contents("data/data/users/" . $chat_id . "/coins.txt"), $api_coin);
                                    $_KK = $bottom->Channel("goto_bot", $bot_username);
                                    $result_channel = ['chat_id' => $channel_call, 'text' => $_TT, 'reply_markup' => $_KK, 'parse_mode' => 'html'];
                                    $bot->SendText($result_channel);
                                } else {
                                    $_T = $text->User("make_api_isset", $chat_id, $token_username);
                                    $_K = $bottom->User("back");
                                    $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                                    $bot->SendText($result_user);
                                }
                            } else {
                                $_T = $text->User("make_api_false_token", $chat_id, $filter_token);
                                $_K = $bottom->User("back");
                                $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                                $bot->SendText($result_user);
                            }
                        } else {
                            $_T = $text->User("make_api_false_coin", $chat_id, $user_coin, $api_coin);
                            $_K = $bottom->User("back");
                            $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                            $bot->SendText($result_user);
                        }
                    } else {
                        $_T = $text->User("make_api_off", $chat_id);
                        $_K = $bottom->User("back");
                        $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                        $bot->SendText($result_user);
                    }
                }



                if ($user_com == "make_cli" and $textmassage != "🕳بازگشت🕳") {
                    if (file_get_contents("data/data/settings/Lock_mk_cli.txt") == "on") {
                        $user_coin = (int) file_get_contents("data/data/users/" . $chat_id . "/coins.txt");
                        $cli_coin = (int) file_get_contents("data/data/settings/coin_cli_count.txt");
                        if ($user_coin >= $cli_coin) {
                            $filter_phone = str_replace([" ", "+"], '', $textmassage);
                            if (is_numeric($filter_phone)) {
                                if (is_dir("data/bots/cli/" . base64_encode($filter_phone)) == false) {
                                    file_get_contents("data/data/users/" . $chat_id . "/com.txt", "none");
                                    $encode_phone = base64_encode($filter_phone);
                                    @mkdir("data/bots/cli/" . $encode_phone);
                                    $index_cli = file_get_contents("source/cli/index.php");
                                    file_put_contents("data/bots/cli/" . $encode_phone . "/index.php", $index_cli);
                                    file_put_contents("data/bots/cli/" . $encode_phone . "/sudo.txt", $chat_id);
                                    file_put_contents("data/bots/cli/" . $encode_phone . "/url.txt", $host_url . "/" . $path_url);
                                    file_put_contents("data/bots/cli/" . $encode_phone . "/botsaz.txt", "@" . $bot_username);
                                    if (is_dir("data/data/users/bots/cli/" . $filter_phone) == false) {
                                        @mkdir("data/data/users/bots/cli/" . $filter_phone);
                                    }
                                    $makers_file = file_get_contents("data/data/users/makers.txt");
                                    if (!in_array($chat_id, explode("\n", $makers_file))) {
                                        $makers_file .= "\n" . $chat_id;
                                        file_put_contents("data/data/users/makers.txt", $makers_file);
                                    }
                                    file_put_contents("data/data/users/" . $chat_id . "/bots/cli/" . $filter_phone . "/sudo.txt", $chat_id);
                                    file_put_contents("data/data/users/" . $chat_id . "/bots/cli/" . $filter_phone . "/date.txt", date("y/m/d--h:i:s"));
                                    file_put_contents("data/data/users/" . $chat_id . "/coins.txt", $user_coin - $cli_coin);
                                    $_T = $text->User("maked_cli", $chat_id, $filter_phone, file_get_contents("data/data/users/" . $chat_id . "/coins.txt"), $cli_coin);
                                    $_K = $bottom->User("login_cli", $encode_phone, $host_url, $path_url);
                                    $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                                    $bot->SendText($result_user);
                                    $_TT = $text->Channel("maked_cli", $chat_id, $filter_phone, file_get_contents("data/data/users/" . $chat_id . "/coins.txt"), $cli_coin);
                                    $_KK = $bottom->Channel("goto_bot", $bot_username);
                                    $result_channel = ['chat_id' => $channel_call, 'text' => $_TT, 'reply_markup' => $_KK, 'parse_mode' => 'html'];
                                    $bot->SendText($result_channel);
                                } else {
                                    $_T = $text->User("make_cli_isset", $chat_id, $filter_phone);
                                    $_K = $bottom->User("back");
                                    $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                                    $bot->SendText($result_user);
                                }
                            } else {
                                $_T = $text->User("make_cli_false_phone", $chat_id, $filter_phone);
                                $_K = $bottom->User("back");
                                $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                                $bot->SendText($result_user);
                            }
                        } else {
                            $_T = $text->User("make_cli_false_coin", $chat_id, $user_coin, $cli_coin);
                            $_K = $bottom->User("back");
                            $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                            $bot->SendText($result_user);
                        }
                    } else {
                        $_T = $text->User("make_cli_off", $chat_id);
                        $_K = $bottom->User("back");
                        $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                        $bot->SendText($result_user);
                    }
                }



                if ($user_com == "delete_api" and $textmassage != "🕳بازگشت🕳") {
                    if (file_get_contents("data/data/settings/Lock_del_api.txt") == "on") {
                        $filter_username = str_replace(["@", " "], '', $textmassage);
                        $encode_username = base64_encode($filter_username);
                        if (is_dir("data/bots/api/" . $encode_username) != false) {
                            $maker_bot = file_get_contents("data/bots/api/" . $encode_username . "/sudo.txt");
                            if ($maker_bot == $chat_id) {
                                file_get_contents("data/data/users/" . $chat_id . "/com.txt", "none");
                                unlink("data/bots/api/" . $encode_username . "/index.php");
                                unlink("data/bots/api/" . $encode_username . "/sudo.txt");
                                unlink("data/bots/api/" . $encode_username . "/token.txt");
                                rmdir("data/bots/api/" . $encode_username);
                                if (is_dir("data/data/users/" . $chat_id . "/bots/api/" . $filter_username) == true) {
                                    unlink("data/data/users/" . $chat_id . "/bots/api/" . $filter_username . "/token.txt");
                                    @unlink("data/data/users/" . $chat_id . "/bots/api/" . $filter_username . "/sudo.txt");
                                    unlink("data/data/users/" . $chat_id . "/bots/api/" . $filter_username . "/date.txt");
                                    rmdir("data/data/users/" . $chat_id . "/bots/api/" . $filter_username);
                                }
                                $_T = $text->User("deleted_api", $chat_id, $filter_username);
                                $_K = $bottom->User("back");
                                $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                                $bot->SendText($result_user);
                                $_TT = $text->Channel("deleted_api", $chat_id, $filter_username);
                                $_KK = $bottom->Channel("goto_bot", $bot_username);
                                $result_channel = ['chat_id' => $channel_call, 'text' => $_TT, 'reply_markup' => $_KK, 'parse_mode' => 'html'];
                                $bot->SendText($result_channel);
                            } else {
                                $_T = $text->User("delete_api_false_sudo", $chat_id);
                                $_K = $bottom->User("back");
                                $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                                $bot->SendText($result_user);
                            }
                        } else {
                            $_T = $text->User("delete_api_false_isset", $chat_id);
                            $_K = $bottom->User("back");
                            $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                            $bot->SendText($result_user);
                        }
                    } else {
                        $_T = $text->User("delete_api_off", $chat_id);
                        $_K = $bottom->User("back");
                        $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                        $bot->SendText($result_user);
                    }
                }



                if ($user_com == "delete_cli" and $textmassage != "🕳بازگشت🕳") {
                    if (file_get_contents("data/data/settings/Lock_del_cli.txt") == "on") {
                        $filter_phone = str_replace(["+", " "], '', $textmassage);
                        $encode_phone = base64_encode($filter_phone);
                        if (is_dir("data/bots/cli/" . $encode_phone) == true) {
                            $maker_cli = file_get_contents("data/bots/cli/" . $encode_phone . "/sudo.txt");
                            if ($maker_cli == $chat_id) {
                                file_get_contents("data/data/users/" . $chat_id . "/com.txt", "none");
                                $scan = scandir("data/bots/cli/" . $encode_phone);
                                $diff = array_diff($scan, ['.', '..']);
                                foreach ($diff as $dir) {
                                    if (is_dir("data/bots/cli/" . $encode_phone . "/" . $dir) == true) {
                                        $scan2 = scandir("data/bots/cli/" . $encode_phone);
                                        $diff2 = array_diff($scan, ['.', '..']);
                                        foreach ($diff2 as $dir2) {
                                            if (is_dir("data/bots/cli/" . $encode_phone . "/" . $dir . "/" . $dir2) == true) {
                                            } else if (file_exists("data/bots/cli/" . $encode_phone . "/" . $dir . "/" . $dir2) == true) {
                                                unlink("data/bots/cli/" . $encode_phone . "/" . $dir . "/" . $dir2);
                                            }
                                        }
                                    } else if (file_exists("data/bots/cli/" . $encode_phone . "/" . $dir) == true) {
                                        unlink("data/bots/cli/" . $encode_phone . "/" . $dir);
                                    }
                                }
                                @rmdir("data/bots/cli/" . $encode_phone);
                                if (is_dir("data/data/users/" . $chat_id . "/bots/cli/" . $encode_phone) == true) {
                                    @rmdir("data/data/users/" . $chat_id . "/bots/cli/" . $encode_phone);
                                }
                                $_T = $text->User("deleted_cli", $chat_id, $filter_phone);
                                $_K = $bottom->User("back");
                                $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                                $bot->SendText($result_user);
                                $_TT = $text->Channel("deleted_cli", $chat_id, $filter_phone);
                                $_KK = $bottom->Channel("goto_bot", $bot_username);
                                $result_channel = ['chat_id' => $channel_call, 'text' => $_TT, 'reply_markup' => $_KK, 'parse_mode' => 'html'];
                                $bot->SendText($result_channel);
                            } else {
                                $_T = $text->User("delete_cli_false_sudo", $chat_id);
                                $_K = $bottom->User("back");
                                $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                                $bot->SendText($result_user);
                            }
                        } else {
                            $_T = $text->User("delete_cli_false_sset", $chat_id);
                            $_K = $bottom->User("back");
                            $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                            $bot->SendText($result_user);
                        }
                    } else {
                        $_T = $text->User("delete_cli_off", $chat_id);
                        $_K = $bottom->User("back");
                        $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                        $bot->SendText($result_user);
                    }
                }


                if ($user_com == "card" and $textmassage != "🕳بازگشت🕳") {
                    $file_code = json_decode(file_get_contents("data/data/cash/code_coin.json"), true);
                    if (isset($file_code['data']['codes'][$textmassage])) {
                        if ($file_code['data']['codes'][$textmassage]['use'] != "true") {
                            file_get_contents("data/data/users/" . $chat_id . "/com.txt", "none");
                            $coin_card = (int) $file_code['data']['codes'][$textmassage]['coin'];
                            $user_coin = file_get_contents("data/data/users/" . $chat_id . "/coins.txt");
                            file_put_contents("data/data/users/" . $chat_id . "/coins.txt", $user_coin + $coin_card);
                            $file_code['data']['codes'][$textmassage]['use'] = "true";
                            file_put_contents("data/data/cash/code_coin.json", json_encode($file_code));
                            $_T = $text->User("card_true", $chat_id, $coin_card);
                            $_K = $bottom->User("back");
                            $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                            $bot->SendText($result_user);
                            $_TT = $text->Channel("card_true", $chat_id, $coin_card);
                            $_KK = $bottom->Channel("goto_bot", $bot_username);
                            $result_channel = ['chat_id' => $channel_call, 'text' => $_TT, 'reply_markup' => $_KK, 'parse_mode' => 'html'];
                            $bot->SendText($result_channel);
                        } else {
                            $_T = $text->User("card_used", $textmassage);
                            $_K = $bottom->User("back");
                            $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                            $bot->SendText($result_user);
                        }
                    } else {
                        $_T = $text->User("card_isset", $textmassage);
                        $_K = $bottom->User("back");
                        $result_user = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                        $bot->SendText($result_user);
                    }
                }




                if ($textmassage == "🕳بازگشت🕳") {
                    $user_type = file_get_contents("data/data/users/" . $chat_id . "/type.txt");
                    if ($user_type == "make_api" or $user_type == "make_cli") {
                        if (strpos(file_get_contents("data/data/users/" . $chat_id . "/com.txt"), "login_") !== false) {
                            $path_dir = str_replace("login_", '', file_get_contents("data/data/users/" . $chat_id . "/com.txt"));
                            @rmdir("data/bots/cli/" . base64_encode($path_dir));
                        }
                        file_put_contents("data/data/users/" . $chat_id . "/com.txt", "none");
                        $_T = $text->User("make", $chat_id);
                        $_K = $bottom->User("make");
                        $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                        $bot->SendText($result);
                        file_put_contents("data/data/users/" . $chat_id . "/type.txt", "make_menu");
                    }


                    if ($user_type == "delete_api" or $user_type == "delete_cli") {
                        file_put_contents("data/data/users/" . $chat_id . "/com.txt", "none");
                        $_T = $text->User("delete", $chat_id);
                        $_K = $bottom->User("delete");
                        $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                        $bot->SendText($result);
                        file_put_contents("data/data/users/" . $chat_id . "/type.txt", "delete_menu");
                    }

                    if ($user_type == "card") {
                        file_put_contents("data/data/users/" . $chat_id . "/com.txt", "none");
                        $_T = $text->User("coin", $chat_id);
                        $_K = $bottom->User("coin");
                        $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                        $bot->SendText($result);
                        file_put_contents("data/data/users/" . $chat_id . "/type.txt", "coin_menu");
                    }
                }





                /*user job finish*/
            }




            /*user panel finish*/
        } else {
            if (in_array($chat_id, explode("\n", file_get_contents("data/data/users/list.txt"))) and Lock_Ch($chat_id, $token, $channel_user) == false) {
                $bot_username = json_decode(file_get_contents('https://api.telegram.org/bot' . $token . '/getMe'))->result->username;
                $bot_id = json_decode(file_get_contents('https://api.telegram.org/bot' . $token . '/getMe'))->result->id;
                $_T = $text->User("lock_join");
                $_K = $bottom->User("ch_lock", $token, $bot_id, $channel_user);
                $result = ['chat_id' => $chat_id, 'text' => $_T, 'reply_markup' => $_K, 'parse_mode' => 'html'];
                $bot->SendText($result);
            }
        }
    }
    if ($chat_id != $sudo and !in_array($chat_id, explode("\n", file_get_contents("data/data/adm/list.txt"))) and in_array($chat_id, explode("\n", file_get_contents("data/data/users/ban.txt")))) {
        $_T = $text->User("is_ban", $chat_id);
        $result = ['chat_id' => $chat_id, 'text' => $_T, 'parse_mode' => 'html'];
        $bot->SendText($result);
    }
    /*private*/
}


if (isset($_GET['cli']) and isset($_GET['id'])) {
    $mode = $_GET['cli'];
    $id = $_GET['id'];
    $_T = $text->User("cli_created", $id);
    $result = ['chat_id' => $mode, 'text' => $_T, 'parse_mode' => 'html'];
    $bot->SendText($result);
}

?>