
<div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title"><strong>Holidays</strong></h4>
        </div>
        <div class="modal-body">
            <div class="portlet-body form">

                <!-- BEGIN FORM-->
                {!! Form::open(array('id' => 'add_holiday_form', 'class'=>'form-horizontal ','method'=>'POST')) !!}


                <div class="form-body">

                    <div class="form-group">
                        <div class="col-md-6">
                            <input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" name="date[0]" type="text" value="" placeholder="Date"/>

                        </div>
                        <div class="col-md-6">
                            <input class="form-control form-control-inline"  type="text" name="occasion[0]" placeholder="Occasion"/>
                        </div>
                    </div>
                    <div id="insertBefore"></div>
                    <button type="button" id="plusButton" class="btn btn-sm green form-control-inline">
                        Add More <i class="fa fa-plus"></i>
                    </button>

                </div>

                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="button" onclick="storeHolidays();"   class="btn green"><i class="fa fa-check"></i> Submit</button>

                        </div>
                    </div>
                </div>
                {!!  Form::close()  !!}
                        <!-- END FORM-->
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>

{{-- This is ajax called inside the index page modal  --}}
<script>
    jQuery(document).ready(function() {
        ComponentsPickers.init();
    });
    var $insertBefore = $('#insertBefore');
    var $i = 0;
    $('#plusButton').click(function(){

        $i = $i+1;
        $(' <div class="form-group"> ' +
                '<div class="col-md-6"><input class="form-control form-control-inline input-medium date-picker'+$i+'" name="date['+$i+']" type="text" value="" placeholder="Date"/></div>' +
                '<div class="col-md-6"><input class="form-control form-control-inline" name="occasion['+$i+']" type="text" value="" placeholder="Occasion"/></div>' +
                '</div>').insertBefore($insertBefore);
        $.fn.datepicker.defaults.format = "dd-mm-yyyy";
        $('.date-picker'+$i).datepicker();
    });
</script>


