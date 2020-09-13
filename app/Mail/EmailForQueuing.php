<?php

namespace App\Mail;

use App\Models\TaskEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailForQueuing extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var TaskEmail
     */
    protected $task;

    /**
     * Create a new message instance.
     *
     * @param TaskEmail $task
     */
    public function __construct(TaskEmail $task)
    {
        $this->task = $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return
            $this->from('danusorn@assignment.com', 'Mailtrap')
                ->view('emails.task')
                ->subject($this->task->title)  //<= how to pass variable on this subject
                ->with([
                    'content' => $this->task->content, //this works without queue
                ]);
    }
}
