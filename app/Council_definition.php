<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Council_definition extends Model
{  public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'council_definition';

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
    protected $fillable = ['council_name', 'number_of_members','faculty_id'];


    public function Council_meeting_subject()
    {
      return $this->hasMany('App\Council_meeting_subject');
    }

    public function Council_meeting_setup()
    {
      return $this->hasMany('App\Council_meeting_setup');
    }

    public function CouncilMember()
    {
      return $this->hasMany('App\CouncilMember');
    }

    public function Faculty()
    {
      return $this->belongsTo('App\Faculty','faculty_id','id');
    }

    public function AsNextMeetingSubject()
    {
      return $this->hasMany('App\Council_meeting_subject');
    }
}
