<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="javascript:;">
                <img src="{{$setting->getLogoImageAttribute()}}" height="30px" />

            </a>
            <div class="menu-toggler sidebar-toggler hide">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">

                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <i class="icon-bell"></i>

                        @if(count($pending_applications)>0)
                            <span class="badge badge-default">
											{{count($pending_applications)}}
										</span>
                        @endif

                    </a>


                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3><span class="bold">{{count($pending_applications)}} pending</span> notifications</h3>

                        </li>
                        @if(count($pending_applications)>0)
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;"
                                    data-handle-color="#637283">
                                    @foreach($pending_applications as $pending)
                                        <li>
                                            <a data-toggle="modal" href="#static_leave_requests"
                                               onclick="show_application_notification({{ $pending->id }});return false;">
                                                <span class="time">{{date('d-M-Y',strtotime($pending->created_at))}}</span>
                                                <span class="details">
                									<span class="label label-sm label-icon label-success">
                									<i class="fa fa-bell-o"></i>
                									</span>
                									 <strong>{{$pending->employeeDetails->fullName}} </strong> has applied for leave on {{date('d-M-Y',strtotime($pending->date))}}</span>
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>

                <li class="dropdown dropdown-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">

                    <span class="username username-hide-on-mobile">
                  {{ $loggedAdmin->name }}</span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="{{route('admin.profile_settings.edit',Auth::guard('admin')->user()->id)}}">
                                <i class="icon-user"></i> My Profile </a>
                        </li>

                        <li class="divider">
                        </li>
                        <li>
                            <a href="{{ URL::to('screenlock') }} ">
                                <i class="icon-lock"></i> Lock Screen </a>
                        </li>
                        <li>
                            <a href="{{ URL::route('admin.logout') }} " id="logout-form">
                                <i class="icon-logout"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->

            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->


{{--Leave Application view MODALS--}}
{!! Form::open(['url'=>'','id'=>'edit_form_leave','method'=>'PATCH']) !!}
<div id="static_leave_requests" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <span class="caption-subject font-red-sunglo bold uppercase">Leave Application</span>
            </div>
            <div class="modal-body" id="modal-data-leave">
                {{--Ajax data call for form--}}
            </div>
        </div>

    </div>
</div>
</div>
{!! Form::close() !!}
{{--Leave Modal Close--}}

<script>
    function show_application_notification(id) {
        $("#modal-data-leave").html('<div class="text-center">{!! HTML::image('assets/admin/layout/img/loading-spinner-blue.gif') !!}</div>');
        var editUrl = "{{ route('admin.leave_applications.update',[':id']) }}";
        editUrl = editUrl.replace(':id', id);
        $('#edit_form_leave').attr('action', editUrl);

        var url = "{{ route('admin.leave_applications.show',[':id']) }}";
        url = url.replace(':id', id);
        $('#edit_form_leave').attr('action', url);

        $.ajax({
            type: "GET",
            url: url

        }).done(function (response) {
            $('#modal-data-leave').html(response);
//
        });
    }
</script>
