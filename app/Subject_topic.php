<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject_topic extends Model
{
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subject_topic';

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
    protected $fillable = ['council_meeting_subject_id','faculty_member','council_member_ID','list_of_member_order','position_id','job'];

    public function Council_meeting_subject()
    {
      return $this->belongsTo('App\Council_meeting_subject');

    }
    public function CouncilMember()
    {
      return $this->belongsTo('App\CouncilMember','council_member_id','id');

    }
    public function List_of_membership_order()
    {
      return $this->belongsTo('App\Position');

    }

}
