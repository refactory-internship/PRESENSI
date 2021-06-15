@component('mail::message')
#### Hello! This employee just created an attendance and needs your approval!

@component('mail::table')
|              |                                                              |
|--------------|--------------------------------------------------------------|
|Employee Name | **{{ $user->getFullNameAttribute() }}**                      |
|Email         | **{{ $user->email }}**                                       |
|Clock-In Time | **{{ date('H:i', strtotime($attendance->clock_in_time)) }}** |
@endcomponent

@endcomponent
