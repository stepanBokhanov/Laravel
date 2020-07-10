<!------------------------------ BEGIN FORM ----------------------------------------->
{!! Form::open(array('url'=>"",'class'=>'sky-form','id'=>'change_password_form')) !!}

<fieldset>

    <section>
        <div class="form-group">
            <label class="label col col-4">New Password</label>
            <div class="col col-8">
                <label class="input">
                    <i class="icon-append fa fa-lock"></i>
                    <input type="password" class="from-control" name="password">
                </label>
            </div>
            <span class="help-block"></span>
        </div>
    </section>

    <section>
        <div class="form-group">
            <label class="label col col-4">Confirm Password</label>
            <div class="col col-8">
                <label class="input">
                    <i class="icon-append fa fa-lock"></i>
                    <input type="password" class="from-control" name="password_confirmation">
                </label>
                <span class="help-block"></span>
            </div>
        </div>
    </section>


</fieldset>
<footer>
    <button type="submit" class="btn-u field" id="submitbutton" onclick="change_password();return false;">Change
        Password
    </button>

</footer>

{!!  Form::close()  !!}
<!------------------------ END FORM ------------------------------------------>