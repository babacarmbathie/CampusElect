<!-- Logo Component -->
<div class="logo-container">
    <img src="{{ asset('logo.svg') }}" alt="CampusElect Logo" class="logo-large">
    <img src="{{ asset('logo-small.svg') }}" alt="CampusElect Logo" class="logo-small">
    <div class="logo-fallback">
        <i class="bi bi-people-fill"></i>
    </div>
</div>

<style>
    .logo-container {
        display: flex;
        align-items: center;
        margin-right: 1rem;
    }

    .logo-large, .logo-small {
        width: 40px;
        height: 40px;
        object-fit: contain;
    }

    @media (max-width: 768px) {
        .logo-large {
            display: none;
        }
        .logo-small {
            display: inline-block;
        }
    }
    
    @media (min-width: 769px) {
        .logo-large {
            display: inline-block;
        }
        .logo-small {
            display: none;
        }
    }

    .logo-fallback {
        width: 40px;
        height: 40px;
        background-color: var(--dark-brown);
        border-radius: 50%;
        display: none;
        align-items: center;
        justify-content: center;
    }

    .logo-fallback i {
        font-size: 1.5rem;
        color: var(--cream);
    }

    /* Show fallback when both images fail to load */
    .logo-large:not([src]), .logo-small:not([src]), 
    .logo-large[src=""], .logo-small[src=""],
    .logo-large.error, .logo-small.error {
        display: none;
    }

    .logo-large.error ~ .logo-small.error ~ .logo-fallback {
        display: flex;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const logoLarge = document.querySelector('.logo-large');
    const logoSmall = document.querySelector('.logo-small');

    function handleImageError(img) {
        img.classList.add('error');
    }

    if (logoLarge) {
        logoLarge.addEventListener('error', function() {
            handleImageError(this);
        });
    }

    if (logoSmall) {
        logoSmall.addEventListener('error', function() {
            handleImageError(this);
        });
    }
});
</script> 