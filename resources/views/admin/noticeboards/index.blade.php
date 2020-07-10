@extends('admin.adminlayouts.adminlayout')

@section('head')


    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/select2/select2.css") !!}
    {!! HTML::style("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css") !!}
    <!-- END PAGE LEVEL STYLES -->

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
                <a href="#">Notice</a>
                <i class="fa "></i>
            </li>

        </ul>

    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row ">
        <div class="col-md-6">

            <a class="btn green" data-toggle="modal" href="{{URL::route('admin.noticeboards.create')}}">
                Add New Notice
                <i class="fa fa-plus"></i> </a>
        </div>
        <div class="col-md-6 form-group text-right">

            <span id="load_notification"></span>
            <input type="checkbox" onchange="ToggleEmailNotification('notice_notification');return false;"
                   class="make-switch" name="notice_notification" @if($setting->notice_notification==1)checked
                   @endif data-on-color="success" data-on-text="Yes" data-off-text="No" data-off-color="danger">
            <strong>Email Notification</strong><br>


        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">


            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div id="load">

                {{--INLCUDE ERROR MESSAGE BOX--}}
                @include('admin.common.error')
                {{--END ERROR MESSAGE BOX--}}

            </div>
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-clipboard"></i>Notice List
                    </div>
                    <div class="tools">
                    </div>
                </div>

                <div class="portlet-body">


                    <table class="table table-striped table-bordered table-hover" id="notices">
                        <thead>
                        <tr>
                            <th> ID</th>
                            <th> Title</th>
                            <th> Description</th>
                            <th> Status</th>
                            <th> Created on</th>
                            <th> Action</th>
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
    @include('admin.include.delete-modal')
    {{--DELETE MODAL CALLING END--}}
@stop



@section('footerjs')


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    {!!  HTML::script("assets/global/plugins/select2/select2.min.js") !!}
    {!! HTML::script("assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js") !!}
    {!!  HTML::script("assets/global/plugins/datatables/media/js/jquery.dataTables.min.js") !!}
    {!!  HTML::script("assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js") !!}

    <!-- END PAGE LEVEL PLUGINS -->

    <script>


        var table = $('#notices').dataTable({
            "cache": true,
            "bProcessing": true,
            "bServerSide": true,
            "bDestroy": true,
            "order": [[1, "desc"]],
            "ajax": "{{ URL::route("admin.ajax_notices") }}",

            "aoColumns": [
                {'sClass': 'center', "bSortable": true},
                {'sClass': 'center', "bSortable": true},
                {'sClass': 'center', "bSortable": true},
                {'sClass': 'center', "bSortable": true},
                {'sClass': 'center', "bSortable": true},
                {'sClass': 'center', "bSortable": false}
            ],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            "sPaginationType": "full_numbers",
            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                var row = $(nRow);
                row.attr("id", 'row' + aData['0']);
            }

        });


        // Show Delete Modal
        function del(id) {

            $('#deleteModal').modal('show');

            $("#deleteModal").find('#info').html('Are you sure ! You want to delete ?');

            $('#deleteModal').find("#delete").off().click(function () {

                var url = "{{ route('admin.noticeboards.destroy',':id') }}";
                url = url.replace(':id', id);

                var token = "{{ csrf_token() }}";

                $.easyAjax({
                    type: 'DELETE',
                    url: url,
                    data: {'_token': token},
                    container: "#deleteModal",
                    success: function (response) {
                        $('#deleteModal').modal('hide');
                        table.fnDraw();
                    }
                });

            });
        }

    </script>
@stop
	