@extends('emails.email')

@section('content')
	<h4 style="margin: 0 0 10px 0; font-family: 'Open Sans',sans-serif; font-size: 18px; line-height: 23px; color: #333333; font-weight: normal;">Hi {{\Illuminate\Support\Str::words($fullName,1,'')}}!</h4>
	<strong>Congratulation!</strong> You have been awarded  <strong>{{$awardName}}</strong>
	<br /><br />
@stop

@section('callToAction')
	<tr>
		<td style="padding: 0 40px 30px; font-family: 'Open Sans',sans-serif; font-size: 15px; line-height: 20px; color: #555555;">

		</td>
	</tr>
@stop