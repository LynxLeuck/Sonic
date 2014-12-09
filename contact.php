<?php

require_once "recaptchalib.php";
// Register API keys at https://www.google.com/recaptcha/admin
$siteKey = "6LdD-P4SAAAAADEXBNmcPITposC8PLoBapS-hp2Z";
$secret = "6LdD-P4SAAAAAC70pyd1bIe7nIhzjHJFAl2qR_JY";
// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$lang = "en";
// The response from reCAPTCHA
$resp = null;
// The error code from reCAPTCHA, if any
$error = null;
$reCaptcha = new ReCaptcha($secret);
// Was there a reCAPTCHA response?
if ($_POST["g-recaptcha-response"]) {
    $resp = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}
?>
<html>
  <head><title>reCAPTCHA Example</title></head>
  <body>
<?php
if ($resp != null && $resp->success) {

// Check for empty fields
    if (empty($_POST['name']) ||
        empty($_POST['email']) ||
        empty($_POST['phone']) ||
        empty($_POST['message']) ||
        !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
    ) {
        echo "No arguments Provided!";
        return false;
    }

    $name = $_POST['name'];
    $email_address = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

// Create the email and send the message
    $to = 'i-am@tristenhogue.me'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
    $email_subject = "Website Contact Form:  $name";
    $email_body = "You have received a new message from your website contact form.\n\n" . "Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
    $headers = "From: noreply@tristenhogue.me\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
    $headers .= "Reply-To: $email_address";
    mail($to, $email_subject, $email_body, $headers);
    return true;
}
?>
    <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Contact Me</h2>
                        <h3 class="section-subheading text-muted">I will read every single one.</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form name="sentMessage" id="contactForm" novalidateWsu
                            t8971341
                            pa>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-12 text-center">
                                    <div id="success"></div> <br>
                                    <div class="g-recaptcha" data-sitekey="<?php echo $siteKey;?>"></div>
                                          <script type="text/javascript"
                                              src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang;?>">
                                          </script>
                                    <br>
                                    <button type="submit" class="btn btn-xl">Send Message</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
  </body>
</html>
      <script type="text/javascript"
          src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang;?>">
      </script>