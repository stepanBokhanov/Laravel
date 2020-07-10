<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><strong>New Salary</strong></h4>
    </div>
    <div class="modal-body">
        <div class="portlet-body form">

            <!-------------- BEGIN FORM------------>
            {!! Form::open(array('route'=>"admin.salary.store",'class'=>'form-horizontal','id'=> 'save_salary','method'=>'POST')) !!}
            <input   type="hidden" name="employeeID" value="{{$employeeID}}"/>

            <div class="form-body">

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <input class="form-control form-control-inline" name="type" type="text" value="" placeholder="Type"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <input class="form-control form-control-inline"  type="text" name="salary" placeholder="Salary"/>
                        <input   type="hidden" name="remarks" value="Added Salary"/>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-4 col-md-9">
                        <button type="button" onclick="saveSalary({{$employeeID}});return false;"    class="btn green"><i class="fa fa-check"></i> Submit</button>

                    </div>
                </div>
            </div>
            {!!  Form::close()  !!}
                    <!-- -----------END FORM-------->
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>