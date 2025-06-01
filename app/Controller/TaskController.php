<?php

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Service\TaskService;

class TaskController
{

    #[Inject]
    protected TaskService $taskService;

    public function index(ResponseInterface $response)
    {
        $tasks = $this->taskService->getAllTasks();
        return $response->json([
            'data' => $tasks,
            'total' => count($tasks),
        ]);
    }

    public function show(ResponseInterface $response, int $id)
    {
        return $response->json(['data' => $this->taskService->findTaskById($id)]);
    }

    public function store(RequestInterface $request, ResponseInterface $response)
    {
        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'is_done' => $request->input('is_done', false)
        ];

        $createdTask = $this->taskService->createTask($data);
        return $response->json([
            'message' => "Tarefa Criada!",
            'data' => $createdTask,
        ])->withStatus(201);
    }

    public function update(RequestInterface $request, ResponseInterface $response, int $id)
    {

        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'is_done' => $request->input('is_done')
        ];

        $updatedTask = $this->taskService->updateTask($id, $data);
        return $response->json([
            'message' => "Atualização Concluída",
            'data' => $updatedTask,
        ])->withStatus(200);
    }

    public function destroy(ResponseInterface $response, int $id)
    {
        $this->taskService->deleteTask($id);
        return $response->json(['message' => "Registro Deletado"])->withStatus(204);
    }
}
