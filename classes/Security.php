<?php

namespace classes;

use interfaces\ComponentInterface;

/**
 * Class Security
 *
 * @package classes
 */
class Security implements ComponentInterface
{
    use ConstructTrait;

    private $salt;

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string $password
     *
     * @return string
     */
    public function cryptPassword($password)
    {
        // md5 for test purposes
        return md5($password . $this->salt);
    }
}
