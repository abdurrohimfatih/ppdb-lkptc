<form class="search-form">
    <div class="input-group">
        <div class="input-group-text">
            <i data-feather="search"></i>
        </div>
        <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
    </div>
</form>
<ul class="navbar-nav">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            @if (\Illuminate\Support\Facades\Auth::user()->level == 1 &&
                $user->biodata != null &&
                $user->biodata->img_user != null)
                <img class="wd-30 ht-30 rounded-circle"
                    src="{{ asset('storage/upload/img/') . '/' . $user->biodata->img_user }}" alt="profile">
            @else
                <img class="wd-30 ht-30 rounded-circle" src="{{ asset('img/bg-login.jpg') }}" alt="profile">
            @endif
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
            <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                <div class="mb-3">
                    @if (\Illuminate\Support\Facades\Auth::user()->level == 1 &&
                        $user->biodata != null &&
                        $user->biodata->img_user != null)
                        <img class="wd-80 ht-80 rounded-circle"
                            src="{{ asset('storage/upload/img/') . '/' . $user->biodata->img_user }}" alt="profile">
                    @else
                        <img class="wd-80 ht-80 rounded-circle" src="{{ asset('img/bg-login.jpg') }}" alt="profile">
                    @endif
                </div>
                <div class="text-center">
                    <p class="tx-16 fw-bolder">{{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
                    <p class="tx-12 text-muted">{{ \Illuminate\Support\Facades\Auth::user()->email }}</p>
                </div>
            </div>
            <ul class="list-unstyled p-1">
                <li class="dropdown-item py-2">
                    <a href="{{ route('processLogout') }}" class="text-body ms-0">
                        <i class="me-2 icon-md" data-feather="log-out"></i>
                        <span>Log Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
</ul>
