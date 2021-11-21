<div class="table-responsive">
  <table class="table table-bordered" id="html_table" width="100%">
        <thead class="m-datatable__head">
          <tr>
              <th class="text-center">#</th>
              <th class="text-center">{{__('lang.title')}}</th>
              <th class="text-center">{{__('lang.client_name')}}</th>
              <th class="text-center">{{__('lang.category')}}</th>
              <th class="text-center">{{__('lang.price')}}</th>
              <th class="text-center">{{__('lang.currency')}}</th>
              <th class="text-center">{{__('lang.city')}}</th>
              <th class="text-center">{{__('lang.certificated')}}</th>
              <th class="text-center">{{__('lang.status')}}</th>
              <th class="text-center">{{__('lang.show')}}</th>
              @can('edit_product')
              <th class="text-center">{{__('lang.edit')}}</th>
              @endcan
              @can('delete_product')
              <th class="text-center">{{__('lang.delete')}}</th>
              @endcan
          </tr>
        </thead>
        <tbody class="m-datatable__body load">
          @php 
            $i =1;
          @endphp
          @if(count($data['product']) > 0)
            @foreach($data['product'] as $product)
              @php 

							if($product->certified == 1)
								{
								$class='btn btn-success m-btn m-btn--icon m-btn--pill';
								$color='green'; 
								$icon='check';
								$text = __('lang.certificated');
							}else{
								$class='btn btn-danger m-btn m-btn--icon m-btn--pill';
								$color='red';
								$icon='check';
								$text = __('lang.uncertificated');
							}


              @endphp
            <tr class="m-datatable__row">
              <td class="text-center">
                {{$i++}}
              </td>
              <td class="text-center">
                {{$product['title']}}
              </td>
              <td class="text-center">
                {{$product['client_name']}}
              </td>
              <td class="text-center">
                {{$product->category}}
              </td>
              <td class="text-center">
                {{$product->price}}
              </td>
              <td class="text-center">
                {{$product->curreny_name}}
              </td>
              <td class="text-center">
                {{$product->city_name}}
              </td>
              <td class="text-center">
					    	<a  href="javascript:void(0);"  color="{{$color}}" data-id="{{$product->id}}" class="{{$class}} certificated" >  <span>{{$text}}</span> </a>
						</td>
              <td class="text-center">
                <select data-id="{{$product->id}}" name="news_status_change" class="form-control news_status_change UpdateStatus"  placeholder="الحالة" data-live-search="true">
                  @foreach ($data['product_status'] as $status)
                    <option value="{{$status->id}}" {{$product->status==$status->id?"selected":""}}>{{$status['name']}}</option>
                  @endforeach
              </select>
              </td>
              <td style="text-align:center">
                  <a href="#" data-id="{{$product->id}}" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                    viewDetails"> <i class="flaticon-eye"></i></a>
              </td>
              @can('edit_product')
              <td class="text-center">
              <a href="#" data-id="{{$product->id}}" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                         updateDetails"> <i class="fa fa-edit"></i> </a>
              </td>
              @endcan
              @can('delete_product')
              <td class="text-center"><a href="#" data-id="{{$product->id}}" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                delete"> <i class="fa fa-trash"></i> </a>
              </td>
              @endcan
            </tr>
            @endforeach
          @else
          <tr  class="m-datatable__row"><td colspan="10" class="text-center">{{__('lang.no_data')}}</td></tr>
          @endif
        </tbody>
        <tbody class="m-datatable__body DataUsers">
      </tbody>
    </table>
    <div style="text-align: center;">
        {!! $data['product']->render() !!}
    </div>
  </div>