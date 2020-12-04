<?php

/**
 *
 *
 * Author:  Nurmukhammadov Shakhrizod
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */
return function ($data) use ($socket) {
    // we tell the client to execute 'new message'
    $socket->broadcast->emit('new message', array(
        'username' => $socket->username,
        'message' => $data
    ));
};
