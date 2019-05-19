<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{  public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rank';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['rank_name'];
    public function Faculty_member()
    {
      return $this->hasMany('App\Faculty_member');

    }

}
