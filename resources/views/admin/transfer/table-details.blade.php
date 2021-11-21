
<div class="">
    {{-- <div class="form-group m-form__group row">
        <div class="col-md-12">
        <div class="">
        <table class="table table-bordered" id="html_table">
        <tbody>
        <tr>
        <td class="text-center " width="20%">{{trans('lang.client_name')}}</td>
        <th class="text-center name" width="30%"></th>
      
        </tr>
        </tbody>
        </table>
        </div>
        </div>  
</div> --}}

    <table class="table table-bordered" id="html_table" width="100%">
                <thead class="m-datatable__head">
                    <tr>
                            <th class="text-center" >{{trans('lang.client_name')}}</th>
                            <th class="text-center" >{{trans('lang.name_tranfer')}}</th>
                            <th class="text-center" >{{trans('lang.mobile_tranfer')}}</th>
                            <th class="text-center" >{{trans('lang.payment_type')}}</th>
                            <th class="text-center" >{{trans('lang.send_date')}}</th>
                            <th class="text-center" >{{trans('lang.IBAN')}}</th>
                            <th class="text-center" >{{trans('lang.tax_number')}}</th>
                            <th class="text-center" >{{trans('lang.name_bank')}}</th>
                            <th class="text-center" >{{trans('lang.total_price')}}</th>
                            <th class="text-center" >{{trans('lang.currency')}}</th>
                            <th class="text-center" >{{trans('lang.status')}}</th>
                    </tr>
                </thead>
                <tbody class="m-datatable__body load">
               
                    @php 
                        $i =1;
                        $img='';
                    @endphp
                    @if(isset($data['details']))
              
                        @php 
                     if($data['details']->status == -1 )
                                {
                                $class='btn btn-success btn-sm m-btn text-white m-btn--icon m-btn--pill';
                            }else  if($data['details']->status == 1 ){
                                $class='btn btn-warning btn-sm text-white m-btn m-btn--icon m-btn--pill';
							}
							else  {
                                $class='btn btn-danger btn-sm text-white m-btn m-btn--icon m-btn--pill';
                            }
							$text = $data['details']->status_sys;
                            $img =$data['details']->image;
                      @endphp  
                                     
                        <tr class="m-datatable__row">
                            
                            <td class="text-center ">
                                {{$data['details']->client_name}}
                            </td>
                            <td class="text-center ">
                                {{$data['details']->name_tranfer}}
                            </td>
                            <td class="text-center ">
                                {{$data['details']->mobile_tranfer}}
                            </td>
                            <td class="text-center ">
                                {{$data['details']->fees_type}}
                            </td>
                            <td class="text-center ">
                                {{$data['details']->date}}
                            </td>
                            <td class="text-center ">
                                {{$data['details']->iban ?? '-'}}
                            </td>
                            <td class="text-center ">
                                {{$data['details']->tax_number ?? '-'}}
                            </td>
                           
                            <td class="text-center ">
                                {{$data['details']->bank_name}}
                            </td>
                            <td class="text-center ">
                                {{$data['details']->total_price}}
                            </td>
                            <td class="text-center ">
                                {{$data['details']->currency_name}}
                            </td>
                            <td class="text-center">
                                @if($data['details']->status != -1)
                                <a class="{{$class}}" ><span>{{$text}}</span> </a>
                                @else
                                    -
                                @endif
                            </td>
                        
                                                     
                        </tr>                       
                    @endif
                </tbody>
            
         
        </table>
        <div class="images text-center">
            <a style="width:120px;margin:5px;" title="{{trans('lang.file_img')}}"  data-fancybox="gallery" href ="{{URL::to('/')}}/uploads/{{$img}}" >
                <img id="main_image" width="200px" class="img-thumbnail" src="{{URL::to('/')}}/uploads/{{$img}}" />
             </a>
        </div>  
        <div style="text-align: center;">
                    
        </div>
    </div>