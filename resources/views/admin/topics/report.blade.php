<style>
@media print {
    body * {
    visibility: hidden;
  }
  #print, #print * {
    visibility: visible;
  }
    #print {
        position: absolute;
        left: 0;
        top: 0;
        size: auto;
        margin: 0;
      }
      a[href]:after {
        content: none !important;
    }

  }
</style>
<form dir="rtl" lang="ar" style="float:right; padding:25px;" class="col-md-12" id="print">
   <h3>
    جدول اعمال {{ $council_meeting_setup->Council_definition->council_name }} رقم {{ $council_meeting_setup->meeting_number }} بتاريخ {{ $council_meeting_setup->meeting_date }} الساعه  {{ $council_meeting_setup->meeting_time }}
</h3>
<hr>
    <hr style="height:1px;border:none;color:#333;background-color:#333;" />
@foreach ($subjects as $indexKey => $item)
@if($item->additional_subject==1)
ما يستجد من اعمال
<br>
@endif
<h2>
( الموضوع رقم {{ ++$indexKey }} {{ $item->Subject_type->subject_type_name }} )
</h2>
<br>
<h3>
    {{ $item->subject_description}}
</h3>
    <br>
    @if(!(\App\Subject_topic::where('council_meeting_subject_id',$item->id)->get())->isEmpty())
   <h4 > لتتكون اللجنه من كلا من :
    </h4>
    <br>
   @foreach(\App\Subject_topic::where('council_meeting_subject_id',$item->id)->orderBy('list_of_member_order', 'ASC')->get() as $data)
   <div class="row">
   <h5 class="col-md-4">{{$data->faculty_member}}</h5>

   <h5 class="col-md-4">{{\App\Position::where('id',$data->list_of_member_order)->first()->position_name }}</h5>
   <h5 class="col-md-4">
        @if($data->job ==0)
        Supervisor
        @elseif($data->job==1)
        Rapporteur
        @else
        Member
        @endif
        <br>
   </h5>
</div>

   @endforeach
   @endif
   <br>

@endforeach
<h5 style="float:left">
    رئيس اللجنه
    <br>
    ا.د/{{$council_member->faculty_member->member_name}}
    </h5>
</form>
<button onclick="myFunction()">Print this page</button>

<script>

function myFunction() {
  window.print();
}
</script>
