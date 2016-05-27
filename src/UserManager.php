<?php

namespace DSteiner23\Light;

use DSteiner23\Light\Exception\InvalidDeviceTypeException;
use DSteiner23\Light\Exception\InvalidUsernameException;
use DSteiner23\Light\Models\User;

/**
 * Class UserManager
 * @package DSteiner23\Light
 */
final class UserManager implements UserManagerInterface
{
    /**
     * @param   string $username
     * @param   string $devicetype
     * @return  User
     * @throws  InvalidUsernameException
     * @throws  InvalidDeviceTypeException
     */
    public function create($username, $devicetype)
    {
        if (!$this->isValidUsername($username)) {
            throw new InvalidUsernameException(sprintf('Username %s is invalid', $username));
        }

        if (!$this->isValidDeviceType($devicetype)) {
            throw new InvalidDeviceTypeException(sprintf('Device %s is invalid', $devicetype));
        }

        $user = new User();
        $user->setUsername($username);
        $user->setDevicetype($devicetype);

        return $user;
    }

    /**
     * @param   string  $username
     * @return  bool
     */
    private function isValidUsername($username)
    {
        $length = strlen($username);

        if ($length < 10 || $length > 40) {
            return false;
        }

        if (preg_match('/^[a-zA-Z0-9]+$/', $username)) {
            return true;
        }

        return false;
    }

    /**
     * @param   string  $devicetype
     * @return  bool
     */
    private function isValidDeviceType($devicetype)
    {
        $length = strlen($devicetype);

        if ($length < 1 || $length > 40) {
            return false;
        }

        return true;
    }
}
