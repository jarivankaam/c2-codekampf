


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container">
        <!-- Navbar brand -->
        <h2><a class="navbar-brand me-2" href="/">
                <img src="{{asset('img/codecamp1.png')}}" alt="codecamp">
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

            <div class="d-flex align-items-center">
                <div class="categoryDropdown">
                    <button class="dropbtn" id="categoryDropdownBtn">Categories</button>
                    <div class="dropDown-content" id="dropDownContent">
                        @foreach($categories as $category)
                            <a class="categoryDropdownItemBtn" href="{{ $category->getFullPath() }}" >{{ $category["title"] }}</a>
                        @endforeach
                    </div>
                </div>
                <br>
                <div class="nav-item">
                    <button type="button" class="btn btn-primary me-3">
                        <a href="/pages">pages</a>
                    </button>
                </div>
                <div class="nav-item">
                    <button type="button" class="btn btn-primary me-3">
                        <a href="/page/create">pagina maken</a>
                    </button>
                </div>
                <div class="nav-item">
                    <button type="button" class="btn btn-primary me-3">
                        <a href="/category/create">categorie maken</a>
                    </button>
                </div>

            </div>

            <!-- Left links -->

            <div class="d-flex align-items-center">
                <div class="nav-item">
                    <button type="button" class="btn btn-primary me-3 login">
                        <a href="/login">login</a>
                    </button>
                </div>
                <div class="nav-item">
                    <button type="button" class="btn btn-primary me-3 login">
                        <a href="/register">Meld je aan</a>
                    </button>
                </div>
            </div>
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->




