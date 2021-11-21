<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center">{{trans('lang.title')}}</th>
						<th class="text-center">{{trans('lang.images')}}</th>
						@can('update_slider')
						<th class="text-center">{{trans('lang.edit')}}</th>
						@endcan
						@can('delete_slider')
						<th class="text-center">{{trans('lang.delete')}}</th>
						@endcan
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				@php 
					$i =1;
				@endphp
				@if(count($data['slider']) > 0)
					@foreach($data['slider'] as $slider)
					@php 
							if($slider->status==1){
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
							{{$slider->title}}
						</td>
					
						<td class="text-center">
						<a href="#" data-id="{{$slider->id}}" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                     	AllImages"> <i class="fa fa-images"></i> </a>
						</td>
						
						@can('update_slider')
						<td class="text-center">
						<a href="#" data-id="{{$slider->id}}" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
						updateDetailsParent"> <i class="fa fa-edit"></i> </a>
						</td>
						@endcan
						@can('delete_slider')
						<td class="text-center">
							<a href="#" data-id="{{$slider->id}}"  class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air	deleteParent"> <i class="fa fa-trash"></i> </a>
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
	<div style="text-align: center;">
			{!! $data['slider']->render() !!}
	</div>
</div>