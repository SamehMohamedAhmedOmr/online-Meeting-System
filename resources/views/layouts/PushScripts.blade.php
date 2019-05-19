<!-- Pusher  -->

<script type="text/javascript" src="https://js.pusher.com/3.1/pusher.min.js"></script>

<script type="text/javascript" data-id="{{ Auth::user()->id }}" id='toPushID'>
    function zero() {
        var bell = document.getElementById('number');
        bell.style.display = 'none';
        bell.innerHTML = 0;
    }

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher('0f1b0bfe1501f60c1186', {
        cluster: "eu",
        encrypted: true,
    });

    var user = $('#toPushID').data('id');
    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('council' + user);

    // Bind a function to a Event (the full Laravel class)
    channel.bind('App\\Events\\Councilcreated', function (data) {
        var currentDate = new Date();

        var date = currentDate.getDate();
        var month = currentDate.getMonth(); //Be careful! January is 0 not 1
        var year = currentDate.getFullYear();
        var hour = currentDate.getHours();
        var mintues = currentDate.getMinutes(); //Be careful! January is 0 not 1
        var seconds = currentDate.getSeconds();
        var dateString = year + "-" + (month + 1) + "-" + date + " " + hour + ":" + mintues + ":" + seconds;
        var ul = document.getElementById("maxy");
        var li = document.createElement('div');
        li.className = 'item-content';

        var des = document.getElementById('number');
        des.removeAttribute("hidden");
        des.style.display = 'block';
        var not = parseInt(document.getElementById('number').innerHTML);
        des.innerHTML = not + 1;


        var a = document.createElement('a');
        a.setAttribute("style", "background-color: #e0e2e8;");
        a.setAttribute("id", "max" + data.d);
        a.setAttribute("href", data.page);
        a.setAttribute("value", data.d);
        a.className = 'dropdown-item';
        var p = document.createElement('p');
        var p2 = document.createElement('p');

        p.className = 'font-weight-light small-text mb-0 text-muted';
        p2.className = 'font-weight-light small-text mb-0 text-muted';
        p2.setAttribute("style", "font-size:0.8em;");

        var h = document.createElement('h6');
        h.className = 'font-weight-normal';

        var thum = document.createElement('div');
        thum.className = 'item-thumbnail';

        var item = document.createElement('div');
        item.className = 'item-icon bg-warning';

        var i = document.createElement('i');
        i.className = 'mdi mdi-information mx-0';

        item.appendChild(i);
        thum.appendChild(item);

        p.appendChild(document.createTextNode(data.message));
        p2.innerHTML = dateString;
        h.appendChild(document.createTextNode(data.title));
        li.appendChild(h);
        li.appendChild(p);
        li.appendChild(p2);
        a.appendChild(thum);
        a.appendChild(li);
        ul.insertBefore(a, ul.childNodes[0]);
    });
</script>

<script type="text/javascript">
    $(function () {
        $('a[id^="max"]').on('click', function () {
            $value = $(this).attr('value');
            $.ajax({
                type: 'get',
                url: '/updateseen',
                data: {
                    'seen': $value
                },
                success: function (data) {
                    $('nav').html(data);
                }
            });
        });
    });

</script>
