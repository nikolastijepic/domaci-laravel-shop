<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="/">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-md-center" id="navbarNav">
            <ul class="navbar-nav gap-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('shop') ? 'active' : '' }}" href="/shop">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="/contact">Contact</a>
                </li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2">
            <div class="me-5">
                <a class="nav-link {{ request()->is('shop/cart*') ? 'active' : '' }}"
                   href="{{ route('shop.cart.index') }}">
                    <i id="cartIcon" class="fa-solid fa-cart-shopping fs-5 {{ request()->is('shop/cart*') ? '' : 'opacity-50' }}"></i>
                </a>
            </div>
            <label for="themeSwitch" class="m-0">
                <i id="themeIcon" class="bi bi-sun-fill fs-5"></i>
            </label>
            <div class="form-check form-switch m-0">
                <input class="form-check-input" type="checkbox" id="themeSwitch">
            </div>
        </div>
    </div>
</nav>
