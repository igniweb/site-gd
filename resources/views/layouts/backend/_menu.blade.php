<div class="ui attached stackable menu">
    <div class="ui container">
        <a class="item">
            <i class="home icon"></i>
            {{ trans('admin.menu.dashboard') }}
        </a>
        <div class="ui simple dropdown item">
            <i class="users icon"></i>
            {{ trans('admin.menu.users') }}
            <i class="dropdown icon"></i>
            <div class="menu">
                <a href="{{ route('admin.user.index') }}" class="item">
                    <i class="list icon"></i>
                    {{ trans('admin.actions.list') }}
                </a>
                <a href="{{ route('admin.user.create') }}" class="item">
                    <i class="edit icon"></i>
                    {{ trans('admin.actions.create') }}
                </a>
            </div>
        </div>
        <div class="right item">
            <div class="ui category search">
                <div class="ui icon input">
                    <input class="prompt" type="text" placeholder="{{ trans('admin.menu.search') }}">
                    <i class="search icon"></i>
                </div>
                <div class="results"></div>
            </div>
        </div>
    </div>
</div>
