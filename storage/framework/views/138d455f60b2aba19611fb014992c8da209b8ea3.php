
<div class="">
    

    <table class="table table-bordered" id="html_table" width="100%">
                <thead class="m-datatable__head">
                    <tr>
                            <th class="text-center" ><?php echo e(trans('lang.client_name')); ?></th>
                            <th class="text-center" ><?php echo e(trans('lang.name_tranfer')); ?></th>
                            <th class="text-center" ><?php echo e(trans('lang.mobile_tranfer')); ?></th>
                            <th class="text-center" ><?php echo e(trans('lang.payment_type')); ?></th>
                            <th class="text-center" ><?php echo e(trans('lang.send_date')); ?></th>
                            <th class="text-center" ><?php echo e(trans('lang.IBAN')); ?></th>
                            <th class="text-center" ><?php echo e(trans('lang.tax_number')); ?></th>
                            <th class="text-center" ><?php echo e(trans('lang.name_bank')); ?></th>
                            <th class="text-center" ><?php echo e(trans('lang.total_price')); ?></th>
                            <th class="text-center" ><?php echo e(trans('lang.currency')); ?></th>
                            <th class="text-center" ><?php echo e(trans('lang.status')); ?></th>
                    </tr>
                </thead>
                <tbody class="m-datatable__body load">
               
                    <?php 
                        $i =1;
                        $img='';
                    ?>
                    <?php if(isset($data['details'])): ?>
              
                        <?php 
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
                      ?>  
                                     
                        <tr class="m-datatable__row">
                            
                            <td class="text-center ">
                                <?php echo e($data['details']->client_name); ?>

                            </td>
                            <td class="text-center ">
                                <?php echo e($data['details']->name_tranfer); ?>

                            </td>
                            <td class="text-center ">
                                <?php echo e($data['details']->mobile_tranfer); ?>

                            </td>
                            <td class="text-center ">
                                <?php echo e($data['details']->fees_type); ?>

                            </td>
                            <td class="text-center ">
                                <?php echo e($data['details']->date); ?>

                            </td>
                            <td class="text-center ">
                                <?php echo e($data['details']->iban ?? '-'); ?>

                            </td>
                            <td class="text-center ">
                                <?php echo e($data['details']->tax_number ?? '-'); ?>

                            </td>
                           
                            <td class="text-center ">
                                <?php echo e($data['details']->bank_name); ?>

                            </td>
                            <td class="text-center ">
                                <?php echo e($data['details']->total_price); ?>

                            </td>
                            <td class="text-center ">
                                <?php echo e($data['details']->currency_name); ?>

                            </td>
                            <td class="text-center">
                                <?php if($data['details']->status != -1): ?>
                                <a class="<?php echo e($class); ?>" ><span><?php echo e($text); ?></span> </a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        
                                                     
                        </tr>                       
                    <?php endif; ?>
                </tbody>
            
         
        </table>
        <div class="images text-center">
            <a style="width:120px;margin:5px;" title="<?php echo e(trans('lang.file_img')); ?>"  data-fancybox="gallery" href ="<?php echo e(URL::to('/')); ?>/uploads/<?php echo e($img); ?>" >
                <img id="main_image" width="200px" class="img-thumbnail" src="<?php echo e(URL::to('/')); ?>/uploads/<?php echo e($img); ?>" />
             </a>
        </div>  
        <div style="text-align: center;">
                    
        </div>
    </div><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/transfer/table-details.blade.php ENDPATH**/ ?>