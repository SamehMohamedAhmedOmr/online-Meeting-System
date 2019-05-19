    @if ($message = Session::get('flash_message'))
    <div class='message' style="width: 100%; text-align: center; color:#fff;">
        <ul class="list-unstyled">
            <li class='alert alert-success' style="direction:ltr">
                <strong style="color:#fff;">{{ $message }}</strong>
            </li>
        </ul>
    </div>
    @endif
