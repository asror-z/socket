<?php

/**
 *
 *
 * Author:  Nurmukhammadov Shakhrizod
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\system\Az;

return function () use ($socket) {
    global $users;
    $model = \zetsoft\models\user\User::findOne($socket->userId);
    if ($model !== null) {
        $model->status = \zetsoft\models\user\User::status['offline'];
        $model->lastseen = date('d-m-Y H:i:s');
        $model->save();
    }
    $id = $socket->userId;
    unset($users[$socket->userId]);
    if (!empty($users))
        foreach ($users as $key => $user) {
            $return = Az::$app->chat->main->getAllList($key);
            $socket->broadcast->to($user)->emit('chat-list', $return);

            $return = Az::$app->chat->main->getChatClick($key, $id);
            $socket->broadcast->to($user)->emit('chat-click', $return);
        }


};
