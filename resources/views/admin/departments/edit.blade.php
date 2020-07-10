<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title"><strong><i class="fa fa-edit"></i> Edit Department</strong></h4>
    </div>
    <div class="modal-body">
        <div class="portlet-body form">

            <!-- BEGIN FORM-->

            {!!  Form::open(['method' => 'PUT','class'=>'form-horizontal','id'=>'edit_department_form'])  !!}

            <div class="form-body">

                <p class="text-success">
                    Department
                </p>
                <div class="form-group">
                    <div class="col-md-12">
                        <input class="form-control form-control-inline " name="deptName" id="edit_deptName" type="text" value="{{$department->deptName}}" placeholder="Department" />
                    </div>

                </div>

                <div id="deptresponse">
                    <p class="text-success">
                        <strong>Designations</strong> (empty if you want to delete the designation )
                    </p>

                    @php $i=0 @endphp
                    @foreach($department->Designations as $designations)

                        <div class="form-group">
                            <div class="col-md-6">
                                <input class="form-control form-control-inline input-medium" name="designation[{{$i}}]" id="designation" type="text" value="{{$designations['designation']}}" placeholder="Designation #1"/>
                                <input type="hidden" name="designationID[{{$i}}]" id="designation" type="text" value="{{$designations['id']}}" placeholder="Designation #1"/>
                            </div>
                            @php
                            $i++;
                            @endphp
                        </div>
                    @endforeach
                </div>

                <div id="editDestinationDiv"></div>
                <button type="button" onclick="addEditDestination()" class="btn btn-sm green form-control-inline">
                    More Designations <i class="fa fa-plus"></i>
                </button>

            </div>
            <br>
            <div class="note note-warning">
                {!! Lang::get('messages.deleteNoteDesignation') !!}
            </div>

            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="button" onclick="UpdateDepartments({{$department->id}});return false;"   class="btn green"><i class="fa fa-edit"></i> Update</button>
                    </div>
                </div>
            </div>
            {!!  Form::close()  !!}
                    <!-- END FORM-->
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>

