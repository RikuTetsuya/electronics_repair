@component('mail::message')
Hello {{ $user->name }},

<p>We understand it happens. </p>

@component('mail::button', ['url' => url('reset/' . $user->remember_token)])
Reset Password
@endcomponent

<p>In case you have anny issues recovering your password, contact us. </p>

Thanks, <br>
{{ config('app.name') }}
@endcomponent