<?php

/**
 *
 *
 * Author:  Nurmukhammadov Shakhrizod
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\models\chat\ChatMessage;
use zetsoft\models\user\UserContact;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;

return function ($user_id, $friend_id) use ($socket) {
    global $users;

    Az::$app->chat->main->blockUser($user_id, $friend_id);

    $user_chat_list = Az::$app->chat->main->getChatClick($user_id, $friend_id);
    $socket->emit('chat-click', $user_chat_list);
    if(ZArrayHelper::keyExists($friend_id,$users)) {
        $friend_chat_list = Az::$app->chat->main->getChatClick($friend_id, $user_id);
        $socket->broadcast->to($users[$friend_id])->emit('chat-click', $friend_chat_list);

        $return = Az::$app->chat->main->getUserInform( $user_id, $friend_id);
        $socket->broadcast->to($users[$friend_id])->emit('user-data', $return);
    }
    $return = Az::$app->chat->main->getUserInform($friend_id, $user_id);
    $socket->emit('user-data', $return);



};
