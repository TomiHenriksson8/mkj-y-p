<?php
/*
Template Name: About Us
*/

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <div class="image-container">
            <img src="<?php echo get_template_directory_uri(); ?>/images/aboutus2.jpg" alt="Descriptive alt text" style="width: 100%;">
        </div>

        <div class="contact-container">
            <div class="contact-info">
                <h3>Contact Us</h3>
                <p>We are committed to responding within 24 hours. If you have any inquiries, concerns, or need assistance, please do not hesitate to reach out.</p>
                <p><strong>How can you contact us?</strong></p>
                <ul>
                    <li>Fill out the form on this page.</li>
                    <li>Email us directly at <a href="mailto:info@tproducts.fi">info@tproducts.fi</a>.</li>
                    <li>Call us during business hours at +358 20 123 4567</li>
                </ul>
                <p><strong>Frequently Asked Questions:</strong></p>
                <ul>
                    <li><strong>What types of services do you offer?</strong> - We provide a range of services including X, Y, and Z. Visit our Services page for more details.</li>
                    <li><strong>What are your hours of operation?</strong> - We are open from 9 AM to 5 PM, Monday through Friday.</li>
                </ul>

            </div>

            <form class="contact-form" action="/path-to-your-script.php" method="POST">
                <h4>Contact Us Form</h4>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
                <input type="submit" value="Submit">
            </form>
        </div>

    </main>
</div>

<?php get_footer(); ?>
