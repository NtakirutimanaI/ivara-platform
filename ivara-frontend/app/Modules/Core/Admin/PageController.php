<?php
namespace App\Modules\Core\Admin\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class PageController extends Controller
{
public function __construct() { $this->middleware(['auth']); }


public function index(): View
{
$pages = Page::with('menu')->latest()->paginate(15);
$menus = Menu::orderBy('title')->get();
return view('admin.pages.index', compact('pages','menus'));
}


public function store(StorePageRequest $request): RedirectResponse
{
$data = $request->validated();
$data['created_by'] = auth()->id();
Page::updateOrCreate(['menu_id' => $data['menu_id']], $data);
return back()->with('success','Page saved.');
}


public function destroy(Page $page): RedirectResponse
{
$page->delete();
return back()->with('success','Page deleted.');
}
}
