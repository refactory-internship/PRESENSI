@component('mail::message')
#### Hello! This user requested a password reset.

@component('mail::table')
|      |                                         |
|------|-----------------------------------------|
|User  | **{{ $user->getFullNameAttribute() }}** |
|Email | **{{ $user->email }}**                  |
@endcomponent

If you do not recognize this request, please ignore this email.

@component('mail::button', ['url' => route('api.auth.password.reset', [$user->id, $token])])
Reset Password
@endcomponent
@endcomponent
