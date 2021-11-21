@extends('admin.layout.master_layout')
@section('title')
   لوحة التحكم
@stop

@section('css')
<style>
    #terms_modal .modal-dialog{
				max-width: initial;
				width: 95vw;
    }
    </style>
@stop

@section('page-content')

					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								
								<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
									<li class="m-nav__item m-nav__item--home">
										<a href="#" class="m-nav__link m-nav__link--icon">
											<i class="m-nav__link-icon la la-home"></i>
										</a>
									</li>
									<li class="m-nav__item">
										<a href="/admin/dashborad" class="m-nav__link">
											<span class="m-nav__link-text">{{trans('lang.home')}}</span>
										</a>
									</li>
									
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="/admin/home_order" class="m-nav__link">
											<span class="m-nav__link-text">{{trans('lang.home_order')}}</span>
										</a>
									</li>
								</ul>
							</div>

		<div class="m-demo__preview  m-demo__preview--btn">
		</div>
	
	<div>

</div>
</div>
</div>

<div class="m-grid__item m-grid__item--fluid m-wrapper">
<!-- BEGIN: Subheader -->
<!-- END: Subheader -->
<div class="m-content">
<div class="row">
<div class="col-lg-12">
<!--begin::Portlet-->
<div class="m-portlet m-portlet--mobile" id="m_blockui_2_portlet">
	<div class="m-portlet__head">
<div class="m-portlet__head-caption">
<div class="m-portlet__head-title">
<h3 class="m-portlet__head-text">
{{trans('lang.home_order')}}
</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
	<div id="table-container">
		<form method="post" class="form_order" action="{{URL::to('/')}}/admin/home_order/save_order">
			@csrf
			<div class="row" id="gridDemo">
				@foreach($data['home_order'] as $h)
				<div class="col-md-12" style="display:block;cursor:pointer">
					<div class="px-3 mb-2 py-2" style="border: 1px solid #ccc;">
						@if($h->type == 1)
							@if(App::getLocale() == 'ar')
								<h6 class="mb-0">{{$h->title}}</h6>
							@else
								<h6 class="mb-0">{{$h->title_en}}</h6>
							@endif
						@else
							<h6 class="mb-0">{{trans("lang.$h->title")}}</h6>
						@endif
						<input type="hidden" name="type[]" value="{{$h->type}}">
						<input type="hidden" name="title[]" value="{{$h->title}}">
						<input type="hidden" name="title_en[]" value="{{$h->title_en}}">
						<input type="hidden" name="reference_id[]" value="{{$h->reference_id}}">
					</div>
				</div>
				@endforeach
			</div>
			<div class="row mt-2">
				<div class="col-md-12">
					<button class="btn btn-primary btn-sm">{{trans('lang.save')}}</button>
				</div>
			</div>
		</form>
	</div>

	</div>
</div>
</div>
</div>
</div>
</div>
@stop   

@section('js')
<script src="{{URL::to('/')}}/js/Sortable.min.js"></script>
<script type="text/javascript">
	var example1 = document.getElementById('gridDemo');
	new Sortable(example1, {
		animation: 150,
		ghostClass: 'blue-background-class'
	});

	$('.form_order').on('submit', function(e){
            e.preventDefault();
            $('#load').show();
            var formData = new FormData(this);
       
                $.ajax({
                    url: '/admin/home_order/save_order',
                    dataType:'json',
                    type: 'POST',
                    cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#load').hide();
                        if (data["status"] == true) {
                                Swal.fire(
                                data['message'],
                                '',
                                'success'
                                );
                        }else {
                            Swal.fire({
                                type: 'error',
                                title: 'عذرا',
                                text: data['message']
                            })
                        }
                    },
                });
            });
</script>
@stop