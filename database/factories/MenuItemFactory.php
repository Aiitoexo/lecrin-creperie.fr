<?php

namespace Database\Factories;

use App\Models\MenuItem;
use App\Models\SectionMenu;
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

        return [
            'name' => $this->faker->unique()->firstName,
            'img' => 'https://placeimg.com/480/480/nature',
            'alt_img' => $this->faker->text,
            'price' => rand(9, 25),
            'section' => $all_section[rand(0, ($count_section - 1))]->id,
            'menu' => rand(0, 1)
        ];
    }
}
