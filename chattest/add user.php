<?php

/**
 *
 *
 * Author:  Nurmukhammadov Shakhrizod
 * https://www.linkedin.com/in/asror-zakirovcores\main\index
 * https://github.com/asror-z
 *
 */
return function ($username) use ($socket) {
    if ($socket->addedUser)
        return;
    global $usernames, $numUsers;
    // we store the username in the socket session for this client
    $socket->username = $username;
    ++$numUsers;
    $socket->addedUser = true;
    $socket->emit('login', array(
        'numUsers' => $numUsers
    ));
    // echo globally (all clients) that a person has connected
    $socket->broadcast->emit('user joined', [
        'username' => $socket->username,
        'numUsers' => $numUsers
    ]);
};
