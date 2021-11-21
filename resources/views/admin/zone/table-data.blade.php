<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center">{{trans('lang.title_zone')}}</th>
						<th class="text-center">المنطقة</th>
						@can('add_sub_zones')
						<th class="text-center">{{trans('lang.title_zone_sub')}}</th>
						@endcan
						@can('change_status_zones')
						<th class="text-center">{{trans('lang.status')}}</th>
						 @endcan
						@can('update_zones')
						<th class="text-center">{{trans('lang.edit')}}</th>
						@endcan
						@can('delete_zones')
						<th class="text-center">{{trans('lang.delete')}}</th>
						@endcan
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				@php 
					$i =1;
				@endphp
				@if(count($data['zone']) > 0)
					@foreach($data['zone'] as $z)
					@php 
						if($z->status == 1 )
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
							{{$z->name}}
						</td>
						<td class="text-center">
							@if($z->parent)
							{{$z->parent->name_ar}}
							@else 
							-
							@endif
							
						</td>
						
						@can('add_sub_zones')
						<td class="text-center">
						<a href="javascript:void(0)" data-name="{{$z->name}}" data-id="{{$z->id}}" class="btn btn-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air 
						addzonesub"> <i class="fa fa-plus"></i> </a>
						</td>
						@endcan
						@can('change_status_zones')
						<td class="text-center">
						<a  color="{{$color}}" data-id="{{$z->id}}" data-parent="0" class="{{$class}} UpdateStats "  href="javaScript:;">  <span>{{$text}}</span> </a>
						</td>
						@endcan
						@can('update_zones') 
						<td class="text-center">
						<a href="#" data-id="{{$z->id}}" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
						 updateDetails"> <i class="fa fa-edit"></i> </a>
				
						</td>
						 @endcan
						@can('delete_zones')
						<td class="text-center">
							<a href="#" data-id="{{$z->id}}" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air	delete"> <i class="fa fa-trash"></i> </a>
						</td>
						 @endcan 
					</tr>
					@endforeach
				@else
				<tr class="m-datatable__row text-center"><td colspan="8">{{trans("lang.no_data")}} </td></tr>
				@endif
			</tbody>
			<tbody class="m-datatable__body DataUsers">
		</tbody>
	</table>
	<div style="text-align: center;">
			{!! $data['zone']->render() !!}
	</div>
</div>