<form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" class="custom-contact-form">
  <p><input type="text" name="cf-name" placeholder="Your Name" required></p>
  <p><input type="email" name="cf-email" placeholder="Your Email" required></p>
  <p><textarea name="cf-message" rows="6" placeholder="Your Message" required></textarea></p>
  <p><input type="submit" name="cf-submitted" value="Send Message"></p>
</form>
