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
use zetsoft\models\user\UserCompany;
use zetsoft\models\user\UserContact;
use zetsoft\system\Az;

/*
 * status = new,
*           reject,
*           accept
*           cancel
 * */

return function ($user_id) use ($socket, $io) {
    global $users;
    $return = Az::$app->chat->main->getRequestList($user_id);
    $socket->emit('requests-list', $return);
};
