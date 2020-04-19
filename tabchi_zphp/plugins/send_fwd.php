<?php
# S  O  U  L  O  O  S  H

if (in_array($userID, $Admin)) {
    if ($msg == 'Fwd all') {
        $rid =  $update['update']['message']['reply_to_msg_id'];
        $dialogs = $MadelineProto->get_dialogs();
        foreach ($dialogs as $peer) {
            $Type = $MadelineProto->get_info($peer);
            $Type1 = $Type['type'];
            if ($Type1 == "supergroup" || $Type1 == "user" || $Type1 == "chat") {
                $MadelineProto->messages->forwardMessages([
                    'from_peer' => $chatID,
                    'to_peer'   => $peer, 'id' => [$rid]
                ]);
            }
        }
        $MadelineProto->messages->sendMessage([
            'peer'       => $chatID,
            'message'    => '✅ پیام شما به تمامی اعضا فوروارد شد !',
            'parse_mode' => "html"]);
    }
    if ($msg == 'Fwd user') {
        $rid =  $update['update']['message']['reply_to_msg_id'];
        $dialogs = $MadelineProto->get_dialogs();
        foreach ($dialogs as $peer) {
            $Type = $MadelineProto->get_info($peer);
            $Type1 = $Type['type'];
            if ($Type1 == "user") {
                $MadelineProto->messages->forwardMessages([
                    'from_peer' => $chatID,
                    'to_peer'   => $peer,
                    'id'        => [$rid],]);
            }
        }
        $MadelineProto->messages->sendMessage([
            'peer'       => $chatID,
            'message'    => '✅ پیام شما به یوزرها فوروارد شد !',
            'parse_mode' => "markdown"]);
    }
    if ($msg == 'Fwd gp') {
        $rid =  $update['update']['message']['reply_to_msg_id'];
        $dialogs = $MadelineProto->get_dialogs();
        foreach ($dialogs as $peer) {
            $Type = $MadelineProto->get_info($peer);
            $Type1 = $Type['type'];
            if ($Type1 == "chat") {
                $MadelineProto->messages->forwardMessages([
                    'from_peer' => $chatID,
                    'to_peer'   => $peer,
                    'id'        => [$rid],]);
            }
        }
        $MadelineProto->messages->sendMessage([
            'peer'       => $chatID,
            'message'    => '✅ پیام شما به گروه ها فوروارد شد !',
            'parse_mode' => "markdown"]);
    }
    if ($msg == 'Fwd sgp') {
        $rid =  $update['update']['message']['reply_to_msg_id'];
        $dialogs = $MadelineProto->get_dialogs();
        foreach ($dialogs as $peer) {
            $Type = $MadelineProto->get_info($peer);
            $Type1 = $Type['type'];
            if ($Type1 == "supergroup") {
                $MadelineProto->messages->forwardMessages([
                    'from_peer' => $chatID,
                    'to_peer'   => $peer,
                    'id'        => [$rid],]);
            }
        }
        $MadelineProto->messages->sendMessage([
            'peer'       => $chatID,
            'message'    => '✅ پیام شما به سوپرگروه ها فوروارد شد !',
            'parse_mode' => "markdown"
        ]);
    }
    // @Z_PHP
    if (preg_match("/^(Sendall) (.*)$/", $msg)) {
        preg_match("/^(Sendall) (.*)$/", $msg, $text1);
        $text = $text1[2];
        $dialogs = $MadelineProto->get_dialogs();
        foreach ($dialogs as $peer) {
            $Type = $MadelineProto->get_info($peer);
            $Type1 = $Type['type'];
            if ($Type1 == "supergroup" || $Type1 == "user" || $Type1 == "chat") {
                $MadelineProto->messages->sendMessage([
                    'peer' => $peer,
                    'message' => "$text"
                ]);
            }
        }
        $MadelineProto->messages->sendMessage([
            'peer'       => $chatID,
            'message'    => '☑️ پیام شما به تمامی اعضا ارسال شد !',
            'parse_mode' => "markdown"
        ]);
    }
    // @Amir_IT_Man
    if (preg_match("/^(Senduser) (.*)$/", $msg)) {
        preg_match("/^(Senduser) (.*)$/", $msg, $text1);
        $text = $text1[2];
        $dialogs = $MadelineProto->get_dialogs();
        foreach ($dialogs as $peer) {
            $Type = $MadelineProto->get_info($peer);
            $Type1 = $Type['type'];
            if ($Type1 == "user") {
                $MadelineProto->messages->sendMessage([
                    'peer' => $peer,
                    'message' => "$text"
                ]);
            }
        }
        $MadelineProto->messages->sendMessage([
            'peer'       => $chatID,
            'message'    => '☑️ پیام شما به یوزرها ارسال شد !',
            'parse_mode' => "markdown"]);
    }
    //
    if (preg_match("/^(Sendsgp) (.*)$/", $msg)) {
        preg_match("/^(Sendsgp) (.*)$/", $msg, $text1);
        $text = $text1[2];
        $dialogs = $MadelineProto->get_dialogs();
        foreach ($dialogs as $peer) {
            $Type = $MadelineProto->get_info($peer);
            $Type1 = $Type['type'];
            if ($Type1 == "supergroup") {
                $MadelineProto->messages->sendMessage([
                    'peer' => $peer,
                    'message' => "$text"
                ]);
            }
        }
        $MadelineProto->messages->sendMessage([
            'peer'       => $chatID,
            'message'    => '☑️ پیام شما به سوپرگروه ها ارسال شد !',
            'parse_mode' => "markdown"]);
    }
    if (preg_match("/^(Sendgp) (.*)$/", $msg)) {
        preg_match("/^(Sendgp) (.*)$/", $msg, $text1);
        $text = $text1[2];
        $dialogs = $MadelineProto->get_dialogs();
        foreach ($dialogs as $peer) {
            $Type = $MadelineProto->get_info($peer);
            $Type1 = $Type['type'];
            if ($Type1 == "chat") {
                $MadelineProto->messages->sendMessage(['
                peer' => $peer,
                'message' => "$text"]);
            }
        }
        $MadelineProto->messages->sendMessage([
            'peer'       => $chatID,
            'message'    => '☑️ پیام شما به گروه ها ارسال شد !',
            'parse_mode' => "markdown"
        ]);
    }
}
# S  O  U  L  O  O  S  H
