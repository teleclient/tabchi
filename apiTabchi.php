<?php
/*
کانال جنیس ! پر از سورس هاي ربات هاي تلگرامي !
لطفا در کانال ما عضو شويد
@lovehil1
https://t.me/lovehil1
*/
//error_reporting(0);
define('API_KEY', '********'); // توکن ربات را در اینجا قرار دهید

function bot($method, $datas = [])
{
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
    }
}

// #### Function - فانکشن
function sendmessage($chat_id, $text)
{
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => "MarkDown"
    ]);
}
function Forward($koja, $key, $pm)
{
    bot('ForwardMessage', [
        'chat_id' => $koja,
        'from_chat_id' => $key,
        'message_id' => $pm
    ]);
}

// Moteqayer - متغیرها
$update      = json_decode(file_get_contents('php://input'));
$name        = $update->message->from->first_name;
$message     = $update->message;
$chat_id     = $message->chat->id;
$text        = $message->text;
@$message_id = $message->message_id;
$from_id     = $message->from->id;
$admin       = 314397908;        /*ایدی عددی ادمین*/
$channel     = "-1001350575337"; /*ایدی عددی کانال*/
$message_id2 = $message->message_id;
$command     = file_put_contents("data/commanda.doc");
$bcpv        = file_get_contents("bcpv.doc");
$data        = file_get_contents("data/$chat_id/data.doc");
mkdir('data');
mkdir('data/$chat_id/data.doc');
//==================================

if ($text == "$text") {
    $user = file_get_contents('users.doc');
    $members = explode("\n", $user);
    if (!in_array($from_id, $members)) {
        $add_user = file_get_contents('users.doc');
        $add_user .= $from_id . "\n";
        $step = file_get_contents("data/" . $from_id . "/step.doc");
        file_put_contents("data/$chat_id/membrs.doc", "0");
        file_put_contents('users.doc', $add_user);
    }
    file_put_contents("data/$chat_id/arash.doc", "no");

    bot('ForwardMessage', [
        'chat_id'             => $chat_id,
        'from_chat_id'        => $channel,
        'message_id'          => 156, /*مسیج آیدی پیام فرواردی مورد نظر در کانالی که ایدی عددیش را قرار داده اید*/
        'reply_to_message_id' => $message_id2,
    ]);
}
//=================//

if (
    $text === "پنل"    ||
    $text === "مدیریت"
) {
    bot('sendmessage', [
        'chat_id'             => $admin,
        'text'                => "به پنل مدیریت خوش آمدید🥀",
        'reply_to_message_id' => $message_id2,
        'parse_mode'          => "MarkDown",
        'reply_markup' => json_encode([
            'resize_keyboard' => true,
            'keyboard' => [
                [
                    ['text' => "امار📊"], ['text' => "📩 پیام همگانی"]
                ],
            ]
        ])
    ]);
}
elseif ($text === "امار📊") {
    $user = file_get_contents("users.doc");
    $member_id = explode("\n", $user);
    $member_count = count($member_id) - 1;

    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "تعداد ممبر ها : $member_count",
        'parse_mode' => "MarkDown",
    ]);
}
elseif ($text === "📩 پیام همگانی") {
    file_put_contents("bcpv.doc", "bc");
    bot('sendmessage', [
        'chat_id' => $admin,
        'text' => "پیام مورد نظر را در قالب متن بنویسید",
        'parse_mode' => 'html',
        'reply_markup' => json_encode([
            'keyboard' => [
                [['text' => 'مدیریت']],
            ], 'resize_keyboard' => true
        ])
    ]);
}

if ($bcpv == "bc" && $chat_id == $admin) {
    file_put_contents("bcpv.doc", "none");
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text'    => "پیام شما با موفقیت به تمام کاربران ارسال شد!",
    ]);
    $all_member = fopen("users.doc", "r");
    while (!feof($all_member)) {
        $user = fgets($all_member);
        sendmessage($user, $text, "html");
    }
}
?>
