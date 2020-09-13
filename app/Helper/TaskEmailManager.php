<?php

namespace App\Helper;

use App\Jobs\ProcessEmail;
use App\Models\TaskEmail;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TaskEmailManager
{
    public static function getPendingMail()
    {
        return TaskEmail::where('status', 0)->get();
    }

    public static function create($payload)
    {
        $task = self::createTaskRecord($payload);
        if (!$task->save()) {
            throw new \Exception('Invalid Request');
        }
        ProcessEmail::dispatch($task)->delay(Carbon::parse($task->exec_time));
        return ['status' => 0];

    }

    private static function createTaskRecord($payload)
    {
        $task = new TaskEmail();
        $task->status = 0;
        $task->title = $payload['title'];
        $task->content = $payload['content'];
        $task->recipients = $payload['recipients'];
        $task->exec_time = $payload['send_date'];
        return $task;
    }
}