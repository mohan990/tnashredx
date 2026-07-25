<?php

$form_status = '';
if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_tna_form']) ) {
    $guard = tna_shredx_guard_submission();
    if ( ! $guard['proceed'] ) {
        $form_status = $guard['status'];
    } else {
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
        $form_status = tna_shredx_form_notice( 'success', '✔ Thank you for contacting us. We\'ll get back to you soon.' );
    } else {
        $form_status = tna_shredx_form_notice( 'error', '✘ Failed to send message. Please try again later.' );
    }
    }
}

get_header();
?>

	<main id="primary" class="site-main">

        <section class="hero-section hero-large">
            <video class="hero-video" autoplay muted loop playsinline>
                <source src="https://tnashredx.com/wp-content/uploads/2026/02/landing_video.mp4" type="video/mp4">
            </video>
            <div class="hero-overlay"></div>
            <div class="hero-grain" aria-hidden="true"></div>
            <div class="hero-content">
                <span class="hero-eyebrow">The Notorious Alpha</span>
                <h1>Elite Online<br><span class="gradient-text">Performance Engineering</span></h1>
                <p class="hero-subtitle">Technical, remote-first metabolic reset and structural transformation systems.</p>
                <div class="hero-buttons">
                    <a href="#programs" class="btn">Explore Programs</a>
                    <a href="#contact" class="btn btn-outline">Apply Now</a>
                </div>
            </div>
            <a href="#about-us" class="hero-scroll" aria-label="Scroll to content">
                <span class="hero-scroll-text">Scroll</span>
                <span class="hero-scroll-mouse"><span class="hero-scroll-wheel"></span></span>
            </a>
        </section>

        <section id="about" class="features-section section-padding reveal">
            <div class="container">
                <p class="section-eyebrow">Beyond Ordinary Fitness</p>
                <h2 class="section-title">Transformation Becomes <span class="gradient-text">Lifestyle</span></h2>
                <p class="section-subtitle">Most programs focus only on calories. We focus on training stimulus, gut-friendly nutrition, metabolic control, and habit engineering.</p>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon"><span class="feature-icon-inner">🧬</span></div>
                        <h3>Metabolic Reset</h3>
                        <p>We fix digestion, optimize protein intake, and manage stress to create an efficient fat-burning engine.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon"><span class="feature-icon-inner">⛓️</span></div>
                        <h3>Habit Engineering</h3>
                        <p>Identity creates consistency. Consistency creates results. We build systems that make discipline automatic.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon"><span class="feature-icon-inner">🌍</span></div>
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
                
                <div class="program-cards">
                    <div class="program-card program-card--featured">
                        <div class="program-card-badge">Most Popular</div>
                        <div class="program-card-icon"><img src="https://tnashredx.com/wp-content/uploads/2026/02/shredX.webp" alt="ShredX body recomposition program icon" width="320" height="180" loading="lazy"></div>
                        <h3>ShredX</h3>
                        <p class="program-card-tagline">Body Recomposition Engine</p>
                        <p class="program-card-desc">A high-density fat loss protocol. We optimize macro-nutrient thresholds to shift your metabolic baseline while installing rigid discipline systems.</p>
                        <ul class="program-card-features">
                            <li>Hypertrophy-focused stimuli</li>
                            <li>Protein-frequency optimization</li>
                            <li>Gut-biome restoration window</li>
                        </ul>
                        <a href="#contact" class="program-link">Apply for ShredX →</a>
                    </div>

                    <div class="program-card">
                        <div class="program-card-icon"><img src="https://tnashredx.com/wp-content/uploads/2026/02/nomadX.webp" alt="Nomad X travel performance program icon" width="320" height="180" loading="lazy"></div>
                        <h3>Nomad X</h3>
                        <p class="program-card-tagline">Distributed Performance Protocol</p>
                        <p class="program-card-desc">Location-independent performance engineering for high-frequency travelers. Remote strength maintenance and anti-bloat travel nutrition systems.</p>
                        <ul class="program-card-features">
                            <li>Micro-gym equipment scaling</li>
                            <li>20-minute metabolic pulses</li>
                            <li>Physiological regression prevention</li>
                        </ul>
                        <a href="#contact" class="program-link">Apply for Nomad X →</a>
                    </div>

                    <div class="program-card">
                        <div class="program-card-icon"><img src="https://tnashredx.com/wp-content/uploads/2026/02/TNATribe.webp" alt="TNA's Tribe group coaching program icon" width="320" height="180" loading="lazy"></div>
                        <h3>TNA's Tribe</h3>
                        <p class="program-card-tagline">Synchronized Accountability Ecosystem</p>
                        <p class="program-card-desc">A high-performance online network providing structure, peer-to-peer competitive benchmarks, and technical mindset engineering.</p>
                        <ul class="program-card-features">
                            <li>Remote strength cycles</li>
                            <li>Global benchmark tracking</li>
                            <li>Habit-bypass psychological prep</li>
                        </ul>
                        <a href="#contact" class="program-link">Join The Tribe →</a>
                    </div>

                    <div class="program-card program-card--elite">
                        <div class="program-card-badge program-card-badge--elite">Application Only</div>
                        <div class="program-card-icon"><img src="https://tnashredx.com/wp-content/uploads/2026/02/Tna1-1.webp" alt="1-on-1 Elite personal coaching program" width="320" height="180" loading="lazy"></div>
                        <h3>1-on-1 Elite</h3>
                        <p class="program-card-tagline">High-Threshold Biological Engineering</p>
                        <p class="program-card-desc">Maximum-intervention remote coaching. Precision programming for athletes requiring absolute metabolic and physiological optimization.</p>
                        <ul class="program-card-features">
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
                        <div class="feature-icon"><span class="feature-icon-inner">🏃‍♂️</span></div>
                        <h3>Alpha Circuit</h3>
                        <p>High-intensity Obstacle Race pushing athletes to their cardiovascular and mental limits.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon"><span class="feature-icon-inner">🏋️‍♀️</span></div>
                        <h3>2x CrossFit Competitions</h3>
                        <p>Head-to-head functional fitness battles testing strength, speed, and gymnastics.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon"><span class="feature-icon-inner">💪</span></div>
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
                
                <div class="testimonial-grid">
                    <div class="content-box testimonial-card">
                        <span class="testimonial-quote-mark">&ldquo;</span>
                        <p class="testimonial-text">Lost 8kg in 45 days without starving.</p>
                    </div>
                    <div class="content-box testimonial-card">
                        <span class="testimonial-quote-mark">&ldquo;</span>
                        <p class="testimonial-text">My digestion improved and bloating reduced significantly.</p>
                    </div>
                    <div class="content-box testimonial-card">
                        <span class="testimonial-quote-mark">&ldquo;</span>
                        <p class="testimonial-text">First time I trained with proper structure. Built muscle while reducing fat.</p>
                    </div>
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

                <div class="yt-controls insta-controls">
                    <?php if ( shortcode_exists( 'instagram-feed' ) ) : ?>
                        <button class="yt-arrow" id="insta-prev" aria-label="Previous posts">&larr;</button>
                        <button class="yt-arrow" id="insta-next" aria-label="Next posts">&rarr;</button>
                    <?php endif; ?>
                    <a href="https://www.instagram.com/tna_shredx/" target="_blank" rel="noopener" class="btn insta-follow-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.844.047 1.097.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                        </svg>
                        Follow @tna_shredx
                    </a>
                </div>

            </div>
        </section>






        <section class="video-section section-padding reveal" style="background: rgba(0,0,0,0.15);">
            <div class="container" style="text-align:center;">
                <p class="section-eyebrow">See It In Action</p>
                <h2 class="section-title">Watch Us <span class="gradient-text">Train</span></h2>
                <p class="section-subtitle">Technique breakdowns, sessions, and results — straight from the channel.</p>

                <?php
                /**
                 * YouTube videos / shorts shown in the carousel.
                 * To add a video: copy its ID from the URL (the part after watch?v= or youtu.be/
                 * or /shorts/) and add a new entry. 'title' is optional.
                 */
                $yt_videos = array(
                    array( 'id' => '-VhFPu7fDFU' ),
                    array( 'id' => 'tdZ_GRWNiJA' ),
                    array( 'id' => '9XCIYUIxsNs' ),
                    array( 'id' => 'aNbbjb3JDuc' ),
                    array( 'id' => 'eFPx-LKQuDA' ),
                    array( 'id' => '5Pildzdm-1k' ),
                    array( 'id' => 'AsFNDw6j2F4' ),
                );
                ?>

                <div class="yt-channel-wrap">
                    <div class="yt-scroll-track" id="yt-track">
                        <?php foreach ( $yt_videos as $video ) : ?>
                            <div class="yt-card">
                                <div class="yt-card-embed">
                                    <iframe
                                        src="https://www.youtube.com/embed/<?php echo esc_attr( $video['id'] ); ?>?rel=0&modestbranding=1"
                                        title="<?php echo esc_attr( isset( $video['title'] ) ? $video['title'] : 'The Notorious Alpha' ); ?>"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen
                                        loading="lazy"
                                    ></iframe>
                                </div>
                                <?php if ( ! empty( $video['title'] ) ) : ?>
                                    <div class="yt-card-title"><?php echo esc_html( $video['title'] ); ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="yt-controls">
                    <?php if ( count( $yt_videos ) > 1 ) : ?>
                        <button class="yt-arrow" id="yt-prev" aria-label="Previous video">&larr;</button>
                        <button class="yt-arrow" id="yt-next" aria-label="Next video">&rarr;</button>
                    <?php endif; ?>
                    <a href="https://www.youtube.com/@Thenotoriousalpha" target="_blank" rel="noopener" class="btn">Watch on YouTube</a>
                </div>

            </div>
        </section>


        <section id="about-us" class="community-section section-padding reveal">
            <div class="container">
                <div class="community-grid">
                    <div class="community-image" style="order: 1;">
                        <img src="https://tnashredx.com/wp-content/uploads/2026/02/photo_2022-08-03_21-54-50.webp" alt="Maheshwaran ChandraMohan — Founder and Head Coach of TNAShredX gym Bangalore" loading="lazy" style="width: 100%; height: 100%; object-fit: cover; border-radius: 14px; box-shadow: 0 16px 48px rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.05);">
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
                        <div class="architect-cta" style="display: flex; gap: 20px; align-items: center; margin-top: 20px; flex-wrap: wrap;">
                            <a href="#contact" class="btn">Train With Maheshwaran</a>

                            <div class="social-icons">

                                <a href="https://www.instagram.com/tna_shredx/" target="_blank" rel="noopener" aria-label="Instagram" class="social-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.844.047 1.097.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                    </svg>
                                </a>

                                <a href="#" aria-label="Facebook" class="social-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                    </svg>
                                </a>

                                <a href="https://www.youtube.com/@Thenotoriousalpha" target="_blank" rel="noopener" aria-label="YouTube" class="social-icon social-icon--youtube">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z"/>
                                    </svg>
                                </a>

                            </div>
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
                        <img src="https://images.unsplash.com/photo-1574680178050-55c6a6a96e0a?q=80&w=1469&auto=format&fit=crop" alt="TNAShredX online fitness coaching team — strength and conditioning training in Bangalore" loading="lazy" style="width: 100%; height: 100%; object-fit: cover; border-radius: 14px; box-shadow: 0 16px 48px rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.05);">
                    </div>
                </div>
            </div>
        </section>

        <section id="faq" class="faq-section section-padding reveal" style="background: rgba(0,0,0,0.15);">
            <div class="container">
                <p class="section-eyebrow" style="text-align:center;">Common Questions</p>
                <h2 class="section-title" style="text-align:center;">Frequently Asked <span class="gradient-text">Questions</span></h2>
                <p class="section-subtitle">Everything you need to know before you start. Still unsure? <a href="#contact" style="color:var(--primary-color);">Reach out</a> and we'll answer personally.</p>

                <div class="faq-list">
                    <details class="faq-item" open>
                        <summary class="faq-question">
                            <span>How long before I see results?</span>
                            <span class="faq-icon" aria-hidden="true"></span>
                        </summary>
                        <div class="faq-answer">
                            <p>Visible changes usually happen in <strong>3–4 weeks</strong> with strict adherence to the system. Structural transformation compounds from there — most clients hit their key milestone inside the first program cycle.</p>
                        </div>
                    </details>

                    <details class="faq-item">
                        <summary class="faq-question">
                            <span>Do I need gym access?</span>
                            <span class="faq-icon" aria-hidden="true"></span>
                        </summary>
                        <div class="faq-answer">
                            <p><strong style="color:var(--primary-color);">ShredX &amp; 1-on-1 Elite</strong> — Yes, gym access is recommended for these strength-focused tracks.</p>
                            <p><strong style="color:var(--primary-color);">Nomad X &amp; TNA's Tribe</strong> — No gym needed. 100% gym-free, designed for training anywhere.</p>
                        </div>
                    </details>

                    <details class="faq-item">
                        <summary class="faq-question">
                            <span>Is the diet very strict?</span>
                            <span class="faq-icon" aria-hidden="true"></span>
                        </summary>
                        <div class="faq-answer">
                            <p>It is <strong>highly structured, not blindly restrictive</strong>. We optimise for digestion and performance over starvation — the goal is a metabolism that works with you, not a crash diet you can't sustain.</p>
                        </div>
                    </details>

                    <details class="faq-item">
                        <summary class="faq-question">
                            <span>Do you focus on gut health?</span>
                            <span class="faq-icon" aria-hidden="true"></span>
                        </summary>
                        <div class="faq-answer">
                            <p>Yes. Digestion drives metabolism, so <strong>gut health is a core pillar</strong> of our metabolic reset. Better absorption means better energy, recovery, and body composition.</p>
                        </div>
                    </details>

                    <details class="faq-item">
                        <summary class="faq-question">
                            <span>How does online coaching actually work?</span>
                            <span class="faq-icon" aria-hidden="true"></span>
                        </summary>
                        <div class="faq-answer">
                            <p>You get a personalised training and nutrition protocol, direct check-ins over WhatsApp, and weekly progress audits. Everything is remote-first — you train on your schedule while we adjust the plan around your data.</p>
                        </div>
                    </details>

                    <details class="faq-item">
                        <summary class="faq-question">
                            <span>How do I get started?</span>
                            <span class="faq-icon" aria-hidden="true"></span>
                        </summary>
                        <div class="faq-answer">
                            <p>Hit <a href="#contact" style="color:var(--primary-color);">Apply Now</a> and fill out the short form. We'll review your goals and match you to the right program — then your protocol is built and you begin.</p>
                        </div>
                    </details>
                </div>
            </div>
        </section>
        
        <section id="contact" class="contact-section section-padding reveal" style="background: rgba(0,0,0,0.2);">
            <div class="container">
                <p class="section-eyebrow">Get In Touch</p>
                <h2 class="section-title" style="text-align:center;">Start Your <span class="gradient-text">Journey</span></h2>
                <div class="contact-grid">
                    
                    <div class="contact-info content-box">
                        <h3>Reserve Your Spot</h3>
                        <p style="margin-bottom: 20px; color: #9a9ab0;">A few quick steps and we'll match you to the right program.</p>

                        <?php echo $form_status; ?>

                        <form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>#contact" method="POST" class="tna-form tna-wizard" data-wizard>
                            <?php wp_nonce_field( 'tna_contact_form', 'tna_contact_nonce' ); ?>
                            <?php echo tna_shredx_honeypot_field(); ?>

                            <!-- Progress bar (shown only when JS enables the wizard) -->
                            <div class="wizard-progress" aria-hidden="true">
                                <div class="wizard-progress-track"><span class="wizard-progress-fill"></span></div>
                                <div class="wizard-steps-labels">
                                    <span class="wizard-step-label is-active">Goal</span>
                                    <span class="wizard-step-label">About You</span>
                                    <span class="wizard-step-label">Message</span>
                                </div>
                            </div>

                            <!-- STEP 1 — Goal -->
                            <div class="wizard-step" data-step="1">
                                <div class="form-group">
                                    <label>Which program interests you?</label>
                                    <div class="program-picker">
                                        <label class="program-option">
                                            <input type="radio" name="program" value="ShredX" required>
                                            <span class="program-option-card"><strong>ShredX</strong><small>Strength & shred</small></span>
                                        </label>
                                        <label class="program-option">
                                            <input type="radio" name="program" value="Nomad X">
                                            <span class="program-option-card"><strong>Nomad X</strong><small>Gym-free anywhere</small></span>
                                        </label>
                                        <label class="program-option">
                                            <input type="radio" name="program" value="TNA Tribe">
                                            <span class="program-option-card"><strong>TNA's Tribe</strong><small>Community coaching</small></span>
                                        </label>
                                        <label class="program-option">
                                            <input type="radio" name="program" value="1-on-1 Elite">
                                            <span class="program-option-card"><strong>1-on-1 Elite</strong><small>Fully personalised</small></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="goal">Your #1 goal</label>
                                    <input type="text" id="goal" name="goal" required placeholder="e.g. Fat loss, metabolic reset...">
                                </div>
                                <div class="wizard-nav">
                                    <span></span>
                                    <button type="button" class="btn" data-wizard-next>Next →</button>
                                </div>
                            </div>

                            <!-- STEP 2 — About You -->
                            <div class="wizard-step" data-step="2">
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
                                <div class="wizard-nav">
                                    <button type="button" class="btn btn-outline" data-wizard-prev>← Back</button>
                                    <button type="button" class="btn" data-wizard-next>Next →</button>
                                </div>
                            </div>

                            <!-- STEP 3 — Message -->
                            <div class="wizard-step" data-step="3">
                                <div class="form-group">
                                    <label for="message">Tell us about your current situation</label>
                                    <textarea id="message" name="message" rows="4" required placeholder="Where you're at now, what you've tried, your timeline..."></textarea>
                                </div>
                                <div class="wizard-nav">
                                    <button type="button" class="btn btn-outline" data-wizard-prev>← Back</button>
                                    <button type="submit" name="submit_tna_form" class="btn" data-wizard-submit>Apply Now</button>
                                </div>
                            </div>
                        </form>

                        <div class="contact-info-block">
                            <h4 class="contact-info-title">Contact Us</h4>
                            <div class="contact-info-grid">
                                <a href="mailto:magi.lawa@gmail.com" class="contact-info-item">
                                    <span class="contact-info-icon">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64b5f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                    </span>
                                    <div class="contact-info-details">
                                        <span class="contact-info-label">Email</span>
                                        <span class="contact-info-value">magi.lawa@gmail.com</span>
                                    </div>
                                </a>

                                <a href="https://wa.me/917349517372" target="_blank" rel="noopener noreferrer" class="contact-info-item">
                                    <span class="contact-info-icon">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#25D366" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                                        </svg>
                                    </span>
                                    <div class="contact-info-details">
                                        <span class="contact-info-label">WhatsApp</span>
                                        <span class="contact-info-value">+91 73495 17372</span>
                                    </div>
                                </a>

                                <div class="contact-info-item">
                                    <span class="contact-info-icon">
                                        <span class="live-pulse-dot"></span>
                                    </span>
                                    <div class="contact-info-details">
                                        <span class="contact-info-label">Availability</span>
                                        <span class="contact-info-value live-status-text">Online 24/7</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-box online-panel">
                        <div class="online-panel-header">
                            <img class="online-panel-globe" src="https://tnashredx.com/wp-content/uploads/2026/02/earth_network.webp" alt="TNAShredX global online coaching network" width="120" height="120" loading="lazy">
                            <h3 class="online-panel-title">100% Online. <span class="gradient-text">Worldwide.</span></h3>
                            <p class="online-panel-intro">Join the elite network of performance-focused athletes worldwide. Our remote engineering protocols eliminate physical boundaries, providing you with high-threshold programming and constant bio-feedback loops.</p>
                            
                            <div class="online-panel-stats">
                                <div class="online-stat-chip">
                                    <span class="stat-number">5★</span>
                                    <span class="stat-label">Average Rating</span>
                                </div>
                                <div class="online-stat-chip">
                                    <span class="stat-number">100%</span>
                                    <span class="stat-label">Remote Engineering</span>
                                </div>
                                <div class="online-stat-chip">
                                    <span class="stat-number">24/7</span>
                                    <span class="stat-label">Bio-Sync Support</span>
                                </div>
                                <div class="online-stat-chip">
                                    <span class="stat-number">150+</span>
                                    <span class="stat-label">Online Athletes</span>
                                </div>
                            </div>
                        </div>
                        <ul class="online-features">
                            <li class="online-feature">
                                <span class="online-feature-icon"><img src="https://tnashredx.com/wp-content/uploads/2026/02/chat_sync.webp" alt="" role="presentation" aria-hidden="true" width="32" height="32" loading="lazy"></span>
                                <span>Direct Bio-Sync via WhatsApp</span>
                            </li>
                            <li class="online-feature">
                                <span class="online-feature-icon"><img src="https://tnashredx.com/wp-content/uploads/2026/02/analytics_chart.webp" alt="" role="presentation" aria-hidden="true" width="32" height="32" loading="lazy"></span>
                                <span>Weekly Metabolic &amp; Progress Audits</span>
                            </li>
                            <li class="online-feature">
                                <span class="online-feature-icon"><img src="https://tnashredx.com/wp-content/uploads/2026/02/digital_protocol.webp" alt="" role="presentation" aria-hidden="true" width="32" height="32" loading="lazy"></span>
                                <span>Customized Digital Protocols</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </section>

	</main>

<?php
/**
 * WebSite + Organization graph. Google reads `WebSite.name` for the site name
 * shown above search results, and `Organization.logo` for the logo beside them.
 * Neither can be derived from the LocalBusiness node alone, which is why search
 * results were rendering as a bare URL.
 */
$tna_home = home_url( '/' );
$tna_graph = array(
	'@context' => 'https://schema.org',
	'@graph'   => array(
		array(
			'@type'         => 'WebSite',
			'@id'           => $tna_home . '#website',
			'url'           => $tna_home,
			'name'          => 'TNAShredX',
			'alternateName' => array( 'TNA ShredX', 'TNA - The Notorious Alpha' ),
			'inLanguage'    => 'en-IN',
			'publisher'     => array( '@id' => $tna_home . '#organization' ),
		),
		array(
			'@type'         => 'Organization',
			'@id'           => $tna_home . '#organization',
			'name'          => 'TNAShredX',
			'alternateName' => 'TNA - The Notorious Alpha',
			'url'           => $tna_home,
			'logo'          => array(
				'@type' => 'ImageObject',
				'@id'   => $tna_home . '#logo',
				'url'   => 'https://tnashredx.com/wp-content/uploads/2026/02/shredX.webp',
				'caption' => 'TNAShredX',
			),
			'image'    => array( '@id' => $tna_home . '#logo' ),
			'sameAs'   => array(
				'https://www.instagram.com/tna_shredx/',
				'https://www.youtube.com/@Thenotoriousalpha',
			),
		),
	),
);
echo '<script type="application/ld+json">'
	. wp_json_encode( $tna_graph, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )
	. '</script>' . "\n";
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": ["LocalBusiness", "SportsActivityLocation", "GymOrFitnessCenter"],
  "@id": "<?php echo esc_url( home_url( '/' ) ); ?>#gym",
  "name": "TNA - The Notorious Alpha",
  "alternateName": "TNA ShredX",
  "parentOrganization": { "@id": "<?php echo esc_url( home_url( '/' ) ); ?>#organization" },
  "url": "<?php echo esc_url( home_url( '/' ) ); ?>",
  "logo": "https://tnashredx.com/wp-content/uploads/2026/02/shredX.webp",
  "image": "https://tnashredx.com/wp-content/uploads/2026/02/shredX.webp",
  "description": "Elite online CrossFit and functional fitness coaching based in Bangalore, India. Expert body recomposition, metabolic reset and remote performance engineering by Maheshwaran ChandraMohan — serving clients worldwide.",
  "telephone": "+917349517372",
  "email": "<?php echo esc_attr( get_option( 'admin_email' ) ); ?>",
  "priceRange": "₹₹",
  "currenciesAccepted": "INR",
  "paymentAccepted": "Cash, UPI, Bank Transfer",
  "founder": {
    "@type": "Person",
    "name": "Maheshwaran ChandraMohan",
    "jobTitle": "Head Coach & Founder",
    "sameAs": "https://www.instagram.com/tna_shredx/"
  },
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Bangalore",
    "addressRegion": "Karnataka",
    "addressCountry": "IN"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 12.9716,
    "longitude": 77.5946
  },
  "areaServed": [
    { "@type": "City", "name": "Bangalore" },
    { "@type": "Country", "name": "India" },
    { "@type": "AdministrativeArea", "name": "Worldwide" }
  ],
  "knowsAbout": [
    "CrossFit",
    "Functional Fitness",
    "Body Recomposition",
    "Metabolic Reset",
    "Online Personal Training",
    "Fat Loss Coaching",
    "Performance Engineering",
    "Gut Health Nutrition",
    "Remote Strength Training"
  ],
  "openingHours": "Mo-Su 00:00-23:59",
  "sameAs": [
    "https://www.instagram.com/tna_shredx/",
    "https://www.youtube.com/@Thenotoriousalpha",
    "https://g.page/tnashredx"
  ]
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "TNA Coaching Programs",
  "serviceType": "Online Fitness Coaching",
  "provider": {
    "@type": "LocalBusiness",
    "name": "TNA - The Notorious Alpha",
    "url": "<?php echo esc_url( home_url( '/' ) ); ?>"
  },
  "areaServed": { "@type": "Country", "name": "India" },
  "hasOfferCatalog": {
    "@type": "OfferCatalog",
    "name": "TNA Online Coaching Programs",
    "itemListElement": [
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "ShredX — Body Recomposition Engine",
          "description": "High-density fat loss and body recomposition protocol for CrossFit and functional fitness athletes. Hypertrophy-focused training, protein-frequency optimization, and gut-biome restoration. Based in Bangalore, available online across India.",
          "category": "Body Recomposition & Fat Loss"
        }
      },
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "Nomad X — Distributed Performance Protocol",
          "description": "Location-independent functional fitness and performance engineering for high-frequency travelers. Remote strength maintenance, 20-minute metabolic pulses, and anti-bloat travel nutrition.",
          "category": "Travel & Remote Fitness"
        }
      },
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "TNA's Tribe — Accountability Ecosystem",
          "description": "High-performance online CrossFit and functional fitness community with remote strength cycles, global benchmark tracking, and habit-engineering systems.",
          "category": "Group Online Coaching"
        }
      },
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "1-on-1 Elite Coaching",
          "description": "Maximum-intervention online personal coaching in Bangalore and worldwide. Custom neuro-type training, hormonal baseline optimization, and direct bio-sync with TNA head coaches.",
          "category": "Premium Personal Coaching"
        }
      }
    ]
  }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "How long before I see results?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Visible changes usually happen in 3–4 weeks with strict adherence to the system."
      }
    },
    {
      "@type": "Question",
      "name": "Do I need gym access?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "ShredX and 1-on-1 Elite recommend gym access. Nomad X and TNA's Tribe are 100% gym-free."
      }
    },
    {
      "@type": "Question",
      "name": "Is the diet very strict?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "It is highly structured, not blindly restrictive. We optimize for digestion and performance over starvation."
      }
    },
    {
      "@type": "Question",
      "name": "Do you focus on gut health?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes. Digestion drives metabolism. Gut health is a core pillar of our metabolic reset."
      }
    }
  ]
}
</script>

<?php
get_footer();
?>
