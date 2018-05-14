<?php

namespace classes;

/**
 * Trait ConstructTrait
 *
 * @package classes
 */
trait ConstructTrait
{
    /**
     * ComponentInterface constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $methods = get_class_methods(static::class);
        $vars = get_class_vars(static::class);
        foreach ($config as $key => $val) {
            $setter = 'set' . ucfirst($key);
            if (in_array($setter, $methods)) {
                $this->$setter($val);
            } elseif (array_key_exists($key, $vars)) {
                $this->$key = $val;
            }
        }
    }
}