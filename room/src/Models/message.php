<?php

namespace ChatApp\Models;
/**
*
*/
use Illuminate\Database\Eloquent\Model as Model;

class Message extends Model
{
    protected $table='messages';

    protected $fillable = ['text'];
}

?>