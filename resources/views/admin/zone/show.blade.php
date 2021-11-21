<div class="modal fade in" id="modal_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
       <form class="form-show" id="form-show" action="" enctype="multipart/form-data">
           @csrf
           
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalCenterTitle"> {{trans('lang.title_zone_sub')}} </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           {{-- <button type="button"  data-toggle="modal" data-target="#add_page" class="btn btn-danger m-btn m-btn--custom btnAddCustomer" style="line-height: 15px;
           padding-bottom: 15px;"><i class="fa fa-plus"></i> {{trans('lang.add_zone')}}</button> --}}
           {{-- @endcan --}}
           <div class="modal-body">
            <button value="0" data-toggle="modal" data-target="#add_page"  type="button" class="btn btn-danger  m-btn m-btn--custom btn_add_zone_sub mb-3" style="line-height: 15px;
            padding-bottom: 15px; float: left;"> <i class="fa fa-plus"> </i> {{trans('lang.add_title_zone_sub')}} </button>
           </div>
           <div class="container" id="table-container">
            @include('admin.zone.table-data-sub')
        </div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">إخفاء</button>
</div>
</form>
</div>        
</div>
</div>
</div>


