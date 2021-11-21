<div class="modal fade in" id="modal_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
       <form class="form-show" id="form-show" action="" enctype="multipart/form-data">
           <?php echo csrf_field(); ?>
           
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalCenterTitle"> <?php echo e(trans('lang.title_zone_sub')); ?> </h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           
           
           <div class="modal-body">
            <button value="0" data-toggle="modal" data-target="#add_page"  type="button" class="btn btn-danger  m-btn m-btn--custom btn_add_zone_sub mb-3" style="line-height: 15px;
            padding-bottom: 15px; float: left;"> <i class="fa fa-plus"> </i> <?php echo e(trans('lang.add_title_zone_sub')); ?> </button>
           </div>
           <div class="container" id="table-container">
            <?php echo $__env->make('admin.zone.table-data-sub', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">إخفاء</button>
</div>
</form>
</div>        
</div>
</div>
</div>


<?php /**PATH /var/www/html/backend_yagot/resources/views/admin/zone/show.blade.php ENDPATH**/ ?>