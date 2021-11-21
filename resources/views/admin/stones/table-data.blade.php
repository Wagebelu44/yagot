<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center">{{trans('lang.name')}}</th>
						<th class="text-center">{{trans('lang.image')}}</th>
					
						@can('edit_stones')
						<th class="text-center">{{trans('lang.edit')}}</th>
						@endcan
						@can('delete_stones')
				
						<th class="text-center">{{trans('lang.delete')}}</th>
						@endcan
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				@php 
					$i =1;
				@endphp
				@if(count($data['category']) > 0)
					@foreach($data['category'] as $slider)
					@php 
					if($slider->status==1)
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
							{{$slider->name}}
						</td>
						<td class="text-center">
							<a  data-fancybox="gallery" href ="{{$slider->photo}}"  >
								<img src="{{$slider->photo}}" width="50px" style="height:50px" alt="">
							</a>
						</td>
						
						@can('edit_stones')
						<td class="text-center">
						<a href="#" data-id="{{$slider->id}}" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                     	updateDetails"> <i class="fa fa-edit"></i> </a>
						</td>
						@endcan
						@can('delete_stones')
						<td class="text-center">
							<a href="#" data-id="{{$slider->id}}" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air	delete"> <i class="fa fa-trash"></i> </a>
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
			{!! $data['category']->render() !!}
	</div>
</div>