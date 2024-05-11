<?php
/*
Template Name: Payment Information
*/
?>

<?php get_header(); ?>

<div class="payment-info-container">
    <h1>Payment Information</h1>
    <form action="process-payment.php" method="post">
        <div class="form-group">
            <label for="cardNumber">Card Number</label>
            <input type="text" id="cardNumber" name="cardNumber" required>
        </div>
        <div class="form-group">
            <label for="cardExpiry">Expiration Date</label>
            <input type="text" id="cardExpiry" name="cardExpiry" placeholder="MM/YY" required>
        </div>
        <div class="form-group">
            <label for="cardCVC">CVC</label>
            <input type="text" id="cardCVC" name="cardCVC" required>
        </div>
        <a href="<?php echo esc_url(home_url('/thank-you?action=clear_cart')); ?>" class="btn btn-primary">Proceed to Order</a>
        <a href="<?php echo home_url(); ?>" class="btn btn-secondary">Return to Homepage</a>
    </form>
</div>

<?php get_footer(); ?>
