  @auth

  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-danger navbar-danger border-bottom">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link bars-script-aside" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>

        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            {{App::getLocale()}}
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <li>
              @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              <a class="dropdown-item bg-dark" rel="alternate" hreflang="{{ $localeCode }}"
                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                @if ($properties['native'] == 'English')
                <img src="{{asset('uploads/img/united-kingdom.png')}}" width="30px" height="20x"> En
                @else
                <img src="{{asset('uploads/img/egypt.png')}}" width="30px" height="20x"> Ar
                @endif
              </a>
              @endforeach
            </li>

          </div>
        </div>

      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav mr-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-comments-o"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{asset('adminlte/img/user1-128x128.jpg')}}" alt="User Avatar"
                  class="img-size-50 ml-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    محمدرضا عطوان
                    <span class="float-left text-sm text-danger"><i class="fa fa-star"></i></span>
                  </h3>
                  <p class="text-sm">با من تماس بگیر لطفا...</p>
                  <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{asset('adminlte/img/user8-128x128.jpg')}}" alt="User Avatar"
                  class="img-size-50 img-circle ml-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    پیمان احمدی
                    <span class="float-left text-sm text-muted"><i class="fa fa-star"></i></span>
                  </h3>
                  <p class="text-sm">من پیامتو دریافت کردم</p>
                  <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{asset('adminlte/img/user3-128x128.jpg')}}" alt="User Avatar"
                  class="img-size-50 img-circle ml-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    سارا وکیلی
                    <span class="float-left text-sm text-warning"><i class="fa fa-star"></i></span>
                  </h3>
                  <p class="text-sm">پروژه اتون عالی بود مرسی واقعا</p>
                  <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i>4 ساعت قبل</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">مشاهده همه پیام‌ها</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-bell-o"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
            <span class="dropdown-item dropdown-header">15 نوتیفیکیشن</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fa fa-envelope ml-2"></i> 4 پیام جدید
              <span class="float-left text-muted text-sm">3 دقیقه</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fa fa-users ml-2"></i> 8 درخواست دوستی
              <span class="float-left text-muted text-sm">12 ساعت</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fa fa-file ml-2"></i> 3 گزارش جدید
              <span class="float-left text-muted text-sm">2 روز</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">مشاهده همه نوتیفیکیشن</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item bg-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary navbar-danger elevation-4">
      <!-- Brand Logo -->
      <a href="{{route('home', app()->getLocale())}}" class="brand-link text-center">
        <span class="brand-text font-weight-light text-white">{{config('app.name') ?? 'lara'}}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <div>
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              @if (Auth::user()->image == null)
              <i class="fa fa-user img-circle fa-2x px-1 text-light"></i>
              @else
              <img src="{{asset('uploads/users/' . Auth::user()->image)}}" class="img-circle elevation-2"
                alt="User Image">
              @endif
            </div>
            <div class="info">
              <li class="d-block text-white">{{ Auth::user()->name }}</li>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
              <li class="nav-item has-treeview">
                <a href="{{route('home')}}" class="nav-link text-white">
                  <i class="nav-icon fa fa-dashboard"></i>
                  <p>
                    {{__('لوحه التحكم')}}
                  </p>
                </a>
              </li>

              <li class="nav-item has-treeview">
                <a href="{{route('restaurants.index')}}" class="nav-link text-white">
                  <i class="nav-icon fa fa-cutlery"></i>
                  <p>
                    {{__('المطاعم')}}
                    <i class="right fa fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('restaurants.index')}}" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>{{ __('عرض المطاعم') }}</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('restaurants.category', app()->getLocale())}}" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>تصنيفات المطاعم</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="{{route('installment.index')}}" class="nav-link text-white">
                  <i class="nav-icon fa fa-money"></i>
                  <p>
                    {{__('العمليات المالية')}}
                  </p>
                </a>
              </li>

              <li class="nav-item has-treeview">
                <a href="{{route('orders.index', app()->getLocale())}}" class="nav-link text-white">
                  <i class="nav-icon fa fa-table"></i>
                  <p>
                    {{__('الطلبات')}}
                    <i class="fa fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('orders.index', app()->getLocale())}}" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>عرض الطلبات</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview">
                <a href="" class="nav-link text-white">
                  <i class="nav-icon fa fa-list-ul"></i>
                  <p>
                    المناطق
                    <i class="fa fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('city.index', app()->getLocale())}}" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>المدن</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('district.index', app()->getLocale())}}" class="nav-link">
                      <i class="fa fa-circle-o nav-icon"></i>
                      <p>المناطق</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="{{route('clients.index', app()->getLocale())}}" class="nav-link text-white">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                    العملاء
                  </p>
                </a>
              </li>

              <?php $orders = App\Models\Offer::where('from', '>', Carbon\Carbon::now())->get(); ?>
              <li class="nav-item">
                <a href="{{route('offers.index', app()->getLocale())}}" class="nav-link text-white">
                  <i class="nav-icon fa fa-tags"></i>
                  <p>
                    العروض
                    @if ($orders->count())
                    <span class="right badge badge-success">جدید</span>
                    @endif
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('payment.index', app()->getLocale())}}" class="nav-link text-white">
                  <i class="nav-icon fa fa-cc-visa"></i>
                  <p>
                    طرق الدفع
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('profile',[ auth()->user()->id, app()->getLocale()])}}" class="nav-link text-white">
                  <i class="nav-icon fa fa-envelope"></i>
                  <p>
                    البروفايل
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('profile.password', [auth()->user()->id, app()->getLocale()])}}"
                  class="nav-link text-white">
                  <i class="nav-icon fa fa-key"></i>
                  <p>
                    {{__('تغيير كلمه المرور')}}
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('clients.index', app()->getLocale())}}" class="nav-link text-white">
                  <i class="nav-icon fa fa-cogs"></i>
                  <p>
                    الأعدادات
                  </p>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
      </div>
      <!-- /.sidebar -->
    </aside>
    @endauth

    {{-- guest --}}
    @guest

    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          {{ config('app.name', 'Laravel') }}
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item text-dark">
              <a class="nav-link" href="{{ route('login', app()->getLocale()) }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item" class="background-color:red;">
              <a class="nav-link" href="{{ route('register', app()->getLocale()) }}">{{ __('Register') }}</a>
            </li>
            @endif
          </ul>

        </div>
      </div>
    </nav>

    <main class="py-4">
      <div>
        @include('auth.login')
        @yield('content')
      </div>
    </main>

    @endguest
