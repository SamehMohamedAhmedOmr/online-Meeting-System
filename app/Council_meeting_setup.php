<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Council_meeting_setup extends Model
{  public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'council_meeting_setup';

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
    protected $fillable = ['meeting_number','council_definition_id', 'meeting_date','meeting_time','close'];
    public function Subject_attachment()
    {
      return $this->hasMany('App\Subject_attachment');

    }
    public function Meeting_attendance()
    {
      return $this->hasMany('App\Meeting_attendance','meeting_number','id');

    }
    public function Council_meeting_subject()
    {
      return $this->hasMany('App\Council_meeting_subject','council_meeting_id','id');

    }
    public function Council_definition()
    {
      return $this->belongsTo('App\Council_definition');

    }


}
