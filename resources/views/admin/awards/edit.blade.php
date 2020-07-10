@extends('admin.adminlayouts.adminlayout')

@section('head')
    <!-- BEGIN PAGE LEVEL STYLES -->
    {!! HTML::style("assets/global/plugins/bootstrap-select/bootstrap-select.min.css") !!}
    {!! HTML::style("assets/global/plugins/select2/select2.css") !!}
    {!! HTML::style("assets/global/plugins/jquery-multi-select/css/multi-select.css") !!}
    <!-- BEGIN THEME STYLES -->
@stop


@section('mainarea')

			
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			<i class="fa fa-edit"></i> Edit <small>{{ $award->awardName }} given to {{ $award->employeeDetails->fullName }}</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="{{route('admin.dashboard.index')}}">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="{{ route('admin.awards.index') }}">Awards</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href=""> Edit an Awards</a>
					</li>
				</ul>
			
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-edit"></i>Edit Award
							</div>
							<div class="tools">
							</div>
						</div>

						<div class="portlet-body form">

						<!------------------------ BEGIN FORM---------------------->
						    {!!  Form::model($award, ['method' => 'PUT', 'class'=>'form-horizontal form-bordered', 'id' => 'edit_award_form'])  !!}

                            <div class="form-body">

                            <div class="form-group">
                            <label class="col-md-2 control-label">Award Name: <span class="required">
                            * </span>
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="awardName" placeholder="Award Name" value="{{ $award->awardName }}">
                                </div>
                            </div>

                            <div class="form-group">
                            <label class="col-md-2 control-label">Gift Item: <span class="required">
                                * </span>
                                </label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="gift" placeholder="Gift" value="{{ $award->gift }}" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Cash price: ( <span class="fa {{$setting->currency_icon}}"></span> )</label>

                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="cashPrice" placeholder="CashPrice" value="{{ $award->cashPrice }}">
                                        </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Employee name:</label>

                                    <div class="col-md-8">
                                        {!!  Form::select('employeeID', $employees,$award->employeeID,['class'=>'form-control input-xlarge select2me'])  !!}
                                    </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Month:</label>

                                      <div class="col-md-3">
                                     <select class="form-control select2me" name="forMonth">
                                        <option value="" selected="selected">Month</option>
                                        <option value="january"  @if($award->forMonth=='january')selected='selected'@endif >January</option>
                                        <option value="february" @if($award->forMonth=='february')selected='selected'@endif>February</option>
                                        <option value="march"    @if($award->forMonth=='march')selected='selected'@endif>March</option>
                                        <option value="april"    @if($award->forMonth=='april')selected='selected'@endif>April</option>
                                        <option value="may"      @if($award->forMonth=='may')selected='selected'@endif>May</option>
                                        <option value="june"     @if($award->forMonth=='june')selected='selected'@endif>June</option>
                                        <option value="july"     @if($award->forMonth=='july')selected='selected'@endif>July</option>
                                        <option value="august"   @if($award->forMonth=='august')selected='selected'@endif>August</option>
                                        <option value="september" @if($award->forMonth=='september')selected='selected'@endif>September</option>
                                        <option value="october"  @if($award->forMonth=='october')selected='selected'@endif>October</option>
                                        <option value="november" @if($award->forMonth=='november')selected='selected'@endif>November</option>
                                        <option value="december" @if($award->forMonth=='december')selected='selected'@endif>December</option>
                                 </select>

                                       </div>

                                     <label class="col-md-2 control-label">Year:</label>

                                           <div class="col-md-3">
                                                    {!!  Form::selectYear('forYear', 2013, 2015,$award->forYear,['class'=>'form-control select2me'])  !!}
                                     </div>
                                                    </div>

                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="button" onclick="updateAward({{$award->id}});return false;"   class="btn green"><i class="fa fa-check"></i> Submit</button>

                                    </div>
                                </div>
                            </div>
                        {!!  Form::close()  !!}
                       <!------------------------- END FORM ----------------------->

						</div>
                        </div>
					<!-- END EXAMPLE TABLE PORTLET-->
					
				</div>
			</div>
			<!-- END PAGE CONTENT-->



@stop

@section('footerjs')

<!-- BEGIN PAGE LEVEL PLUGINS -->
{!! HTML::script("assets/global/plugins/bootstrap-select/bootstrap-select.min.js") !!}
{!! HTML::script("assets/global/plugins/select2/select2.min.js") !!}
{!! HTML::script("assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js") !!}
<!-- END PAGE LEVEL PLUGINS -->
  <script>
      // Javascript function to update the company info and Bank Info
      function updateAward(id){

          var url = "{{ route('admin.awards.update',':id') }}";
          url = url.replace(':id',id);
          $.easyAjax({
              type: 'POST',
              url: url,
              container: '#edit_award_form',
              data: $('#edit_award_form').serialize(),
          });
      }
  </script>
@stop