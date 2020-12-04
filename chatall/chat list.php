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

return function ($user_id, $friend_id) use ($socket) {
    global $users;
    $return = Az::$app->chat->main->getChatClick($user_id, $friend_id);
    $socket->emit('chat-click', $return);

};
