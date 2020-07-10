<style type="text/css">
            .tg  {border-collapse:collapse;border-spacing:0;border-color:#aaa;margin:0px auto;}
            .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;}
            .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#f38630;}
            .tg .tg-0ord{text-align:right}
            .tg .tg-s6z2{text-align:center}
            .tg .tg-z2zr{background-color:#FCFBE3}
            .tg .tg-gyqc{background-color:#FCFBE3;text-align:right}
 </style>
<table width="100%" border="1" style="border-collapse:collapse; border-color:white;">
		<tr>
	    	<td style="background-color:black;padding:10px;">
				<img src="{{$setting->getLogoImageAttribute()}}" height="30px" width="117px" />
	    	</td>
	    </tr>
	    <tr>
	    	<td style="padding:10px;"><strong>{{Auth::guard('employees')->user()->fullName}}</strong> Applied for Leave

	    	<br /><br/>

<table style="width:100%;border-collapse:collapse;border-spacing:0;border-color:#aaa;margin:0px auto">
	<tr>
	<th style="font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#fff;background-color:#f38630;text-align:center" colspan="6">Leaves</th>
	</tr>
	<tr>
		<td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#FCFBE3">Date</td>
		<td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#FCFBE3">Leave Type</td>
		<td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#FCFBE3">Reason</td>
	</tr>
	@foreach ($dates as $index=>$value)
	<tr>
		<td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff">{{$value}}</td>
		<td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;">{{ $leaveType[$index]}}</td>
		<td style="font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#aaa;color:#333;background-color:#fff;">{{$reason[$index]}}</td>
	</tr>
	@endforeach
</table>



			  <br /><br />

	       <b> {{$setting->website}}</b><br />
	        <font size="1"><a href="{{URL::to('/')}}">{{URL::to('/')}}</a><br />
	        </font>
	        </td>
	    </tr>
</table>


