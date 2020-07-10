@extends('admin.adminlayouts.adminlayout')

@section('head')
	<!-- BEGIN PAGE LEVEL STYLES -->
	{!! HTML::style("assets/global/plugins/bootstrap-datepicker/css/datepicker3.css") !!}
	{!! HTML::style("assets/global/plugins/select2/select2.css") !!}
	{!! HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css") !!}
	<!-- END PAGE LEVEL STYLES -->
@stop


@section('mainarea')


			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			{{$pageTitle}} <small>Employee List</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="{{route('admin.dashboard.index')}}">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="{{route('admin.attendances.index')}}">Attendance</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">attendance</a>
					</li>
				</ul>

			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div id="load">

                            @if(Session::get('success'))
                                <div class="alert alert-success">{!! Session::get('success') !!} </div>
                            @endif

                    </div>

                    <div class="row">
                                   <div class="col-md-3">

                             {!! Form::open(['route'=>["admin.attendances.create"],'class'=>'form-horizontal','method'=>'GET']) !!}

                                    <div class="input-group input-medium date date-picker"   data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                           <input type="text" class="form-control" name="date" readonly placeholder="select Date">
                                           <span class="input-group-btn">
                                           <button class="btn blue" type="submit"><i class="fa fa-calendar"></i> Edit</button>
                                           </span>
                                       </div>
                                     {!! Form::close() !!}

                                         </div>
                                   <div class="col-md-offset-6 col-md-3 ">

                                    <a href="{{route('admin.attendances.create')}}" class="btn green">
                                         Mark Todays Attendance <i class="fa fa-plus"></i>
                                         </a>


                                    </div>


                       </div>


                         <hr>
					<div class="portlet box blue">

						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-users"></i>Attendance Summary
							</div>
                            <div class="tools" style="padding: 5px;">
                                <form id="attendanceExport" method="POST">
                                    {{ csrf_field() }}
                                    <div class="btn-group pull-right">
                                        <button type="submit" class="btn yellow"><i class="fa fa-file-excel-o"></i> Export</button>
                                    </div>
                                    <div class="btn-group pull-right" style="margin-right: 10px;">
                                        <div class="input-daterange input-group">
                                            <input type="text" class="input-md form-control" name="start" />
                                            <span class="input-group-addon">to</span>
                                            <input type="text" class="input-md form-control" name="end" />
                                        </div>
                                    </div>
                                </form>
							</div>
						</div>

						<div class="portlet-body">

							<table class="table table-striped table-bordered table-hover" id="sample_1">
							<thead>
							<tr>
								<th> EmployeeID </th>
								<th class="text-center"> Image </th>
								<th> Name </th>
								<th> Last Absent </th>
								<th> Leaves </th>
								<th> Status</th>
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

			{{--DELETE MODAL CALLING--}}
                            @include('admin.common.delete')
             {{--DELETE MODAL CALLING END--}}

@stop


@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->
	{!!  HTML::script("assets/global/plugins/select2/select2.min.js") !!}
	{!!  HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js") !!}
	{!!  HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js") !!}
    {!!  HTML::script("assets/admin/pages/scripts/table-managed.js") !!}
    {!! HTML::script("assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js") !!}
    {!! HTML::script("assets/admin/pages/scripts/components-pickers.js") !!}

<!-- END PAGE LEVEL PLUGINS -->

	<script>
        var table = $('#sample_1');

        jQuery(document).ready(function() {
            ComponentsPickers.init();
        TableManaged.init();
            attendanceList();
        });

        $('.input-daterange input[name="start"], .input-daterange input[name="end"]').val((new Date()).toISOString().slice(0, 10));

        $('.input-daterange').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            endDate: new Date(),
        });

        function attendanceList(){
            table.dataTable({
                "cache": true,
                "bProcessing": true,
                "colReorder": true,
                "bServerSide": true,
                "bDestroy": true,
                "order": [[0, "desc"]],

                "ajax": "{{ route("admin.attendance.ajax-attendance-list") }}",
                "aoColumns": [
                    {'sClass': 'center', 'bSortable': true, 'data': 0 },
                    {'sClass': 'center', 'bSortable': false, 'data': 1},
                    {'sClass': 'center', 'bSortable': false, 'data': 2},
                    {'sClass': 'center', 'bSortable': false, 'data': 4},
                    {'sClass': 'center', 'bSortable': false, 'data': 5},
                    {'sClass': 'center', 'bSortable': false, 'data': 3},
                    {'sClass': 'center', 'bSortable': false, 'data': 6},
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
    //				var row = $(nRow);
    //				row.attr("id", 'row'+aData['0']);
                },
                "fnDrawCallback": function () {
                    Metronic.init();
                },
                "sPaginationType": "full_numbers",
                "language": {
                    "emptyTable": "No data available"
                },
                "fnInitComplete": function(oSettings, json) {
                    Metronic.init();
                },
            });

    //		new $.fn.dataTable.ColReorder( table, {
    //			table.colReorder.move( 0, 3 );
    //		});

        }

        $('#attendanceExport').submit(function(e) {
            var form = $(this);

            var searchValue = $('.dataTables_filter input').val();
            var url = '{{ route("admin.attendance.export") }}?s='+searchValue;

            form.attr('action', url);
        });
	</script>

@stop
