// end image preview
let PhotoPreview = function () {
    return {
        uploadFile:function (upload_photo,preview) {
            $("#"+upload_photo).change(function() {
                PhotoPreview.imagePreview(this,preview);
            });
        },
        imagePreview : function (input,preview) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#'+preview).attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    };
}();