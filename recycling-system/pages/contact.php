<?php include('includes/header.php'); ?>
<section class="contact-section">
    <h2>Contact Us</h2>
    <p>If you have any questions, feel free to contact us!</p>
    <form action="contact_script.php" method="POST">
        <label for="name">Your Name</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Your Email</label>
        <input type="email" name="email" id="email" required>

        <label for="message">Message</label>
        <textarea name="message" id="message" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</section>
<?php include('includes/footer.php'); ?>
