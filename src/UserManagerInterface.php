<?php

namespace DSteiner23\Light;

use DSteiner23\Light\Models\User;

/**
 * Interface UserManagerInterface
 * @package DSteiner23\Light
 */
interface UserManagerInterface
{
    /**
     * @param   string  $username
     * @param   string  $deviceType
     * @return  User
     */
    public function create($username, $deviceType);
}