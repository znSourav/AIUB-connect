<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $table="users";
  protected $primaryKey="userId";
  public $timestamps=false;
  public $keyType = 'string';
}
