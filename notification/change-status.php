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

return function ($id) use ($socket, $io) {
    global $user, $numUsers;
    // we store the username in the socket session for this client
    $usernames[$user_id] = $socket->id;
    // echo globally (all clients) that a person has connected
    $friendsList = Az::$app->chat->main->getFriendsList($user_id);
    $socket->emit('user-list', $friendsList);
};
