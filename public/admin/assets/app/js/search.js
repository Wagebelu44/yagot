

$('.client_id').selectpicker().ajaxSelectPicker({
        ajax: {


          // data source
          url: 'clients/search',

          // ajax type
          type: 'get',

          // data type
          dataType: 'json',

          data: {
                  name:'{{{q}}}'
              }

        },

        // function to preprocess JSON data
        preprocessData: function (data) {
        
          var i, l = data['data'].length, array = [];
          // console.log(l);
          if (l) {
              for (i = 0; i < l; i++) {
                  array.push($.extend(true, data[i], {
                      text : data['data'][i].name,
                      value: data['data'][i].id,
                  }));
              }
          }

          // You must always return a valid array when processing data. The
          // data argument passed is a clone and cannot be modified directly.
          return array;
        }

      });



      $('.product_select').selectpicker().ajaxSelectPicker({
        ajax: {


          // data source
          url: 'products/search',

          // ajax type
          type: 'get',

          // data type
          dataType: 'json',

          data: {
                  name:'{{{q}}}'
              }

        },

        // function to preprocess JSON data
        preprocessData: function (data) {
        
          var i, l = data['data'].length, array = [];
          // console.log(l);
          if (l) {
              for (i = 0; i < l; i++) {
                  array.push($.extend(true, data[i], {
                      text : data['data'][i].name,
                      value: data['data'][i].id,
                  }));
              }
          }

          // You must always return a valid array when processing data. The
          // data argument passed is a clone and cannot be modified directly.
          return array;
        }

      });

      
