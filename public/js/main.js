$(document).ready(function () {
    // home page
    $('#search').keydown(function () {
        var word = $(this).val();

        if (word.length > 3) {
            var list = [];
            $.get("/product/find/" + word, function (data) {
                data.forEach(function (entry) {
                    list.push($('<li/>').append(
                        $('<a/>', {text: entry.name, href: "/product/" + entry.id})
                    ));

                });
                $("#result_search").empty().append(list).show();
            });

        }
        else {
            $("#result_search").hide();
        }

    })
        // .focusout(function () {
        //     $("#result_search").hide();
        // });

    $('.btn_search').click(function () {
        $(".form_search").toggle();
    });
    $('.enter').click(function () {
        $(".form_enter").toggle();
    });

});
