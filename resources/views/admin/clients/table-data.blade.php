<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center">الاسم</th>
						<th class="text-center">الصورة</th>
						<th class="text-center">الجوال</th>
						<th class="text-center">الايميل</th>
						<th class="text-center">المنطقة</th>
						<th class="text-center">النوع</th>
						@can('change_status_clients')
						<th class="text-center">{{__('lang.status')}}</th>
						@endcan
						@can('update_clients')
						<th class="text-center">{{__('lang.edit')}}</th>
						@endcan
						@can('delete_clients')
						<th class="text-center">{{__('lang.delete')}}</th>
						@endcan
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				@php 
					$i =1;
				@endphp
				@if(count($data['clients']) > 0)
					@foreach($data['clients'] as $client)
					@php 
						$lang = \App::getLocale();
						if($client->type==1)
								{
								$class1='btn btn-dark m-btn m-btn--icon m-btn--pill';
								$color1='green'; 
								$icon1='check';
								$text1 = 'هاوي';
							}elseif($client->type==2){
								$class1='btn btn-warning  m-btn m-btn--icon m-btn--pill';
								$color1='red';
								$icon1='check';
								$text1 = 'شركة';
							}else{
								$class1='btn btn-danger  m-btn m-btn--icon m-btn--pill';
								$color1='red';
								$icon1='check';
								$text1 = 'عميل';
							}
							if($client->status==1)
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
							{{$client['name']}}
						</td>
						<td class="text-center">
							<a  data-fancybox="gallery" href ="{{$client->image}}"  >
								<img src="{{$client->image}}" width="50px" style="height:50px" alt="">
							</a>
						</td>
						<td class="text-center">
							{{$client->phone}}
						</td>
						<td class="text-center">
							{{$client['email']}}
						</td>
						<td class="text-center">
							@if($client->zone){{$client->zone->name}}@endif
						</td>
						
						<td class="text-center">
							<a  href="javascript:void(0);"   color="{{$color1}}" data-id="{{$client->id}}" class="{{$class1}}" >  <span>{{$text1}}</span> </a>
						</td>

						@can('change_status_clients')
						<td class="text-center">
						<a  href="javascript:void(0);"  color="{{$color}}" data-id="{{$client->id}}" class="{{$class}} UpdateStats " >  <span>{{$text}}</span> </a>
						</td>
						@endcan
						@can('update_clients')
						<td class="text-center">
						<a href="javascript:void(0);" data-id="{{$client->id}}" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                     	updateDetails"> <i class="fa fa-edit"></i> </a>
						</td>
						@endcan
						@can('delete_clients')
						<td class="text-center"><a href="javascript:void(0);" data-id="{{$client->id}}" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							delete"> <i class="fa fa-trash"></i> </a>
						</td>
						@endcan
					</tr>
					@endforeach
				@else
				<tr  class="m-datatable__row"><td colspan="10" class="text-center">{{__('lang.no_data')}} </td></tr>
				@endif
			</tbody>
			<tbody class="m-datatable__body DataUsers">
		</tbody>
	</table>
	<div style="text-align: center;">
			{!! $data['clients']->render() !!}
	</div>
</div>