@component('mail::message')
# Hi {{$data['name']}}, we’re glad you’re here!

Following are your account details:

### Email: {{$data['email']}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
