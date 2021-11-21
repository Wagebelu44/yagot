<div class="table-responsive">

<table class="table table-bordered" id="html_table" width="100%">

			<thead class="m-datatable__head">

				<tr>

						<th class="text-center">#</th>

						<th class="text-center">{{trans('lang.name')}} </th>
						<th class="text-center">{{trans('lang.price')}}</th>
						<th class="text-center">{{trans('lang.number_days')}}</th>
						<th class="text-center">{{trans('lang.number_products')}}</th>

						@can('edit_subscriptions')

						<th class="text-center">{{trans('lang.edit')}}</th>

						@endcan

						@can('delete_subscriptions')

						<th class="text-center">{{trans('lang.delete')}}</th>

						@endcan

				</tr>

			</thead>

			<tbody class="m-datatable__body load">

				@php 

					$i =1;

				@endphp

				@if(count($data['static']) > 0)

					@foreach($data['static'] as $static)

					@php 

						if($static->status==1)

								{

								$class='btn btn-success m-btn m-btn--icon m-btn--pill';

								$color='green'; 

								$icon='check';

								$text = 'مفعل';

							}else{

								$class='btn btn-danger m-btn m-btn--icon m-btn--pill';

								$color='red';

								$icon='check';

								$text = 'غير مفعل';

							}

					@endphp

					<tr class="m-datatable__row">

						<td class="text-center">

							{{$i++}}

						</td>

						<td class="text-center">

							{{$static['name']}}

						</td>

						<td class="text-center">

							{{$static['price']}} {{$static['currency_name']}}


						</td>
						<td class="text-center">

							{{$static->number_days}}


						</td>
						<td class="text-center">
							{{$static->number_products}}

						</td>

						@can('edit_subscriptions')

						<td class="text-center">

						<a href="#" data-id="{{$static->id}}" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air

                     	updateDetails"> <i class="fa fa-edit"></i> </a>

						</td>

						@endcan

						@can('delete_subscriptions')

						<td class="text-center">
							@if($static->id != 4)
							<a href="#" data-id="{{$static->id}}" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air

							delete"> <i class="fa fa-trash"></i> </a>
							@else 
								-
							@endif
						</td>

						@endcan

					</tr>

					@endforeach

				@else

				<tr  class="m-datatable__row"><td colspan="10" class="text-center">{{trans('lang.no_data')}}</td></tr>

				@endif

			</tbody>

			<tbody class="m-datatable__body DataUsers">

		</tbody>

	</table>

	<div style="text-align: center;">

			{!! $data['static']->render() !!}

	</div>

</div>