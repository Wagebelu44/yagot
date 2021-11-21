<div class="table-responsive">
<table class="table table-bordered" id="html_table" width="100%">
			<thead class="m-datatable__head">
				<tr>
						<th class="text-center">#</th>
						<th class="text-center">{{trans('lang.full_name')}}</th>
						<th class="text-center">{{trans('lang.email')}}</th>
						<th class="text-center">{{trans('lang.mobile')}}</th>
						@can('change_status_users')
						<th class="text-center">{{trans('lang.status')}}</th>
						@endcan
						@can('update_users')
						<th class="text-center">{{trans('lang.edit')}}</th>
						@endcan
						@can('change_password_user')
						<th class="text-center">{{trans('lang.change_password')}}</th>
						@endcan
						@can('permission_users')
						<th class="text-center">{{trans('lang.permission')}}</th>
						@endcan
						@can('delete_users')
						<th class="text-center">{{trans('lang.delete')}}</th>
						@endcan
				</tr>
			</thead>
			<tbody class="m-datatable__body load">
				@php 
					$i =1;
				@endphp
				@if(count($data['users']) > 0)
					@foreach($data['users'] as $users)
					@php 
						if($users->status==1)
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
							{{$users->fullname}}
						</td>
						<td class="text-center">
							{{$users->email}}
						</td>
						<td class="text-center">
							{{$users->mobile}}
						</td>
						@can('change_status_users')
						<td class="text-center">
							<a  color="{{$color}}" data-id="{{$users->id}}" class="{{$class}} UpdateStats "  href="javaScript:;">  <span>{{$text}}</span> </a>
						</td>
						@endcan
						@can('update_users')
						<td class="text-center">
							<a href="#" data-id="{{$users->id}}" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							updateDetails"> <i class="fa fa-edit"></i> </a>
						</td>
						@endcan
						@can('change_password_user')
						<td class="text-center">
							<a href="#"  data-id="{{$users->id}}" style="background:#1F4282 !important;border-color:#1F4282 !important;box-shadow:0px 5px 10px 2px rgba(31, 66, 130, 0.3) !important" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							password-modal"> <i class="fa fa-lock"></i> </a>
						</td>
						@endcan
						@can('permission_users')
						<td class="text-center">
							<a href="#" data-id="{{$users->id}}" style="background:#F88732 !important;border-color:#F88732 !important;box-shadow:0px 5px 10px 2px rgba(248, 115, 50, 0.25) !important"  class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							permission"> <i class="fas fa-user"></i></a>
						</td>
						@endcan
						@can('delete_users')
						<td class="text-center"><a href="#" data-id="{{$users->id}}" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							delete"> <i class="fa fa-trash"></i> </a>
						</td>
						@endcan
					</tr>
					@endforeach
				@else
				<tr class="m-datatable__row text-center"><td colspan="9">{{trans('lang.no_data')}}</td></tr>
				@endif
			</tbody>
			<tbody class="m-datatable__body DataUsers">
		</tbody>
	</table>
	<div style="text-align: center;">
			{!! $data['users']->render() !!}
	</div>
</div>