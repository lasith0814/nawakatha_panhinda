<div class="sidebar" data-color="purple" data-background-color="white" >
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{route('home')}}" class="simple-text logo-normal">
      {{ __("Nawakatha Panhinda") }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'Dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
        <li class="nav-item{{ $activePage == 'Reader' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('readers.index') }}">
                <i class="material-icons">local_library</i>
                <p>{{ __('Reader Management') }}</p>
            </a>
        </li>
        @if (Auth::user()->can('viewAny', \App\User::class) || Auth::user()->can('viewAny', \App\UserAccessRole::class))
        <li class="nav-item {{ $activePage == 'User' ? ' active' : '' }} {{ $activePage == 'Role' ? ' active' : '' }}">
            <a class="nav-link collapsed" data-toggle="collapse" href="#userControl" aria-expanded="false">
                <i class="material-icons">people</i>
                <p>{{ __('User Control') }}
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse {{ $activePage == 'User' ? ' show' : '' }} {{ $activePage == 'Role' ? ' show' : '' }}" id="userControl">
                <ul class="navbar-expand-sm" style="list-style-type: none; padding-top: 10px ">
                    @can('viewAny' , \App\User::class)
                    <li class="nav-item{{ $activePage == 'User' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('users.index') }}">
                            <span class="sidebar-mini"> UM </span>
                            <span class="sidebar-normal"> {{ __('User Management') }} </span>
                        </a>
                    </li>
                    @endcan
                    @can('viewAny' , \App\UserAccessRole::class)
                    <li class="nav-item {{ $activePage == 'Role' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('roles.index') }}">
                            <span class="sidebar-mini"> RM </span>
                            <span class="sidebar-normal"> {{ __('Role Management') }} </span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
        </li>
        @endif

        @if (Auth::user()->can('viewAny', \App\Ebook::class) || Auth::user()->can('viewAny', \App\Author::class) || Auth::user()->can('viewAny', \App\EbookCategory::class))
            <li class="nav-item {{ $activePage == 'Book' ? ' active' : '' }} {{ $activePage == 'Page' ? ' active' : '' }} {{ $activePage == 'Author' ? ' active' : '' }} {{ $activePage == 'Category' ? ' active' : '' }}">
                <a class="nav-link collapsed" data-toggle="collapse" href="#bookControl" aria-expanded="false">
                    <i class="material-icons">menu_book</i>
                    <p>{{ __('Book Control') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ $activePage == 'Book' ? ' show' : '' }} {{ $activePage == 'Page' ? ' show' : '' }} {{ $activePage == 'Author' ? ' show' : '' }} {{ $activePage == 'Category' ? ' show' : '' }}" id="bookControl">
                    <ul class="navbar-expand-sm" style="list-style-type: none; padding-top: 10px ">
                        @can('viewAny' , \App\Ebook::class)
                            <li class="nav-item{{ $activePage == 'Book' ? ' active' : '' }} {{ $activePage == 'Page' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('books.index') }}">
                                    <span class="sidebar-mini"> BM </span>
                                    <span class="sidebar-normal"> {{ __('Book Management') }} </span>
                                </a>
                            </li>
                        @endcan
                        @can('viewAny' , \App\EbookCategory::class)
                            <li class="nav-item {{ $activePage == 'Category' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('categories.index') }}">
                                    <span class="sidebar-mini"> CM </span>
                                    <span class="sidebar-normal"> {{ __('Category Management') }} </span>
                                </a>
                            </li>
                        @endcan
                        @can('viewAny' , \App\Author::class)
                            <li class="nav-item {{ $activePage == 'Author' ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route('authors.index') }}">
                                    <span class="sidebar-mini"> AM </span>
                                    <span class="sidebar-normal"> {{ __('Author Management') }} </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endif
    </ul>
  </div>
</div>
