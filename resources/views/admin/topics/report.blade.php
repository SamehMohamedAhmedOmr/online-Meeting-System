<form dir="rtl" lang="ar" style="float:right;">

@foreach ($subjects as $indexKey => $item)
{{$item->id}}
( الموضوع رقم {{ ++$indexKey }} {{ $item->Subject_type->subject_type_name }} )
    <br>
    {{ $item->subject_description}}
    <br>
    @if(\App\Subject_topic::where('council_meeting_subject_id',$item->id)->get())
     لتتكون اللجنه من كلا من :
@endif
   <br>
   <div class="row">

   @foreach(\App\Subject_topic::where('council_meeting_subject_id',$item->id)->get() as $data)
   @if($data->council_member_ID)
 {{\App\Faculty_member::where('id',$data->council_member_ID)->first()->faculty_member}}
   @else
   <h4 class="col-md-4">{{$data->faculty_member}}</h4>
@endif
   <h4 class="col-md-4"></h4>
   <h4 class="col-md-4">
        @if($data->job ==0)
        Supervisor
        @elseif($data->job==1)
        Rapporteur
        @else
        Member
        @endif
        <br>
   </h4>

   @endforeach
   </div>
@endforeach
</form>
