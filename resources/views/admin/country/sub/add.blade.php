<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="addNewpageForm" id="addNewpageForm" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">الدول</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label>{{trans('lang.title_ar')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="name_ar" autocomplete="off" class="form-control name_ar" id="name_ar" placeholder="{{trans('lang.title_ar')}}">
                            </div>
                        </div>
                     
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label>{{trans('lang.title_en')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="name_en" autocomplete="off" class="form-control name_en" id="name_en" placeholder="{{trans('lang.title_en')}}">
                            </div>
                        </div>

                    </div>

                    <div class="form-group m-form__group row">
                    <div class="col-md-12">
                            <label>مقدمة الدولة<span class="required"></span></label>
                            <div class="form-valid">
                              <input type="text" name="country_code" autocomplete="off" class="form-control country_code" id="country_code" placeholder="مقدمة الدولة">

                            </div>
                        </div>
                   
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-md-6">
                                <label>{{trans('lang.status')}}<span class="required">*</span></label>
                                <input type="checkbox" value="on" name="activeValue" id="activeValue"
                                data-on-color="success" class="make-switch status activeValue"
                                data-size="normal" data-on-text="{{trans('lang.on')}}"
                                data-off-text="{{trans('lang.off')}}">                            
                            </div>

                        </div>
                   

                    </div>

     
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn_save_page">{{trans('lang.save')}}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('lang.hide')}}</button>
                </div>
                
                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">
                <input type="hidden" class="sub_zone" value="0">
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
            </form>
        </div>
    </div>
</div>


