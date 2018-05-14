<?php

namespace classes;

use controllers\DefaultController;
use interfaces\ComponentInterface;

/**
 * Class UrlResolver
 *
 * @package classes
 */
class UrlResolver implements ComponentInterface
{
    /**
     * @var array
     */
    protected $patterns = [];

    /**
     * ComponentInterface constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->patterns = $config['rules'] ?? [];
    }

    /**
     * @return array
     */
    public function resolve()
    {
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '')['path'];
        if ('/' === $path) {
            return ['class' => DefaultController::class, 'action' => 'actionIndex'];
        }

        if (array_key_exists($path, $this->patterns)) {
            return ['class' => $this->patterns[$path][0], 'action' => 'action' . ucfirst($this->patterns[$path][1])];
        }
    }
}
