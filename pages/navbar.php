<nav class="navbar">
    <a href="dashboard.php">Home</a>
    <?php if (!isset($_SESSION['logged_in'])): ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php else: ?>
        <a href="logout.php">Logout</a>
    <?php endif; ?>
    <div class="theme-switcher">
        <button id="theme-toggle" class="btn">Switch Theme</button>
    </div>
</nav>