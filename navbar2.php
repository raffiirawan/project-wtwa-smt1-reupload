<!-- Navbar 3 Kolom -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <!-- Kolom 1: Menu Kiri -->
        <div class="d-flex align-items-center">
            <a class="navbar-brand fw-bold" href="#">NEDLIX</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">All Movies</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        Genre
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Horror</a></li>
                        <li><a class="dropdown-item" href="#">Sci-Fi</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- Kolom 2: Search Bar Tengah -->
        <form class="d-flex mx-auto col-12 col-lg-4" role="search">
            <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
        </form>

        <!-- Kolom 3: Profil atau Login Kanan -->
        <div class="d-flex align-items-center">
            <div class="dropdown">
                <a href="#" class="d-block text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
