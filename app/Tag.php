<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = [
        'name',
    ];

    public function tasks()
    {
        return $this->belongsToMany('App\Task', 'tag_task');
    }
}
