<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connect extends Model
{
  protected $table="connected";
  protected $primaryKey="userId";
  public $timestamps=false;
  public $keyType = 'string';
}
