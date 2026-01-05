@php
    $userRoles = auth()->user()->getRoleNames();
    $menus = App\Models\Menu::with('children','roles')
        ->where('is_active', true)
        ->whereNull('parent_id')
        ->orderBy('order')
        ->get();
@endphp

<ul class="sidebar-menu">
    @foreach($menus as $menu)
        @if($menu->roles->pluck('name')->intersect($userRoles)->isNotEmpty() || auth()->user()->hasRole('admin'))
            <li class="menu-item">
                <a href="{{ route('page.show', $menu->slug) }}">
                    @if($menu->icon)<i class="{{ $menu->icon }}"></i>@endif
                    <span>{{ $menu->title }}</span>
                </a>

                @if($menu->children->count())
                    <ul class="submenu">
                        @foreach($menu->children as $child)
                            @if($child->roles->pluck('name')->intersect($userRoles)->isNotEmpty() || auth()->user()->hasRole('admin'))
                                <li>
                                    <a href="{{ route('page.show', $child->slug) }}">
                                        @if($child->icon)<i class="{{ $child->icon }}"></i>@endif
                                        {{ $child->title }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </li>
        @endif
    @endforeach
</ul>
