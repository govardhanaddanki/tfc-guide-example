<?php include('includes/header.php'); ?>
<section class="register-section">
    <h2>Register</h2>
    <form action="register_script.php" method="POST" id="registerForm">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <label for="confirmPassword">Confirm Password</label>
        <input type="password" name="confirmPassword" id="confirmPassword" required>

        <button type="submit">Register</button>
        <div id="errorMessages"></div>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</section>
<?php include('includes/footer.php'); ?>
