<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Project;
use App\Models\User;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'is_done', 'project_id', 'due_date', 'assigned_to'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
