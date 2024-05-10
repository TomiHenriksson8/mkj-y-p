jQuery(document).ready(function($) {
    $('.cart-decrease, .cart-remove').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            success: function(result) {
                alert('Cart updated!');
                location.reload();
            }
        });
    });
});
