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
use zetsoft\system\Az;

return function (array $chat_ids, $friend_id) use ($socket) {
    global $users;
    $msgs = ChatMessage::find()->where(['id' => $chat_ids])->all();
    if (!empty($msgs)) {
        foreach ($msgs as $msg) {
            $msg->read = true;
            $msg->save();
        }
        $return = Az::$app->chat->main->getFriendsList($friend_id);
        $socket->broadcast->to($users[$friend_id])->emit('chat-list', $return);

        $return = Az::$app->chat->main->getFriendsList($socket->userId);
        $socket->emit('chat-list', $return);

        $friend_chat_list = Az::$app->chat->main->getChatClick($friend_id, $socket->userId);
        $socket->broadcast->to($users[$friend_id])->emit('chat-click', $friend_chat_list);

        $user_chat_list = Az::$app->chat->main->getChatClick($socket->userId, $friend_id);
        $socket->emit('chat-click', $user_chat_list);
//        $socket->broadcast->emit('message-read', $chat_ids);
    }
};
