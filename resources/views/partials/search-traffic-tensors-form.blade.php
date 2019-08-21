<div class="row">
    <div class="col-sm-8 offset-sm-4 col-md-6 offset-md-6 col-lg-5 offset-lg-7 col-xl-4 offset-xl-8">
        {!! Form::open(['route' => 'search-traffic-tensors', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'id' => 'search_traffic_tensors']) !!}
            {!! csrf_field() !!}
            <div class="input-group mb-3">
                {!! Form::text('traffic_tensor_search_box', NULL, ['id' => 'traffic_tensor_search_box', 'class' => 'form-control', 'placeholder' => trans('traffic-tensors.search.search-traffic-tensors-ph'), 'aria-label' => trans('traffic-tensors.search.search-traffic-tensors-ph'), 'required' => false]) !!}
                <div class="input-group-append">
                    <a href="#" class="input-group-addon btn btn-warning clear-search" data-toggle="tooltip" title="{{ trans('traffic-tensors.tooltips.clear-search') }}" style="display:none;">
                        <i class="fa fa-fw fa-times" aria-hidden="true"></i>
                        <span class="sr-only">
                            {!! trans('traffic-tensors.tooltips.clear-search') !!}
                        </span>
                    </a>
                    <a href="#" class="input-group-addon btn btn-secondary" id="search_trigger" data-toggle="tooltip" data-placement="bottom" title="{{ trans('traffic-tensors.tooltips.submit-search') }}" >
                        <i class="fa fa-search fa-fw" aria-hidden="true"></i>
                        <span class="sr-only">
                            {!!  trans('traffic-tensors.tooltips.submit-search') !!}
                        </span>
                    </a>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
