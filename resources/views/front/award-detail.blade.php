<div class="modal-header">
    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
    <h4  class="modal-title">
        Award Details
    </h4>
</div>
<div class="modal-body" >
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 feedback_view">
            <div class="divider8"></div>
            <h3>{{ $award->awardName }}</h3>
            <p>
                Month - <strong>{{ ucfirst($award->forMonth) }}, {{ $award->forYear }}</strong>
            </p>
            <p>
                Gift - <strong>{{ $award->gift }}</strong>
            </p>
            <p>
                Price - <strong><i class="fa {{ $setting->currency_icon }}"></i> {{ $award->cashPrice }}</strong>
            </p>
        </div>
    </div>
</div>
