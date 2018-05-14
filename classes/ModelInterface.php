<?php

namespace classes;

use interfaces\ComponentInterface;

/**
 * Interface ModelInterface
 *
 * @package classes
 */
interface ModelInterface extends ComponentInterface
{
    /**
     * @return int|null
     */
    public function getId();

    /**
     * @param int $id
     */
    public function setId(int $id);

    /**
     * @return bool
     */
    public function validate(): bool;

    /**
     * @return array
     */
    public function getErrors(): array;

    /**
     * @return array
     */
    public function getAttributes(): array;

    /**
     * @param array $data
     *
     * @return bool
     */
    public function load(array $data): bool;
}
