


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Navbar brand -->
        <h2><a class="navbar-brand me-2" href="/">
           CODECAMP
        </a></h2>

        <!-- Toggle button -->
        <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#navbarButtonsExample"
            aria-controls="navbarButtonsExample"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarButtonsExample">
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <div class="categoryDropdown">
                        <button class="dropbtn" id="categoryDropdownBtn">Categories</button>
                        <div class="dropDown-content" id="dropDownContent">
                            @foreach($categories as $category)
                                <a class="categoryDropdownItemBtn" href="{{ $category->getFullPath() }}" >{{ $category["title"] }}</a>
                            @endforeach
                        </div>
                    </div>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-link px-3 me-2">
                    <a href="/pages">pages</a>
                </button>
                <button type="button" class="btn btn-link px-3 me-2">
                    <a href="/category/create">categorie maken</a>
                </button>

            </div>

            <!-- Left links -->

            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-link px-3 me-2">
                    <a href="/login">login</a>
                </button>
                <button type="button" class="btn btn-primary me-3">
                    <a href="/register" style="color:white;">Meld je aan</a>
                </button>
            </div>
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->




