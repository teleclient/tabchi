<?php
# S  O  U  L  O  O  S  H
if ($contacts == "yes") {
    if (isset($update['update']['message']['media']["phone_number"])) {
        $phone      = $update['update']['message']['media']["phone_number"];
        $first_name = $update['update']['message']['media']["first_name"];
        $last_name  = $update['update']['message']['media']["last_name"];
        $input      = [
            '_'          => 'inputPhoneContact',
            'client_id'  => 0,
            'phone'      => $phone,
            'first_name' => $first_name,
            'last_name'  => $last_name
        ];
        $MadelineProto->contacts->importContacts(['contacts' => [$input]]);
        $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => '⚠️ درحال سیو کردن مخاطب ...', 'parse_mode' => "markdown"]);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚪️⚪️⚪️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚪️⚪️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚪️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚫️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '✅ مخاطب ذخیره شد!', 'parse_mode' => 'html']);
    }
}
// @Z_PHP
if (in_array($userID, $Admin)) {
    if ($typing == 'yes') {
        $sendMessageTypingAction = ['_' => 'sendMessageTypingAction'];
        $m = $MadelineProto->messages->setTyping([
            'peer'   => $chatID,
            'action' => $sendMessageTypingAction
        ]);
    }
    if ($markread == 'yes') {
        $msg_id = $update['update']['message']['id'];
        if ($chatID < 0) {
            $msg_id = $update['update']['message']['id'];
            $MadelineProto->channels->readHistory([
                'channel' => $chatID,
                'max_id'  => $msg_id]);
            $MadelineProto->channels->readMessageContents([
                'channel' => $chatID,
                'id'      => [$msg_id]]);
        } else {
            $MadelineProto->messages->readHistory([
                'peer'   => $chatID,
                'max_id' => $msg_id
            ]);
        }
    }

    if ($msg == "Seen on") {
        $data["data"]["markread"] = "yes";
        file_put_contents("data.json", json_encode($data));
        $ed = $MadelineProto->messages->sendMessage(['peer' => $chatID,                      'message' => '⚪️⚪️⚪️⚪️', 'parse_mode' => 'markdown']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚪️⚪️⚪️', 'parse_mode' => 'markdown']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚪️⚪️', 'parse_mode' => 'markdown']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚪️', 'parse_mode' => 'markdown']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚫️', 'parse_mode' => 'markdown']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '✔️ مشاهده پیام ها روشن شد !', 'parse_mode' => 'markdown']);
    }
    if ($msg == "Seen off") {
        $data["data"]["markread"] = "no";
        file_put_contents("data.json", json_encode($data));
        $ed = $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => '⚪️⚪️⚪️⚪️', 'parse_mode' => 'markdown']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚪️⚪️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚪️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚫️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '✖️ مشاهده پیام ها خاموش شد !', 'parse_mode' => 'html']);
    }
    if ($msg == "Typing on") {
        $data["data"]["typing"] = "yes";
        file_put_contents("data.json", json_encode($data));
        $ed = $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => '⚪️⚪️⚪️⚪️', 'parse_mode' => 'markdown']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚪️⚪️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚪️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚫️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '✅ وضعیت تایپینگ روشن شد !', 'parse_mode' => 'html']);
    }
    if ($msg == "Typing off") {
        $data["data"]["typing"] = "no";
        file_put_contents("data.json", json_encode($data));
        $ed = $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => '⚪️⚪️⚪️⚪️', 'parse_mode' => 'markdown']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚪️⚪️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚪️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚫️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '❌ وضعیت تایپینگ خاموش شد!', 'parse_mode' => 'html']);
    }
    if ($msg == "Autoadd on") {
        $data["data"]["contacts"] = "yes";
        file_put_contents("data.json", json_encode($data));
        $ed = $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => '⚪️⚪️⚪️⚪️', 'parse_mode' => 'markdown']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚪️⚪️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚪️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚫️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '✅ اددکردن خودکار روشن شد !', 'parse_mode' => 'html']);
    }
    if ($msg == "Autoadd off") {
        $data["data"]["contacts"] = "no";
        file_put_contents("data.json", json_encode($data));
        $ed = $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => '⚪️⚪️⚪️⚪️', 'parse_mode' => 'markdown']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚪️⚪️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚪️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚫️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '❌ اددکردن خودکار خاموش شد !', 'parse_mode' => 'html']);
    }
    if ($msg == "Autojoin on") {
        $data["data"]["link"] = "yes";
        file_put_contents("data.json", json_encode($data));
        $ed = $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => '⚪️⚪️⚪️⚪️', 'parse_mode' => 'markdown']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚪️⚪️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚪️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚫️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '✔️ پیوستن خودکار ربات به گروه ها روشن شد !', 'parse_mode' => 'html']);
    }
    if ($msg == "Autojoin off") {
        $data["data"]["link"] = "no";
        file_put_contents("data.json", json_encode($data));
        $ed = $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => '⚪️⚪️⚪️⚪️', 'parse_mode' => 'markdown']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚪️⚪️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚪️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚪️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⚫️⚫️⚫️⚫️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '✔✖️ پیوستن خودکار ربات به گروه ها خاموش شد !', 'parse_mode' => 'html']);
    }
    // @Amir_IT_Man
    if ($msg == "%") {
        $msg_id = $update['update']['message']['id'];
        $dialogs1 = json_encode($MadelineProto->get_dialogs());
        $dialogs =        count($MadelineProto->get_dialogs());
        $s = file_put_contents("Statistics.txt", "$dialogs1");
        $Updates = $MadelineProto->messages->sendMedia([
            'peer' => $chatID,
            'reply_to_msg_id' => $msg_id,
            'media'           =>  [
                '_'          => 'inputMediaUploadedDocument',
                'file'       => 'Statistics.txt',
                'attributes' => [['_' => 'documentAttributeFilename', 'file_name' => 'Statistics']]
            ],
            'message'          =>
'📊 Statistics => ' . $dialogs . '
🌐 Channel => @Z_PHP
👨🏼‍💻 Creator => @Amir_IT_Man',
            'parse_mode' => 'html'
        ]);
        unlink("Statistics.txt");
    }
    if ($msg == "Ping") {
        $MadelineProto->messages->sendMessage([
            'peer' => $chatID,
            'reply_to_msg_id' => $msg_id,
            'message'         => '♻️ ربات آنلاین است !',
            'parse_mode'      => 'html'
        ]);
    }
    if ($msg == "Support") {
        $MadelineProto->messages->sendMessage([
            'peer'            => $chatID,
            'reply_to_msg_id' => $msg_id,
            'message'         => "🆔 : @Z_PHP <br>👨🏼‍💻 : @Amir_IT_Man",
            'parse_mode'      => 'html']);
    }
    if ($msg == "/creator") {
        $MadelineProto->messages->sendMessage([
            'peer'            => $chatID,
            'reply_to_msg_id' => $msg_id,
            'message'         => "👨🏼‍💻 : @Amir_IT_Man",
            'parse_mode'      => 'MarkDown']);
    }
    if ($msg == "help" || $msg == "Help" || $msg == "راهنما") {
        $MadelineProto->messages->sendMessage([
            'peer' => $chatID,
            'message' =>
"📚 راهنمای زد تبچی :

⚠️ (به کوچک و بزرگ بودن حروف دقت کنید).

📍Ping
🔖 اطلاع از آنلاین بودن ربات.
➿➿➿➿➿➿➿➿➿
📍 %
🔖 مشاهده تعداد اعضای ربات به همراه لیست.
➿➿➿➿➿➿➿➿➿
📍 Typing on
🔖 روشن شدن وضعیت تایپینگ.
➿➿➿➿➿➿➿➿➿
📍 Typing off
🔖 خاموش شدن وضعیت تایپینگ.
➿➿➿➿➿➿➿➿➿
📍 Seen on
🔖 روشن شدن مشاهده پیام ها (تیک دوم).
➿➿➿➿➿➿➿➿➿
📍 Seen off
🔖 خاموش شدن مشاهده پیام ها (تیک دوم).
➿➿➿➿➿➿➿➿➿
📍 Autoadd on
🔖 روشن شدن اضافه کردن خودکار مخاطب.
➿➿➿➿➿➿➿➿➿
📍 Autoadd off
🔖 خاموش شدن اضافه کردن خودکار مخاطب.
➿➿➿➿➿➿➿➿➿
📍 Autojoin on
🔖 روشن شدن پیوستن خودکار به گروه ها.
➿➿➿➿➿➿➿➿➿
📍 Autojoin off
🔖 خاموش شدن پیوستن خودکار به گروه ها.
➿➿➿➿➿➿➿➿➿
📍 Support
🔖 پشتیبانی ربات.
➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖

✒️ Addall {User}
🔖 اضافه کردن کاربر مورد نظر به گروه ها.
➰➰➰➰➰➰➰➰➰
✒️ Fwd user {Reply}
🔖 فروارد کردن پیام به کاربران.
➰➰➰➰➰➰➰➰➰
✒️ Fwd gp {Reply}
🔖 فروارد کردن پیام به گروه ها.
➰➰➰➰➰➰➰➰➰
✒️ Fwd sgp {Reply}
🔖 فروارد کردن پیام به سوپر گروه ها.
➰➰➰➰➰➰➰➰➰
✒️ Fwd all {Reply}
🔖 فروارد کردن پیام به تمامی عضوها.
➰➰➰➰➰➰➰➰➰
✒️ Senduser {Text}
🔖 ارسال کردن پیام به کاربران.
➰➰➰➰➰➰➰➰➰
✒️ Sendgp {Text}
🔖 ارسال کردن پیام به گروه ها.
➰➰➰➰➰➰➰➰➰
✒️ Sendsgp {Text}
🔖 ارسال کردن پیام به سوپرگروه ها.
➰➰➰➰➰➰➰➰➰
✒️ Sendall {Text}
🔖 ارسال کردن پیام به تمامی عضو ها.

______

👨🏼‍💻 : @Amir_IT_Man
🆔 : @Z_PHP
🌐 : www.ProCpanel.com",
            'parse_mode' => 'html'
        ]);
    }
}

# S  O  U  L  O  O  S  H
