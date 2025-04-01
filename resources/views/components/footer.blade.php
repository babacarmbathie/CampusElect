<!-- Footer -->
<footer class="footer">
    <div class="custom-shape-divider-top-1713266907">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
        </svg>
    </div>
    <div class="container-fluid footer-body">
        <div class="row">
            <div class="col-md-6 footer-left pt-xl-4 px-xl-5">
                <div class="footer-brand">
                    @include('components.logo')
                    <h4 class="brand-name">CAMPUS ELECT</h4>
                </div>
                <p class="footer-description">Plateforme de vote électronique innovante pour les élections universitaires. Votre voix compte pour l'avenir de votre campus.</p>
                <div class="footer-social">
                    <a href="#" class="social-link" title="Suivez-nous sur Twitter">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="social-link" title="Rejoignez-nous sur Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="social-link" title="Suivez-nous sur Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="social-link" title="Connectez-vous sur LinkedIn">
                        <i class="bi bi-linkedin"></i>
                    </a>
                </div>
                <div class="footer-copyright">
                    <div class="vertical-line"></div>
                    <p class="credits-footer" id="credits">
                        <span class="hello-text">© {{ date('Y') }} CampusElect.</span> Tous droits réservés.
                    </p>
                </div>
            </div>
            <div class="col-md-3 footer-middle">
                <h5 class="footer-title">Liens Utiles</h5>
                <div class="row">
                    <div class="col-6">
                        <a href="https://www.cena.sn/" class="footer-link" target="_blank" rel="noopener">
                            <i class="bi bi-link-45deg"></i>CENA
                        </a>
                        <a href="https://www.interieur.gouv.sn/" class="footer-link" target="_blank" rel="noopener">
                            <i class="bi bi-link-45deg"></i>Ministère
                        </a>
                        <a href="https://www.dge.sn/" class="footer-link" target="_blank" rel="noopener">
                            <i class="bi bi-link-45deg"></i>DGE
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="https://www.assemblee.sn/" class="footer-link" target="_blank" rel="noopener">
                            <i class="bi bi-link-45deg"></i>Assemblée
                        </a>
                        <a href="https://www.presidence.sn/" class="footer-link" target="_blank" rel="noopener">
                            <i class="bi bi-link-45deg"></i>Présidence
                        </a>
                        <a href="https://www.seneweb.com/" class="footer-link" target="_blank" rel="noopener">
                            <i class="bi bi-link-45deg"></i>Seneweb
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 footer-right">
                <h5 class="footer-title">Contact & Info</h5>
                <div class="contact-info">
                    <p class="contact-item">
                        <i class="bi bi-envelope-fill"></i>
                        <a href="mailto:contact@campus-elect.sn" class="campus-elect-email">contact@campus-elect.sn</a>
                    </p>
                    <p class="contact-item">
                        <i class="bi bi-telephone-fill"></i>
                        <a href="tel:+221777286959" class="campus-elect-phone">+221 77 728 69 59</a>
                    </p>
                    <p class="contact-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        Université Gaston Berger, Saint-Louis
                    </p>
                </div>
                <div class="quick-links">
                    <a href="{{ route('about') }}" class="footer-link">
                        <i class="bi bi-info-circle"></i>À propos
                    </a>
                    <!-- <a href="{{ route('histoire') }}" class="footer-link"> -->
                        <i class="bi bi-clock-history"></i>Notre Histoire
                    </a>
                    <a href="{{ route('confidentialite') }}" class="footer-link">
                        <i class="bi bi-shield-check"></i>Confidentialité
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
.footer {
    position: relative;
    background-color: var(--cream);
    padding-top: 120px;
    margin-top: 50px;
    font-family: 'Poppins', sans-serif;
}

.custom-shape-divider-top-1713266907 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    pointer-events: none;
}

.custom-shape-divider-top-1713266907 svg {
    position: relative;
    display: block;
    width: calc(100% + 1.3px);
    height: 120px;
    transform: rotateY(180deg);
}

.custom-shape-divider-top-1713266907 .shape-fill {
    fill: var(--dark-brown);
}

.footer-body {
    padding: 3rem 0;
}

.footer-left {
    border-right: 2px solid rgba(var(--dark-brown-rgb), 0.1);
}

.footer-brand {
    display: flex;
    align-items: center;
    margin-bottom: 2rem;
}

.footer-brand .logo-container {
    transform: scale(1.5);
    margin-right: 1.5rem;
}

.footer-brand .logo-large,
.footer-brand .logo-small {
    width: 50px;
    height: 50px;
}

.footer-brand .logo-fallback {
    width: 50px;
    height: 50px;
}

.brand-name {
    margin: 0 0 0 1rem;
    color: var(--dark-brown);
    font-weight: 700;
    font-size: 1.8rem;
}

.footer-description {
    color: var(--dark-brown);
    opacity: 0.8;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.footer-social {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
}

.social-link {
    display: inline-flex !important;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: var(--dark-brown);
    color: var(--cream) !important;
    transition: all 0.3s ease;
}

.social-link:hover {
    transform: translateY(-3px);
    background-color: var(--primary);
    box-shadow: 0 5px 15px rgba(var(--primary-rgb), 0.3);
}

.social-link i {
    font-size: 1.2rem;
    color: inherit;
}

.footer-title {
    color: var(--dark-brown);
    font-weight: 600;
    margin-bottom: 1.5rem;
    position: relative;
    padding-bottom: 0.5rem;
}

.footer-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 2px;
    background-color: var(--primary);
}

.footer-link {
    display: flex !important;
    align-items: center;
    gap: 0.5rem;
    color: var(--dark-brown);
    opacity: 0.8;
    transition: all 0.3s ease;
}

.footer-link:hover {
    opacity: 1;
    color: var(--primary);
    transform: translateX(5px);
}

.footer-link i {
    font-size: 1.1rem;
}

.contact-info {
    margin-bottom: 2rem;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
    color: var(--dark-brown);
    opacity: 0.8;
}

.contact-item i {
    color: var(--primary);
}

.campus-elect-email, .campus-elect-phone {
    color: var(--primary) !important;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
}

.campus-elect-email:hover, .campus-elect-phone:hover {
    opacity: 0.8;
}

.footer-copyright {
    margin-top: 2rem;
}

.vertical-line {
    width: 50px;
    height: 3px;
    background-color: var(--primary);
    margin: 1rem 0;
}

.credits-footer {
    font-size: 0.9rem;
    color: var(--dark-brown);
    opacity: 0.8;
}

@media (max-width: 768px) {
    .footer {
        padding-top: 80px;
    }

    .footer-left {
        border-right: none;
        border-bottom: 2px solid rgba(var(--dark-brown-rgb), 0.1);
        padding-bottom: 2rem;
        margin-bottom: 2rem;
    }

    .footer-social {
        justify-content: center;
    }

    .footer-title {
        margin-top: 1rem;
    }

    .contact-info, .quick-links {
        margin-bottom: 1.5rem;
    }
}

@media (max-width: 576px) {
    .footer-body {
        padding: 2rem 1rem;
    }

    .footer-brand {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    .footer-brand .logo-container {
        transform: scale(2);
        margin-right: 0;
    }

    .brand-name {
        margin: 0;
        font-size: 2rem;
    }

    .footer-description {
        text-align: center;
    }

    .footer-copyright {
        text-align: center;
    }

    .vertical-line {
        margin: 1rem auto;
    }
}
</style> 