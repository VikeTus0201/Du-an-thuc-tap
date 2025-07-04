<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prime | Login</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/login/login.css">
</head>

<body>
  <header class="header">
    <div class="logo">
      <h2 style="font-weight: 600;">
        <a href="./" style="text-decoration: none; color: black;">
          <P></P><span class="highlight">P</span>rime | Login
        </a>
      </h2>
    </div>



  </header>

  <main>
    <div class="login-section">
      <!-- <img src="/img/image.png" alt="Shoes" class="product-image"> -->
      <form class="login-form" action="" method="POST">
        <h2>Login</h2>
        <?php if (!empty($error)): ?>
          <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password" required>

        <button type="submit" class="login-button" name="login">Login</button>

        <!-- <div class="social-login">
          <button type="button" class="facebook-login">Facebook</button>
          <a href="?act=dang-ki">
          <button type="button" class="google-login">Đăng kí </button>
          </a>
        </div> -->
        <br><br>

        <a href="./?act=register" class="forgot-link">Register</a>
      </form>
    </div>
  </main>
  <footer>

  </footer>

  
</body>

</html>