@component('mail::message')
#### Hello! This user requested a password reset.

@component('mail::table')
|      |                                         |
|------|-----------------------------------------|
|User  | **{{ $user->getFullNameAttribute() }}** |
|Email | **{{ $user->email }}**                  |
@endcomponent

If you do not recognize this request, please ignore this email.

@component('mail::button', ['url' => route('auth.password.reset', $user->id)])
Reset Password
@endcomponent
@endcomponent
