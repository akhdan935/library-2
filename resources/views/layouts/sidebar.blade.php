<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-muted">
        <span>Tables</span>
    </h6>

    <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link {{ Request::is('books*') ? 'active' : '' }}" href="/books">
            <span data-feather="file-text"></span>
            Books
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link {{ Request::is('histories*') ? 'active' : '' }}" href="/histories">
            <span data-feather="file-text"></span>
            Histories
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link {{ Request::is('categories*') ? 'active' : '' }}" href="/categories">
            <span data-feather="file-text"></span>
            Categories
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link {{ Request::is('authors*') ? 'active' : '' }}" href="/authors">
            <span data-feather="file-text"></span>
            Authors
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link {{ Request::is('publishers*') ? 'active' : '' }}" href="/publishers">
            <span data-feather="file-text"></span>
            Publishers
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link {{ Request::is('punishes*') ? 'active' : '' }}" href="/punishes">
            <span data-feather="file-text"></span>
            Punishes
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link {{ Request::is('punishments*') ? 'active' : '' }}" href="/punishments">
            <span data-feather="file-text"></span>
            Punishments
        </a>
        </li>
    </ul>
    </div>
</nav>