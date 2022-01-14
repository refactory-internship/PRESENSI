@component('mail::message')
# Hello, welcome to OASYS!

You have been successfully registered!

@component('mail::table')
|          |                                         |
|----------|-----------------------------------------|
| Name     | **{{ $user->getFullNameAttribute() }}** |
| Email    | **{{ $user->email }}**                  |
| Password | `{{ $password }}`                       |
@endcomponent

@component('mail::panel')
We advise you to change your password right after you login!
@endcomponent

@component('mail::button', ['url' => route('login')])
Go to Login Page
@endcomponent

@endcomponent
