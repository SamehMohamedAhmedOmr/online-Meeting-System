<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #print,
        #print * {
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

        .report-header {
        border-bottom: 5px double #000;
        padding-bottom: 1px;
        }

        .report-header h3{
            margin-bottom: 1px;
            border-bottom: 1px solid #000;
            padding-bottom: 15px;
        }

    }

</style>
<form dir="rtl" lang="ar" style="float:right; padding:25px;" class="col-md-12" id="print">
    <div class="report-header d-flex justify-content-center mb-5">
        <h3 class="text-center w-100" style="line-height: 2.7rem;">
            {{ $council_meeting_setup->Council_definition->council_name }} رقم
            {{ $council_meeting_setup->meeting_number }} بتاريخ <span  dir="ltr"> {{ $council_meeting_setup->meeting_date }}</span>
        </h3>
    </div>

    <p style="font-size: 1.2rem; line-height: 1.7rem;">

        اجتمعت {{ $council_meeting_setup->Council_definition->council_name }} رقم
        {{ $council_meeting_setup->meeting_number }} بتاريخ <span  dir="ltr">{{ $council_meeting_setup->meeting_date }}</span> الساعه
        {{ $council_meeting_setup->meeting_time }} برئاسه السيد/ه
        {{App\Rank::where('id',$council_member->faculty_member->rank_id)->pluck('rank_name')->first()}}
        /{{$council_member->faculty_member->User->name}}
        {{App\Position::where('id',$council_member->faculty_member->position_id)->pluck('position_name')->first()}}

        <span class="d-block my-3">و بحضور كل من :</span>


        @foreach ($attend as $item)
        <div class="row">

            <h5 class="col-6">
                {{App\Rank::where('id',$item->faculty_member->rank_id)->pluck('rank_name')->first()}}
                /{{$item->faculty_member->member_name}}
            </h5>
            <h5 class="col-6">
                {{App\Position::where('id',$item->faculty_member->position_id)->pluck('position_name')->first()}}
            </h5>
        </div>
        @endforeach

        @if($nattend)
            <span class="d-block my-3"> وعدم حضور كل من : </span>

            @foreach ($nattend as $item)
            <div class="row">
                <h5 class="col-md-4">
                    {{App\Rank::where('id',$item->faculty_member->rank_id)->pluck('rank_name')->first()}} /
                    {{$item->faculty_member->member_name}}
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

        @endif
    </p>

    <h5 style="text-align: center;text-decoration: underline;">استهلال</h5><br>
    <p style="font-size: 1.2rem; line-height: 1.7rem;">
        وقد استهل السيد/ه {{App\Rank::where('id',$council_member->faculty_member->rank_id)->pluck('rank_name')->first()}} /
        {{$council_member->faculty_member->User->name}} رئيس اللجنه ب "بسم الله الرحمن الرحيم"
        ورحب بالحضور ,وانتقل بعده لمناقشة جدول الاعمال علي النحو التالي:

        @foreach ($subjects as $indexKey => $item)
            @if($item->additional_subject==1)
                <h6 class="mb-3">ما يستجد من اعمال</h6>
            @endif

            <h4 class="mb-2" style="line-height:2.7rem;">(الموضوع رقم {{ ++$indexKey }} {{ $item->Subject_type->subject_type_name }})</h4>

            <p class='mb-3' style="font-size: 1.1rem; line-height: 1.7rem;">{{ $item->subject_description}}</p>


            @if($item->final_decision_description)
               <div class="mb-3">
                    <h4>القرار</h4>
                    <p style="font-size: 1.1rem; line-height: 1.7rem;">
                        اوصت {{ $council_meeting_setup->Council_definition->council_name }} رقم {{ $council_meeting_setup->meeting_number }}
                        بتاريخ <span  dir="ltr">{{ $council_meeting_setup->meeting_date }}</span> بـ{{$item->final_decision_description}}
                    </p>
               </div>
            @endif


            @if(!(\App\Subject_topic::where('council_meeting_subject_id',$item->id)->get())->isEmpty())
                <div class="topics mb-2">
                    <h4 class="mb-3"> لتتكون اللجنه من كلا من :</h4>

                    @foreach(\App\Subject_topic::join('position','subject_topic.list_of_member_order','=','position.id')->where('council_meeting_subject_id',$item->id)->orderBy('position.priority',
                            'ASC')->get() as $data)
                        <div class="row">
                            <p class="col-4">{{$data->faculty_member}}</p>

                            <p class="col-4">{{\App\Position::where('id',$data->list_of_member_order)->first()->position_name }}</p>
                            <p class="col-4">
                                @if($data->job ==0)
                                مشرفًا
                                @elseif($data->job==1)
                                مقررًا
                                @else
                                عضوًا
                                @endif
                                <br>
                            </p>
                        </div>

                    @endforeach
                </div>
            @endif

        @endforeach
    </p>

    <h5 style="float:left">
        <span class="d-block mb-3">رئيس اللجنه</span>

        <span> ا.د/{{$council_member->faculty_member->User->name}}</span>
    </h5>

    <h5 style="float:right">
       <span class="d-block mb-3"> امين اللجنه</span>
        @php
            $member = $council_members->where('type',1)->first();
            if (isset($member)) {
                $Staff = $member->faculty_member->User->name;
            }
            else{
                    $Staff = null;
            }
        @endphp
        <span> {{ $Staff }} </span>
    </h5>

</form>

<button class="btn btn-dark" onclick="myFunction()">اطبع التقرير</button>

<script>
    function myFunction() {
        window.print();
    }

</script>
