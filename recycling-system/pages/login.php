<?php include('includes/header.php'); ?>
<section class="login-section">
    <h2>Login</h2>
    <form action="login_script.php" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</section>
<?php include('includes/footer.php'); ?>
