@component('mail::message')

# Welcome to {{ config('app.name') }}, {{ $name }}!

We are excited to have you as a new member of {{ config('app.name') }}.

Your account details are as follows:

- **Name:**  {{ $name }}
- **Email:**  {{ $email }}
- **Birthdate:**  {{ $birthdate }}

@component('mail::button', ['url' => url('/login')])
Click here to login
@endcomponent

Thanks,<br>
{{ config('app.name') }}

@endcomponent
