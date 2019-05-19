<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject_attachment extends Model
{  public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subject_attachment';

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
    protected $fillable = ['meeting_number','subject_id','attachment_document'];

    public function Council_meeting_setup()
    {
      return $this->belongsTo('App\Council_meeting_setup');

    }

    public function Council_meeting_subject()
    {
      return $this->belongsTo('App\Council_meeting_subject');

    }

}
