<div class="table-responsive">
    <table class="table table-bordered" id="html_table" width="100%">
                <thead class="m-datatable__head">
                    <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">{{trans('lang.title_zone')}}</th>
                            
                            {{-- @can('status_zone') --}}
                            {{-- <th class="text-center">{{trans('lang.status')}}</th> --}}
                            {{-- @endcan
                            @can('edit_zone') --}}
                            <th class="text-center">{{trans('lang.edit')}}</th>
                            {{-- @endcan
                            @can('delete_zone') --}}
                            <th class="text-center">{{trans('lang.delete')}}</th>
                            {{-- @endcan --}}
                    </tr>
                </thead>
                <tbody class="m-datatable__body load">
                    @php 
                        $i =1;
                    @endphp
                    @if(isset($data['zone_sub']) )
                    @if($data['zone_sub'] and count($data['zone_sub']) > 0)
                        @foreach($data['zone_sub'] as $z)
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
                                {{$z->name_ar}}
                            </td>
                           
                            {{-- @can('status_zone') --}}
                            {{-- <td class="text-center">
                            <a  color="{{$color}}" data-id="{{$z->id}}" data-parent="{{$z->parent_id}}" class="{{$class}} UpdateStats "  href="javaScript:;">  <span>{{$text}}</span> </a>
                            </td> --}}
                            {{-- @endcan
                            @can('edit_zone') --}}
                            <td class="text-center">
                            <a href="#" data-id="{{$z->id}}" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                             updateDetailssub"> <i class="fa fa-edit"></i> </a>
                            </td>
                            {{-- @endcan
                            @can('delete_zone') --}}
                            <td class="text-center">
                                <a href="#" data-id="{{$z->id}}" data-parent="{{$z->parent_id}}" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air	delete"> <i class="fa fa-trash"></i> </a>
                            </td>
                            {{-- @endcan --}}
                        </tr>
                        @endforeach
                    @else
                    <tr class="m-datatable__row text-center"><td colspan="4">{{trans("lang.no_data")}} </td></tr>
                    @endif
                    @endif
                </tbody>
                <tbody class="m-datatable__body DataUsers">
            </tbody>
        </table>
        <div style="text-align: center;">
            @if(isset($data['zone_sub']))
            {!! $data['zone_sub']->render() !!}
        @endif
        </div>
    </div>