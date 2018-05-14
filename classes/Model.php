<?php

namespace classes;

/**
 * Class Model
 *
 * @property int $id
 * @package classes
 */
abstract class Model
{
    use ConstructTrait;

    protected $id;
    protected $errors = [];

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
            if (in_array($field->name, $data)) {
                $this->{$field->name} = $data;
                $load = true;
            }
        }

        return $load;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        $fields = get_object_vars($this);
        unset($fields['errors']);

        return $fields;
    }
}
