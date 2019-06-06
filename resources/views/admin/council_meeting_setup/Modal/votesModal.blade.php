<!-- Votes Modal -->
<div class="modal fade votes-modal" id="votes{{ $subject->id }}" tabindex="-1" role="dialog" aria-labelledby="votes"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center justify-content-center">
                <h5 class="modal-title" id="votesTitle" style="font-size: 1.8rem; color: #2d4278;">
                    {{__("admin.VotersList")}}
                </h5>
            </div>
            <div class="modal-body">

                <canvas id="myChart{{ $subject->id }}" width="100%" height="30" class="mb-3"></canvas>


                <div class="row mb-4 pb-3" style="border-bottom: 1px solid #ccc;">
                    <div class="col-lg-3 col-6 text-center mb-lg-0 mb-3" style="color:#2D4278;">
                        <h4>{{__("home.total")}}</h4>
                        <h4 id='totalVotes{{ $subject->id }}'>{{ $subject->Votes->count() }}</h4>
                    </div>
                    <div class="col-lg-3 col-6 text-center mb-lg-0 mb-3" style="color:#71C016;">
                        <h4>{{__("home.Accepted")}}</h4>
                        <h4 id="acceptedVotes{{ $subject->id }}">{{ $subject->Votes->where('vote', 1)->count() }}</h4>
                    </div>
                    <div class="col-lg-3 col-6 text-center" style="color:#FF2121;">
                        <h4>{{__("home.Rejected")}}</h4>
                        <h4 id="rejectedVotes{{ $subject->id }}">{{ $subject->Votes->where('vote', 0)->count() }}</h4>
                    </div>
                    <div class="col-lg-3 col-6 text-center" style="color:#555555;">
                        <h4>{{__("home.NotVoted")}}</h4>
                        <h4 id="notVotedVotes{{ $subject->id }}">{{ $subject->Votes->where('vote', 2)->count() }}</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 d-flex flex-column align-items-center">
                        <h4 class="pb-3 mb-2" style="border-bottom: 1px solid #ccc;">{{__("admin.Members who Voted")}}</h4>
                        @foreach ($subject->Votes as $vote)
                            @if ($vote->vote != 2)
                                <div class="m-3 pb-3 w-100" style="border-bottom: 1px solid #ccc;">
                                    <div class="d-flex justify-content-center mb-2">
                                        <h6>{{ $vote->CouncilMember->Faculty_member->User->name }}</h6>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        @if ($vote->vote == 0)
                                            <span class="badge badge-danger">{{__("home.Rejected")}}</span>
                                        @else
                                            <span class="badge badge-success">{{__("home.Accepted")}}</span>
                                        @endif
                                    </div>
                                    @if($vote->commet)
                                        <div class="d-flex justify-content-center mt-3">
                                            <p style="border:1px solid #ccc;" class="py-3 px-5">{{ $vote->commet }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach

                        @if ($subject->Votes->where('vote','!=', 2)->count() == 0)
                        <div class="m-3 pb-3 w-100" style="color:#555555;">
                            <div class="d-flex justify-content-center mb-2">
                                <h4>{{ __('Staff.NoOne') }}</h4>
                            </div>
                        </div>
                    @endif

                    </div>
                    <div class="col-6 d-flex flex-column align-items-center">
                        <h4 class="pb-3 mb-2" style="border-bottom: 1px solid #ccc;">{{__("admin.Members who didn't vote")}}</h4>
                        @foreach ($subject->Votes as $vote)

                            @if ($vote->vote == 2)
                                <div class="m-3 pb-3 w-100" style="border-bottom: 1px solid #ccc;">
                                    <div class="d-flex justify-content-center mb-2">
                                        <h6>{{ $vote->CouncilMember->Faculty_member->User->name }}</h6>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <span class="badge badge-secondary">{{__("home.NotVoted")}}</span>
                                    </div>
                                </div>
                            @endif

                        @endforeach
                        @if ($subject->Votes->where('vote', 2)->count() == 0)
                            <div class="m-3 pb-3 w-100" style="color:#555555;">
                                <div class="d-flex justify-content-center mb-2">
                                    <h4>{{ __('Staff.NoOne') }}</h4>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @if (count($subject->Votes)==0)
                <div class="text-center" style="color:#555555;">
                    <h4>{{__("home.No Votes Yet")}}</h4>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@section('votingGrahpScripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

<script type="text/javascript">
    $(function () {

        $('.voteslist').on('click',function(){
            var id = $(this).data('id');
            var ctx = $('#myChart'+id);

            var totalVotes = $('#totalVotes'+id).text();
            var acceptedVotes = $('#acceptedVotes'+id).text();
            var rejectedVotes = $('#rejectedVotes'+id).text();
            var notVotedVotes = $('#notVotedVotes'+id).text();

            var acceptedPercentage = Math.round(acceptedVotes * 100) / totalVotes;
            var rejectedPercentage = Math.round(rejectedVotes * 100) / totalVotes;
            var notVotePercentage = Math.round(notVotedVotes * 100) / totalVotes;

            if(acceptedPercentage > Math.floor(acceptedPercentage)){
                var acceptedLabel = ' ~ ' + acceptedPercentage.toFixed(1) + "%";
            }else{
                var acceptedLabel = ' ~ ' + acceptedPercentage + "%";
            }

            if(rejectedPercentage > Math.floor(rejectedPercentage)){
                var rejectedLabel = ' ~ ' + rejectedPercentage.toFixed(1) + "%";
            }else{
                var rejectedLabel = ' ~ ' + rejectedPercentage + "%";
            }

            if(notVotePercentage > Math.floor(notVotePercentage)){
                var notVoteLabel = ' ~ ' + notVotePercentage.toFixed(1) + "%";
            }else{
                var notVoteLabel = ' ~ ' + notVotePercentage + "%";
            }

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
                        '{{__("home.Accepted")}}'+acceptedLabel,
                        '{{__("home.Rejected")}}'+rejectedLabel,
                        '{{__("home.NotVoted")}}'+notVoteLabel
                        ],
                    datasets: [{
                        label: '{{__("Staff.Votes")}}',
                        data: [acceptedVotes, rejectedVotes, notVotedVotes],
                        backgroundColor: [
                            'rgba(113,192,22, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(113,192,22, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
legend :{display:false},
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                precision:0,
                            },
                            scaleLabel: {
                                display: true,
                                labelString: '{{__("admin.Number of Voters")}}'
                            }

                        }],
                        xAxes: [{
                            barThickness: 30,
                            scaleLabel: {
                                display: true,
                                labelString:'{{__("admin.Vote Status")}}'
                            }
                        }]
                    },
                    tooltips: {
                        // callbacks: {
                        //     label: function(tooltipItem, data) {
                        //         var label = data.datasets[tooltipItem.datasetIndex].label || '';

                        //         if (label) {
                        //             label += ': ';
                        //         }
                        //         var percentage = ' ~ ' + Math.round(tooltipItem.yLabel * 100,1) / totalVotes + "%";
                        //         label += Math.round(tooltipItem.yLabel * 100) / 100;
                        //         label += percentage;
                        //         return label;
                        //     }
                        // }
                    }
                }
            });
        });

    });
</script>
@endsection
