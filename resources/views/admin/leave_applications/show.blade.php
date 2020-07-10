<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><strong>View Application</strong></h4>
</div>
<div class="modal-body">
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="portlet-body form">
        <div class="row">
            <label class="control-label col-md-3"><strong>Name</strong></label>
            <div class="col-md-9">
                {{$leave_application->employeeDetails->fullName}}
            </div>
        </div>
        <br>
        <div class="row">
            <label class="control-label col-md-3"><strong>Leave Type</strong></label>
            <div class="col-md-9">
                @if($leave_application->leaveType == 'half day')
                    {{ucfirst($leave_application->leaveType)}} - {{$leave_application->halfDayType}}
                @else
                    {{ucfirst($leave_application->leaveType)}}
                @endif
            </div>
        </div>
        <br>
        <div class="row">
            <label class="control-label col-md-3"><strong>Date</strong></label>
            <div class="col-md-9">
                {{date('d-M-Y',strtotime($leave_application->date))}}
            </div>
        </div>
        <br>
        <div class="row">
            <label class="control-label col-md-3"><strong>Reason</strong></label>
            <div class="col-md-9">
                {{$leave_application->reason}}
            </div>
        </div>
        <br>
        <div class="row">
            <label class="control-label col-md-3"><strong>Applied on</strong></label>
            <div class="col-md-9">
                {{date('d-M-Y',strtotime($leave_application->applied_on))}}
            </div>
        </div>
        <br>
        <div class="row">
            <label class="control-label col-md-3"><strong>Action</strong></label>
            <div class="col-md-9">
                {{ Form::select('application_status', [
                    'pending'   =>  'Pending',
                    'approved'  =>  'Approved',
                    'rejected'  =>   'Rejected'
                  ], $leave_application->application_status,['class' => 'form-control']) }}
            </div>
        </div>
        <br>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
                    <button type="button" onclick="updateLeaveApplication({{$leave_application->id}})"   class="btn green"><i class="fa fa-check"></i> Submit</button>
                </div>
            </div>
        </div>

    </div>
</div>
