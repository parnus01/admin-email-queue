<?php

namespace App\Jobs;

use App\Mail\EmailForQueuing;
use App\Models\TaskEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class ProcessEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $task;
    /**
     * @var EmailForQueuing
     */
    protected $email;
    /**
     * @var bool
     */
    protected $isFail;

    /**
     * Create a new job instance.
     *
     * @param $task
     */
    public function __construct(TaskEmail $task)
    {
        $this->isFail = false;
        $this->task = $task;
        $this->email = new EmailForQueuing($task);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $recipients = $this->getRecipients($this->task->recipients);
            Mail::to($recipients)->send($this->email);
        } catch (\Exception $e) {
            /*Handle failure case*/
            $this->isFail = true;
        }
        $this->updateTaskStatus();
    }

    protected function getRecipients($recipients)
    {
        return explode(',', $recipients);
    }

    protected function updateTaskStatus()
    {
        $status = ($this->isFail === true) ? -1 : 1;

        $this->task->status = $status;
        $this->task->save();
    }
}
