<?php

/**
 *
 *
 * Author:  Nurmukhammadov Shakhrizod
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\models\chat\ChatMessage;
use zetsoft\models\place\PlaceCountry;
use zetsoft\models\user\UserCompany;
use zetsoft\service\App\eyuf\User;
use zetsoft\system\Az;

return function ($user_id) use ($socket) {
    global $users;
    $return = Az::$app->chat->main->getUserInform($user_id, $socket->userId);
    $socket->emit('user-data', $return);
};
