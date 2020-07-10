@extends('admin.adminlayouts.adminlayout')

@section('head')

{!! HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css") !!}
@stop

@section('mainarea')

			
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			    {{$pageTitle}}
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="{{route('admin.dashboard.index')}}">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="{{route('admin.leavetypes.index')}}">LeaveTypes</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Leave Types</a>
					</li>
				</ul>
			
			</div>
			<!-- END PAGE HEADER-->


			<!-- BEGIN PAGE CONTENT-->

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->

                   <a class="btn green" onclick="showAdd()">
									Add New Leave Type
                    <i class="fa fa-plus"></i> </a>

                         <hr>
					<div class="portlet box blue">

						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-users"></i>LeaveTypes List
							</div>
							<div class="tools">
							</div>
						</div>

						<div class="portlet-body">
					<div class="note note-info">
							<p>
								{!! Lang::get('messages.noteLeaveTypes') !!}
							</p>
					</div>
							<table class="table table-striped table-bordered table-hover" id="leaveType" >
							<thead>
							<tr>
								<th> # </th>
								<th> Leave </th>
								<th> Number of Leaves </th>
								<th> Action </th>

							</tr>
							</thead>
							<tbody>

							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
					
				</div>
			</div>
			<!-- END PAGE CONTENT-->

    {{-------------------------- Add MODALS -----------------}}


			{{--DELETE MODAL CALLING--}}
@include('admin.include.delete-modal')
@include('include.show-modal')
             {{--DELETE MODAL CALLING END--}}

@stop


@section('footerjs')

    {!!  HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js") !!}
    {!!  HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js") !!}

	<script>
        var table = $('#leaveType').dataTable( {
                    "cache": true,
                    "bProcessing": true,
                    "bServerSide": true,
                    "bDestroy": true,
                    "order": [[1, "desc"]],
                    "ajax": "{{ URL::route("admin.leavetypes.ajax_list") }}",
                    "aoColumns": [
                        { 'sClass': 'center', "bSortable": true  },
                        { 'sClass': 'center', "bSortable": true },
                        { 'sClass': 'center', "bSortable": true },
                        { 'sClass': 'center', "bSortable": false }
                    ],
                    "lengthMenu": [
                        [5, 15, 20, -1],
                        [5, 15, 20, "All"] // change per page values here
                    ],
                    "sPaginationType": "full_numbers",
                    "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                        var row = $(nRow);
                        row.attr("id", 'row'+aData['0']);
                    }

                });

        // Show Delete Modal
        function del(id,name) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html('Are you sure ! You want to delete <strong>'+name+'</strong> ?');

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "{{ route('admin.leavetypes.destroy',':id') }}";
                url = url.replace(':id',id);

                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token},
                    container: "#deleteModal",
                    success: function (response) {
                        if (response.status == "success") {
                            $('#deleteModal').modal('hide');
							table.fnDraw();
                        }
                    }
                });

            });
        }
        // Show Create Department Modal
        function showEdit(id,leaveType,num) {
            var url = "{{ route('admin.leavetypes.edit',':id') }}";
            url = url.replace(':id',id);
             $.ajaxModal('#showModal', url);

        $("#edit_leaveType").val(leaveType);
        $("#edit_num_of_leave").val(num);
        }

        // Show Create Department Modal
        function showAdd() {
            var url = "{{ route('admin.leavetypes.create') }}";
             $.ajaxModal('#showModal', url);

        }
        // Javascript function to update the company info and Bank Info
        function addUpdateLeaveType(id){

            if(typeof id!='undefined') {
                var url = "{{ route('admin.leavetypes.update',':id') }}";
                url = url.replace(':id',id);
            } else {
                url ="{{route('admin.leavetypes.store')}}";
            }
            $.easyAjax({
                type: 'POST',
                url: url,
                container: '#leave_type_update_form',
                data: $('#leave_type_update_form').serialize(),
                success: function () {
                    $('#showModal').modal('hide');
                    table.fnDraw();
                }
            });
        }

</script>
@stop
	