<?php
    return [
            'name' => 'dth-auth',
            'author' => 'Alexandru Lupaescu a.k.a alexanderdth',
            'email' => 'alexandrulupaescu@gmail.com',
            'title' => 'DTH-Labs Authentication Package',
            'description' => 'Allows implementation of an authentication engine similar to Laravels, but easier and faster.',
            'version' => '1.0',
            'requires' => '',
            'classMap' =>
                [
                    /**
                     * Class load order
                     * no namespace required
                     * folders are allowed as well
                     */
                    'AuthenticateUtils.php',
                    'libs/class.php'
                ],

    ];