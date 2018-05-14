<?php

namespace classes;

use interfaces\ComponentInterface;

/**
 * Interface RepositoryInterface
 *
 * @package classes
 */
interface RepositoryInterface extends ComponentInterface
{
    /**
     * @param int $id
     *
     * @return ModelInterface
     */
    public function getById(int $id): ModelInterface;

    /**
     * @param array $params
     * @param string $order
     * @param string $limit
     *
     * @return array
     */
    public function getByParams(array $params, $order, $limit): array;

    /**
     * @param $order
     * @param $limit
     *
     * @return array
     */
    public function getAll($order, $limit): array;

    /**
     * @param ModelInterface $model
     *
     * @return bool
     */
    public function save(ModelInterface $model): bool;
}
