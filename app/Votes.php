<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Votes';

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
    protected $fillable = ['council_member_id', 'vote','Council_meeting_subject_id','commet'];

    public function CouncilMember()
    {
      return $this->belongsTo('App\CouncilMember','council_member_id','id');

    }
    public function Council_meeting_subject()
    {
      return $this->belongsTo('App\Council_meeting_subject');

    }

}
