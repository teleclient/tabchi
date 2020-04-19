<?php
// @Z_PHP
if (in_array($userID, $Admin)) {
    if (preg_match("/^(Addall) (.*)$/", $msg)) {
        preg_match("/^(Addall) (.*)$/", $msg, $text1);
        $user = $text1[2];
        $dialogs = $MadelineProto->get_dialogs();
        foreach ($dialogs as $peer) {
            $Type = $MadelineProto->get_info($peer);
            $Type1 = $Type['type'];
            if ($Type1 == "supergroup") {
                $MadelineProto->channels->inviteToChannel([
                    'channel' => $peer,
                    'users' => [$user]
                ]);
            }
        }
        $MadelineProto->messages->sendMessage([
            'peer'       => $chatID,
            'message'    => '➕ درحال اضافه کرن مخاطب به گروه های ربات ...',
            'parse_mode' => "markdown"
        ]);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⬜️⬜️⬜️⬜️⬜️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⬛️⬜️⬜️⬜️⬜️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⬛️⬛️⬜️⬜️⬜️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⬛️⬛️⬛️⬜️⬜️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⬛️⬛️⬛️⬛️⬜️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '⬛️⬛️⬛️⬛️⬛️', 'parse_mode' => 'html']);
        $ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id + 1, 'message' => '✔️ مخاطب به گروه های ربات اضافه شد!', 'parse_mode' => 'html']);
    }

    if (preg_match("/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me/", $msg)) {
        try {
            $MadelineProto->messages->importChatInvite([
                'hash' => str_replace('https://t.me/joinchat/', '', $msg),
            ]);
            $MadelineProto->messages->sendMessage([
                'peer'       => $Admin,
                'message'    => "♨️ ربات وارد یک گروه شد !",
                'parse_mode' => 'MarkDown'
            ]);
        } catch (\danog\MadelineProto\RPCErrorException $e) {
            $MadelineProto->messages->sendMessage(['peer' => $Admin, 'message' => "📛 تلگرام مانع از ورود ربات به داخل گروه شد !", 'parse_mode' => 'MarkDown']);
        } catch (\danog\MadelineProto\Exception $e2) {
            $MadelineProto->messages->sendMessage(['peer' => $Admin, 'message' => "📛 تلگرام مانع از ورود ربات به داخل گروه شد !", 'parse_mode' => 'MarkDown']);
        }
    }
}
if ($link == "yes") {
    if (preg_match("/^(.*)([Hh]ttp|[Hh]ttps|t.me)(.*)|([Hh]ttp|[Hh]ttps|t.me)(.*)|(.*)([Hh]ttp|[Hh]ttps|t.me)|(.*)[Tt]elegram.me(.*)|[Tt]elegram.me(.*)|(.*)[Tt]elegram.me|(.*)[Tt].me(.*)|[Tt].me(.*)|(.*)[Tt].me/", $msg)) {
        try {
            $MadelineProto->messages->importChatInvite([
                'hash' => str_replace('https://t.me/joinchat/', '', $msg),
            ]);
            $MadelineProto->messages->sendMessage([
                'peer' => $Admin, 'message' => "♨️ ربات وارد یک گروه شد !", 'parse_mode' => 'MarkDown']);
        } catch (\danog\MadelineProto\RPCErrorException $e) {
            $MadelineProto->messages->sendMessage(['peer' => $Admin, 'message' => "📛 تلگرام مانع از ورود ربات به داخل گروه شد !", 'parse_mode' => 'MarkDown']);
        } catch (\danog\MadelineProto\Exception $e2) {
            $MadelineProto->messages->sendMessage(['peer' => $Admin, 'message' => "📛 تلگرام مانع از ورود ربات به داخل گروه شد !", 'parse_mode' => 'MarkDown']);
        }
    }
}

# S  O  U  L  O  O  S  H
