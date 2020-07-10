@extends('admin.adminlayouts.adminlayout')

@section('head')

    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
    {!! HTML::style('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css') !!}
    <!-- END PAGE LEVEL STYLES -->
@stop


@section('mainarea')

    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title" xmlns="http://www.w3.org/1999/html">
        Employee Details
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="index.html">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="{{route('admin.employees.index')}}">Employees</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="">Edit Employee </a>

            </li>
        </ul>
    </div>
    <!-- END PAGE HEADER-->
    <div class="clearfix">
    </div>
    <div class="row ">
        <div class="col-md-6 col-sm-6">
            <div class="portlet box purple-wisteria">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-calendar"></i>Personal Details
                    </div>
                    <div class="actions">

                        <a href="javascript:;" onclick="UpdateDetails('{!! $employee->employeeID !!}','personal')"
                           class="btn btn-sm btn-default ">
                            <i class="fa fa-save"></i> Save </a>
                    </div>
                </div>


                <div class="portlet-body">
                    <div id="personal_alert"></div>

                    {{--------------------Personal Info Form--------------------------------------------}}

                    {!! Form::open(['method' => 'PUT','route'=> ['admin.employees.update', $employee->employeeID],'class'   =>  'form-horizontal','id'  =>  'personal_details_form','files'=>true]) !!}
                    <input type="hidden" name="updateType" class="form-control" value="personalInfo">
                    @if(Session::get('successPersonal'))
                        <div class="alert alert-success"><i
                                    class="fa fa-check"></i> {!! Session::get('successPersonal') !!}</div>
                    @endif


                    @if (Session::get('errorPersonal'))

                        <div class="alert alert-danger alert-dismissable ">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            @foreach (Session::get('errorPersonal') as $error)
                                <p><strong><i class="fa fa-warning"></i></strong> {{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="form-body">
                        <div class="form-group ">
                            <label class="control-label col-md-3">Photo</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="{{$employee->profile_image_url}}"/>
                                        <input type="hidden" name="hiddenImage" value="{{$employee->profileImage}}">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px;">
                                    </div>
                                    <div>
        													<span class="btn default btn-file">
        													<span class="fileinput-new">
        													Select image </span>
        													<span class="fileinput-exists">
        													Change </span>
        													<input type="file" name="profileImage">
        													</span>
                                        <a href="#" class="btn btn-sm red fileinput-exists" data-dismiss="fileinput">
                                            Remove </a>
                                    </div>
                                </div>

                                <div class="clearfix margin-top-10">
                                                            <span class="label label-danger">
                                                            NOTE! </span> Image Size must be (872px by 724px)

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name<span class="required">* </span></label>
                            <div class="col-md-9">
                                <input type="text" name="fullName" class="form-control" value="{{$employee->fullName}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Father's Name</label>
                            <div class="col-md-9">
                                <input type="text" name="fatherName" class="form-control"
                                       value="{{$employee->fatherName}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Date of Birth</label>
                            <div class="col-md-3">
                                <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy"
                                     data-date-viewmode="years">
                                    <input type="text" class="form-control" name="date_of_birth" readonly
                                           value="@if(empty($employee->date_of_birth))@else{{date('d-m-Y',strtotime($employee->date_of_birth))}}@endif">
                                    <span class="input-group-btn">
        												<button class="btn default" type="button"><i
                                                                    class="fa fa-calendar"></i></button>
        												</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Gender</label>
                            <div class="col-md-9">
                                <select class="form-control" name="gender">

                                    <option value="male" @if($employee->gender=='male') selected @endif>Male</option>
                                    <option value="female" @if($employee->gender=='female') selected @endif>Female
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Phone</label>
                            <div class="col-md-9">
                                <input type="text" name="mobileNumber" class="form-control"
                                       value="{{$employee->mobileNumber}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Address</label>
                            <div class="col-md-9">
                                <textarea name="localAddress" class="form-control"
                                          rows="3">{{$employee->localAddress}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Permanent Address</label>
                            <div class="col-md-9">
                                <textarea name="permanentAddress" class="form-control"
                                          rows="3">{{$employee->permanentAddress}}</textarea>
                            </div>
                        </div>
                        <h4><strong>Account Login</strong></h4>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email<span class="required">* </span></label>
                            <div class="col-md-9">
                                <input type="text" name="email" class="form-control" value="{{$employee->email}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password</label>
                            <div class="col-md-9">
                                <input type="password" name="new_password" class="form-control">
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="portlet box red-sunglo">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-calendar"></i>Company Details
                    </div>
                    <div class="actions">
                        <a href="javascript:;"
                           onclick="UpdateDetails('{!! $employee->employeeID !!}','company');return false"
                           class="demo-loading-btn-ajax btn btn-sm btn-default ">
                            <i class="fa fa-save"></i> Save </a>
                    </div>
                </div>
                <div class="portlet-body">

                    {{--------------------Company Form--------------------------------------------}}
                    {!! Form::open(['method' => 'PUT','class'   =>  'form-horizontal','id'  =>  'company_details_form']) !!}
                    <input type="hidden" name="updateType" class="form-control" value="company">
                    <div id="company_alert">

                    </div>

                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Employee ID<span class="required">* </span></label>
                            <div class="col-md-9">
                                <input type="text" name="employeeID" class="form-control" readonly
                                       value="{{$employee->employeeID}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Department<span class="required">* </span></label>
                            <div class="col-md-9">
                                {!!  Form::select('department', $department,$designation->deptID,['class' => 'form-control select2me','id'=>'department','onchange'=>'dept();return false;'])  !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Designation<span class="required">* </span></label>
                            <div class="col-md-9">

                                <select class="select2me form-control" name="designation" id="designation">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Date of Joining</label>
                            <div class="col-md-3">
                                <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy"
                                     data-date-viewmode="years">
                                    <input type="text" class="form-control" name="joiningDate" readonly
                                           value="@if(empty($employee->joiningDate))00-00-0000 @else {{date('d-m-Y',strtotime($employee->joiningDate))}} @endif">
                                    <span class="input-group-btn">
        												<button class="btn default" type="button"><i
                                                                    class="fa fa-calendar"></i></button>
        												</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Exit Date</label>
                            <div class="col-md-3">
                                <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy"
                                     data-date-viewmode="years">
                                    <input type="text" class="form-control" name="exit_date" readonly
                                           value="@if(empty($employee->exit_date)) @else {{date('d-m-Y',strtotime($employee->exit_date))}} @endif">
                                    <span class="input-group-btn">
                                                            <button class="btn default" type="button"><i
                                                                        class="fa fa-calendar"></i></button>
                                                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-3">
                                <input type="checkbox" value="active" onchange="remove_exit();" class="make-switch"
                                       name="status" @if($employee->status=='active')checked
                                       @endif data-on-color="success" data-on-text="Active" data-off-text="Inactive"
                                       data-off-color="danger">
                            </div>
                            <div class="col-md-6">
                                (<strong>Note:</strong>Status active will remove the exit date)
                            </div>
                        </div>

                        <hr>
                        <h4><strong>Salary ( <i class="fa {{$setting->currency_icon}}"></i> )</strong></h4>
                        <div id="salaryData">
                            @foreach($employee->getSalary as $salary)
                                <div id="salary{{$salary->id}}">
                                    <div class="form-group">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="type[{{$salary->id}}]"
                                                   value="{{$salary->type}}">
                                        </div>

                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="salary[{{$salary->id}}]"
                                                   value="{{$salary->salary}}">
                                        </div>

                                        <div class="col-md-2">
                                            <a class="btn btn-sm red"
                                               onclick="del('{{$salary->id}}','{{$salary->type}}')"><i
                                                        class="fa fa-trash"></i> </a>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <a class="" href="javascript:;" onclick="showSalary({{$employee->employeeID}})">
                            Add Salary
                            <i class="fa fa-plus"></i> </a>
                    </div>
                    {!! Form::close() !!}


                    {{----------------Company Form end -------------}}

                </div>
            </div>

            <div class="portlet box red-sunglo">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-calendar"></i>Bank Account Details
                    </div>
                    <div class="actions">
                        <a href="javascript:;" onclick="UpdateDetails('{{$employee->employeeID}}','bank');return false"
                           class="demo-loading-btn-ajax btn btn-sm btn-default ">
                            <i class="fa fa-save"></i> Save </a>
                    </div>
                </div>
                <div class="portlet-body">

                    {{--------------------Bank Account Form--------------------------------------------}}
                    {!! Form::open(['method' => 'PUT','class'   =>  'form-horizontal','id'  =>  'bank_details_form']) !!}
                    <input type="hidden" name="updateType" class="form-control" value="bank">

                    <div id="bank_alert"></div>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Account Holder Name</label>
                            <div class="col-md-9">
                                <input type="text" name="accountName" class="form-control"
                                       value="{{$bank_details->accountName ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Account Number</label>
                            <div class="col-md-9">
                                <input type="text" name="accountNumber" class="form-control"
                                       value="{{$bank_details->accountNumber ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Bank Name</label>
                            <div class="col-md-9">
                                <input type="text" name="bank" class="form-control"
                                       value="{{$bank_details->bank ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">IFSC Code</label>
                            <div class="col-md-9">
                                <input type="text" name="ifsc" class="form-control"
                                       value="{{$bank_details->ifsc ?? ''}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">PAN Number</label>
                            <div class="col-md-9">
                                <input type="text" name="pan" class="form-control" value="{{$bank_details->pan ?? ''}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Branch</label>
                            <div class="col-md-9">
                                <input type="text" name="branch" class="form-control"
                                       value="{{$bank_details->branch ?? '' }}">
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    {{-------------------Bank Account Form end-----------------------------------------}}


                </div>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="row ">
            <div class="col-md-12 col-sm-12">
                <div class="portlet box purple-wisteria">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-calendar"></i>Documents
                        </div>
                        <div class="actions">
                            <button onclick="UpdateDetails('{!! $employee->employeeID !!}','documents')"
                                    class="btn btn-sm btn-default ">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="portlet-body">
                            {{--------------------Documents Info Form--------------------------------------------}}

                            {!! Form::open(['method' => 'PUT','route'=> ['admin.employees.update', $employee->employeeID],'class'   =>  'form-horizontal','id'  =>  'documents_details_form','files'=>true]) !!}
                            <input type="hidden" name="updateType" class="form-control" value="documents">
                            <div id="documents_alert">

                            </div>
                            @if(Session::get('successDocuments'))
                                <div class="alert alert-success"><i
                                            class="fa fa-check"></i> {!! Session::get('successDocuments') !!}</div>
                            @endif

                            @if(Session::get('errorDocuments'))
                                <div class="alert alert-danger"><i
                                            class="fa fa-warning"></i> {!! Session::get('errorDocuments') !!}</div>
                            @endif

                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Resume</label>
                                    <div class="col-md-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
        														</span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
        													<span class="fileinput-new">
        													Select file </span>
        													<span class="fileinput-exists">
        													Change </span>
        													<input type="file" name="resume">
        													</span>
                                                <a href="#" class="input-group-addon btn btn-sm red fileinput-exists"
                                                   data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        @if(isset($documents['resume']))
                                            <a href="{{ $documents['resume'] }}"
                                               target="_blank" class="btn btn-sm purple">View Resume</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Offer Letter</label>
                                    <div class="col-md-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
        														</span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
        													<span class="fileinput-new">
        													Select file </span>
        													<span class="fileinput-exists">
        													Change </span>
        													<input type="file" name="offerLetter">
        													</span>
                                                <a href="#" class="input-group-addon btn btn-sm red fileinput-exists"
                                                   data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        @if(isset($documents['offerLetter']))
                                            <a href="{{ $documents['offerLetter'] }}"
                                               target="_blank" class="btn btn-sm purple">Offer Letter</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Joining Letter</label>
                                    <div class="col-md-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
        														</span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
        													<span class="fileinput-new">
        													Select file </span>
        													<span class="fileinput-exists">
        													Change </span>
        													<input type="file" name="joiningLetter">
        													</span>
                                                <a href="#" class="input-group-addon btn btn-sm red fileinput-exists"
                                                   data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        @if(isset($documents['joiningLetter']))
                                            <a href="{{ $documents['joiningLetter'] }}"
                                               target="_blank" class="btn btn-sm purple">View Joining Letter</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Contract and Agreement</label>
                                    <div class="col-md-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
        														</span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
        													<span class="fileinput-new">
        													Select file </span>
        													<span class="fileinput-exists">
        													Change </span>
        													<input type="file" name="contract">
        													</span>
                                                <a href="#" class="input-group-addon btn btn-sm red fileinput-exists"
                                                   data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        @if(isset($documents['contract']))
                                            <a href="{{ $documents['contract'] }}"
                                               target="_blank" class="btn btn-sm purple">View Contract</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">ID Proof</label>
                                    <div class="col-md-5">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp; <span
                                                            class="fileinput-filename">
        														</span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
        													<span class="fileinput-new">
        													Select file </span>
        													<span class="fileinput-exists">
        													Change </span>
        													<input type="file" name="IDProof">
        													</span>
                                                <a href="#" class="input-group-addon btn btn-sm red fileinput-exists"
                                                   data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        @if(isset($documents['IDProof']))
                                            <a href="{{ $documents['IDProof'] }}"
                                               target="_blank" class="btn btn-sm purple">View ID Proof</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix">
            </div>
        </div>

    </div>
    @include('admin.include.delete-modal')
    @include('include.show-modal')
    {{------------------------------------END NEW SALARY ADD MODALS--------------------------------------}}

@stop

@section('footerjs')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!!  HTML::script('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
    {!!  HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js") !!}
    {!!  HTML::script('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
    {!!  HTML::script('assets/admin/pages/scripts/components-pickers.js') !!}

    <!-- END PAGE LEVEL PLUGINS -->

    <script>
        jQuery(document).ready(function () {
            ComponentsPickers.init();
            dept();
        });

        function dept() {

            $.getJSON("{{ route('admin.departments.ajax_designation')}}",
                {deptID: $('#department').val()},
                function (data) {
                    var model = $('#designation');
                    model.empty();
                    var selected = '';
                    var match = {{ $employee->designation}};
                    $.each(data, function (index, element) {
                        if (element.id == match) selected = 'selected';
                        else selected = '';
                        model.append("<option value='" + element.id + "' " + selected + ">" + element.designation + "</option>");
                    });

                });
        }

        // Javascript function to update the company info and Bank Info
        function UpdateDetails(id, type) {

            var form_id = '#' + type + '_details_form';
            var alert_div = '#' + type + '_alert';

            var url = "{{ route('admin.employees.update',':id') }}";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'POST',
                url: url,
                container: form_id,
                file: true,
                alertDiv: alert_div
            });
        }

        // Add New Salary
        function saveSalary(id) {
            var url = "{{ route('admin.salary.store') }}";
            url = url.replace(':id', id);
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '#save_salary',
                data: $('#save_salary').serialize(),
                success: function (response) {
                    if (response.status == "success") {
                        $('#showModal').modal('hide');
                        $('#salaryData').append(response.viewData);
                    }
                }
            });
        }

        // Show Salary Modal
        function showSalary(id) {
            $('#showModal .modal-dialog').removeClass("modal-md").addClass("modal-lg");
            var url = "{{ route('admin.add-salary-modal',[':id']) }}";
            url = url.replace(':id', id);
            $.ajaxModal('#showModal', url);
            $('#showModal_div').removeClass("modal-dialog modal-lg").addClass("modal-dialog modal-md");
        }

        // Show Delete Modal and delete salary
        function del(id, type) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html('Are you sure ! You want to delete <strong>' + type + '</strong> Salary?.');

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "{{ route('admin.salary.destroy',':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token},
                    container: "#deleteModal",
                    success: function (response) {
                        if (response.status == "success") {
                            $('#deleteModal').modal('hide');
                            $('#salary' + id).remove();
                        }
                    }
                });

            });
        }


        function remove_exit() {
            if ($("input[name=status]:checked").val() == "active") {
                $("input[name=exit_date]").val("");
            }
        }


        $("input[name=exit_date]").change(function () {
            $("input[name=status]").bootstrapSwitch('state', false);

        });
    </script>

    @if(Session::get('successDocuments'))
        {{--Move to bottom of page if success comes from documents--}}
        <script>
            $("html, body").animate({scrollTop: $(document).height()}, 2000);
        </script>
    @endif

@stop
