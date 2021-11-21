
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
										<a href="/admin/setting" class="m-nav__link">
											<span class="m-nav__link-text"><?php echo e(trans('lang.setting')); ?></span>
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
<?php echo e(trans('lang.setting')); ?>

</h3>
</div>
</div>
</div>
	<div class="m-portlet__body">
    <form class="settingForm" id="settingForm" action="" method="post"  enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group m-form__group row">
                        <div class="col-md-6 mb-4">
                            <label><?php echo e(trans('lang.site_name_ar')); ?><span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="site_name_ar" value="<?php echo e($title = $data['setting']->title_ar ?? ''); ?>" class="form-control site_name_ar" placeholder="<?php echo e(trans('lang.site_name_ar')); ?>">
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label><?php echo e(trans('lang.site_name_en')); ?><span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="text" name="site_name_en" value="<?php echo e($title = $data['setting']->title_en ?? ''); ?>" class="form-control site_name_en" placeholder="<?php echo e(trans('lang.site_name_en')); ?>">
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label><?php echo e(trans('lang.email_contactus')); ?><span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="email" name="email" value="<?php echo e($title = $data['setting']->email ?? ''); ?>" class="form-control email" placeholder="<?php echo e(trans('lang.email_contactus')); ?>">
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label><?php echo e(trans('lang.ios')); ?><span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="url" name="ios" value="<?php echo e($title = $data['setting']->ios ?? ''); ?>" class="form-control ios" placeholder="<?php echo e(trans('lang.ios')); ?>">
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label><?php echo e(trans('lang.andriod')); ?><span class="required">*</span></label>
                            <div class="form-valid">
                                <input type="url" name="andriod" value="<?php echo e($title = $data['setting']->andriod ?? ''); ?>" class="form-control andriod" placeholder="<?php echo e(trans('lang.andriod')); ?>">
                            </div>
                        </div>
 
                            <div class="col-md-4 mb-4">
                                <label><?php echo e(trans('lang.site_commission')); ?><span class="required">*</span></label>
                                <div class="form-valid">
                                    <input type="text" name="site_commission" value="<?php echo e($title = $data['setting']->site_commission ?? ''); ?>" class="form-control site_commission" placeholder="<?php echo e(trans('lang.site_commission')); ?>">
                                </div>
                            </div>
                         
                </div>

                <div class="modal-footer">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update_setting')): ?>
                    <button type="submit" class="btn btn-primary btn_save_page"><?php echo e(trans('lang.save')); ?></button>
                    <?php endif; ?>
                </div>
            </form>
	</div>
</div>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
  $('#activeValue').bootstrapSwitch();
            $('#settingForm').on('submit', function(e){
            e.preventDefault();
            $('#load').show();
            var formData = new FormData(this);
       
                $.ajax({
                    url: '/admin/setting/update',
                    dataType:'json',
                    type: 'POST',
                    cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#load').hide();
                        if (data["status"] == true) {
                                Swal.fire(
                                data['message'],
                                '',
                                'success'
                                );
                                location.reload();
                        }else {
                            Swal.fire({
                                type: 'error',
                                title: 'عذرا',
                                text: data['message']
                            })
                        }
                    },
                });
            });
</script>
<script src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyC3WpKCxoMYKOzwaSAXkts8Z1IrceC3lPQ" type="text/javascript"></script>

    <script type="text/javascript">

   var gmarkers = [];var map ;var infowindow;
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

         infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) { 
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
  $(document).ready(function(e){

    
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(<?php echo e($data['setting']->lat); ?>, <?php echo e($data['setting']->lon); ?>),
        map: map
      });
      placeMarker(marker.position)
  })
</script>

<script>
  $(document).on('click','.delete_video',function(e){
      e.preventDefault();

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
                url: "/admin/setting/delete_video",
                type: "post",
                dataType: "JSON",
                data: {
                    
                },
                success: function(data){
					if(data['status'] == true){
            Swal.fire(
                        data['message'],
                        '',
                        'success'
                        );
                        location.reload();
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/backend_yagot/resources/views/admin/setting/index.blade.php ENDPATH**/ ?>