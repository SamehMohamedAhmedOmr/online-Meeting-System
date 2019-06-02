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

</style>

<form dir="rtl" lang="ar" style="float:right; padding:25px;" class="col-md-12" id="print">
    <div class="report-header d-flex justify-content-center mb-5">
        <h3 class="text-center w-100" style="line-height: 2.7rem;">
            جدول اعمال {{ $council_meeting_setup->Council_definition->council_name }} رقم
            {{ $council_meeting_setup->meeting_number }} بتاريخ <span  dir="ltr"> {{ $council_meeting_setup->meeting_date }}</span>
        </h3>
    </div>

    @php
    $covar=-1;
    $subjectCount = 0;
    @endphp
        @foreach ($subjects as $indexKey => $item)
            @if($item->subject_type_id!=$covar)
            @php
            $count = 0;
            $subjectCount++;
            @endphp
            <h4 class="mb-3">(الموضوع رقم {{ $subjectCount }}  {{App\Subject_type::where('id',$item->subject_type_id)->first()->subject_type_name}})</h4>
            @endif
        @php
            $covar=$item->subject_type_id;
        @endphp
        <div class="singleSubject mb-4">
            @if($item->additional_subject==1)
                <h6 class="mb-3">ما يستجد من اعمال</h6>
            @endif
            <p class='mb-3' style="font-size: 1rem; line-height: 1.7rem;">{{ ++$count }} - {{ $item->subject_description}}</p>

            @if(!(\App\Subject_topic::where('council_meeting_subject_id',$item->id)->get())->isEmpty())
                <div class="topics mb-2">
                    <h4 class="mb-3"> لتتكون اللجنه من كلا من :</h4>

                    @foreach(\App\Subject_topic::where('council_meeting_subject_id',$item->id)->orderBy('list_of_member_order',
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
        </div>

    @endforeach

    <h5 style="float:left">
        <span class="d-block mb-3">رئيس اللجنه</span>

        <span> ا.د/{{$council_member->faculty_member->User->name}}</span>
    </h5>
</form>

<button class="btn btn-dark" onclick="myFunction()">اطبع التقرير</button>

<script>
    function myFunction() {
        window.print();
    }
</script>
