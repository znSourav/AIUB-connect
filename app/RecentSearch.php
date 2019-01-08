<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecentSearch extends Model
{
  protected $table="recent_search";
  protected $primaryKey="userId";
  public $timestamps=false;
  public $keyType = 'string';
}
