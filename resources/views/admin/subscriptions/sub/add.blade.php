<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

     aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <form class="addNewpageForm" id="addNewpageForm" action="" method="post" enctype="multipart/form-data">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel">{{trans('lang.add_subscriptions')}}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                      

                           

                                <div class="form-group m-form__group row">

                                    <div class="col-md-4">

                                        <label> {{trans('lang.name_ar')}}  <span class="required">*</span> </label>

                                        <div class="form-valid">

                                            <input type="text" name="name_ar" class="form-control name_ar" placeholder="{{trans('lang.name_ar')}}">

                                        </div>

                                    </div> 
                                    <div class="col-md-4">

<label> {{trans('lang.name_en')}}  <span class="required">*</span> </label>

<div class="form-valid">

    <input type="text" name="name_en" class="form-control name_en" placeholder="{{trans('lang.name_en')}}">

</div>

</div>
                                    <div class="col-md-4">

                                        <label>  {{trans('lang.price')}}<span class="required">*</span> </label>
            
                                        <div class="form-valid">
            
                                            <input type="text" name="price" class="form-control price" placeholder="{{trans('lang.price')}}">
            
                                        </div>
            
                                    </div>
                                    

                                </div>


     

                    <div class="form-group m-form__group row">

                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                    <label>مميزات الباقة<span class="required"></span></label>
                        </div>
                    <div class="col-md-12">
                        <div class="row all_plans_check" id="gridDemo">
                            @foreach($data['all_tplan'] as $b)
                                <div class="col-md-6 ">
                                    <label for="checkboxRule{{$b->id}}">
                                            <input value="{{$b->id}}" type="checkbox" name="all_tplan[]" class="zt-control all_tplan" id="checkboxRule{{$b->id}}">
                                            {{$b->name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                   
                
                </div>

                <div class="form-group m-form__group row">
                        <div class="col-md-4  days_div numbers">
                            <label>{{trans('lang.number_days')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="number" name="number_days" class="form-control number_days" placeholder="{{trans('lang.number_days')}}">
                            </div>
                        </div>
                        <div class="col-md-4  products_div numbers">
                        <label>{{trans('lang.number_products')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="number" name="number_products" class="form-control number_products" placeholder="{{trans('lang.number_products')}}">
                            </div>

                        </div>
                        <div class="col-md-4 slider_div numbers">
                        <label>{{trans('lang.number_slider')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="number" name="number_slider" class="form-control number_slider" placeholder="{{trans('lang.number_slider')}}">
                            </div>
                        </div>
                        
                    </div>
                    
            </div>
                <div class="modal-footer">

                    <button  type="submit" class="btn btn-primary btn_save_page">حفظ</button>

                    <button type="button" class="btn btn-secondary  " data-dismiss="modal">إخفاء</button>

                </div>

                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">

                <div id="loading">

                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>

                </div>

            </form>

        </div>

    </div>

</div>