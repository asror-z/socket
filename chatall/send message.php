<?php

/**
 *
 *
 * Author:  Nurmukhammadov Shakhrizod
 * https://www.linkedin.com/in/asror-zakirovcores\main\index
 * https://github.com/asror-z
 *
 */

use zetsoft\models\chat\ChatMessage;
use zetsoft\models\chat\ChatNotify;
use zetsoft\models\user\UserCompany;
use zetsoft\models\user\UserContact;
use zetsoft\system\Az;

/*
 * status = new,
*           reject,
*           accept
*           cancel
 * */

return function ($user_id, $receiver_id, $msg) use ($socket, $io) {
    global $users;

    Az::$app->chat->main->saveMessage($user_id, $receiver_id, $msg);

    if (\zetsoft\system\helpers\ZArrayHelper::keyExists($receiver_id, $users)) {
        $return = Az::$app->chat->main->getAllList($receiver_id);
        $socket->broadcast->to($users[$receiver_id])->emit('chat-list', $return);
    }

//
    $return = Az::$app->chat->main->getAllList($user_id);
    $socket->emit('chat-list', $return);
    if (\zetsoft\system\helpers\ZArrayHelper::keyExists($receiver_id, $users)) {
        $friend_chat_list = Az::$app->chat->main->getChatClick($receiver_id, $user_id);
        $socket->broadcast->to($users[$receiver_id])->emit('chat-click', $friend_chat_list);
    }
    $user_chat_list = Az::$app->chat->main->getChatClick($user_id, $receiver_id);
    $socket->emit('chat-click', $user_chat_list);
};
