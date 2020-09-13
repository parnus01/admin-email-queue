<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskEmail extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'task_email';
    protected $guarded = ['id'];
    public $incrementing = true;
}
