@extends('admin.adminlayouts.adminlayout')

@section('head')


<!-- BEGIN PAGE LEVEL STYLES -->
{!!  HTML::style("assets/global/plugins/bootstrap-datepicker/css/datepicker3.css")  !!}
{!!  HTML::style("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css")  !!}
<!-- END PAGE LEVEL STYLES -->
@stop


@section('mainarea')

			
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Employee Add page
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="{{route('admin.dashboard.index')}}">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="{{ route('admin.employees.index') }}">Employee</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="">New Employee</a>
					</li>
				</ul>

			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->

                {{--INLCUDE ERROR MESSAGE BOX--}}
                @include('admin.common.error')
                {{--END ERROR MESSAGE BOX--}}


				<div class="tab-pane" id="tab_2">
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-plus"></i>Add New Employee
                            </div>

                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            {!! Form::open(array('route'=>"admin.employees.store",'class'=>'form-horizontal','method'=>'POST','files' => true)) !!}

                                <div class="form-body">

                                {{--Company Info--}}
                                <h3 class="form-section">Company </h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Employee ID <span class="required" aria-required="true">
                                                                                                          										* </span></label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" name="employeeID" placeholder="Employee ID" value="{{Input::old('employeeID')}}">

                                                        </div>
                                                    </div>
                                                </div>
                                               </div>

                                                <!--/span-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Department <span class="required" aria-required="true">* </span></label>
                                                            <div class="col-md-9">
                                                                 {!!  Form::select('department', $department,null,['class' => 'form-control input-xlarge select2me','id'=>'department','onchange'=>'dept();return false;'])  !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Designation<span class="required" aria-required="true">* </span></label>
                                                                <div class="col-md-9">
                                                                    <select  class="select2me form-control" name="designation" id="designation" >


                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                  <div class="row">
                                          <div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="control-label col-md-3">Joining Date</label>
                                                  <div class="col-md-9">
                                                    <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                        <input type="text" class="form-control" name="joiningDate" readonly value="{{Input::old('joiningDate')}}">
                                                    <span class="input-group-btn">
                                                    <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                    </span>
                                                    </div>

                                                  </div>
                                              </div>
                                          </div>
                                           <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Joining Salary</label>
                                                        <div class="col-md-9">
                                                          <input type="text" class="form-control" name="currentSalary" placeholder="Current Salary" value="{{ Input::old('currentSalary') }}">


                                                        </div>
                                                    </div>
                                                </div>
                                         </div>
                                                <!--/span-->

                                {{--END Company Info--}}

                                    <h3 class="form-section">Person Info</h3>
                                    <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Profile Image</label>
                                                    <div class="col-md-9">
                                                      <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
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

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Name<span class="required" aria-required="true">* </span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="fullName" placeholder="Employee Name" value="{{ Input::old('fullName') }}">

                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Father Name</label>
                                                <div class="col-md-9">
                                                     <input type="text" class="form-control" name="fatherName" placeholder="Father Name">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Gender<span class="required" aria-required="true">* </span></label>
                                                <div class="col-md-9">
                                                {!!  Form::select('gender', array('male' => 'Male', 'female' => 'Female'), Input::old('gender'),array('class'=>'form-control'))  !!}


                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Date of Birth</label>
                                                <div class="col-md-9">
                                                   <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                   			<input type="text" class="form-control" name="date_of_birth" readonly>
                                                        <span class="input-group-btn">
                                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Email</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" name="email" placeholder="Email" value="{{ Input::old('email') }}">

                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                           <div class="form-group">
                                               <label class="control-label col-md-3">Phone Number</label>
                                               <div class="col-md-9">
                                                   <input type="text" class="form-control" name="mobileNumber" placeholder="Contact Number" value="{{Input::old('mobileNumber')}}">

                                               </div>
                                           </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <h3 class="form-section">Address</h3>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Local Address</label>
                                                <div class="col-md-9">
                                                  <textarea class="form-control" name="localAddress" rows="3">{{Input::old('localAddress')}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Permanent Address</label>
                                                <div class="col-md-9">
                                                   <textarea class="form-control" name="permanentAddress" rows="3">{{Input::old('permanentAddress')}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--------------BANK DETAILS-----------------------}}
                                       <h3 class="form-section">{{--<i class="fa fa-bank"></i>--}} Salary Account Bank Details</h3>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Account Holder Name</label>
                                                <div class="col-md-9">
                                                   <input type="text" class="form-control" name="accountName" placeholder="Account Holder Name" value="{{Input::old('accountName')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Account Number</label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" name="accountNumber" placeholder="Account Number" value="{{Input::old('accountNumber')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-6">
                                        <div class="form-group">
                                                    <label class="control-label col-md-3">BANK</label>
                                                    <div class="col-md-9">
                                                       <input type="text" class="form-control" name="bank" placeholder="BANK Name" value="{{Input::old('bank')}}">
                                                    </div>
                                          </div>
                                        </div>
                                        </div>
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">IFSC CODE</label>
                                                <div class="col-md-9">
                                                   <input type="text" class="form-control" name="ifsc" placeholder="IFSC Code" value="{{Input::old('ifsc')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Branch</label>
                                                <div class="col-md-9">
                                                <input type="text" class="form-control" name="branch" placeholder="BRANCH" value="{{Input::old('branch')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--BANK DETAILS--}}


                                    {{---------------Documents------------------}}

                                           <h3 class="form-section">{{--<i class="fa fa-bank"></i>--}} Documents</h3>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Resume</label>
                                                    <div class="col-md-9">


                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="input-group input-large">
                                                            <div class="form-control uneditable-input" data-trigger="fileinput">
                                                                <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                                </span>
                                                            </div>
                                                            <span class="input-group-addon btn default btn-file">
                                                            <span class="fileinput-new">
                                                            Select file </span>
                                                            <span class="fileinput-exists">
                                                            Change </span>
                                                            <input type="file" name="resume">
                                                            </span>
                                                            <a href="#" class="input-group-addon btn btn-sm red fileinput-exists" data-dismiss="fileinput">
                                                            Remove </a>

                                                             </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

                                        </div>
                                         <div class="row">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                        <label class="control-label col-md-3">Offer Letter</label>
                                                        <div class="col-md-9">


                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="input-group input-large">
                                                                    <div class="form-control uneditable-input" data-trigger="fileinput">
                                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                                        </span>
                                                                    </div>
                                                                    <span class="input-group-addon btn default btn-file">
                                                                    <span class="fileinput-new">
                                                                    Select file </span>
                                                                    <span class="fileinput-exists">
                                                                    Change </span>
                                                                    <input type="file" name="offerLetter">
                                                                    </span>
                                                                    <a href="#" class="input-group-addon btn btn-sm red fileinput-exists" data-dismiss="fileinput">
                                                                    Remove </a>
                                                                </div>

                                                        </div>
                                                        </div>
                                              </div>
                                            </div>
                                            </div>
                                         <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Joining Letter</label>
                                                    <div class="col-md-9">
                                                   <div class="fileinput fileinput-new" data-provides="fileinput">
                                                           <div class="input-group input-large">
                                                               <div class="form-control uneditable-input" data-trigger="fileinput">
                                                                   <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                                   </span>
                                                               </div>
                                                               <span class="input-group-addon btn default btn-file">
                                                               <span class="fileinput-new">
                                                               Select file </span>
                                                               <span class="fileinput-exists">
                                                               Change </span>
                                                               <input type="file" name="joiningLetter">
                                                               </span>
                                                               <a href="#" class="input-group-addon btn btn-sm red fileinput-exists" data-dismiss="fileinput">
                                                               Remove </a>

                                                                </div>
                                                       </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                             <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Contact and Agreement</label>
                                                        <div class="col-md-9">
                                                       <div class="fileinput fileinput-new" data-provides="fileinput">
                                                               <div class="input-group input-large">
                                                                   <div class="form-control uneditable-input" data-trigger="fileinput">
                                                                       <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                                       </span>
                                                                   </div>
                                                                   <span class="input-group-addon btn default btn-file">
                                                                   <span class="fileinput-new">
                                                                   Select file </span>
                                                                   <span class="fileinput-exists">
                                                                   Change </span>
                                                                   <input type="file" name="contract">
                                                                   </span>
                                                                   <a href="#" class="input-group-addon btn btn-sm red fileinput-exists" data-dismiss="fileinput">
                                                                   Remove </a>

                                                                    </div>
                                                           </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">ID Proof</label>
                                                        <div class="col-md-9">
                                                       <div class="fileinput fileinput-new" data-provides="fileinput">
                                                               <div class="input-group input-large">
                                                                   <div class="form-control uneditable-input" data-trigger="fileinput">
                                                                       <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                                       </span>
                                                                   </div>
                                                                   <span class="input-group-addon btn default btn-file">
                                                                   <span class="fileinput-new">
                                                                   Select file </span>
                                                                   <span class="fileinput-exists">
                                                                   Change </span>
                                                                   <input type="file" name="IDProof">
                                                                   </span>
                                                                   <a href="#" class="input-group-addon btn btn-sm red fileinput-exists" data-dismiss="fileinput">
                                                                   Remove </a>

                                                                    </div>
                                                           </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                    {{----------------Documents-----------------}}

                                    </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Submit</button>
                                                    <button type="button" class="btn default">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                </div>
                           {!!  Form::close()  !!}
                            <!-- END FORM-->
                        </div>
                    </div>

                </div>
			</div>
			<!-- END PAGE CONTENT-->



@stop

@section('footerjs')



<!-- BEGIN PAGE LEVEL PLUGINS -->
{!!  HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js")  !!}
{!!  HTML::script("assets/admin/pages/scripts/components-pickers.js")  !!}
{!!  HTML::script("assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js")  !!}

<!-- END PAGE LEVEL SCRIPTS -->
<script>
        jQuery(document).ready(function() {

           ComponentsPickers.init();
            dept();

        });
        function dept(){

                              $.getJSON("{{ URL::to('admin/departments/ajax_designation/')}}",
                              { deptID: $('#department').val() },
                              function(data) {
                                  var model = $('#designation');
                                   model.empty();
                                  $.each(data, function(index, element) {
                                      model.append("<option value='"+element.id+"'>" + element.designation + "</option>");
                                  });
                             });

                        }

    </script>
@stop