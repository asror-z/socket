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

return function ($user_id) use ($socket, $io) {
    global $users;
    // we store the username in the socket session for this client
    $users[$user_id] = $socket->id;

    $socket->userId = $user_id;
    $model = \zetsoft\models\user\User::findOne($user_id);
    $model->status = \zetsoft\models\user\User::status['online'];
    $model->save();

    // echo globally (all clients) that a person has connected
    if (!empty($users))
        foreach ($users as $key => $user) {
            $return = Az::$app->chat->main->getAllList($key);
            $socket->broadcast->to($user)->emit('chat-list', $return);
        }

    $return = Az::$app->chat->main->getAllList($user_id);
    $socket->emit('chat-list', $return);
    
    $usersList = Az::$app->chat->main->getUsersList($user_id);
    $socket->emit('user-list', $usersList);

    $return = Az::$app->chat->main->getRequestList($user_id);
    $socket->emit('requests-list', $return);
};
