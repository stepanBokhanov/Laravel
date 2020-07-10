@extends('emails.email')

@section('content')
	<h4 style="margin: 0 0 10px 0; font-family: 'Open Sans',sans-serif; font-size: 18px; line-height: 23px; color: #333333; font-weight: normal;">Hi {{\Illuminate\Support\Str::words($fullName,1,'')}}!</h4>
	<b> {{\Illuminate\Support\Str::words($fullName,1,'')}}</b> Your account is created on {{$website}}<br /><br/>
	<p>Your Login details as below!</p>

	<p><strong>Email</strong>:  {{$email}}</p>
	<p><strong>Password</strong>: {{$password}}</p>
	<br />
	<br />
	<p>Try Logging at <a href="{{\Illuminate\Support\Facades\URL::to('/')}}">{{\Illuminate\Support\Facades\URL::to('/')}}</a></p>
@stop

@section('callToAction')
	<tr>
		<td style="padding: 0 40px 30px; font-family: 'Open Sans',sans-serif; font-size: 15px; line-height: 20px; color: #555555;">

		</td>
	</tr>
@stop
