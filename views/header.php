<div class="header">
    <div class="logo"><a href="#"><img width=120 height=80 src="images/logo.jpg" alt="" border="0"/></a></div>
    <div id="menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About us</a></li>
            <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])) : ?>
            <li><a href="profile.php">My Account</a></li>
            <?php endif; ?>
            <?php if (!isset($_SESSION['username']) && empty($_SESSION['username'])) : ?>
            <li><a href="register.php">Register</a></li>
            <?php endif; ?>
            <li><a href="contact.php">Contact us</a></li>
            <li><a href="help.php">Help</a></li>
            <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])) : ?>
                <li><a href="logout.php">Logout </a></li>
            <?php else: ?>
                <li><a href="login.php">Login </a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>