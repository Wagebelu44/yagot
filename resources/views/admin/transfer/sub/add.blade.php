<div class="modal fade in" id="details"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <form class="detailsform" id="detailsform" action="" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('lang.details')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="" id="table-container">
                       
                        <div class="form-group m-form__group row">
                        @include('admin.transfer.table-details')
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="submit" class="btn btn-primary btn_save_password">{{trans('lang.save')}}</button> --}}
                    <button type="button" class="btn btn-secondary  " data-dismiss="modal">{{trans('lang.hide')}}</button>
                </div>
                <div id="loading">
                    <img id="loading-image" src="/admin/assets/ajax-loader.gif" alt="Loading..."/>
                </div>
                <input type="hidden" name="hidden" class="userIdUpdate" value="0">
            </form>
        </div>
    </div>
</div>