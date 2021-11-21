<div class="modal fade in" id="add_page" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="addNewpageForm" id="addNewpageForm" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة رابط تواصل</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="form-group m-form__group row">
                    <div class="col-md-12">
                            <label>{{ __('lang.url') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="url" name="url" autocomplete="off" class="form-control url" id="url" placeholder="{{ __('lang.url') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                    <div class="col-md-12">
                            <label>{{ __('lang.image') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="file" name="file" autocomplete="off" class="form-control file" id="file" placeholder="{{ __('lang.image') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row d-none">
                    <div class="col-md-12">
                            <label>{{ __('lang.type_soial') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <select name="social" class="form-control social input-sm ">
                                     <option value="fa-facebook-f" data-icon="fa-facebook icon-success">{{ __('lang.facebook') }}</option>
                                     <option value="fa-twitter" data-icon="fa-twitter icon-success">{{ __('lang.twitter') }}</option>
                                     <option value="fa-telegram" data-icon=" fa-telegram icon-success">{{ __('lang.telegram') }}</option>
                                     <option value="fa-skype" data-icon="fa-skype icon-success">{{ __('lang.skype') }}</option>
                                     <option value="fa-linkedin" data-icon="fa-linkedin icon-success">{{ __('lang.linkedin') }}</option>
                                     <option value="fa-youtube" data-icon="fa-youtube icon-success">{{ __('lang.youtube') }}</option>
                                     <option value="fa-instagram" data-icon="fa-instagram icon-instagram">{{ __('lang.instagram') }}</option>
                                     <option value="fa-whatsapp" data-icon="fa-whatsapp icon-instagram">{{ __('lang.whatsapp') }}</option>
                                     <option value="fa-rss" data-icon="fa-whatsapp icon-instagram">{{ __('lang.rss') }}</option>
                                 </select> 
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-form__group row">
                        <div class="col-md-12">
                            <label> {{ __('lang.status') }} <span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="checkbox" name="activeValue" id="activeValue"
                                 data-on-color="success" class="make-switch status activeValue"
                                 data-size="normal" data-on-text="{{ __('lang.active') }}"
                                 data-off-text="{{ __('lang.inactive') }}">
                            </div>
                        </div>
                    </div>

                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn_save_page">{{ __('lang.save') }}</button>
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal">{{ __('lang.hide') }}</button>
                </div>
                <input type="hidden" name="hidden" class="rowIdUpdate" value="0">
                <div id="loading">
                    <img id="loading-image" src="/assets/admin/ajax-loader.gif" alt="Loading..."/>
                </div>
            </form>
        </div>
    </div>
</div>