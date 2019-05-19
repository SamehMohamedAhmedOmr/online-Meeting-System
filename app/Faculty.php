<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{  public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faculty';

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
    protected $fillable = ['faculty_name','logo'];


    public function Faculty_member()
    {
      return $this->hasMany('App\Faculty_member');

    }
    public function Council_meeting_subject()
    {
      return $this->hasMany('App\Council_meeting_subject');

    }
    public function Council_definintion()
    {
      return $this->hasMany('App\Council_definintion');

    }

}
