<div class="sl-logo"><a href="{{route('dashboard')}}">DASHBOARD</a></div>
<div class="sl-sideleft">
  <div class="card">
    <div class="">
        <div class="">
            <div class="text-center">
                <img src="{{asset('/')}}admin/assets/img/img9.jpg" class="" alt="..." style="width:100px;border-radius:50%;height:100px;">
              </div>
            <h5>Name : {{ Auth::user()->name }}</h5>
        </div>
    </div>
  </div>

  <div class="sl-sideleft-menu">
      <a href="{{ route('blogs.index') }}" class="sl-menu-link {{ request()->is('dashboard/blogs*') ? 'active' : '' }}">
      <div class="sl-menu-item">
        <span class="menu-item-label">Blogs</span>
      </div>
    </a>

    <a href="{{ route('home') }}" class="sl-menu-link ">
      <div class="sl-menu-item">
        <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
        <span class="menu-item-label">Home</span>
      </div>
    </a>

  </div>

  <br>
</div>
