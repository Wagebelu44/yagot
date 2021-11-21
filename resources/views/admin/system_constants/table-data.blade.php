<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center">{{trans('lang.name')}}</th>
						<th class="text-center">{{trans('lang.type')}}</th>
						@can('status_system_constants')
						<th class="text-center">{{trans('lang.status')}}</th>
						@endcan
						@can('update_system_constants')
						<th class="text-center">{{trans('lang.edit')}}</th>
						@endcan
						@can('delete_system_constants')
						<th class="text-center">{{trans('lang.delete')}}</th>
						@endcan
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				@php 
					$i =1;
					$name_type = '';
				@endphp
				@if(count($data['system_constants']) > 0)
					@foreach($data['system_constants'] as $system_constant)
                    @php 
						if($system_constant->status==1)
								{
								$class='btn btn-success m-btn m-btn--icon m-btn--pill';
								$color='green'; 
								$icon='check';
								$text = trans("lang.on");
							}else{
								$class='btn btn-danger m-btn m-btn--icon m-btn--pill';
								$color='red';
								$icon='check';
								$text = trans("lang.off");
							}
					
					@endphp
					<tr class="m-datatable__row">
						<td class="text-center">
							{{$i++}}
						</td>
						<td class="text-center">
							{{$system_constant->name}}
						</td>
						<td class="text-center">
							{{$system_constant->type}}
						</td>
                        @can('status_system_constants')
						<td class="text-center">
							<a  color="{{$color}}" data-id="{{$system_constant->id}}" class="{{$class}} UpdateStats "  href="javaScript:;"> <span>{{$text}}</span> </a>
						</td>
						@endcan
						@can('update_system_constants')
						<td class="text-center">
							<a href="#" data-id="{{$system_constant->id}}" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							updateDetails"> <i class="fa fa-edit"></i> </a>
						</td>
						@endcan
						@can('delete_system_constants')
						<td class="text-center"><a href="#" data-id="{{$system_constant->id}}" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							delete"> <i class="fa fa-trash"></i> </a>
						</td>
						@endcan
					
					</tr>
					@endforeach
				@else
				<tr class="m-datatable__row text-center"><td colspan="15">{{trans('lang.no_data')}}</td></tr>
				@endif
			</tbody>
			<tbody class="m-datatable__body DataUsers">
		</tbody>
	</table>
	<div style="text-align: center;">
			{!! $data['system_constants']->render() !!}
	</div>
</div>