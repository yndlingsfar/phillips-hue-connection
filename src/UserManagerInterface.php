<?php

namespace DSteiner23\Light;

/**
 * Interface UserManagerInterface
 * @package DSteiner23\Light
 */
interface UserManagerInterface
{
    /**
     * @param   string  $username
     * @param   string  $devicetype
     * @return  bool
     */
    public function create($username, $devicetype);
}