<?php

/**
 *
 *
 * Author:  Nurmukhammadov Shakhrizod
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */
return  function () use ($socket) {
    $socket->broadcast->emit('stop typing', array(
        'username' => $socket->username
    ));
};
