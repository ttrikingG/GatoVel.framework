<?php

namespace app\nucleo\protons\middlewares\collections;

class Middleware
{
	private array $middlewares = [];

	public static function middleware(): self
	{
		return new self();
	}

	public function session(): self
	{
		$this->middlewares[] = function () {
			if (session_status() === PHP_SESSION_NONE) session_start();
		};
		return $this;
	}

	public function csrf(): self
	{
		$this->middlewares[] = function () {
			if (
				$_SERVER['REQUEST_METHOD'] === 'POST' ||
				$_SERVER['REQUEST_METHOD'] === 'PUT' ||
				$_SERVER['REQUEST_METHOD'] === 'DELETE'
			) {

				$token = $_POST['_csrf'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;

				if (!$token || !isset($_SESSION['_csrf']) || $token !== $_SESSION['_csrf']) {
					http_response_code(403);
					die('Token CSRF inválido ou ausente.');
				}
			}
		};
		return $this;
	}

	public function auth(): self
	{
		$this->middlewares[] = function () {
			if (!isset($_SESSION['admin_logged'])) {
				redirect('/login');
				exit;
			}
		};
		return $this;
	}

	public function execute(): void
	{
		foreach ($this->middlewares as $middleware) {
			$middleware();
		}
	}
}
