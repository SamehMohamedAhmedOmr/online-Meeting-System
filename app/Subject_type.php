<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject_type extends Model
{  public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subject_type';

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
    protected $fillable = ['subject_type_name'];

    public function Council_meeting_subject()
    {
      return $this->hasMany('App\Council_meeting_subject');

    }
}
