@extends('layouts.app')

@section('styles')
<meta charset='UTF-8'>
<meta name="robots" content="noindex">
<link rel="canonical" href="https://codepen.io/emilcarlsson/pen/ZOQZaV?limit=all&page=74&q=contact+" />

<script src="https://use.typekit.net/hoy3lrg.js"></script>
<script>
    try {
        Typekit.load({
            async: true
        });
    } catch (e) {}

</script>
<link rel='stylesheet prefetch'
    href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
<link href="{{ asset('css/chat.css') }}" rel="stylesheet">

@endsection
@section('content')

<div class="main-panel">
    <div class="content-wrapper">


        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="chatbox d-flex justify-content-center w-100">

                    <div id="frame">
                        <div class="content" id="out">

                            <div class="contact-profile">

                                <span class="nav-profile-name">
                                </span>
                            </div>

                            <div class="messages">
                                <ul id='show'>

                                </ul>
                            </div>

                            <div class="message-input">
                                <div class="wrap">
                                    <input type="text" placeholder="Write your message..." id="message" required>
                                    <button class="submit">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

@endsection

@section('scripts')

<script src="https://www.gstatic.com/firebasejs/5.11.1/firebase.js"></script>
<script type="text/javascript" id='toPushh' data-def="{{ $id }}" data-i="{{ Auth::user()->id }}">
    // Initialize Firebase

    var config = {
        apiKey: "AIzaSyBfYHRhzF52hC-YtR6hHnDkpska1TchZ7g",
        authDomain: "online-meeting-9d181.firebaseapp.com",
        databaseURL: "https://online-meeting-9d181.firebaseio.com",
        projectId: "online-meeting-9d181",
        storageBucket: "online-meeting-9d181.appspot.com",
        messagingSenderId: "978461272383"
    };
    firebase.initializeApp(config);
    var def = $('#toPushh').data('def');
    var ref = firebase.database().ref(def);
    $i = $('#toPushh').data('i');


    ref.limitToLast(25).once("value", function (snapshot) {
        snapshot.forEach(function (childSnapshot) {
            var item = childSnapshot.val();
            item.key = childSnapshot.key;
            var ul = document.getElementById("show");
            var li = document.createElement('li');
            var pdate = document.createElement('p');
            var pall = document.createElement('p');
            if (String(item.id) == String($i)) {
                li.className = 'sent';
                item.user_id = 'Me';
            } else {
                li.className = 'replies';

            }
            pdate.setAttribute("style", "text-align: center;  font-weight: bold; color: #bec3c9; font-size: 11px;");
            pdate.appendChild(document.createTextNode(item.date));
            pall.innerHTML = item.user_id+':'+item.message;
            li.appendChild(pall);
            ul.appendChild(pdate);
            ul.appendChild(li);
        });
        $(".messages").scrollTop($('.messages').prop("scrollHeight"));

    }, function (error) {
        console.log("Error: " + error.code);
    });



</script>

<script type="text/javascript" data-id="{{ Auth::user()->name }}" data-i="{{ Auth::user()->id }}" id='toPush'
    data-def="{{ $id }}">
              $def = $('#toPush').data('def');
              var ref = firebase.database().ref($def);
                ref.limitToLast(1).on("value", function (snapshot) {
                    snapshot.forEach(function (childSnapshot) {

                        var ul = document.getElementById("show");
                        var li = document.createElement('li');
                        var pdate = document.createElement('p');
                        var pall = document.createElement('p');
                        if (String(childSnapshot.val().id) != String($i) && String(
                                childSnapshot.val().message) != String('undefined')) {
                            li.className = 'replies';

                            pdate.setAttribute("style",
                                "text-align: center;  font-weight: bold;");
                            pdate.appendChild(document.createTextNode(childSnapshot.val()
                                .date));
                            pall.innerHTML = childSnapshot.val().user_id + ':' +
                                childSnapshot.val().message;
                            li.appendChild(pall);
                            ul.appendChild(pdate);
                            ul.appendChild(li);
                            $(".messages").scrollTop($('.messages').prop("scrollHeight"));

                        }
                        $(".messages").scrollTop($('.messages').prop("scrollHeight"));

                    });
                }, function (error) {
                    console.log("Error: " + error.code);
                });



    $('.submit').click(function () {
        newMessage();
    })
    $(window).on('keydown', function (e) {
        if (e.which == 13) {
            newMessage();

        }
    })

</script>
<script
    src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'>
</script>
<script src="{{ asset('js/custom/chat.js') }}"></script>

@endsection
