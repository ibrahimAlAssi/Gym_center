<?php

namespace App\Domains\Tasks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduleTask extends Model
{
    use HasFactory;

    protected $table = 'schedule_task';

    public $timestamps = true;

    protected $fillable = [
        'schedule_id',
        'task_id',
        'repeat',
        'weight',
        'complete',
    ];

    protected $cast = [
        'repeat' => 'integer',
        'weight' => 'double',
        'complete' => 'boolean',
    ];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
