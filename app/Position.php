<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{  public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'position';

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
    protected $fillable = ['position_name'];

    public function Faculty_member()
    {
      return $this->hasMany('App\Faculty_member');

    }
    public function CouncilMember()
    {
      return $this->hasMany('App\CouncilMember');

    }
}
