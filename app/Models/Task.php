<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'project_id',
        'priority'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new UserScope);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tasks() {
        return $this->belongsTo(Project::class);
    }    
}
