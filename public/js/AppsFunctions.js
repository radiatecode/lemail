let AppsFunction = function () {
   return {
       getSelectedId : function(array){
           let rows = document.getElementsByName(array);
           let selectedRows = [];let j=0;
           for (let i = 0; rows[i]; i++) {
               if (rows[i].checked) {
                   selectedRows[j]=rows[i].value;
                   j++;
               }
           }
           return selectedRows;
       },
       checkAll: function(check_all,checkboxes){
           $("#"+check_all).click(function () {
               $("."+checkboxes).prop('checked', $(this).prop('checked'));
           });
       },
       selectedItemsActions : function (array,url,doWhat,csrf,buttonName) {
           $("#"+buttonName,).click(function () {
               swal({
                   title: 'Are you sure?',
                   text: "You won't be able to revert this!",
                   type: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#3085d6',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Yes, '+doWhat+'!'
               }).then((result) => {
                   if (result.value) {
                       if (AppsFunction.getSelectedId(array).length>0) {
                           $.ajax({
                               data: {selected_ids: AppsFunction.getSelectedId(array), '_token': csrf},
                               url: url + '/' + doWhat,
                               type: 'POST',
                               dataType: 'json',
                               error: function (xhr, status, error) {
                                   if (status === "timeout") {
                                       alert("timeout");
                                   } else {
                                       alert(status);
                                   }
                               },
                               success: function (response) {
                                   if (response === "success") {
                                       location.reload();
                                   }
                               },
                               timeout: 7000
                           });
                       }else{
                           swal({
                               title: 'No Item Selected',
                               type: 'warning',
                           });
                       }
                   }
               });
           });
       },
       deleteSingleItem: function (url,redirect_path) {
           swal({
               title: 'Are you sure?',
               text: "You won't be able to revert this!",
               type: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Yes, Delete!'
           }).then((result) => {
               if (result.value) {
                   $.ajax({
                       url: url,
                       type: 'GET',
                       dataType: 'json',
                       error: function (xhr, status, error) {
                           if (status === "timeout") {
                               alert("timeout");
                           } else {
                               alert(status);
                           }
                       },
                       success: function (response) {
                           if (response === "success") {
                               window.location.href = redirect_path;
                           }
                       },
                       timeout: 7000
                   });
               }
           });
       }
   }

}();