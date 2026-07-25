<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
            font-family:Arial, sans-serif;
        }

        .contact-section{
            padding:70px 0;
        }

        .contact-card{
            background:#fff;
            border-radius:15px;
            box-shadow:0 5px 20px rgba(0,0,0,.15);
            padding:40px;
            transition:.3s;
        }

        .contact-card:hover{
            transform:translateY(-5px);
        }

        .title{
            color:#0d6efd;
            font-weight:bold;
        }

        .contact-info{
            font-size:18px;
            margin:20px 0;
        }

        .contact-info i{
            color:#0d6efd;
            margin-right:10px;
            font-size:22px;
        }

        .social a{
            text-decoration:none;
            margin:10px;
            font-size:18px;
            color:#0d6efd;
            font-weight:bold;
        }

        .social a:hover{
            color:#084298;
        }
    </style>

</head>
<body>

<?php include("navbar.php"); ?>

<section class="contact-section">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="contact-card text-center">

                    <h2 class="title">Contact Us</h2>

                    <p class="text-muted mt-3">
                        If you have any questions, feel free to contact us through the following information.
                    </p>

                    <hr>

                    <div class="contact-info">
                        📍 <strong>Address:</strong> 10th of Ramadan City, Egypt
                    </div>

                    <div class="contact-info">
                        📞 <strong>Phone:</strong> +20 100 123 4567
                    </div>

                    <div class="contact-info">
                        ✉️ <strong>Email:</strong> info@example.com
                    </div>

                    <div class="contact-info">
                        🕒 <strong>Working Hours:</strong><br>
                        Sunday - Thursday<br>
                        9:00 AM - 5:00 PM
                    </div>

                    <hr>

                    <div class="social">
                        <a href="#">Facebook</a> |
                        <a href="#">Instagram</a> |
                        <a href="#">LinkedIn</a> |
                        <a href="#">Twitter</a>
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>

<?php include("footer.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>