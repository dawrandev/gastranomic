<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RestaurantMenuItem;
use App\Services\RestaurantMenuItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RestaurantMenuItemController extends Controller
{
    public function __construct(
        protected RestaurantMenuItemService $service
    ) {}

    public function index(Request $request, Restaurant $restaurant)
    {
        Gate::authorize('viewAny', RestaurantMenuItem::class);

        if (auth()->user()->id !== $restaurant->user_id && !auth()->user()->isSuperAdmin()) {
            abort(403, 'Bu restoran menyusini ko\'rishga ruxsatingiz yo\'q.');
        }

        $search = $request->input('search');
        $restaurantMenuItems = $this->service->getRestaurantMenuItems($restaurant->id, $search, 15);

        $availableMenuItems = $this->service->getAvailableMenuItems(
            auth()->user()->brand_id,
            $restaurant->id
        );

        return view('pages.restaurant-menu-items.index', compact('restaurant', 'restaurantMenuItems', 'availableMenuItems'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create', RestaurantMenuItem::class);

        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'menu_item_id' => 'required|exists:menu_items,id',
            'price' => 'required|numeric|min:0',
            'is_available' => 'nullable|boolean',
        ]);

        $validated['is_available'] = $request->has('is_available') ? (bool)$request->input('is_available') : true;

        try {
            $this->service->createRestaurantMenuItem($validated);
            return redirect()->route('restaurant-menu-items.index', $validated['restaurant_id'])
                ->with('success', 'Taom restoran menyusiga muvaffaqiyatli qo\'shildi!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Xatolik yuz berdi: ' . $e->getMessage());
        }
    }

    public function edit(RestaurantMenuItem $restaurantMenuItem)
    {
        Gate::authorize('update', $restaurantMenuItem);

        $menuItemName = $restaurantMenuItem->menuItem->getTranslation();

        return response()->json([
            'id' => $restaurantMenuItem->id,
            'restaurant_id' => $restaurantMenuItem->restaurant_id,
            'menu_item_id' => $restaurantMenuItem->menu_item_id,
            'menu_item_name' => $menuItemName ? $menuItemName->name : 'N/A',
            'price' => $restaurantMenuItem->price,
            'is_available' => $restaurantMenuItem->is_available,
        ]);
    }

    public function update(Request $request, RestaurantMenuItem $restaurantMenuItem)
    {
        Gate::authorize('update', $restaurantMenuItem);

        $validated = $request->validate([
            'price' => 'required|numeric|min:0',
            'is_available' => 'nullable|boolean',
        ]);

        $validated['is_available'] = $request->has('is_available') ? (bool)$request->input('is_available') : false;

        try {
            $this->service->updateRestaurantMenuItem($restaurantMenuItem, $validated);
            return redirect()->route('restaurant-menu-items.index', $restaurantMenuItem->restaurant_id)
                ->with('success', 'Restoran taomi muvaffaqiyatli yangilandi!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Xatolik yuz berdi: ' . $e->getMessage());
        }
    }

    public function destroy(RestaurantMenuItem $restaurantMenuItem)
    {
        Gate::authorize('delete', $restaurantMenuItem);

        try {
            $restaurantId = $restaurantMenuItem->restaurant_id;
            $this->service->deleteRestaurantMenuItem($restaurantMenuItem);
            return redirect()->route('restaurant-menu-items.index', $restaurantId)
                ->with('success', 'Taom restoran menyusidan muvaffaqiyatli o\'chirildi!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Xatolik yuz berdi: ' . $e->getMessage());
        }
    }
}
