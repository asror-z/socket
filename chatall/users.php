<?php

/**
 *
 *
 * Author:  Nurmukhammadov Shakhrizod
 * https://www.linkedin.com/in/asror-zakirovcores\main\index
 * https://github.com/asror-z
 *
 */

use zetsoft\system\Az;

return function ($user_id) use ($socket) {
    global $users;
    // echo globally (all clients) that a person has connected
    $usersList = Az::$app->chat->main->getUsersList($user_id);
    $socket->emit('user-list', $usersList);
};
