<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouncilMember extends Model
{
    public $timestamps = false;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'council_member';

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
    protected $fillable = ['council_definition_id','faculty_member_id','type','start_date_of_membership','end_date_of_membership','list_of_membership_order','user_name','password'];
    public function Council_definition()
    {
      return $this->belongsTo('App\Council_definition');

    }
    public function Faculty_member()
    {
      return $this->belongsTo('App\Faculty_member');

    }
    public function List_of_membership_order()
    {
      return $this->belongsTo('App\Position');

    }

    public function Votes()
    {
      return $this->hasMany('App\Votes');

    }

}
