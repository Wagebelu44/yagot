
<?php $__env->startSection('title'); ?>
   لوحة التحكم
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
											<span class="m-nav__link-text"><?php echo e(trans('lang.home')); ?></span>
										</a>
									</li>
									
									<li class="m-nav__separator">-</li>
									<li class="m-nav__item">
										<a href="/admin/zone" class="m-nav__link">
											<span class="m-nav__link-text"><?php echo e(trans('lang.zones')); ?></span>
										</a>
									</li>
								</ul>
							</div>

		<div class="m-demo__preview  m-demo__preview--btn">

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add_zones')): ?>
				<button type="button"  data-toggle="modal" data-target="#add_page" class="btn btn-danger m-btn m-btn--custom btnAddCustomer" style="line-height: 15px;
    			padding-bottom: 15px;"><i class="fa fa-plus"></i> <?php echo e(trans('lang.add_zone')); ?></button>
                <?php endif; ?>
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
<?php echo e(trans('lang.zone')); ?>

</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
	<div id="table-container">
        <?php echo $__env->make('admin.zone.table-data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div>

	</div>
</div>
</div>
</div>
</div>
</div>
<?php echo $__env->make('admin.zone.show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.zone.sub.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">

$(document).on('click', '.map', function () {
   $a = $('#lon').val(); 
   $b = $('#lat').val(); 
  

});


    function dd($a,$b){
    $(document).ready(function(e){ 
      if(marker){
        marker.setMap(null);
        marker = [];
    }
         marker = new google.maps.Marker({
          position: new google.maps.LatLng($a, $b),
          map: map
        });
        placeMarker(marker.position)
    })
}
$('#activeValue').bootstrapSwitch('state', false, true);

/***********************************************************************************************************************/
        $('body').on('click','.UpdateStats',function(){
            $(this).addClass('disabled');
            $('.loadImg').removeClass('hidden');
            $('.loadMSG').html('جاري تحديث الحالة');
            var thisTag = $(this);
            var id = $(this).data('id');
            var parent=$(this).data('parent');
            $('#load').show();
			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
            	url: "/admin/zone/UpdateStats",
                type: "POST",
                dataType: "JSON",
                data:{id:id},
                success: function(data) {
                    $('#load').hide();
                    if(data["status"] == true){					
                                var url = $(this).attr('href');
                                getData(url);
                                window.history.pushState("", "", url);                  					
                    }
                }
            });
            $(thisTag).removeClass('disabled');
            $('.loadImg').addClass('hidden');
        });
</script>

<script>
$(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var url = $(this).attr('href');
            getData(url);
        });
  
    function getData(url) {
        // $('#load')
        $.ajax({
            url : url
        }).done(function (data) {
            $("#table-container").empty().html(data);
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        /*************************************************/
        $(document).on('click', '.btnAddCustomer', function () {
			      $('#addNewpageForm').find(".name_ar").val('');
		     	  $('#addNewpageForm').find(".name_en").val('');
            $('#addNewpageForm').find('.notes').val(''); 
            $('#addNewpageForm').find('.rowIdUpdate').val(0);
            $('#addNewpageForm').find('.lon').val(''); 
            $('#addNewpageForm').find('.lat').val(''); 
            $(".country_div").addClass('d-none');
            $(".parent_div").addClass('d-none');
            $(".parent_id").val('');
            $(".country_id").val(''); 
            $('#addNewpageForm').find('.parent_type_id').val(''); 
            $('.sub_zone').val(0);
            $a='';
            $b='';
            dd($a,$b);  
            
            $('#add_page .modal-title').html("<?php echo e(__('lang.add_data')); ?>");
        });
        $(document).on('click', '.btn_add_zone_sub', function () {
            id = $(this).val();            
			      $('#addNewpageForm').find(".name_ar").val('');
			      $('#addNewpageForm').find(".name_en").val('');
            $('#addNewpageForm').find('.notes').val(''); 
            $('#addNewpageForm').find('.rowIdUpdate').val(0);
            $('#addNewpageForm').find('.lon').val(''); 
            $('#addNewpageForm').find('.parent_id').val('');  
            $(".country_div").addClass('d-none');
            $(".parent_div").addClass('d-none');
            $(".parent_id").val('');
            $(".country_id").val('');
            $('#addNewpageForm').find('.parent_type_id').val('');                    
            $('#add_page .modal-title').html("<?php echo e(__('lang.add_title_zone_sub')); ?>");
        });
        // $('.addzonesub').on('click',function(e){
        
        //     $('#modal_show').modal('show');  
        // });

        $(document).on('click','.addzonesub',function(e){      
            id = $(this).data('id');           
            name = $(this).data('name');
            $('.sub_zone').val(id);
            $('#addNewpageForm').find('.parent_id').val(id); 
            $('#modal_show .btn_add_zone_sub').val(id); 
            getZones(id);
        });

        function getZones(id){
           
            $.ajax({
                    url: "/admin/zone/show",
                    type: "get",
                    dataType: "JSON",
                    data: {
                        id: id,
                    },
                    success: function(data){
                                        
                        $('#modal_show #table-container').html(data['data']);                           
                    },
                    complete: function () {
                       
                        $('#modal_show').modal('show'); 
                    }
                })
        }
        
        /*************************************************/
        $(document).on('click', '.updateDetailssub', function () {
			      $('#addNewpageForm').find('.rowIdUpdate').val(0);
            $('#addNewpageForm').find('.parent_id').val(''); 
            $(".country_div").addClass('d-none');
            $(".parent_div").addClass('d-none');
            $(".parent_id").val('');
            $(".country_id").val('');
            var id = $(this).data('id');
            $('.rowIdUpdate').val(id);
            $.ajax({
                url: "/admin/zone/edit",
                type: "get",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
					if(data['status'] == true){
                    
						if(data['data']['status'] == 1){
							$('#activeValue').bootstrapSwitch('state', true, true);
						}else{
							$('#activeValue').bootstrapSwitch('state', false, true);
						}                       
                        $(".rowIdUpdate").val(data['data']['id']);
                        $(".name_ar").val(data['data']['name_ar']);
                        $(".name_en").val(data['data']['name_en']);
                        $(".notes").val(data['data']['notes']);
                        $(".lon").val(data['data']['lon']);
                        $(".lat").val(data['data']['lat']);
                        if(data['data']['parent_id']){
                          $(".parent_id").val(data['data']['parent_id']);
                          $('.parent_type_id').val(1);
                          $(".parent_div").removeClass('d-none');
                        }else{
                          $(".country_id").val(data['data']['country_id']);
                          $('.parent_type_id').val(2);
                          $(".country_div").removeClass('d-none');
                        }
                        // $a=(data['data']['lat']);
                        // $b=(data['data']['lon']);
                        // dd($a,$b);
					}
                },
                complete: function () {
                    $('#add_page').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({title: 'حدث خطأ غير معروف، الرجاء المحاولة فيما بعد', type: "error"});
                }
            });

            $('#add_page .modal-title').html("<?php echo e(__('lang.edit_data')); ?>");
            $('.btn_save_user').html('تعديل');

        });

        $(document).on('click', '.updateDetails', function () {
           
			$('#addNewpageForm').find('.rowIdUpdate').val(0);
            $('#addNewpageForm').find('.parent_id').val(''); 
            $('.sub_zone').val(0);   
            var id = $(this).data('id');
            $('.rowIdUpdate').val(id);
            $.ajax({
                url: "/admin/zone/edit",
                type: "get",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
					if(data['status'] == true){
                    
						if(data['data']['status'] == 1){
							$('#activeValue').bootstrapSwitch('state', true, true);
						}else{
							$('#activeValue').bootstrapSwitch('state', false, true);
						}                       
                        $(".rowIdUpdate").val(data['data']['id']);
                        $(".name_ar").val(data['data']['name_ar']);
                        $(".name_en").val(data['data']['name_en']);
                        $(".notes").val(data['data']['notes']);
                        $(".lon").val(data['data']['lon']);
                        $(".lat").val(data['data']['lat']);
                        if(data['data']['parent_id']){
                          $(".parent_id").val(data['data']['parent_id']);
                          $('.parent_type_id').val(2);
                          $(".parent_div").removeClass('d-none');
                        }else{
                          $(".country_id").val(data['data']['country_id']);
                          $('.parent_type_id').val(1);
                          $(".country_div").removeClass('d-none');
                        }
                        // $a=(data['data']['lat']);
                        // $b=(data['data']['lon']);
                        // dd($a,$b);
					}
                },
                complete: function () {
                    $('#add_page').modal('show');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({title: 'حدث خطأ غير معروف، الرجاء المحاولة فيما بعد', type: "error"});
                }
            });

            $('#add_page .modal-title').html("<?php echo e(__('lang.edit_data')); ?>");
            $('.btn_save_user').html('تعديل');

        });
        /*************************************************/
        $('.addNewpageForm').on('submit', function(e){
            e.preventDefault();
			var formData = new FormData(this);
            $('.loader_add_user').css('display', 'initial');
            setTimeout(function () {
                $('.btn_save_customer').removeClass('disabled');
                $('.loader_add_user').css('display', 'none');
            }, 30000);
            var id = $(".rowIdUpdate").val();
          
            var sub_zone = $('.sub_zone').val();
            
            $('#loading').show();
            if (id == 0) {
                $.ajax({
                    url: "/admin/zone/add",
                    type: "post",
					cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#loading').hide();
                        if (data["status"] == true) {
                            swal({
                                title: "",
                                text: data["data"],
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "حسنا",
                                cancelButtonText: "الغاء",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
                            $('#addNewpageForm').find(".name_ar").val('');
                            $('#addNewpageForm').find(".name_en").val('');
                            $('#addNewpageForm').find('.notes').val(''); 
                            $('#addNewpageForm').find('.lon').val(''); 
                            $('#addNewpageForm').find('.lat').val(''); 
                            $('#addNewpageForm').find('.rowIdUpdate').val(0);
                            $('#addNewpageForm').find('.parent_id').val('');    
                            $('#add_page').modal('hide');
                            if(sub_zone > 0){
                                
                                getZones(sub_zone);
                            }else{
                                var url = $(this).attr('href');
                                getData(url);
                            }
                           
                            // window.history.pushState("", "", url); 
                        } else {
                            swal({
                                title: "",
                                text: data["data"],
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "<?php echo e(__('lang.ok')); ?>",
                                cancelButtonText: "<?php echo e(__('lang.cancel')); ?>",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });

                        }
                    }
                });
            } else {
				$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
                });
                $('#loading').show();
                $.ajax({
                    url: "/admin/zone/update",
                    type: "POST",
                    dataType: "JSON",
					cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#loading').hide();
                        if (data["status"] == true) {
                            swal({
                                title: "",
                                text: data["data"],
                                type: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "<?php echo e(__('lang.ok')); ?>",
                                cancelButtonText: "<?php echo e(__('lang.cancel')); ?>",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
                            $('#addNewpageForm').find(".name_ar").val('');
                            $('#addNewpageForm').find(".name_en").val('');
                            $('#addNewpageForm').find('.notes').val(''); 
                            $('#addNewpageForm').find('.lon').val(''); 
                            $('#addNewpageForm').find('.lat').val(''); 
                            $('#addNewpageForm').find('.rowIdUpdate').val(0);
                            $('#addNewpageForm').find('.parent_id').val('');    
                            if(sub_zone > 0){
                                getZones(sub_zone);
                            }else{
                                var url = $(this).attr('href');
                                getData(url);
                            }
                            // window.history.pushState("", "", url); 
                       
                            $("#add_page").modal('hide');
                        } else {
                            swal({
                                title: "",
                                text: data["data"],
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "<?php echo e(__('lang.ok')); ?>",
                                cancelButtonText: "<?php echo e(__('lang.cancel')); ?>",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });

                        }
                    }
                });
            }
        });
        /****************************************************/
    });

    $(document).on('click','.delete',function(e){
		    var id = $(this).data('id');
        var p = $(this).data('parent');


		Swal.fire({
				title: '<?php echo e(__('lang.are_you_sure')); ?>',
				text: "",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: '<?php echo e(__('lang.ok')); ?>',
				cancelButtonText: "<?php echo e(__('lang.cancel')); ?>",
			}).then((result) => {
				if (result.value) {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
                url: "/admin/zone/delete",
                type: "post",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
					if(data['status'] == true){

						Swal.fire(
                        data["data"],
						'',
						'success'
						)

						if(p>0){                                                    
                            getZones(p);              
                        }else{
                            var url = $(this).attr('href');
                            getData(url);
                        }

						 window.history.pushState("", "", url); 
					}else{
						swal({
                                title: "",
                                text: data["data"],
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: '<?php echo e(__('lang.ok')); ?>',
                                cancelButtonText: '<?php echo e(__('lang.cancel')); ?>',
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
					}
                },
            });
				}
			})
    });
</script><script src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyC3WpKCxoMYKOzwaSAXkts8Z1IrceC3lPQ" type="text/javascript"></script>

<script type="text/javascript">

var gmarkers = [];var map ;var infowindow;var marker;
function initMap() {
  var locations = [
        [],
    ];
  
     
    // Create a new StyledMapType object, passing it an array of styles,
    // and the name to be displayed on the map type control.
    var styledMapType = new google.maps.StyledMapType(
        [
          {elementType: 'geometry', stylers: [{color: '#ebe3cd'}]},
          {elementType: 'labels.text.fill', stylers: [{color: '#523735'}]},
          {elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
          {
            featureType: 'administrative',
            elementType: 'geometry.stroke',
            stylers: [{color: '#c9b2a6'}]
          },
          {
            featureType: 'administrative.land_parcel',
            elementType: 'geometry.stroke',
            stylers: [{color: '#dcd2be'}]
          },
          {
            featureType: 'administrative.land_parcel',
            elementType: 'labels.text.fill',
            stylers: [{color: '#ae9e90'}]
          },
          {
            featureType: 'landscape.natural',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'poi',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'poi',
            elementType: 'labels.text.fill',
            stylers: [{color: '#93817c'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'geometry.fill',
            stylers: [{color: '#a5b076'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'labels.text.fill',
            stylers: [{color: '#447530'}]
          },
          {
            featureType: 'road',
            elementType: 'geometry',
            stylers: [{color: '#f5f1e6'}]
          },
          {
            featureType: 'road.arterial',
            elementType: 'geometry',
            stylers: [{color: '#fdfcf8'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry',
            stylers: [{color: '#f8c967'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry.stroke',
            stylers: [{color: '#e9bc62'}]
          },
          {
            featureType: 'road.highway.controlled_access',
            elementType: 'geometry',
            stylers: [{color: '#e98d58'}]
          },
          {
            featureType: 'road.highway.controlled_access',
            elementType: 'geometry.stroke',
            stylers: [{color: '#db8555'}]
          },
          {
            featureType: 'road.local',
            elementType: 'labels.text.fill',
            stylers: [{color: '#806b63'}]
          },
          {
            featureType: 'transit.line',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'transit.line',
            elementType: 'labels.text.fill',
            stylers: [{color: '#8f7d77'}]
          },
          {
            featureType: 'transit.line',
            elementType: 'labels.text.stroke',
            stylers: [{color: '#ebe3cd'}]
          },
          {
            featureType: 'transit.station',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'water',
            elementType: 'geometry.fill',
            stylers: [{color: '#b9d3c2'}]
          },
          {
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [{color: '#92998d'}]
          }
        ],
        {name: 'Styled Map'});

    // Create a map object, and include the MapTypeId to add
    // to the map type control.
     map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 21.4660524, lng:39.2539445},
      zoom: 8,
      mapTypeControlOptions: {
        mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                'styled_map']
      }
    });
    // 

     infowindow = new google.maps.InfoWindow();

var  i;

for (i = 0; i < locations.length; i++) { 
  if(marker){
        marker.setMap(null);
        marker = [];
    }
  marker = new google.maps.Marker({
    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
    map: map
  });
   gmarkers[locations[i][3]] = marker;
  google.maps.event.addListener(marker, 'click', (function(marker, i) {
    return function() {
     
      infowindow.setContent(locations[i][0]);
      infowindow.open(map, marker);
    }
  })(marker, i));
}


google.maps.event.addListener(map, 'click', function(event) {
      placeMarker(event.latLng);
});

    //Associate the styled map with the MapTypeId and set it to display.
    map.mapTypes.set('styled_map', styledMapType);
    map.setMapTypeId('styled_map');
  }

var marker;
function placeMarker(location) {
  if ( marker ) {
    marker.setPosition(location);
  } else {
    marker = new google.maps.Marker({
      position: location,
      map: map
    });

  }
//   var loc =   JSON.stringify(location);
  $('.location').val(location);

  //var array=location.split(',');
/*  $('#lat').val(location[0]);
  $('#lan').val(location[1]);
    JSON.stringify(location);*/
//    alert(location[0]);
   var location = $('.location').val().replace('(', '');
   var location = location.replace(')', '');
   var array = location.split(',');
   $('.lat').val(array['0']);
   $('.lon').val(array['1']);
}
/****************************************************************/
  initMap();
</script>
<script>
   $(".parent_type_id").on('change',function(){
        const val = $(this).val();
        
        if(val ==2){
            $(".parent_div").removeClass('d-none');
            $(".country_div").addClass('d-none');
        }
        else{
            $(".parent_div").addClass('d-none');
            $(".country_div").removeClass('d-none');
        }
        $(".parent_id").val('');
        $(".country_id").val('');
    })
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/zone/index.blade.php ENDPATH**/ ?>