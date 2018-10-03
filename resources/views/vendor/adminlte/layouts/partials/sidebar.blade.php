<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if ( Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/uploads/avatars/{{ $user->avatar }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- <li class="header">{{ trans('adminlte_lang::message.header') }}</li> -->
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-home'></i> <span>{{ trans('adminlte_lang::message.dashboard') }}</span></a></li>
            @if($user->hasRole('manager'))
            <li><a href="{{ route('manageMembers') }}"><i class='fa fa-user-md'></i> <span>Manage Members</span></a></li>
           @endif 
<!--             <li><a href="#"><i class='fa fa-users'></i> <span>Access Item 1</span></a></li>
          
            <li><a href="#"><i class='fa fa-user-md'></i> <span>Access Item 2</span></a></li> -->
         
           <!-- <li><a href="{{ url('/company') }}"><i class='fa fa-user-md'></i> <span>Manage Companies</span></a></li> -->



        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
