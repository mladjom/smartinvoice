<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{{ URL::to('') }}}#" class="navbar-brand"><i class="fa fa-sheqel"></i> Smart<span>Invoice</span></a>
        </div>
        <nav class="collapse navbar-collapse" role="navigation">
            <ul class="nav navbar-nav navbar-right">
                <li{{ (Request::is('dashboard') ? ' class="active"' : '') }}>
                    <a href="{{{ URL::to('dashboard') }}}">
                        <i class="fa fa-dashboard"></i> {{{ Lang::get('general.dashboard') }}}
                    </a>
                </li> 
                <li{{ (Request::is('billers*') ? ' class="active"' : '') }}>
                    <a href="{{{ URL::to('billers') }}}">
                        <i class="fa fa-user"></i> {{{ Lang::get('general.billers') }}}
                    </a>
                </li> 
                <li{{ (Request::is('clients*') ? ' class="active"' : '') }}><a href="{{{ URL::to('clients') }}}"><i class="fa fa-users"></i> {{{ Lang::get('general.clients') }}}</a></li>
<!--                <li{{ (Request::is('quotes*') ? ' class="active"' : '') }}><a href="{{{ URL::to('quotes') }}}"><i class="fa fa-file-text-o"></i> {{{ Lang::get('general.quotes') }}}</a></li>-->
                <li{{ (Request::is('invoices*') ? ' class="active"' : '') }}><a href="{{{ URL::to('invoices') }}}"><i class="fa fa-file-text"></i> {{{ Lang::get('general.invoices') }}}</a></li>
<!--                <li{{ (Request::is('reports*') ? ' class="active"' : '') }}>
                    <a href="{{{ URL::to('reports') }}}">
                        <i class="fa fa-bar-chart-o"></i> {{{ Lang::get('general.reports') }}}
                    </a>
                </li>-->
                @if(Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{{ Lang::get('general.hello') }}} {{{ Auth::user()->username }}} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
<!--                         <li{{ (Request::is('custom_fields*') ? ' class="active"' : '') }}>
                            <a href="{{{ URL::to('custom_fields') }}}">
                                <i class="fa fa-plug"></i> {{{ Lang::get('general.custom_fields') }}}
                            </a>
                        </li> -->
                         <li{{ (Request::is('account*') ? ' class="active"' : '') }}>
                            <a href="{{{ URL::to('account') }}}">
                                 {{{ Lang::get('general.account') }}}
                            </a>
                        </li>                       
                        <li{{ (Request::is('tax_rates*') ? ' class="active"' : '') }}>
                            <a href="{{{ URL::to('tax_rates') }}}">
                                 {{{ Lang::get('general.tax_rates') }}}
                            </a>
                        </li> 
                        <li{{ (Request::is('settings*') ? ' class="active"' : '') }}>
                            <a href="{{{ URL::to('settings') }}}">
                                 {{{ Lang::get('general.settings') }}}
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
                    <button class="btn btn-secondary navbar-btn"><i class="fa fa-user"></i> {{{ Lang::get('general.login') }}}</button>
                </a>
                @endif

            </ul>
        </nav>
    </div>
</nav>