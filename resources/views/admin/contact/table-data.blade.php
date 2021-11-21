<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center">{{trans('lang.name')}}</th>
                        <th class="text-center">{{trans('lang.mobile')}}</th>	
						<th class="text-center">{{trans('lang.email')}}</th>	
						<th class="text-center">{{trans('lang.date')}}</th>						
						<th class="text-center">{{trans('lang.show')}}</th>
					
						@can('reply_contact')
                        <th class="text-center">{{trans('lang.send_reply')}}</th>
						@endcan	
					
						@can('delete_contact')
                        <th class="text-center">{{trans('lang.delete')}}</th>
						@endcan		
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				@php 
					$i =1;
				@endphp
				@if(count($data['message']) > 0)
					@foreach($data['message'] as $message)
					@php 
						$color = '';
						
						$length = strlen((string)$message->mobile);
						if($length == 10){
							$mobile = substr($message->mobile, 1);
						}else{	
							$mobile = $message->mobile;
						}

						if($message->admin_view == 1){
						 	$color = 'success';
						}else{
						 	$color = 'danger';
						}
					@endphp
					<tr class="m-datatable__row">
						<td class="text-center">
							{{$i++}}
						</td>
						<td class="text-center">
							{{ $message->name}}
						</td>
						<td class="text-center">
						{{$mobile}}
                        </td>   
						<td class="text-center">
						{{$message->email}}
						</td>  
						<td class="text-center">
						{{$message->created_at}}
                        </td>                       
                        {{-- <td class="text-center">
                            {{$title =  $message->response ?? '-'}}
                        </td> --}}
						
						<td class="text-center">
                            <a href="" class="show_message btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air" data-id="{{ $message->id}}"><i class="far fa-eye"></i></a>
                        </td>	
						
						@can('reply_contact')
                        <td class="text-center">
                            <a href="" class="send_message  btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air" data-id="{{ $message->id}}"><i class="fas fa-reply"></i></a>
                        </td>	
						@endcan	
						
						@can('delete_contact')
							<td class="text-center"><a href="#" data-id="{{$message->id}}" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
								delete"> <i class="fa fa-trash"></i> </a>
							</td>
						@endcan	
					</tr>
					@endforeach
				@else
				<tr class="m-datatable__row"><td class="text-center" colspan="10">لا يوجد بيانات </td></tr>
				@endif
			</tbody>
			<tbody class="m-datatable__body DataUsers">
		</tbody>
	</table>
	<div style="text-align: center;">
			{!! $data['message']->render() !!}
	</div>
</div>