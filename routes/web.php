<?php

use Core\Router;
use App\Http\Controllers\IndexController;

$router = new Router();

$router->get('/register', [IndexController::class, 'register']);
