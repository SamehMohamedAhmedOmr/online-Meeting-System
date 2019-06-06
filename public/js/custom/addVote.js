function OpenVoteModal(id) {
    $('#subjectID').val(id);
    var vote = $("input[name='vote"+id+"']:checked").val();
    $('#lastVote').val(vote);
}

function makeVote() {
    var Council_meeting_subject_id = $('#subjectID').val();

    var commet = $('#voteComment'+Council_meeting_subject_id).val();

    var vote = $("input[name='vote"+Council_meeting_subject_id+"']:checked").val();

    var lastVote = $('#lastVote').val();


    if(vote == null){
        var errordiv = $('#voteError'+Council_meeting_subject_id);
        errordiv.removeClass('d-none');
        setTimeout(function () {
            errordiv.addClass('d-none');
        }, 5000); // <-- time in milliseconds
    }
    else{
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type : 'get',
            url : '/addVote',
            data:{
                'commet':commet,
                'vote':vote,
                'Council_meeting_subject_id':Council_meeting_subject_id,
            },
            success:function(data){
                $('#singleVote'+Council_meeting_subject_id).modal('hide');

                if(lastVote == null){
                    if(vote == 1){
                        var a = $('#acceptedVotes'+Council_meeting_subject_id).text();
                        var accepted = parseInt(a, 10);
                        $('#acceptedVotes'+Council_meeting_subject_id).text(accepted + 1);
                        $('.acceptedVotes'+Council_meeting_subject_id).text(accepted + 1);
                    }
                    else{
                        var r = $('#rejectedVotes'+Council_meeting_subject_id).text();
                        var rejected = parseInt(r, 10);
                        $('#rejectedVotes'+Council_meeting_subject_id).text(rejected + 1);
                        $('.rejectedVotes'+Council_meeting_subject_id).text(rejected + 1);
                    }

                    var n = $('#notVotedVotes'+Council_meeting_subject_id).text();
                    var notVoted = parseInt(n, 10);
                    $('#notVotedVotes'+Council_meeting_subject_id).text(notVoted - 1);
                    $('.notVotedVotes'+Council_meeting_subject_id).text(notVoted - 1);
                }
                else if(lastVote == 1){
                    if(vote == 0){
                        var r = $('#rejectedVotes'+Council_meeting_subject_id).text();
                        var rejected = parseInt(r, 10);
                        $('#rejectedVotes'+Council_meeting_subject_id).text(rejected + 1);
                        $('.rejectedVotes'+Council_meeting_subject_id).text(rejected + 1);

                        var a = $('#acceptedVotes'+Council_meeting_subject_id).text();
                        var accepted = parseInt(a, 10);
                        $('#acceptedVotes'+Council_meeting_subject_id).text(accepted - 1);
                        $('.acceptedVotes'+Council_meeting_subject_id).text(accepted - 1);

                        $('#myPrevVote'+Council_meeting_subject_id+' i').removeClass('mdi-checkbox-marked-circle-outline green').addClass('mdi-close-circle-outline red');
                    }
                }
                else if(lastVote == 0){
                    if(vote == 1){
                        var a = $('#acceptedVotes'+Council_meeting_subject_id).text();
                        var accepted = parseInt(a, 10);
                        $('#acceptedVotes'+Council_meeting_subject_id).text(accepted + 1);
                        $('.acceptedVotes'+Council_meeting_subject_id).text(accepted + 1);

                        var r = $('#rejectedVotes'+Council_meeting_subject_id).text();
                        var rejected = parseInt(r, 10);
                        $('#rejectedVotes'+Council_meeting_subject_id).text(rejected - 1);
                        $('.rejectedVotes'+Council_meeting_subject_id).text(rejected - 1);

                        $('#myPrevVote'+Council_meeting_subject_id+' i').removeClass('mdi-close-circle-outline red').addClass('mdi-checkbox-marked-circle-outline green');

                    }
                }

                var errordiv = $('#voteSuccess'+Council_meeting_subject_id);
                errordiv.removeClass('d-none');
                setTimeout(function () {
                    errordiv.addClass('d-none');
                }, 5000); // <-- time in milliseconds
            }
        });
    }
}
