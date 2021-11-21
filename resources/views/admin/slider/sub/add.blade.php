<div class="modal fade in" id="add_slider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('lang.slider')}}</h5>
                    @can('add_slider')
				<button type="button"  data-toggle="modal" data-target="#add_page" class="btn btn-danger m-btn m-btn--custom btnAddCustomer" style="line-height: 15px;
    			padding-bottom: 15px;margin-right: auto;"><i class="fa fa-plus"></i> {{trans('lang.add_slider')}}</button>
                @endcan
                    <button type="button" class="close ml-0 mt-1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
              
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal">{{trans('lang.hide')}}</button>
                </div>
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
        </div>
    </div>
</div>


<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="addNewpageForm" id="addNewpageForm" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('lang.add_slider')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                <div class="form-group m-form__group row">
                    <div class="col-md-6">  
                        <label>{{trans('lang.type')}}<span class="required"></span></label>
                        <select name="type" class="form-control type" id="type">
                            <option value="">{{trans('lang.type')}}</option>
                            @foreach($data['slider_type'] as $s)
                                <option value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>{{trans('lang.image')}}<span class="required"></span></label>
                        <div class="form-valid">
                            <input type="file" name="photo" class="form-control photo"  id="photo">
                        </div>
                    </div>
                </div>
               

                
                <div class="form-group m-form__group row">

                    <div class="col-md-6 product_div div_select">  
                            <label>{{trans('lang.products')}}<span class="required"></span></label>
                            <select name="product"  data-live-search="true" class="form-control product product_select selectpicker" id="ajax-select">
                                <option value="">{{trans('lang.products')}}</option>
                            </select>
                        </div>

                        <div class="col-md-6 category_div div_select">  
                            <label>{{trans('lang.category')}}<span class="required"></span></label>
                            <select name="category" class="form-control category" id="category">
                                <option value="">{{trans('lang.category')}}</option>
                                @foreach($data['category'] as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 url_div div_select">
                            <label>{{trans('lang.url')}}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="url" name="url" class="form-control url"  placeholder="{{trans('lang.url')}}" id="url">
                            </div>
                        </div>

                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label> {{trans('lang.status')}} <span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="checkbox" value="on" name="activeValue" id="activeValue"
                                 data-on-color="success" class="make-switch status activeValue"
                                 data-size="normal" data-on-text="{{trans('lang.on')}}"
                                 data-off-text="{{trans('lang.off')}}">
                            </div>
                        </div>
                    </div>
                
                    
                </div>
                <div class="modal-footer">
                    <button  type="submit" class="btn btn-primary btn_save_page">{{trans('lang.save')}}</button>
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal">{{trans('lang.hide')}}</button>
                </div>
                <input type="hidden" name="parent_id" class="parent_id" value="0">
                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade in" id="add_parent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="addParentForm" id="addParentForm" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('lang.add_slider')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                <div class="form-group m-form__group row">
                    
                    <div class="col-md-12">
                        <label>{{trans('lang.title_ar')}}<span class="required"></span></label>
                        <div class="form-valid">
                            <input type="text" name="title_ar" class="form-control title_ar" placeholder="{{trans('lang.title_ar')}}"  id="title_ar">
                        </div>
                    </div>
                </div>
                
                <div class="form-group m-form__group row">
                    <div class="col-md-12">
                        <label>{{trans('lang.title_en')}}<span class="required"></span></label>
                        <div class="form-valid">
                            <input type="text" name="title_en" class="form-control title_en"  placeholder="{{trans('lang.title_en')}}" id="title_en">
                        </div>
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                    <button  type="submit" class="btn btn-primary btn_save_page">{{trans('lang.save')}}</button>
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal">{{trans('lang.hide')}}</button>
                </div>
                <input type="hidden" name="hidden" class="rowIdParent" value="0">
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
            </form>
        </div>
    </div>
</div>


