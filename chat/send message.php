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

    $return = Az::$app->chat->main->getFriendsList($receiver_id);
    $socket->broadcast->to($users[$receiver_id])->emit('chat-list', $return);

    $return = Az::$app->chat->main->getFriendsList($user_id);
    $socket->emit('chat-list', $return);

    $friend_chat_list = Az::$app->chat->main->getChatClick($receiver_id, $user_id);
    $socket->broadcast->to($users[$receiver_id])->emit('chat-click', $friend_chat_list);

    $user_chat_list = Az::$app->chat->main->getChatClick($user_id, $receiver_id);
    $socket->emit('chat-click', $user_chat_list);
};
