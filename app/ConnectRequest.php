<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConnectRequest extends Model
{
  protected $table="connect_request";
  protected $primaryKey="request_id";
  public $timestamps=false;
}
