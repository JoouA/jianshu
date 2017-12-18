<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    @if(Auth::guard('admin')->user()->can('system'))
    <li class="treeview active">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>系统管理</span>
            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="/admin/users"><i class="fa fa-user"></i> 用户管理</a></li>
            <li><a href="/admin/roles"><i class="fa fa-circle-o"></i> 角色管理</a></li>
            <li><a href="/admin/permissions"><i class="fa fa-circle-o"></i> 权限管理</a></li>
        </ul>
    </li>
    @endif
    @if(Auth::guard('admin')->user()->can('post'))
        <li>
            <a href="{{ route('admin.post.index') }}"><i class="fa fa-book"></i> <span>文章管理</span></a>
        </li>
    @endif
    @if(Auth::guard('admin')->user()->can('topic'))
    <li>
        <a href="/admin/topics">
            <i class="fa fa-dashboard"></i> <span>专题管理</span>
        </a>
    </li>
    @endif
    @if(Auth::guard('admin')->user()->can('notice'))
    <li>
        <a href="/admin/notices">
            <i class="fa fa-comments" aria-hidden="true"></i> <span>通知管理</span>
        </a>
    </li>
    @endif
    <li>
        <a href="/admin/fronts">
            <i class="fa fa-user" aria-hidden="true"></i><span>前台用户管理</span>
        </a>
    </li>
</ul>