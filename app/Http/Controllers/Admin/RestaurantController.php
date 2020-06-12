<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantRequest;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * @return Restaurant[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
//      $restaurants = Restaurant::where('owner_id', Auth::user()->id)->get();
        $restaurants = Auth::user()->restaurants;
        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function new()
    {
        return view('admin.restaurants.store');
    }

    /**
     * @param RestaurantRequest $request
     */
    public function store(RestaurantRequest $request)
    {
        $restaurantData = $request->all();

        $request->validated();

        $user = Auth::user();
        $user->restaurants()->create($restaurantData);
        
        flash('Restaurante criado com sucesso')->success();
        return redirect()->route('restaurant.index');
    }

    /**
     * @param Restaurant $restaurant
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Restaurant $restaurant)
    {
        return view('admin.restaurants.edit', compact('restaurant'));
    }

    /**
     * @param RestaurantRequest $request
     * @param $id
     */
    public function update(RestaurantRequest $request, $id)
    {
        $restaurantData = $request->all();

        $request->validated();

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update($restaurantData);

        flash('Restaurante atualizado com sucesso')->success();
        return redirect()->route('restaurant.edit', ['restaurant' => $id]);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        flash('Restaurante removido com sucesso')->success();
        return redirect()->route('restaurant.index');
    }
}
