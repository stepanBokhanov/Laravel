@php($envatoUpdateCompanySetting = \Froiden\Envato\Functions\EnvatoUpdate::companySetting())

@if(!is_null($envatoUpdateCompanySetting->supported_until))
    <div class="" id="support-div">
        @if(\Carbon\Carbon::parse($envatoUpdateCompanySetting->supported_until)->isPast())
            <div class="col-md-12 note note-danger">
                <div class="col-md-6">
                    Your support has been expired on <b><span
                                id="support-date">{{\Carbon\Carbon::parse($envatoUpdateCompanySetting->supported_until)->format('d M, Y')}}</span></b>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ config('froiden_envato.envato_product_url') }}" target="_blank"
                       class="btn btn btn-success btn-sm">Renew Now <i class="fa fa-shopping-cart"></i></a>
                    <a href="javascript:;" onclick="getPurchaseData();" class="btn btn-success btn-small btn-sm">Refresh
                        <i class="fa fa-refresh"></i></a>
                </div>
            </div>

        @else
            <div class="col-md-12 alert alert-info">
            <div class="col-md-6 ">
                Your support will expire on <b><span
                            id="support-date">{{\Carbon\Carbon::parse($envatoUpdateCompanySetting->supported_until)->format('d M, Y')}}</span></b>
            </div>
            @if(\Carbon\Carbon::parse($envatoUpdateCompanySetting->supported_until)->diffInDays() < 30)
                <div class="col-md-6 text-right">
                    <a href="{{ config('froiden_envato.envato_product_url') }}" target="_blank"
                       class="btn btn btn-success btn-sm">Extend Now <i class="fa fa-shopping-cart"></i></a>
                    <a href="javascript:;" onclick="getPurchaseData();" class="btn btn-success btn-small btn-sm">Refresh
                        <i class="fa fa-refresh"></i></a>
                </div>
            @endif
            </div>
        @endif
    </div>
@endif

@php($updateVersionInfo = \Froiden\Envato\Functions\EnvatoUpdate::updateVersionInfo())
@if(isset($updateVersionInfo['lastVersion']))
    <div class="alert alert-danger col-md-12">
        <p> @lang('messages.updateAlert')</p>
        <p>@lang('messages.updateBackupNotice')</p>
    </div>

    <div class="alert alert-info col-md-12">
        <div class="col-md-9"><i class="ti-gift"></i> @lang('core.newUpdate') <label
                    class="label label-success">{{ $updateVersionInfo['lastVersion'] }}</label><br><br>
            <h5 class="text-white font-bold"><label class="label label-danger">ALERT</label>You will get logged
                out after update. Login again to use the application.</h5>
            <span class="font-12 text-warning">@lang('core.updateAlternate')</span>
        </div>
        <div class="col-md-3 text-center">
            <a id="update-app" href="javascript:;"
               class="btn btn-success btn-small">@lang('core.updateNow') <i
                        class="fa fa-download"></i></a>

        </div>

        <div class="col-md-12">
            <p>{!! $updateVersionInfo['updateInfo'] !!}</p>
        </div>
    </div>

    <div id="update-area" class="m-t-20 m-b-20 col-md-12 white-box hide">
        Loading...
    </div>
@else
    <div class="alert alert-success col-md-12">
        <div class="col-md-12">You have latest version of this app.</div>
    </div>
@endif
