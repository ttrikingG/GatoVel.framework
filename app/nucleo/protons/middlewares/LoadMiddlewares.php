<?php

namespace app\nucleo\protons\Loadmiddlewares;

use app\nucleo\protons\middlewares\collections\Middleware;

class LoadMiddleware
{
    private static array $namespaces = [
        'site'  => 'app\nucleo\protons\controllers\site\\',
        // 'admin' => 'app\nucleo\protons\controllers\admin\\',
    ];

    public static function runMiddlewares(string $controllerName, string $method): void
    {
        // 🔹 Carrega map externo
        $map = require __DIR__ . '/LoadMiddlewares.php';

        $middlewares = $map[$controllerName][$method] ?? [];

        $chain = Middleware::middleware();
        foreach ($middlewares as $m) {
            if (method_exists($chain, $m)) {
                $chain->$m();
            }
        }

        $chain->execute();
    }
}


