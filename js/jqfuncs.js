$(document).ready(function () {
    $(":radio").on({

        change: function () {
            console.log(this);
            console.log('radio clicked !');
            console.log( $(this).val());
            console.log($(this).attr("data-productid"));
            console.log($(this).attr("data-type"));

            $.post("ajax_requests_handler.php",
                {

                    rating: $(this).val(),
                    product_id : $(this).attr("data-productid"),
                    type :  $(this).attr("data-type"),


                });
           location.reload(true);
           // done with the bug .


        }
    });
});