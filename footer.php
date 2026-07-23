	<footer id="colophon" class="site-footer">
		<div class="container">
            <div class="footer-grid">

                <div class="footer-col">
                    <h4 class="footer-col-title">Programs</h4>
                    <ul class="footer-links">
                        <li><a href="#programs">ShredX</a></li>
                        <li><a href="#programs">Nomad X</a></li>
                        <li><a href="#programs">TNA's Tribe</a></li>
                        <li><a href="#programs">1-on-1 Elite Coaching</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4 class="footer-col-title">Connect</h4>
                    <ul class="footer-links">
                        <li><a href="#contact">Apply Now</a></li>
                        <li><a href="https://wa.me/917349517372" target="_blank" rel="noopener">WhatsApp Us: 7349517372</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="footer-brand">TNA - The Notorious Alpha</p>
                <p class="footer-tagline">Transformation Becomes Lifestyle.</p>
                <p class="footer-copy">&copy; <?php echo date('Y'); ?> TNA. All Rights Reserved.</p>
            </div>
		</div>
	</footer>

    <a href="https://wa.me/917349517372?text=Hi!%20I'm%20interested%20in%20joining%20a%20training%20session." class="whatsapp-float" target="_blank" rel="noopener noreferrer">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
          <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.508.646-.622.779-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
        </svg>
    </a>


</div>

<?php wp_footer(); ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggle = document.getElementById('nav-toggle');
        const nav = document.getElementById('site-navigation');
        const header = document.getElementById('masthead');
        if (toggle && nav && header) {
            toggle.addEventListener('click', function() {
                nav.classList.toggle('nav-open');
                header.classList.toggle('nav-open');
                toggle.classList.toggle('is-open');
                toggle.setAttribute('aria-expanded', nav.classList.contains('nav-open'));
            });

            nav.querySelectorAll('a').forEach(function(link) {
                link.addEventListener('click', function() {
                    nav.classList.remove('nav-open');
                    header.classList.remove('nav-open');
                    toggle.classList.remove('is-open');
                    toggle.setAttribute('aria-expanded', 'false');
                });
            });

            document.addEventListener('click', function(e) {
                if (header && !header.contains(e.target)) {
                    nav.classList.remove('nav-open');
                    header.classList.remove('nav-open');
                    toggle.classList.remove('is-open');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });
        }

        const reveals = document.querySelectorAll('.reveal');
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if(entry.isIntersecting) {
                    entry.target.classList.add('active');
                    observer.unobserve(entry.target);
                }
            });
        }, { root: null, threshold: 0.05, rootMargin: "0px" });
        reveals.forEach(reveal => revealObserver.observe(reveal));

        const navItems = document.querySelectorAll('.main-navigation li');
        navItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.animation = `fadeUp 0.6s cubic-bezier(0.1, 0.8, 0.2, 1) forwards ${index * 0.1 + 0.3}s`;
        });

        const brand = document.querySelector('.site-branding');
        if (brand) {
            brand.style.opacity = '0';
            brand.style.animation = 'fadeUp 0.8s cubic-bezier(0.1, 0.8, 0.2, 1) forwards 0.1s';
        }

        const track = document.getElementById('yt-track');
        const prevBtn = document.getElementById('yt-prev');
        const nextBtn = document.getElementById('yt-next');

        if (track && prevBtn && nextBtn) {
            const scrollAmount = () => {
                const card = track.querySelector('.yt-card');
                return card ? card.offsetWidth + 24 : 380;
            };

            nextBtn.addEventListener('click', () => {
                track.scrollBy({ left: scrollAmount(), behavior: 'smooth' });
            });

            prevBtn.addEventListener('click', () => {
                track.scrollBy({ left: -scrollAmount(), behavior: 'smooth' });
            });

            const updateBtns = () => {
                prevBtn.disabled = track.scrollLeft <= 0;
                nextBtn.disabled = track.scrollLeft + track.offsetWidth >= track.scrollWidth - 2;
            };
            track.addEventListener('scroll', updateBtns, { passive: true });
            updateBtns();
        }

        const instaTrack = document.getElementById('insta-track');
        const instaPrevBtn = document.getElementById('insta-prev');
        const instaNextBtn = document.getElementById('insta-next');

        if (instaTrack && instaPrevBtn && instaNextBtn) {
            const scrollAmount = () => {
                const card = instaTrack.querySelector('.insta-card');
                return card ? card.offsetWidth + 20 : 300; 
            };

            instaNextBtn.addEventListener('click', () => {
                instaTrack.scrollBy({ left: scrollAmount(), behavior: 'smooth' });
            });

            instaPrevBtn.addEventListener('click', () => {
                instaTrack.scrollBy({ left: -scrollAmount(), behavior: 'smooth' });
            });

            const updateInstaBtns = () => {
                instaPrevBtn.disabled = instaTrack.scrollLeft <= 0;
                instaNextBtn.disabled = instaTrack.scrollLeft + instaTrack.offsetWidth >= instaTrack.scrollWidth - 5;
            };
            instaTrack.addEventListener('scroll', updateInstaBtns, { passive: true });
            updateInstaBtns();
        }
    });
</script>

</body>
</html>
