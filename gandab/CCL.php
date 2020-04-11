<?php

class TelegramBot
{
    public $token;
    public function __construct($token)
    {
        $this->token = $token;
    }

    public function SetWebHook($method, $arg)
    {
        $url = "https://api.telegram.org/bot" . $this->token . "/" . $method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($arg));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $arg);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function SendAction($arg)
    {
        return $this->SetWebHook('sendChataction', $arg);
    }
    public function SendText($arg)
    {
        return $this->SetWebHook('sendMessage', $arg);
    }
    public function ForMsg($arg)
    {
        return $this->SetWebHook('ForwardMessage', $arg);
    }
    public function SendPhoto($arg)
    {
        return $this->SetWebHook('sendPhoto', $arg);
    }
    public function SendVideo($arg)
    {
        return $this->SetWebHook('sendvideo', $arg);
    }
    public function SendDoc($arg)
    {
        return $this->SetWebHook('sendDocument', $arg);
    }
    public function SendAudio($arg)
    {
        return $this->SetWebHook('sendAudio', $arg);
    }
    public function SendVoice($arg)
    {
        return $this->SetWebHook('sendVoice', $arg);
    }
    public function EditMsg($arg)
    {
        return $this->SetWebHook('editMessageText', $arg);
    }
    public function AsQ($arg)
    {
        return $this->SetWebHook('answerCallbackQuery', $arg);
    }
    public function EditKey($arg)
    {
        return $this->SetWebHook('editMessageReplyMarkup', $arg);
    }
    public function AsINQ($arg)
    {
        return $this->SetWebHook('answerInlineQuery', $arg);
    }
    public function GetMe($arg)
    {
        return $this->SetWebHook('getMe')['result'];
    }
    public function GetFile($arg)
    {
        return $this->SetWebHook('getFile', ['file_id' => $fileid]);
    }
    public function GetChatM($arg)
    {
        return $this->SetWebHook('getChatMember', $args);
    }
}


class Hash
{

    public function UserPass($E1, $E2 = null, $E3 = null, $E4 = null)
    {
    }
}
