<?php
$form_status = '';
if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_gym_form']) ) {
    $nonce_valid  = isset( $_POST['tna_contact_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['tna_contact_nonce'] ) ), 'tna_contact_form' );
    $is_bot       = ! empty( $_POST['tna_website'] );
    $ip           = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';
    $throttle_key = 'tna_contact_' . md5( $ip );

    if ( $is_bot ) {
        $form_status = '<p style="color: #25d366; background: rgba(37, 211, 102, 0.1); padding: 10px; border-radius: 5px; font-weight: bold; margin-bottom: 20px;">✔ Thank you for contacting us. We\'ll get back to you soon.</p>';
    } elseif ( ! $nonce_valid ) {
        $form_status = '<p style="color: var(--primary-color); background: rgba(204, 41, 54, 0.1); padding: 10px; border-radius: 5px; font-weight: bold; margin-bottom: 20px;">✘ Security check failed. Please refresh the page and try again.</p>';
    } elseif ( get_transient( $throttle_key ) ) {
        $form_status = '<p style="color: var(--primary-color); background: rgba(204, 41, 54, 0.1); padding: 10px; border-radius: 5px; font-weight: bold; margin-bottom: 20px;">✘ Please wait a minute before submitting again.</p>';
    } else {
        set_transient( $throttle_key, 1, MINUTE_IN_SECONDS );

        $name    = sanitize_text_field( $_POST['full_name'] );
        $email   = sanitize_email( $_POST['email'] );
        $phone   = sanitize_text_field( $_POST['phone'] );
        $program = sanitize_text_field( $_POST['program'] );
        $goal    = sanitize_text_field( $_POST['goal'] );
        $message = sanitize_textarea_field( $_POST['message'] );

        $to = 'magi.lawa@gmail.com';
        $subject = 'TNA Application: ' . $program . ' - ' . $name;
        $body = "Name: $name\nEmail: $email\nPhone: $phone\nProgram: $program\nGoal: $goal\n\nMessage:\n$message";
        $headers = array('Reply-To: ' . $email);

        if ( wp_mail( $to, $subject, $body, $headers ) ) {
            $form_status = '<p style="color: #25d366; background: rgba(37, 211, 102, 0.1); padding: 10px; border-radius: 5px; font-weight: bold; margin-bottom: 20px;">✔ Thank you for contacting us. We\'ll get back to you soon.</p>';
        } else {
            $form_status = '<p style="color: var(--primary-color); background: rgba(204, 41, 54, 0.1); padding: 10px; border-radius: 5px; font-weight: bold; margin-bottom: 20px;">✘ Failed to send message. Please try again later.</p>';
        }
    }
}

get_header();
?>

	<main id="primary" class="site-main">

        <section class="hero-section hero-large">
            <video class="hero-video" autoplay muted loop playsinline>
                <source src="https://tnashredx.com/wp-content/uploads/2026/02/IMG_6396.mp4" type="video/mp4">
            </video>
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <p class="hero-eyebrow">The Notorious Alpha</p>
                <h1>Elite Online<br>Performance Engineering</h1>
                <p>Technical, remote-first metabolic reset and structural transformation systems.</p>
                <div class="hero-buttons">
                    <a href="#programs" class="btn">Explore Programs</a>
                    <a href="#contact" class="btn btn-outline">Apply Now</a>
                </div>
            </div>
        </section>

        <section id="about" class="features-section section-padding reveal">
            <div class="container">
                <p class="section-eyebrow">Beyond Ordinary Fitness</p>
                <h2 class="section-title">Transformation Becomes <span class="gradient-text">Lifestyle</span></h2>
                <p class="section-subtitle">Most programs focus only on calories. We focus on training stimulus, gut-friendly nutrition, metabolic control, and habit engineering.</p>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">🧬</div>
                        <h3>Metabolic Reset</h3>
                        <p>We fix digestion, optimize protein intake, and manage stress to create an efficient fat-burning engine.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⛓️</div>
                        <h3>Habit Engineering</h3>
                        <p>Identity creates consistency. Consistency creates results. We build systems that make discipline automatic.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🌍</div>
                        <h3>Remote Engineering</h3>
                        <p>True performance is location-independent. Our online systems ensure elite-level training stimulus from anywhere in the world.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="programs" class="programs-section section-padding reveal" style="background: rgba(0,0,0,0.2);">
            <div class="container">
                <p class="section-eyebrow">The Core Pillars</p>
                <h2 class="section-title">Coaching <span class="gradient-text">Sync</span></h2>
                <p class="section-subtitle">Precision programming designed for specific metabolic and lifestyle outcomes.</p>
                
                <div class="program-cards" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                    <div class="program-card program-card--featured">
                        <div class="program-card-badge">Most Popular</div>
                        <div class="program-card-icon"><img src="https://tnashredx.com/wp-content/uploads/2026/02/shredX.png" alt="ShredX" style="width:64px;height:64px;object-fit:contain;"></div>
                        <h3>ShredX</h3>
                        <p style="font-weight:bold; color:#fff; margin-bottom: 8px;">Body Recomposition Engine</p>
                        <p>A high-density fat loss protocol. We optimize macro-nutrient thresholds to shift your metabolic baseline while installing rigid discipline systems.</p>
                        <ul style="color:var(--text-muted); font-size: 0.9rem; margin-bottom: 20px; padding-left: 15px;">
                            <li>Hypertrophy-focused stimuli</li>
                            <li>Protein-frequency optimization</li>
                            <li>Gut-biome restoration window</li>
                        </ul>
                        <a href="#contact" class="program-link">Apply for ShredX →</a>
                    </div>

                    <div class="program-card">
                        <div class="program-card-icon"><img src="https://tnashredx.com/wp-content/uploads/2026/02/nomadX.png" alt="Nomad X" style="width:64px;height:64px;object-fit:contain;"></div>
                        <h3>Nomad X</h3>
                        <p style="font-weight:bold; color:#fff; margin-bottom: 8px;">Distributed Performance Protocol</p>
                        <p>Location-independent performance engineering for high-frequency travelers. Remote strength maintenance and anti-bloat travel nutrition systems.</p>
                        <ul style="color:var(--text-muted); font-size: 0.9rem; margin-bottom: 20px; padding-left: 15px;">
                            <li>Micro-gym equipment scaling</li>
                            <li>20-minute metabolic pulses</li>
                            <li>Physiological regression prevention</li>
                        </ul>
                        <a href="#contact" class="program-link">Apply for Nomad X →</a>
                    </div>

                    <div class="program-card">
                        <div class="program-card-icon"><img src="https://tnashredx.com/wp-content/uploads/2026/02/TNATribe.png" alt="TNA's Tribe" style="width:64px;height:64px;object-fit:contain;"></div>
                        <h3>TNA's Tribe</h3>
                        <p style="font-weight:bold; color:#fff; margin-bottom: 8px;">Synchronized Accountability Ecosystem</p>
                        <p>A high-performance online network providing structure, peer-to-peer competitive benchmarks, and technical mindset engineering.</p>
                        <ul style="color:var(--text-muted); font-size: 0.9rem; margin-bottom: 20px; padding-left: 15px;">
                            <li>Remote strength cycles</li>
                            <li>Global benchmark tracking</li>
                            <li>Habit-bypass psychological prep</li>
                        </ul>
                        <a href="#contact" class="program-link">Join The Tribe →</a>
                    </div>

                    <div class="program-card" style="border-color: rgba(186, 104, 200, 0.4);">
                        <div class="program-card-badge" style="background: #ba68c8;">Application Only</div>
                        <div class="program-card-icon"><img src="https://tnashredx.com/wp-content/uploads/2026/02/Tna1-1.jpeg" alt="1-on-1 Elite" style="width:64px;height:64px;object-fit:contain;border-radius:8px;"></div>
                        <h3>1-on-1 Elite</h3>
                        <p style="font-weight:bold; color:#fff; margin-bottom: 8px;">High-Threshold Biological Engineering</p>
                        <p>Maximum-intervention remote coaching. Precision programming for athletes requiring absolute metabolic and physiological optimization.</p>
                        <ul style="color:var(--text-muted); font-size: 0.9rem; margin-bottom: 20px; padding-left: 15px;">
                            <li>Custom neuro-type training</li>
                            <li>Hormonal baseline optimization</li>
                            <li>Direct Bio-sync with TNA head coaches</li>
                        </ul>
                        <a href="#contact" class="program-link">Apply for Coaching →</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="events" class="features-section section-padding reveal">
            <div class="container">
                <p class="section-eyebrow">Competitive Culture</p>
                <h2 class="section-title">Previous <span class="gradient-text">Events</span></h2>
                <p class="section-subtitle">TNA has successfully organized events built to elevate competitive culture and performance standards.</p>
                
                <div class="features-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
                    <div class="feature-card">
                        <div class="feature-icon">🏃‍♂️</div>
                        <h3>Alpha Circuit</h3>
                        <p>High-intensity Obstacle Race pushing athletes to their cardiovascular and mental limits.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🏋️‍♀️</div>
                        <h3>2x CrossFit Competitions</h3>
                        <p>Head-to-head functional fitness battles testing strength, speed, and gymnastics.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">💪</div>
                        <h3>2x Powerlifting Championships</h3>
                        <p>Raw strength showcases focusing on the big three: Squat, Bench, and Deadlift.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="results" class="wod-section section-padding reveal">
            <div class="container">
                <p class="section-eyebrow">The Evidence</p>
                <h2 class="section-title">Client <span class="gradient-text">Results</span></h2>
                <p class="section-subtitle">Real feedback from athletes who committed to the TNA system.</p>
                
                <div class="program-cards" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-top: 40px;">
                    <div class="content-box" style="text-align:left; padding: 30px;">
                        <div style="color: var(--primary-color); font-size: 2rem; margin-bottom: -10px;">"</div>
                        <p style="font-size: 1.1rem; font-style: italic;">Lost 8kg in 45 days without starving.</p>
                    </div>
                    <div class="content-box" style="text-align:left; padding: 30px;">
                        <div style="color: var(--primary-color); font-size: 2rem; margin-bottom: -10px;">"</div>
                        <p style="font-size: 1.1rem; font-style: italic;">My digestion improved and bloating reduced significantly.</p>
                    </div>
                    <div class="content-box" style="text-align:left; padding: 30px;">
                        <div style="color: var(--primary-color); font-size: 2rem; margin-bottom: -10px;">"</div>
                        <p style="font-size: 1.1rem; font-style: italic;">First time I trained with proper structure. Built muscle while reducing fat.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="video-section section-padding reveal" style="background: rgba(0,0,0,0.15);">
            <div class="container" style="text-align:center;">
                <p class="section-eyebrow">See It In Action</p>
                <h2 class="section-title">Watch Us <span class="gradient-text">Train</span></h2>

                <?php
                $yt_video_id = '-quCnNY95vQ';
                ?>

                <div class="yt-channel-wrap" style="display: flex; justify-content: center;">
                    <div class="yt-card" style="max-width: 350px; width: 100%;">
                        <div class="yt-card-embed">
                            <iframe
                                src="https://www.youtube.com/embed/<?php echo esc_attr( $yt_video_id ); ?>?rel=0&modestbranding=1"
                                title="The Notorious Alpha Training"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen
                                loading="lazy"
                            ></iframe>
                        </div>
                    </div>
                </div>

                <div class="yt-controls">
                    <a href="https://www.youtube.com/shorts/-quCnNY95vQ" target="_blank" rel="noopener" class="btn">Watch on YouTube</a>
                </div>



            </div>
        </section>


        <section id="instagram-feed" class="instagram-section section-padding reveal">
            <div class="container">
                <p class="section-eyebrow">On the Gram</p>
                <h2 class="section-title">Instagram <span class="gradient-text">Feed</span></h2>
                <p class="section-subtitle">Catch our daily training tips, transformation stories, and arena highlights on Instagram.</p>

                <?php if ( shortcode_exists( 'instagram-feed' ) ) : ?>
                    <div class="insta-plugin-container">
                        <?php echo do_shortcode( '[instagram-feed feed=1]' ); ?>
                    </div>
                <?php else : ?>
                    <div class="insta-pending">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.844.047 1.097.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                        </svg>
                        <p>Install &amp; activate the <strong>Smash Balloon Social Photo Feed</strong> plugin, then connect your Instagram account to display your live feed here.</p>
                        <?php if ( current_user_can( 'install_plugins' ) ) : ?>
                            <a href="<?php echo esc_url( admin_url( 'plugin-install.php?s=smash+balloon+instagram&tab=search&type=term' ) ); ?>" class="btn" style="margin-top:16px;">Install Plugin →</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div style="text-align:center; margin-top: 36px;">
                    <a href="https://www.instagram.com/tna_shredx/" target="_blank" rel="noopener" class="btn insta-follow-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.844.047 1.097.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                        </svg>
                        Follow @tna_shredx
                    </a>
                </div>

            </div>
        </section>






        <section id="about-us" class="community-section section-padding reveal">
            <div class="container">
                <div class="community-grid">
                    <div class="community-image" style="order: 1;">
                        <img src="https://tnashredx.com/wp-content/uploads/2026/02/photo_2022-08-03_21-54-50.jpg" alt="Maheshwaran ChandraMohan - The Architect" style="width: 100%; height: 100%; object-fit: cover; border-radius: 14px; box-shadow: 0 16px 48px rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.05);">
                    </div>
                    <div class="community-text" style="order: 2;">
                        <p class="section-eyebrow">The Brainchild</p>
                        <h2 class="section-title">Meet The <span class="gradient-text">Architect</span></h2>
                        <h3 style="color: #fff; font-size: 1.4rem; margin-bottom: 20px;">Maheshwaran ChandraMohan – Founder & Head Coach</h3>
                        <p style="color: var(--text-muted); font-size: 1.1rem; line-height: 1.8; margin-bottom: 20px;">
                            Behind the TNA system is a relentless pursuit of peak human performance. Maheshwaran built The Notorious Alpha not as a traditional gym, but as a high-end remote engineering protocol designed to hack biology, optimize metabolic pathways, and build unbreakable mindsets.
                        </p>
                        <p style="color: var(--text-muted); font-size: 1.1rem; line-height: 1.8; margin-bottom: 30px;">
                            With years of experience transforming elite athletes and high-performers, the philosophy is simple: cut the noise, focus on precise data-driven programming, and scale true structural transformation globally.
                        </p>
                        <div style="display: flex; gap: 20px; align-items: center; margin-top: 20px;">
                            <a href="#contact" class="btn">Train With Maheshwaran</a>
                            <a href="https://www.instagram.com/tna_shredx/" target="_blank" rel="noopener" style="color: var(--text-muted); font-size: 1.5rem; transition: color 0.3s ease;" onmouseover="this.style.color='var(--primary-color)'" onmouseout="this.style.color='var(--text-muted)'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.844.047 1.097.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="community-section section-padding reveal">
            <div class="container">
                <div class="community-grid">
                    <div class="community-text">
                        <p class="section-eyebrow">Who We Are</p>
                        <h2 class="section-title">Online <span class="gradient-text">Excellence</span></h2>
                        <p style="color: var(--text-muted); font-size: 1.1rem; line-height: 1.8; margin-bottom: 20px;">TNA is a purely online-based elite coaching platform. We utilize advanced remote engineering protocols to deliver world-class structural body transformations regardless of your geographical coordinates.</p>
                        <p style="color: var(--text-muted); font-size: 1.1rem; line-height: 1.8; margin-bottom: 30px;">Our remote coaching infrastructure leverages data-driven programming across metabolic control and athletic performance. This is technical transformation, simplified for global access.</p>
                        <div class="stats-row">
                            <div class="stat-item">
                                <span class="stat-number gradient-text">150+</span>
                                <span class="stat-label">Online Athletes</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number gradient-text">12+</span>
                                <span class="stat-label">Expert Coaches</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number gradient-text">5★</span>
                                <span class="stat-label">Average Rating</span>
                            </div>
                        </div>
                    </div>
                    <div class="community-image">
                        <img src="https://images.unsplash.com/photo-1574680178050-55c6a6a96e0a?q=80&w=1469&auto=format&fit=crop" alt="TNA Online Coaching" style="width: 100%; height: 100%; object-fit: cover; border-radius: 14px; box-shadow: 0 16px 48px rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.05);">
                    </div>
                </div>
            </div>
        </section>

        <section id="faq" class="video-section section-padding reveal" style="background: rgba(0,0,0,0.15);">
            <div class="container">
                <p class="section-eyebrow" style="text-align:center;">Common Questions</p>
                <h2 class="section-title" style="text-align:center;">Frequently Asked <span class="gradient-text">Questions</span></h2>
                
                    <div class="content-box" style="margin-bottom: 20px; text-align: left; padding: 25px;">
                        <h3 style="font-size: 1.3rem; margin-bottom: 10px;">How long before I see results?</h3>
                        <p style="margin-bottom:0; color:var(--text-muted);">Visible changes usually happen in 3–4 weeks with strict adherence to the system.</p>
                    </div>
                    
                    <div class="content-box" style="margin-bottom: 20px; text-align: left; padding: 25px;">
                        <h3 style="font-size: 1.3rem; margin-bottom: 10px;">Do I need gym access?</h3>
                        <p style="margin-bottom: 8px; color:var(--text-muted);"><strong style="color:#25d366;">✓ ShredX &amp; 1-on-1 Elite</strong> — Yes, gym access is recommended.</p>
                        <p style="margin-bottom:0; color:var(--text-muted);"><strong style="color:var(--primary-color);">✓ Nomad X &amp; TNA's Tribe</strong> — No gym needed. 100% gym-free.</p>
                    </div>

                    <div class="content-box" style="margin-bottom: 20px; text-align: left; padding: 25px;">
                        <h3 style="font-size: 1.3rem; margin-bottom: 10px;">Is the diet very strict?</h3>
                        <p style="margin-bottom:0; color:var(--text-muted);">It is highly structured, not blindly restrictive. We optimize for digestion and performance over starvation.</p>
                    </div>

                    <div class="content-box" style="margin-bottom: 20px; text-align: left; padding: 25px;">
                        <h3 style="font-size: 1.3rem; margin-bottom: 10px;">Do you focus on gut health?</h3>
                        <p style="margin-bottom:0; color:var(--text-muted);">Yes. Digestion drives metabolism. Gut health is a core pillar of our metabolic reset.</p>
                </div>
        </section>
        
        <section id="contact" class="contact-section section-padding reveal" style="background: rgba(0,0,0,0.2);">
            <div class="container">
                <p class="section-eyebrow">Get In Touch</p>
                <h2 class="section-title" style="text-align:center;">Start Your <span class="gradient-text">Journey</span></h2>
                <div class="contact-grid">
                    
                    <div class="contact-info content-box">
                        <h3>Reserve Your Spot</h3>
                        <p style="margin-bottom: 20px; color: #9a9ab0;">Fill out the form below to book a class or ask a question.</p>
                        
                        <?php echo $form_status; ?>

                        <form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>#contact" method="POST" class="gym-form">
                            <?php wp_nonce_field( 'tna_contact_form', 'tna_contact_nonce' ); ?>
                            <div class="form-group" style="position:absolute; left:-9999px; top:auto; overflow:hidden;" aria-hidden="true">
                                <label for="tna_website">Website</label>
                                <input type="text" id="tna_website" name="tna_website" tabindex="-1" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" id="full_name" name="full_name" required placeholder="John Doe">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required placeholder="john@example.com">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" id="phone" name="phone" required placeholder="(555) 123-4567">
                            </div>
                            <div class="form-group">
                                <label for="program">Program Interested In</label>
                                <select id="program" name="program" required>
                                    <option value="" disabled selected>Select a Program...</option>
                                    <option value="ShredX">ShredX</option>
                                    <option value="Nomad X">Nomad X</option>
                                    <option value="TNA Tribe">TNA's Tribe</option>
                                    <option value="1-on-1 Elite">1-on-1 Elite Coaching</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="goal">Goal</label>
                                <input type="text" id="goal" name="goal" required placeholder="e.g. Fat loss, metabolic reset...">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" rows="4" required placeholder="Tell us more about your current situation..."></textarea>
                            </div>
                            <button type="submit" name="submit_gym_form" class="btn" style="width: 100%;">Apply Now</button>
                        </form>

                        <div style="margin-top: 40px; border-top: 1px solid rgba(100,181,246,0.15); padding-top: 20px;">
                            <h3>Contact Us</h3>
                            <p><strong>Email:</strong> magi.lawa@gmail.com</p>
                            <p><strong>WhatsApp:</strong> +91 73495 17372</p>
                            <p><strong>Availability:</strong> Online 24/7</p>
                        </div>
                    </div>

                    <div class="contact-map" style="border-radius: 14px; overflow: hidden; box-shadow: 0 8px 32px rgba(0,0,0,0.5); border: 1px solid rgba(100,181,246,0.12); display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 40px; background: rgba(255,255,255,0.03); gap: 24px;">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/earth_network.png" alt="Global Network" style="width: 120px; height: 120px; object-fit: contain; margin-bottom: -10px; filter: drop-shadow(0 0 15px rgba(100,181,246,0.3));">
                        <h3 style="font-size: 1.6rem; text-align:center;">100% Online. <span class="gradient-text">Worldwide.</span></h3>
                        <p style="color: var(--text-muted); text-align:center; font-size:1.05rem; line-height:1.8;">Join the elite network of performance-focused athletes worldwide. Our remote engineering protocols eliminate physical boundaries, providing you with high-threshold programming and constant bio-feedback loops.</p>
                        <div style="display:flex; flex-direction:column; gap:16px; width:100%; max-width:380px; margin-top: 10px;">
                            <div style="display:flex; align-items:center; gap:16px; color:var(--text-muted); padding: 10px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/chat_sync.png" alt="Sync" style="width: 32px; height: 32px; object-fit: contain;"> 
                                <span style="font-weight: 500;">Direct Bio-Sync via WhatsApp</span>
                            </div>
                            <div style="display:flex; align-items:center; gap:16px; color:var(--text-muted); padding: 10px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/analytics_chart.png" alt="Analytics" style="width: 32px; height: 32px; object-fit: contain;"> 
                                <span style="font-weight: 500;">Weekly Metabolic &amp; Progress Audits</span>
                            </div>
                            <div style="display:flex; align-items:center; gap:16px; color:var(--text-muted); padding: 10px; background: rgba(255,255,255,0.02); border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/digital_protocol.png" alt="Protocol" style="width: 32px; height: 32px; object-fit: contain;"> 
                                <span style="font-weight: 500;">Customized Digital Protocols</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

	</main>

<?php
get_footer();
?>
