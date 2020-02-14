@component('mail::message')
# Sofra Messege to you

Thx, <strong>{{$contact['name']}}</strong> &nbsp; for contact with us.<br>
<p>We'll revise your form so soon.</p>

@component('mail::button', ['url' => 'http://ipda3.com', 'color' => 'success'])
Our website
@endcomponent

{{ config('app.name') }}
@endcomponent
