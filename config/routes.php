<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::get('/tasks', 'App\Controller\TaskController@index');
Router::get('/tasks/{id}', 'App\Controller\TaskController@show');
Router::post('/tasks', 'App\Controller\TaskController@store');
Router::put('/tasks/{id}', 'App\Controller\TaskController@update');
Router::delete('/tasks/{id}', 'App\Controller\TaskController@destroy');
