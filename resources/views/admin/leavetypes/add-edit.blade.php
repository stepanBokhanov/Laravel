<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><strong>@if(isset($leavetype))<i class="fa fa-edit"></i> Edit @else <i class="fa fa-plus"></i>  Add @endif leaves type</strong></h4>
    </div>
    <div class="modal-body">
        <div class="portlet-body form">

            <!-- BEGIN FORM-->

            @if(isset($leavetype))
                {!!  Form::open(['method' => 'PUT', 'id' => 'leave_type_update_form', 'class'=>'form-horizontal'])  !!}
            @else
                {!!  Form::open(['method' => 'POST', 'id' => 'leave_type_update_form', 'class'=>'form-horizontal'])  !!}
            @endif

            <div class="form-body">
                <div class="form-group">
                    <div class="col-md-6">
                        <input class="form-control form-control-inline " name="leaveType" id="edit_leaveType" type="text" value="{{$leavetype->leaveType ?? ''}}" placeholder="LeaveType" />
                    </div>
                    <div class="col-md-6">
                        <input class="form-control form-control-inline " name="num_of_leave" id="edit_num_of_leave" type="text" value="{{$leavetype->num_of_leave ?? ''}}" placeholder="Number Of Leave" />
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="button" onclick="addUpdateLeaveType({{$leavetype->id ?? ''}})" class="btn green"> @if(isset($leavetype))<i class="fa fa-edit"></i> Update @else <i class="fa fa-plus"></i>  Add @endif</button>

                    </div>
                </div>
            </div>
            {!!  Form::close()  !!}
            <!-- END FORM-->
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>


