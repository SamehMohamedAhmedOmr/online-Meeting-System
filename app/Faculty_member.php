<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty_member extends Model
{
     public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faculty_member';

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
    protected $fillable = ['member_name','rank_id','faculty_id','position_id','department_id','user_id'];
    public function Meeting_attendance()
    {
      return $this->hasMany('App\Meeting_attendance');

    }
    public function User()
    {
      return $this->belongsTo('App\User','user_id','id');

    }

    public function Rank()
    {
      return $this->belongsTo('App\Rank');

    }

    public function Faculty()
    {
      return $this->belongsTo('App\Faculty');

    }
    public function Position()
    {
      return $this->belongsTo('App\Position');

    }
    public function Department()
    {
      return $this->belongsTo('App\Department');

    }
    public function CouncilMember()
    {
      return $this->hasMany('App\CouncilMember','faculty_member_id','id');

    }
}
