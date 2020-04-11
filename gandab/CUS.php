<?php
include "CFG.php";
include_once("CBT.php");
include_once("CCL.php");
include_once("CTX.php");
$bot = new TelegramBot($token);
$text = new Text();
$bottom = new Bottom();
$lock_date = file_get_contents("data/data/settings/Lock_day_coin.txt");
$date_coin = file_get_contents("data/data/settings/coin_day_count.txt");
if ($lock_date == "on" and file_exists("data/data/cash/" . date("Y-m-d") . ".txt") == false) {
    if ((int) $date_coin > 0) {
        file_put_contents("data/data/cash/" . date("Y-m-d") . ".txt", "true");
        $users = explode("\n", file_get_contents("data/data/users/list.txt"));
        $bans = explode("\n", file_get_contents("data/data/users/bans.txt"));
        foreach ($users as $user) {
            if (!in_array($user, $bans) and $user != '') {
                $user_coins = file_get_contents("data/data/users/" . $user . "/coins.txt");
                file_put_contents("data/data/users/" . $user . "/coins.txt", $user_coins + date_coin);
                $user_coins2 = file_get_contents("data/data/users/" . $user . "/coins.txt");
                $_T = $text->User("date_coin", $user, $user_coins, $date_coin, $user_coins2);
                $_K = $bottom->User("back");
                $result = ['chat_id' => $user, 'text' => $_T, 'reply_markup' => $_K];
                $bot->SendText($result);
            }
        }
    }
}
function DT($URL)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEJAR, "cooki.txt");
    return curl_exec($ch);
    curl_close($ch);
}
$scan = scandir("data/bots/cli");
$diff = array_diff($scan, ['.', '..']);
foreach ($diff as $cli) {
    if (file_exists("data/bots/cli/" . $cli . "/true.txt") == false) {
        file_put_contents("data/bots/cli/" . $cli . "/true.txt", "true");
        $email = $C_Gmail;
        $pass = $C_pass;
        $link = $host_url . "/" . $path_url . "/data/bots/cli" . $cli . "/index.php";
        $tt = DT('https://cron-job.org/en/members/');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://cron-job.org/en/members/');
        curl_setopt($ch, CURLOPT_COOKIEJAR, "cooki.txt");
        curl_setopt($ch, CURLOPT_COOKIEFILE, "cooki.txt");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array("action" => "login", 'email' => "$email", 'pw' => "$pass"));
        $res = curl_exec($ch);
        curl_close($ch);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://cron-job.org/en/members/',
            CURLOPT_COOKIEJAR => "cooki.txt",
            CURLOPT_COOKIEFILE => "cooki.txt",
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_AUTOREFERER => TRUE,
            CURLOPT_HEADER => 0,
            CURLOPT_FOLLOWLOCATION => TRUE,
        ]);
        $rr = curl_exec($curl);
        curl_close($curl);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://cron-job.org/en/members/jobs/',
            CURLOPT_COOKIEJAR => "cooki.txt",
            CURLOPT_COOKIEFILE => "cooki.txt",
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_AUTOREFERER => TRUE,
            CURLOPT_HEADER => 0,
            CURLOPT_FOLLOWLOCATION => TRUE,
        ]);
        $rr = curl_exec($curl);
        curl_close($curl);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://cron-job.org/en/members/jobs/add/',
            CURLOPT_COOKIEJAR => "cooki.txt",
            CURLOPT_COOKIEFILE => "cooki.txt",
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_AUTOREFERER => TRUE,
            CURLOPT_HEADER => 0,
            CURLOPT_FOLLOWLOCATION => TRUE,
        ]);
        $rr = curl_exec($curl);
        curl_close($curl);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://cron-job.org/en/members/jobs/add/');
        curl_setopt($ch, CURLOPT_COOKIEJAR, "cooki.txt");
        curl_setopt($ch, CURLOPT_COOKIEFILE, "cooki.txt");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array("action" => 'add', "title" => 'omega', "url" => $link, "auth_user" => "$email", "auth_pass" => "$pass", "exec_mode" => 'interval_minute', "interval_minute_minute" => 1, "day_time_hour" => '0', "day_time_minute" => '0', "month_time_day" => '1', "month_time_hour" => '0', "month_time_minute" => '0', "notify_failure" => 'on', "notify_disable" => 'on',));
        $rr = curl_exec($ch);
        curl_close($ch);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://cron-job.org/en/members/jobs/',
            CURLOPT_COOKIEJAR => "cooki.txt",
            CURLOPT_COOKIEFILE => "cooki.txt",
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_AUTOREFERER => TRUE,
            CURLOPT_HEADER => 0,
            CURLOPT_FOLLOWLOCATION => TRUE,
        ]);
        $rr = curl_exec($curl);
        curl_close($curl);
        echo "TRUE";
    }
}
