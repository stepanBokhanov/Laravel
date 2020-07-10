 @if(Session::get('success'))
        <div class="alert alert-success text-center"><i class="fa fa-check"></i> {!! Session::get('success') !!}</div>
 @endif
 {{--@if (isset($errors) && $errors->has())--}}
        {{--<div class="alert alert-danger alert-dismissable ">--}}
       {{--<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>--}}
            {{--@forelse ($errors->all() as $error)--}}
                {{--<p><strong><i class="fa fa-warning"></i></strong> {{ $error }}</p>--}}
            {{--@empty--}}
            {{--@endforelse--}}
        {{--</div>--}}
 {{--@endif--}}