<?php
/**
 * Template Name: Contact Page with Map
 */

$form_status = '';
if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_gym_form']) ) {
    $name    = sanitize_text_field( $_POST['name'] );
    $email   = sanitize_email( $_POST['email'] );
    $session = sanitize_text_field( $_POST['session'] );
    $message = sanitize_textarea_field( $_POST['message'] );

    $to = get_option( 'admin_email' ); 
    $subject = 'New Gym Inquiry from ' . $name;
    $body = "Name: $name\nEmail: $email\nInterested In: $session\n\nMessage:\n$message";
    $headers = array('Reply-To: ' . $email);

    if ( wp_mail( $to, $subject, $body, $headers ) ) {
        $form_status = '<p style="color: #25d366; background: rgba(37, 211, 102, 0.1); padding: 10px; border-radius: 5px; font-weight: bold; margin-bottom: 20px;">✔ Thank you for contacting us. We\'ll get back to you soon.</p>';
    } else {
        $form_status = '<p style="color: var(--primary-color); background: rgba(204, 41, 54, 0.1); padding: 10px; border-radius: 5px; font-weight: bold; margin-bottom: 20px;">✘ Failed to send message. Please try again later.</p>';
    }
}

get_header();
?>

	<main id="primary" class="site-main">

        <section class="hero-section hero-small">
            <div class="hero-content">
                <h1><?php the_title(); ?></h1>
            </div>
        </section>

        <section class="contact-section section-padding">
            <div class="container contact-grid">

                <div class="contact-info content-box">
                    <h3>Get In Touch</h3>
                    <p style="margin-bottom: 20px; color: #ccc;">Fill out the form below to book a class or ask a question.</p>
                    
                    <?php echo $form_status; ?>

                    <form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="POST" class="gym-form">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" id="name" name="name" required placeholder="John Doe">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required placeholder="john@example.com">
                        </div>
                        <div class="form-group">
                            <label for="session">Interested In</label>
                            <select id="session" name="session">
                                <option value="general">General Inquiry</option>
                                <?php
                                $sessions = get_posts(array(
                                    'post_type' => 'training_session',
                                    'posts_per_page' => -1
                                ));
                                foreach($sessions as $session) {
                                    echo '<option value="' . esc_attr($session->post_title) . '">' . esc_html($session->post_title) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="4" required placeholder="Tell us about your fitness goals..."></textarea>
                        </div>
                        <button type="submit" name="submit_gym_form" class="btn" style="width: 100%;">Send Message</button>
                    </form>

                    <div style="margin-top: 40px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px;">
                        <h3>Gym Details</h3>
                        <p><strong>Email:</strong> info@shinygym.local</p>
                        <p><strong>Phone:</strong> (555) 123-4567</p>
                    </div>
                </div>

                <div class="contact-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.15830869428!2d-74.119763973046!3d40.69766374874431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1700000000000!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>
        </section>

	</main>

<?php
get_footer();
