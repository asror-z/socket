<?php

/**
 *
 *
 * Author:  Nurmukhammadov Shakhrizod
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */
return function () use ($socket) {
    global $usernames, $numUsers;
    if ($socket->addedUser) {
        --$numUsers;
        // echo globally that this client has left
        $socket->broadcast->emit('user left', array(
            'username' => $socket->username,
            'numUsers' => $numUsers
        ));
    }
};
