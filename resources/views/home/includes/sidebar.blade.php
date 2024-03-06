<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        {{-- HOME --}}
        <li class="nav-item">
            <a class="nav-link " href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Home</span>
            </a>
        </li>

        @if (Auth::user()->role == 'admin')
            {{-- Category & News --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#"
                    aria-expanded="true">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav" style="">
                    <li>
                        <a class="nav-link" href="{{ route('category.index') }}">
                            <i class="bi bi-circle"></i>
                            <span>Category</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('news.index') }}">
                            <i class="bi bi-circle"></i>
                            <span>News</span>
                        </a>
                    </li>
                </ul>
            </li>
        @else
        @endif
    </ul>
</aside>
