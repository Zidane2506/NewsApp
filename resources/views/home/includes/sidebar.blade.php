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
                <a class="nav-link" href="{{ route('category.index') }}">
                    <i class="bi bi-basket2"></i>
                    <span>Category</span>
                </a>
            </li>
        @else
        @endif
    </ul>
</aside>
