<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostInfo extends Model
{
  protected $table="postinfo";
  protected $primaryKey="post_id";
  public $timestamps=false;
  public $keyType = 'string';
}
