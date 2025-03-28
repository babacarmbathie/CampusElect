<a href="{{ url('/') }}" class="campus-elect-logo">
    <img src="{{ asset('logo.svg') }}" alt="CampusElect Logo" class="logo-large" {{ $attributes }}>
    <img src="{{ asset('logo-small.svg') }}" alt="CampusElect Logo" class="logo-small" {{ $attributes }}>
</a>

<style>
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
</style> 