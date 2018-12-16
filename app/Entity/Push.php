<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Push extends Model
{
    protected $fillable = ['repository_name', 'pusher', 'pushed_at', 'number_of_commits'];
}
