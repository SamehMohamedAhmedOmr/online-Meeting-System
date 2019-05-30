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
    <form dir="rtl" lang="ar" style="float:right;" class="col-md-12" id="print">
       <h3>
     {{ $council_meeting_setup->Council_definition->council_name }} رقم {{ $council_meeting_setup->meeting_number }} بتاريخ {{ $council_meeting_setup->meeting_date }} الساعه  {{ $council_meeting_setup->meeting_time }}
    </h3>
    <hr>
        <hr style="height:1px;border:none;color:#333;background-color:#333;" />
        <h5>

            اجتمعت  {{ $council_meeting_setup->Council_definition->council_name }} رقم {{ $council_meeting_setup->meeting_number }} بتاريخ   {{ $council_meeting_setup->meeting_date }} الساعه  {{ $council_meeting_setup->meeting_time }} برئاسه السيد/ه  {{App\Rank::where('id',$council_member->faculty_member->rank_id)->pluck('rank_name')->first()}} /{{$council_member->faculty_member->member_name}} {{App\Position::where('id',$council_member->faculty_member->position_id)->pluck('position_name')->first()}}<br>بحضور كل من :<br>

            @foreach ($attend as $item)
            <div class="row">

<h5 class="col-md-4">
        {{App\Rank::where('id',$item->faculty_member->rank_id)->pluck('rank_name')->first()}} /{{$item->faculty_member->member_name}}
</h5>
<h5 class="col-md-4">
{{App\Position::where('id',$item->faculty_member->position_id)->pluck('position_name')->first()}}
</h5>
</div>
@endforeach
@if($nattend)
          <br>  وعدم حضور كل من : <br>

            @foreach ($nattend as $item)
            <div class="row">
            <h5 class="col-md-4">
                    {{App\Rank::where('id',$item->faculty_member->rank_id)->pluck('rank_name')->first()}} / {{$item->faculty_member->member_name}}
            </h5>
            <h5 class="col-md-4">
                    {{App\Position::where('id',$item->faculty_member->position_id)->pluck('position_name')->first()}}
            </h5>
            @if($item->excuse==1)
            <h5 class="col-md-4">
                   وذلك ل {{$item->excuse_description}}
            </h5>
            @endif
        </div>
            @endforeach


        </h5>
        @endif
        <h5 style="text-align: center;text-decoration: underline;">استهلال</h5><br>
          وقد استهل السيد/ه {{App\Rank::where('id',$council_member->faculty_member->rank_id)->pluck('rank_name')->first()}} / {{$council_member->faculty_member->member_name}} رئيس اللجنه   ب بسم الله الرحمن الرحيم
          ورحب بالحضور ,وانتقل بعدع لمناقشه جدول الاعمال علي النحو التالي:
          @foreach ($subjects as $indexKey => $item)
    @if($item->additional_subject==1)
    ما يستجد من اعمال
    <br>
    @endif
    <h3>
    ( الموضوع رقم {{ ++$indexKey }} {{ $item->Subject_type->subject_type_name }} )
    </h3>

    <br>
    <h3>
        {{ $item->subject_description}}
    </h3>
        <br>
        @if($item->final_decision_description)
    اوصت {{ $council_meeting_setup->Council_definition->council_name }} رقم {{ $council_meeting_setup->meeting_number }} بتاريخ   {{ $council_meeting_setup->meeting_date }} ب{{$item->final_decision_description}}
    @endif
    <br>
        @if(!(\App\Subject_topic::where('council_meeting_subject_id',$item->id)->get())->isEmpty())
       <h4 > وتتكون اللجنه من كلا من :
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
        <h5 style="float:right">
                امين اللجنه
                <br>
            {{Auth::user()->name}}
                </h5>
    </form>
    <button onclick="myFunction()">Print this page</button>

    <script>

    function myFunction() {
      window.print();
    }
    </script>
