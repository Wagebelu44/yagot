<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center">{{ __('lang.image') }}</th>
						<th class="text-center">{{ __('lang.url') }}</th>
						@can('update_status_social')
						<th class="text-center">{{ __('lang.status') }}</th>
						@endcan
						@can('edit_social')
						<th class="text-center">{{ __('lang.edit') }}</th>
						@endcan
						@can('delete_social')
						<th class="text-center">{{ __('lang.delete') }}</th>
						@endcan
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				@php 
					$i =1;
				@endphp
				@if(count($data['social']) > 0)
					@foreach($data['social'] as $slider)
					@php 
						if($slider->status == 1 )
								{
								$class='btn btn-success m-btn m-btn--icon m-btn--pill';
								$color='green'; 
								$icon='check';
								$text = __('lang.active');
							}else{
								$class='btn btn-danger m-btn m-btn--icon m-btn--pill';
								$color='red';
								$icon='check';
								$text = __('lang.inactive');
							}
					@endphp
					<tr class="m-datatable__row">
						<td class="text-center">
							{{$i++}}
						</td>
						<td class="text-center">
							<img src="/uploads/{{$slider->file}}" style="width:35px" alt="">
						</td>
						<td class="text-center">
							{{$slider->url}}
						</td>
						
						@can('update_status_social')
						<td class="text-center">
						<a  color="{{$color}}" data-id="{{$slider->id}}" class="{{$class}} UpdateStats "  href="javaScript:;">  <span>{{$text}}</span> </a>
						</td>
						@endcan
						@can('edit_social')
						<td class="text-center">
						<a href="#" data-id="{{$slider->id}}" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                     	updateDetails"> <i class="fa fa-edit"></i> </a>
						</td>
						@endcan
						@can('delete_social')
						<td class="text-center">
							<a href="#" data-id="{{$slider->id}}" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air	delete"> <i class="fa fa-trash"></i> </a>
						</td>
						@endcan
					</tr>
					@endforeach
				@else
				<tr class="m-datatable__row text-center"><td colspan="8">{{ __('lang.no_data_found') }} </td></tr>
				@endif
			</tbody>
			<tbody class="m-datatable__body DataUsers">
		</tbody>
	</table>
	<div style="text-align: center;">
			{!! $data['social']->render() !!}
	</div>
</div>