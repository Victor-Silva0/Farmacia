(function ($) {
    if (!window.FileReader) {
        $("#foto").hide();
    }

    $("#imagem").on("change", function (e) {

        var $img = $("#foto");

        var url = e.target.files;

        if (url.length != 1 || !url[0].type.match("image.*")) {
            $(e.target).val("");

            $(".modal").modal("show");
            Holder.run({images: "#foto"});

            return false;
        }

        var file = url[0];

        var reader = new FileReader();
        reader.onload = function (e) {
            $img.attr("src", e.target.result).attr("alt", encodeURI(file.name));
        };

        reader.readAsDataURL(file);
    });
})(jQuery);