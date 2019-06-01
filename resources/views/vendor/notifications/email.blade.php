@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# <p style="font-weight:bold; {{ (App::getLocale() == 'ar') ? 'direction:rtl; text-align: right;' : 'direction:ltr; text-align: left;' }}">{{ $greeting }}</p>
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hello!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)

<p style="{{ (App::getLocale() == 'ar') ? 'direction:rtl; text-align: right;' : 'direction:ltr; text-align: left;' }}">{{ $line }}</p>

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)

<p style="{{ (App::getLocale() == 'ar') ? 'direction:rtl; text-align: right;' : 'direction:ltr; text-align: left;' }}">{{ $line }}</p>

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
<p style="{{ (App::getLocale() == 'ar') ? 'direction:rtl; text-align: right;' : 'direction:ltr; text-align: left;' }}">
    {{ $salutation }}, <br> Online Meeting Team.
</p>

@else
@lang('Regards'),<br>{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
<p style="{{ (App::getLocale() == 'ar') ? 'direction:rtl; text-align: right;' : 'direction:ltr; text-align: left;' }}">
    {{         __('Emails.If you’re having trouble clicking the')." ".$actionText." ".
    __('Emails.button, copy and paste the URL below')."\n".
    __('Emails.into your web browser:') }}
    <br>
    <a href="{{ $actionUrl }}">{{ $actionUrl }}</a>
</p>

@endslot
@endisset
@endcomponent
