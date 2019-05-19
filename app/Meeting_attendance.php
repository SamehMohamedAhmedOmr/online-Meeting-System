<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting_attendance extends Model
{  public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'meeting_attendance';

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
    protected $fillable = ['meeting_number', 'faculty_member_id', 'attend', 'excuse', 'excuse_description'];
    public function Council_meeting_setup()
    {
      return $this->belongsTo('App\Council_meeting_setup');

    }
    public function Faculty_member()
    {
      return $this->belongsTo('App\Faculty_member');

    }

}
