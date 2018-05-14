<?php

namespace models;

use classes\App;
use classes\Model;
use classes\ModelInterface;

/**
 * Class User
 *
 * @package models
 */
class User extends Model implements ModelInterface
{
    public $username;
    public $password;

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = App::getInstance()->security->cryptPassword($password);
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function load(array $data): bool
    {
        $ref = new \ReflectionClass(static::class);
        $fields = $ref->getProperties(\ReflectionProperty::IS_PUBLIC);
        $load = false;
        foreach ($fields as $field) {

            if (array_key_exists($field->name, $data)) {
                $this->{$field->name} = $data[$field->name];
                $load = true;
            }
        }

        return $load;
    }

    /**
     * @param $password
     *
     * @return bool
     */
    public function checkPassword(string $password): bool
    {
        return $this->password === App::getInstance()->security->cryptPassword($password);
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $this->errors = [];
        foreach (['username', 'password'] as $field) {
            if (empty(trim($this->$field))) {
                $this->errors[$field] = $field . ' is required!';
            }
        }

        return 0 === count($this->errors);
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        $attributes = parent::getAttributes();

        return $attributes;
    }
}
