<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Council_meeting_subject extends Model
{  public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'council_meeting_subject';

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
    protected $fillable = ['council_definition','council_meeting_id','subject_description','additional_subject','subject_type_id','faculty_id','department_id','final_decision_description','final_decision','person_redirected','next_council_definition_id'];

    public function Council_definition()
    {
      return $this->belongsTo('App\Council_definition');
    }

    public function Council_meeting_setup()
    {
      return $this->belongsTo('App\Council_meeting_setup','council_meeting_id','id');
    }

    public function Subject_type()
    {
      return $this->belongsTo('App\Subject_type');
    }

    public function Faculty()
    {
      return $this->belongsTo('App\Faculty');
    }

    public function Department()
    {
      return $this->belongsTo('App\Department');
    }

    public function Subject_attachment()
    {
      return $this->hasMany('App\Subject_attachment','subject_id','id');
    }

    public function PersonRedirect()
    {
      return $this->belongsTo('App\User','person_redirected','id');
    }

    public function next_council_definition()
    {
      return $this->belongsTo('App\Council_definition','next_council_definition_id','id');
    }

    public function Votes()
    {
      return $this->hasMany('App\Votes');
    }

}
