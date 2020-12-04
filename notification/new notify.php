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
    $socket->emit('new notify', 'asdsadsadad');
};
