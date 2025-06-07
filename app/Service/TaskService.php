<?php

namespace App\Service;

use App\Model\Task;
use Hyperf\HttpMessage\Exception\NotFoundHttpException;

class TaskService
{
    public function getAllTasks()
    {
        $task = Task::all();

        if (!$task) {
            throw new NotFoundHttpException('Nenhum registro encontrado');
        }

        return $task;
    }

    public function findTaskById(int $id): Task
    {
        $task = Task::find($id);

        if (!$task) {
            throw new NotFoundHttpException('Task nao encontrada para o id: ' . $id);
        }

        return $task;
    }

    public function createTask(array $data): Task
    {
        return Task::create($data);
    }

    public function updateTask(int $id, array $data): Task
    {
        $task = $this->findTaskById($id);

        $filteredData = array_filter($data, function ($value) {
            return $value !== null;
        });

        $task->update($filteredData);
        $task->refresh();
        return $task;
    }

    public function deleteTask(int $id): bool
    {
        $task = $this->findTaskById($id);
        return $task->delete();
    }

    public function findByIsDoneTrue(int $status)
    {
        if ($status == 1) {
            $tasks = Task::where('is_done', '=', 1)->get();
        } elseif ($status == 0) {
            $tasks = Task::where('is_done', '=', 0)->get();
        }

        return $tasks;
    }
}
