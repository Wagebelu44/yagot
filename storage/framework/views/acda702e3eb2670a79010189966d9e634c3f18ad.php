<?php $__env->startSection('title'); ?>



   لوحة التحكم



<?php $__env->stopSection(); ?>



<?php $__env->startSection('css'); ?>



    <style>



            .hide{



                display:none;



            }



            .img-profile,#img-selected{



                width: 140px;



                background: #ddd;



                height: 140px;



                border-radius: 50%;



            }



            .input-file{



                visibility: hidden;



            }



            .input-file-trigger{



                position: absolute;



                top: 45%;



            }



            .form-submit{



                position: absolute;



                top: 45%;



            }



            .photo{



                text-align:center;



            }



    </style>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('page-content'); ?>



<!-- <div class="m-subheader-search">



		<span class="m-subheader-search__desc">



		<div class="mr-auto">



</div>



</span>



					</div> -->



					<div class="m-subheader ">



						<div class="d-flex align-items-center">



							<div class="mr-auto">



								



								<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">



									<li class="m-nav__item m-nav__item--home">



										<a href="#" class="m-nav__link m-nav__link--icon">



											<i class="m-nav__link-icon la la-home"></i>



										</a>



									</li>



									<li class="m-nav__item">



										<a href="/admin/dashborad" class="m-nav__link">



											<span class="m-nav__link-text">الصفحة الرئيسية</span>



										</a>



									</li>



									



									<li class="m-nav__separator">-</li>



									<li class="m-nav__item">



										<a href="/admin/notification" class="m-nav__link">



											<span class="m-nav__link-text">الإشعارات</span>



										</a>



									</li>



								</ul>



							</div>



	



	<div>







</div>



</div>



</div>







<div class="m-grid__item m-grid__item--fluid m-wrapper">



<!-- BEGIN: Subheader -->



<!-- END: Subheader -->



<div class="m-content">



<div class="row">



<div class="col-lg-12">



<!--begin::Portlet-->



<div class="m-portlet m-portlet--mobile" id="m_blockui_2_portlet">



	<div class="m-portlet__head">



<div class="m-portlet__head-caption">



<div class="m-portlet__head-title">



<h3 class="m-portlet__head-text">


الإشعارات


</h3>



</div>



</div>



</div>



	<div class="m-portlet__body">





            <ul class="nav nav-tabs" id="myTab" role="tablist">



            <li class="nav-item">



                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">كافة الأجهزة</a>



            </li>


            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">العملاء</a>
            </li>

            </ul>



            <div class="tab-content" id="myTabContent">

            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">





          


                <form class="settingForm" id="settingForm" action="" method="post">



                    <?php echo csrf_field(); ?>



                    
                    <div class="row">

                        <div class="col-md-6">
                         
                                <div class="form-group m-form__group row">

                                
                                
                                <div class="col-md-12 mb-3">



                                <label>الأجهزة<span class="required">*</span></label>



                                <div class="form-valid">



                                      <select name="os" class="os form-control">
                                          <option value="">الكل</option>
                                            <option value="1">الاندرويد</option>
                                              <option value="2">الآيفون</option>
                                      </select>



                                </div>



                            </div>
    

                            <div class="col-md-12 mb-3">



                                <label>عنوان الإشعار<span class="required">*</span></label>



                                <div class="form-valid">



                                    <input type="text" name="name" value="" required class="form-control name" placeholder="عنوان الإشعار">



                                </div>



                            </div>
    
    

                            <div class="col-md-12 mb-3">



                                <label>تفاصيل الإشعار<span class="required">*</span></label>



                                <div class="form-valid">



                                   <textarea class="form-control details" name="details" required rows="8" cols="8" placeholder="تفاصيل الإشعار"></textarea>



                                </div>



                            </div>


                        

                            <div class="col-md-12 mb-3">
                                   <button type="submit" class="btn btn-primary btn_save_page">إرسال</button>
                            </div>

                       


                      


                </div>

                
                        </div>
                
                    </div>

                  



                    <div class="modal-footer">



                



                     





                    </div>



                </form>

                </div>









        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">





          


<form class="settingFormNot" id="settingFormNot" action="" method="post">



    <?php echo csrf_field(); ?>



    
    <div class="row">

        <div class="col-md-6">
         
                <div class="form-group m-form__group row">

                
                
                <div class="col-md-12 mb-3">



                <label>العملاء<span class="required">*</span></label>



                <div class="form-valid">


                

                          
                      <select name="client_id[]" required multiple data-live-search="true" id="ajax-select" class="client_id selectpicker form-control">
                          <option value="">اختر العملاء</option>
                      </select>



                </div>



            </div>


            <div class="col-md-12 mb-3">



                <label>عنوان الإشعار<span class="required">*</span></label>



                <div class="form-valid">



                    <input type="text" name="name" value="" required class="form-control name" placeholder="عنوان الإشعار">



                </div>



            </div>



            <div class="col-md-12 mb-3">



                <label>تفاصيل الإشعار<span class="required">*</span></label>



                <div class="form-valid">



                   <textarea class="form-control details" name="details" required rows="8" cols="8" placeholder="تفاصيل الإشعار"></textarea>



                </div>



            </div>


        

            <div class="col-md-12 mb-3">
                   <button type="submit" class="btn btn-primary btn_save_page">إرسال</button>
            </div>

       


      


</div>


        </div>

    </div>

  



    <div class="modal-footer">







     





    </div>



</form>

</div>








</div>







	</div>



</div>



</div>



</div>



</div>



</div>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('js'); ?>


<script src="/admin/assets/select_with_ajax/js/ajax-bootstrap-select.js"></script>
<script src="/admin/assets/app/js/search.js"></script>
<script>



    // $(document).ready(function(e){



    //     getData();



    // });



</script>



<script>



            $('#settingForm').on('submit', function(e){



            e.preventDefault();



            var formData = new FormData(this);



                $.ajax({



                    url: '/admin/notification/send',



                    dataType:'json',



                    type: 'POST',



                    delay:250,



                    data: formData,



                    async: false,



                    success: function (data) {



                        if (data["status"] == true) {



                                Swal.fire(



                                data['message'],



                                '',



                                'success'



                                );




                                $('.name').val('');

                                $('.os').val('');

                                $('.details').val('');



                        }else {



                            Swal.fire({



                                type: 'error',



                                title: 'عذرا',



                                text: data['message']



                            })



                        }



                    },



                    cache: false,



                    contentType: false,



                    processData: false



                });



            });


            
</script>



<script>





$('#settingFormNot').on('submit', function(e){



e.preventDefault();



var formData = new FormData(this);



    $.ajax({



        url: '/admin/notification/send_client',



        dataType:'json',



        type: 'POST',



        delay:250,



        data: formData,



        async: false,



        success: function (data) {



            if (data["status"] == true) {



                    Swal.fire(



                    data['message'],



                    '',



                    'success'



                    );




                    $('.name').val('');

                    $('.os').val('');

                    $('.details').val('');



            }else {



                Swal.fire({



                    type: 'error',



                    title: 'عذرا',



                    text: data['message']



                })



            }



        },



        cache: false,



        contentType: false,



        processData: false



    });



});



</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/dashboard/notifications.blade.php ENDPATH**/ ?>