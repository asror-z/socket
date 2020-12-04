<?php

/**
 *
 *
 * Author:  Nurmukhammadov Shakhrizod
 * https://www.linkedin.com/in/asror-zakirovcores\main\index
 * https://github.com/asror-z
 *
 */

use zetsoft\models\chat\ChatNotify;
use zetsoft\models\user\UserContact;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;

/*
 * status = new,
*           reject,
*           accept
*           cancel
 * */

return function ($user_id, $friend_id, $status) use ($socket, $io) {
    global $users;
    $return = false;
    /** @var UserContact $contact */
    $contact = Az::$app->chat->main->getFriend($user_id, $friend_id);
    switch ($status){
        case 'new':
            $model = new UserContact();
            $model->person = $user_id;
            $model->friend = $friend_id;
            $model->time = date('d-m-Y H:i:s');
            $return = $model->save();
            break;
        case 'reject':
            $contact = Az::$app->chat->main->getFriend($user_id, $friend_id);
            if ($contact !== null){
                $return = $contact->delete();
            }
            break;
        break;
        case 'accept':
            $contact->status = UserContact::status['accepted'];
            $return = $contact->save();
            break;
        case 'cancel':
            $contact = Az::$app->chat->main->getFriend($user_id, $friend_id);
            if ($contact !== null){
                $return = $contact->delete();
            }
            break;

    }
    $return = Az::$app->chat->main->getAllList($user_id);
    $socket->emit('chat-list', $return);

    $usersList = Az::$app->chat->main->getUsersList($user_id);
    $socket->emit('user-list', $usersList);

    $return = Az::$app->chat->main->getRequestList($user_id);
    $socket->emit('requests-list', $return);

    if(ZArrayHelper::keyExists($friend_id,$users)) {
        $return = Az::$app->chat->main->getAllList($friend_id);
        $socket->broadcast->to($users[$friend_id])->emit('chat-list', $return);

        $usersList = Az::$app->chat->main->getUsersList($friend_id);
        $socket->broadcast->to($users[$friend_id])->emit('user-list', $usersList);

        $return = Az::$app->chat->main->getRequestList($friend_id);
        $socket->broadcast->to($users[$friend_id])->emit('requests-list', $return);
       }
};
