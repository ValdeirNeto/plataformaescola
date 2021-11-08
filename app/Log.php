<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'log';
    protected $fillable = ['name', 'email', 'type', 'action', 'date', 'before_action', 'after_action'];
    public $timestamps = false;
}
