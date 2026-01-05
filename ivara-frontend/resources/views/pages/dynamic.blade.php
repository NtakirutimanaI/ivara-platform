
<div class="dynamic-page-container p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">{{ $menu->title }}</h1>

    <div class="page-content">
        {!! $page->content ?? '<p>No content available for this page yet.</p>' !!}
    </div>
</div>
<style>
.sidebar-menu { list-style: none; padding: 0; }
.sidebar-menu .menu-item > a { display: flex; align-items: center; padding: 0.75rem 1rem; font-weight: 500; color: #374151; text-decoration: none; }
.sidebar-menu .menu-item > a:hover { background-color: #f3f4f6; border-radius: 0.5rem; }
.sidebar-menu .submenu { list-style: none; padding-left: 1rem; margin-top: 0.25rem; }
.submenu li a { display: block; padding: 0.5rem 1rem; color: #4b5563; text-decoration: none; }
.submenu li a:hover { background-color: #e5e7eb; border-radius: 0.25rem; }

</style>