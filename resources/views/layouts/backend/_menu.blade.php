<div class="ui attached stackable menu">
    <div class="ui container">
        <a class="item">
            <i class="home icon"></i>
            {{ trans('admin.menu.dashboard') }}
        </a>
        <div class="ui simple dropdown item">
            <i class="user icon"></i>
            {{ trans('admin.menu.users') }}
            <i class="dropdown icon"></i>
            <div class="menu">
                <a class="item">
                    <i class="list icon"></i>
                    {{ trans('admin.actions.list') }}
                </a>
                <a class="item">
                    <i class="edit icon"></i>
                    {{ trans('admin.actions.create') }}
                </a>
            </div>
        </div>
        <div class="right item">
            <div class="ui input">
                <select id="search" placeholder="{{ trans('admin.menu.search') }}"></select>
            </div>
        </div>
    </div>
</div>
