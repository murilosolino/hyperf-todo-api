<?php

namespace App\Service;

use App\Model\Task;
use Hyperf\HttpMessage\Exception\NotFoundHttpException;

class TaskService
{

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

    public function filter(array $params)
    {
        $title = $params['title'] ?? null;
        $is_done = $params['is_done'] ?? null;

        $query = Task::query();

        if ($title === null && $is_done === null) {
            return Task::all();
        }

        if (isset($title)) {
            $query->where('title', 'like', "%{$title}%");
        }

        if (isset($is_done)) {
            $query->where('is_done', '=', $is_done);
        }

        return $query->get();
    }
}
