<?php

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Service\TaskService;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;
use Hyperf\Validation\ValidationException;


class TaskController
{

    #[Inject]
    protected TaskService $taskService;

    #[Inject]
    protected ValidatorFactoryInterface $validatorFactory;

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

        $validator = $this->validatorFactory->make(
            $request->all(),
            [
                'title' => 'required|filled|string|min:1',
                'description' => 'required|filled|string|min:1',
            ],
            [
                'title.required' =>  'Defina um :attribute para a criação da tarefa',
                'description.required' => 'Impossivel criar terefa sem :attribute',
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

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

        $validator = $this->validatorFactory->make(
            $request->all(),
            [
                'title' => 'filled|string|min:1',
                'description' => 'filled|string|min:1',
                'is_done' => 'integer|between:0,1'
            ],
            [
                'string' => ':attribute deve ser do tipo string',
                'integer' => ':attribute deve ser do tipo integer',
                'between' => ':attribute deve ser um integer e não deve ser diferente de 0 ou 1',
                'min:' => ':attribute deve conter ao menos um caracter',
                'filled' => ':attribute não pode ser vazio'
            ]
        );

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }


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
