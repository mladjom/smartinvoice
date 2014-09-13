<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{{ URL::to('') }}}#" class="navbar-brand">Smart<span>Invoice</span></a>
        </div>
        <nav class="collapse navbar-collapse" role="navigation">
            <ul class="nav navbar-nav navbar-right">
                <li{{ (Request::is('about') ? ' class="active"' : '') }}><a href="{{{ URL::to('about') }}}">{{{ Lang::get('general.about') }}}</a></li>
                <li{{ (Request::is('features') ? ' class="active"' : '') }}><a href="{{{ URL::to('features') }}}">{{{ Lang::get('general.features') }}}</a></li>
                <li{{ (Request::is('plan') ? ' class="active"' : '') }}><a href="{{{ URL::to('plans') }}}">{{{ Lang::get('general.plans') }}}</a></li>
                @if(Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li{{ (Request::is('dashboard') ? ' class="active"' : '') }}>
                            <a href="{{{ URL::to('dashboard') }}}">
                                <i class="fa fa-dashboard"></i> {{{ Lang::get('general.dashboard') }}}
                            </a>
                        </li> 
                        <li class="divider"></li>
                        <li>
                            <a href="{{{ URL::to('users/logout') }}}">
                                <i class="fa fa-power-off"></i> {{{ Lang::get('general.logout') }}}
                            </a>
                        </li>
                    </ul>
                </li>
                @else
                <a href="{{{ URL::to('users/login') }}}">
                    <button class="btn btn-warning navbar-btn"><i class="fa fa-user"></i> {{{ Lang::get('general.login') }}}</button>
                </a>
                @endif

            </ul>
        </nav>
    </div>
</nav>