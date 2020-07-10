<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><strong><i class="fa fa-plus"></i> Add Department</strong></h4>
    </div>
    <div class="modal-body">
        <div class="portlet-body form">

            <!-- BEGIN FORM-->

            {!! Form::open(array('route'=>"admin.departments.store",'class'=>'form-horizontal ','method'=>'POST', 'id' => 'add_department_form')) !!}


            <div class="form-body">

                <p class="text-success">
                    Department
                </p>
                <div class="form-group">
                    <div class="col-md-12">
                        <input class="form-control form-control-inline " name="deptName" type="text" value="" placeholder="Department"/>

                    </div>

                </div>
                <hr>
                <p class="text-success">
                    Designations
                </p>
                <div class="form-group">
                    <div class="col-md-6">
                        <input class="form-control form-control-inline input-medium " name="designation[0]" type="text" value="" placeholder="Designation #1"/>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
                <div id="AddedDestinations"></div>
                <button type="button" onclick="addDestinations()" class="btn btn-sm green form-control-inline">
                    More Designations <i class="fa fa-plus"></i>
                </button>

            </div>

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="button" onclick="storeDepartments();return false;"   class="btn green"><i class="fa fa-check"></i> Submit</button>
                    </div>
                </div>
            </div>
            {!!  Form::close()  !!}
                    <!-- END FORM-->
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>



