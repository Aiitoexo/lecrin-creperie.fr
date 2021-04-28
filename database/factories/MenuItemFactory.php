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

        return [
            'name' => $this->faker->unique()->firstName,
            'img' => 'https://placeimg.com/480/480/nature',
            'alt_img' => $this->faker->text,
            'price_ht' => $price_ht,
            'tva_id' => $tva->id,
            'total_tva' => $total_tva,
            'price_ttc' => $price_ttc,
            'section_id' => $all_section[rand(0, ($count_section - 1))]->id,
            'menu' => rand(0, 1)
        ];
    }
}
