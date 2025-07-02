<!-- <!DOCTYPE html> -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Shoe Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/Thuctap/Project_thuc_tap/assets/css/more/contact.css?v=<?= time(); ?>">
</head>

<body>
    <?php require_once './views/layout/header.php' ?>
    <main class="container">

        <div class="row">
            <!-- Contact Information -->
            <div class="col-6 contact-info">
                <h2>Our Store</h2>
                <p><strong>Address:</strong> Quoc Oai, Ha Noi, Viet Nam</p>
                <p><strong>Phone:</strong> 0000 1133</p>
                <p><strong>Email:</strong> support@prime.vn</p>
                <h3>Opening Hours</h3>
                <ul>
                    <li>Monday - Friday: 9:00 AM - 8:00 PM</li>
                    <li>Saturday: 10:00 AM - 6:00 PM</li>
                    <li>Sunday: Closed</li>
                </ul>
            </div>

            <!-- Contact Form -->
            <div class="col-6 contact-form">
                <h2>Send Us a Message</h2>
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Type your message here..."
                            required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Send Message</button>
                </form>
            </div>
        </div>

    </main>
    <?php require_once './views/layout/footer.php' ?>

</body>

</html>