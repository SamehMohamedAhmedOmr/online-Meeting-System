<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{  public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'department';

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
    protected $fillable = ['department_name'];
    public function Faculty_member()
    {
      return $this->hasMany('App\Faculty_member');

    }
    public function Council_meeting_subject()
    {
      return $this->hasMany('App\Council_meeting_subject');

    }

}
