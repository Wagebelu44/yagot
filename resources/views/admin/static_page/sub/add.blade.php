<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="addNewpageForm" id="addNewpageForm" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('lang.add_page')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @php $i = 0; @endphp
                    @foreach($data['system'] as $system)
                        @php $i++; @endphp
                    <li class="nav-item">
                        <a class="nav-link @if($system->value2 == \Lang::getLocale() ) active  @endif" id="tab{{$i}}" data-toggle="tab" href="#lang_{{$system->value2}}" role="tab" aria-controls="lang_{{$system->value2}}" 
                        aria-selected="@if($system->value2 == \Lang::getLocale() ) true @else false @endif">{{ $system->name }}</a>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="myTabContent">
                    @php $i = 0; @endphp
                @foreach($data['system'] as $system)
                    @php $i++; @endphp
                    <div class="tab-pane fade @if($system->value2 == \Lang::getLocale() ) show active @endif" id="lang_{{$system->value2}}" role="tabpanel" aria-labelledby="tab{{$i}}">
                               
                                <div class="form-group m-form__group row">
                                        <div class="col-md-12">
                                            <label>{{trans('lang.title')}}<span class="required">*</span></label>
                                            <div class="form-valid">
                                                <input type="text" name="title_{{$system->value2}}" class="form-control title_{{$system->value2}}" placeholder="{{trans('lang.title')}}">
                                            </div>
                                        </div>
                                    </div>

                                <div class="form-group m-form__group row">
                                    <div class="col-md-12">
                                        <label for="recipient-name" class="form-control-label">{{trans('lang.details')}}<span
                                                    class="required">*</span></label>
                                        <div class="form-valid">
                                            <textarea  name="details_{{$system->value2}}" class="form-control details_{{$system->value2}} ckeditor" placeholder="{{trans('lang.details')}}" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                    </div>  
                @endforeach
                </div>
                
                         
                <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label>{{trans('lang.slug')}}<span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="slug" class="form-control slug" placeholder="{{trans('lang.slug')}}">
                            </div>
                        </div>
                </div>

                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label> {{trans('lang.status')}} <span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="checkbox" name="activeValue" id="activeValue"
                                 data-on-color="success" class="make-switch status activeValue"
                                 data-size="normal" data-on-text="{{trans('lang.on')}}"
                                 data-off-text="{{trans('lang.off')}}">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label>{{trans('lang.image')}}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="file" name="image" class="form-control image" id="image">
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button onClick="CKupdate();$('#addNewpageForm').ajaxSubmit();" type="submit" class="btn btn-primary btn_save_page">{{trans('lang.save')}}</button>
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal">{{trans('lang.hide')}}</button>
                </div>
                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
            </form>
        </div>
    </div>
</div>