<form dir="rtl" lang="ar" style="float:right;" class="col-md-12">

@foreach ($subjects as $indexKey => $item)
@if($item->additional_subject==1)
ما يستجد من اعمال
<br>
@endif
( الموضوع رقم {{ ++$indexKey }} {{ $item->Subject_type->subject_type_name }} )
    <br>
    {{ $item->subject_description}}
    <br>
    @if(!(\App\Subject_topic::where('council_meeting_subject_id',$item->id)->get())->isEmpty())
     لتتكون اللجنه من كلا من :
   <br>
   @foreach(\App\Subject_topic::where('council_meeting_subject_id',$item->id)->orderBy('list_of_member_order', 'ASC')->get() as $data)
   <div class="row">
   <h4 class="col-md-4">{{$data->faculty_member}}</h4>

   <h4 class="col-md-4">{{\App\Position::where('id',$data->list_of_member_order)->first()->position_name }}</h4>
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
</div>

   @endforeach
   @endif

   <br>
@endforeach
</form>
