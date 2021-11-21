<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center">{{trans('lang.client_name')}}</th>
						<th class="text-center">{{trans('lang.transfer_name')}}</th>
						<th class="text-center">{{trans('lang.mobile')}}</th>
						<th class="text-center">{{trans('lang.payment_type')}}</th>
						<th class="text-center">{{trans('lang.currency')}}</th>
						<th class="text-center">{{trans('lang.send_date')}}</th>
						<th class="text-center">{{trans('lang.transaction_id')}}</th>
						
						@can('change_status_banks_transfer')
						<th class="text-center">{{trans('lang.status')}}</th>
						@endcan
						@can('details_banks_transfer')
						<th class="text-center">{{trans('lang.details')}}</th>
						@endcan
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				@php 
					$i =1;
				@endphp
				@if(count($data['transfer']) > 0)
					@foreach($data['transfer'] as $transfer)
					@php 
					 
				 if($transfer->status == -1 )
							{
                                $class='btn btn-success btn-sm m-btn text-white m-btn--icon m-btn--pill';
                            }else  if($transfer->status == 1 ){
                                $class='btn btn-warning btn-sm text-white m-btn m-btn--icon m-btn--pill';
							}
							else  {
                                $class='btn btn-danger btn-sm text-white m-btn m-btn--icon m-btn--pill';
                            }
							$text = $transfer->status_sys;

					@endphp

					<tr class="m-datatable__row">
						<td class="text-center">
							{{$i++}}
						</td>
						<td class="text-center">
							{{$transfer->client_name}}
						</td>
						<td class="text-center">
							{{$transfer->name_tranfer}}
						</td>
						<td class="text-center">
							{{$transfer->mobile}}
						</td>
						<td class="text-center">
							{{$transfer->fees_type}}
						</td>
						<td class="text-center">
							{{$transfer->currency_name}}
						</td>
						<td class="text-center">
							{{$transfer->date}}
						</td>
						<td class="text-center">
							{{$transfer->transaction_id ?? '-'}}
						</td>
						@can('change_status_banks_transfer')

						<td class="text-center">
							@if($transfer->status != -1)

							<a class="{{$class}}" ><span>{{$text}}</span> </a>
							
							@else

							<a href="#" data-id="{{$transfer->id}}" class="btn btn-warning text-white m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							yes"> <i class="fa fa-check"></i> </a>

							<a href="#" data-id="{{$transfer->id}}" class="btn btn-danger text-white m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							no"> <i class="fa fa-times"></i> </a>
																	
							@endif
						
						</td>
						@endcan
						@can('details_banks_transfer')
						<td class="text-center">
							<a href="#" data-id="{{$transfer->id}}" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air details"> <i class="fa fa-book"></i> </a>
						</td>
						@endcan
					</tr>
					@endforeach
				@else
				<tr class="m-datatable__row text-center"><td colspan="8">{{trans('lang.no_data')}}</td></tr>
				@endif
			</tbody>
			<tbody class="m-datatable__body DataUsers">
		</tbody>
	</table>
	<div class="table_page" style="text-align: center;">
			{!! $data['transfer']->render() !!}
	</div>
</div>