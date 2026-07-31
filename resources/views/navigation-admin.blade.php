<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="/admin/add-products">Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-md-center" id="navbarNav">
            <ul class="navbar-nav gap-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.product.add.index') ? 'active' : '' }}" href="{{ route('admin.product.add.index') }}">Add Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.product.all') ? 'active' : '' }}" href="{{ route('admin.product.all') }}">All Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.contact.all') ? 'active' : '' }}" href="{{ route('admin.contact.all') }}">All Contacts</a>
                </li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2">
            <label for="themeSwitch" class="m-0">
                <i id="themeIcon" class="bi bi-sun-fill fs-5"></i>
            </label>
            <div class="form-check form-switch m-0">
                <input class="form-check-input" type="checkbox" id="themeSwitch">
            </div>
        </div>
    </div>
</nav>
