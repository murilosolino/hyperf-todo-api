<?php

namespace App\Controller;

use App\Model\Task;
use Hyperf\HttpMessage\Exception\NotFoundHttpException;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

class TaskController
{

    public function index()
    {
        $task = Task::all();

        if (!$task) {
            throw new NotFoundHttpException('Nenhum registro encontrado');
        }

        return $task;
    }

    public function show(int $id)
    {
        $task = Task::find($id);

        if (!$task) {
            throw new NotFoundHttpException('Task nao encontrada para o id: ' . $id);
        }

        return $task;
    }

    public function store(RequestInterface $request, ResponseInterface $response)
    {

        $title = $request->input('title');
        $description = $request->input('description');
        $is_done = $request->input('is_done');

        $arr = ['title' => $title, 'description' => $description, 'is_done' => $is_done];
        Task::create($arr);
        return $response->json(['message' => "Tarefa Criada!"])->withStatus(201);
    }

    public function update(RequestInterface $request, ResponseInterface $response, int $id)
    {

        $task = $this->show($id);

        $title = $request->input('title', $task->title);
        $description = $request->input('description', $task->description);
        $is_done = $request->input('is_done', $task->is_done);

        $arr = ['title' => $title, 'description' => $description, 'is_done' => $is_done];
        $task->update($arr);
        return $response->json(['message' => "Atualização Concluída"])->withStatus(200);
    }

    public function destroy(ResponseInterface $response, int $id)
    {
        $task = $this->show($id);
        $task->delete();
        return $response->json(['message' => "Atualização Concluída"])->withStatus(204);
    }
}
