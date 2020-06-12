<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use App\Menu;
use App\Restaurant;
use function GuzzleHttp\Promise\all;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $restaurants = Auth::user()->restaurants()->select('id')->get()->toArray();
        $menus = Menu::whereIn('restaurant_id', $restaurants)->get();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function new()
    {
        $restaurants = Auth::user()->restaurants;
        return view('admin.menus.store', compact('restaurants'));
    }

    /**
     * @param MenuRequest $request
     */
    public function store(MenuRequest $request)
    {
        $menuData = $request->all();

        $request->validated();

        $restaurants = Restaurant::find($menuData['restaurant_id']);
        $restaurants->menus()->create($menuData);

        flash('Menu criado com sucesso')->success();
        return redirect()->route('menu.index');
    }

    /**
     * @param Menu $menu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Menu $menu)
    {
        $restaurants = Auth::user()->restaurants;
        return view('admin.menus.edit', compact('menu', 'restaurants'));
    }

    /**
     * @param MenuRequest $request
     * @param $id
     */
    public function update(MenuRequest $request, $id)
    {
        $menuData = $request->all();

        $request->validated();

        $menu = Menu::find($id);
        $menu->restaurant()->associate($menuData['restaurant_id']);
        $menu->update($menuData);

        flash('Menu atualizado com sucesso')->success();
        return redirect()->route('menu.edit', ['menu' => $id]);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        flash('Menu removido com sucesso')->success();
        return redirect()->route('menu.index');
    }
}
