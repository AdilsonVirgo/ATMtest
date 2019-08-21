<script type="text/javascript">
    $("document").ready(function () {
        $("#picture").change(function (event) {
            picture_compress(event);
        });
    });

    $("#vsignal_form").submit(function (e) {
        e.preventDefault(); //prevent submit
        var self = this;
        $("#picture").val('');
        self.submit();
    });

    function picture_compress(e) {
        $('#picture_data').val('');

        const file = e.target.files[0];
        const reader = new FileReader();
        reader.readAsDataURL(e.target.files[0]);
        reader.onload = event => {
            const img = new Image();
            img.src = event.target.result;
            img.onload = () => {
                var ar = img.width / img.height;
                var width = {{ env('APP_UPLOADED_IMAGE_WIDTH', 600) }};
                var height = width / ar;
                const elem = document.createElement('canvas');
                elem.width = width;
                elem.height = height;
                const ctx = elem.getContext('2d');
                ctx.drawImage(img, 0, 0, width, height);
                if (file.type === "image/jpeg") {
                    var dataURL = ctx.canvas.toDataURL("image/jpeg", 1.0);
                } else {
                    var dataURL = ctx.canvas.toDataURL("image/png");
                }
                $('#picture_data').val(dataURL);
            },
                reader.onerror = error => console.log(error);
        };
    }
</script>
