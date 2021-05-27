<?php

namespace Database\Factories;

use App\Models\MenuItem;
use App\Models\SectionMenu;
use App\Models\TvaRestaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use function rand;

class MenuItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MenuItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $all_section = SectionMenu::all();

        $count_section = count($all_section);

        $price_ht = rand(9, 25);
        $rand = rand(1, TvaRestaurant::all()->count());
        $tva = TvaRestaurant::findOrFail($rand);
        $total_tva = (($price_ht * $tva->tva) / 100);
        $price_ttc = $price_ht + $total_tva;

        $drink = rand(1, 10);

        if ($drink >= 8) {
            $type_item = 2;
        } else {
            $type_item = 1;
        }

        if ($type_item === 2) {
            $cat_drink_id = rand(1, 5);
            $capacity = 'Yolo';
            $section = 7;
        } else {
            $cat_drink_id = null;
            $capacity = null;
            $section = rand(1, 6);
        }

        return [
            'type_items_id' => $type_item,
            'name' => $this->faker->unique()->firstName,
            'img' => 'https://placeimg.com/480/480/nature',
            'alt_img' => $this->faker->text,
            'category_drinks_id' => $cat_drink_id,
            'capacity_drink' => $capacity,
            'price_ttc' => $price_ttc,
            'tva_id' => $tva->id,
            'total_tva' => $total_tva,
            'price_ht' => $price_ht,
            'section_id' => $section,
            'menu' => rand(0, 1)
        ];
    }
}
