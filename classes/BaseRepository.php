<?php

namespace classes;

/**
 * Class BaseRepository
 *
 * @package classes
 */
class BaseRepository implements RepositoryInterface
{
    use ConstructTrait;

    protected $modelClass;
    public $table;

    /**
     * @param int $id
     *
     * @return ModelInterface
     */
    public function getById(int $id): ModelInterface
    {
        $models = $this->getByParams(['id' => $id], null, 1);

        return array_pop($models);
    }

    /**
     * @param array $params
     * @param string $order
     * @param string $limit
     *
     * @return array
     */
    public function getByParams(array $params, $order = null, $limit = null): array
    {
        $res = App::getInstance()->db->select($this->table, $params, '*', $order, $limit);

        return $res->fetchAll(\PDO::FETCH_CLASS, $this->modelClass);
    }

    /**
     * @param null $order
     * @param null $limit
     *
     * @return ModelInterface[]
     */
    public function getAll($order = null, $limit = null): array
    {
        $models = $this->getByParams([], $order, $limit);

        return $models;
    }

    /**
     * @param ModelInterface $model
     *
     * @return bool
     */
    public function save(ModelInterface $model): bool
    {
        if ($model->getId()) {
            return App::getInstance()->db->update($this->table, $model->getAttributes(), ['id' => $model->getId()]);
        }

        $id = App::getInstance()->db->insert($this->table, $model->getAttributes());
        if ($id) {
            $model->setId((int)$id);
        }

        return (bool)$id;
    }
}