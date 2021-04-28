<?php

namespace Database\Seeders;

use App\Models\AllergenRecipe;
use App\Models\IngredientRecipe;
use App\Models\MenuItem;
use App\Models\Postal;
use App\Models\SectionMenu;
use App\Models\Allergen;
use App\Models\Ingredient;
use App\Models\TvaRestaurant;
use App\Models\User;
use Illuminate\Database\Seeder;
use function count;
use function rand;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $table_section = [
            'Breizh Burger',
            'Breizh Wrap',
            'Dessert',
            'Boisson',
            'Box Apéro'
        ];

        $table_ingredient = [
            'Tomate',
            'Salade',
            'Oignon',
            'Boeuf',
            'Poulet',
            'Poisson',
            'Raclette',
            'Reblochon',
            'Emmental',
            'Cantal',
            'Bacon',
            'Rosti',
        ];

        $table_allergen = [
            'Arachide',
            'Lactose',
            'Oeuf',
            'Agrume',
            'Crustacé'
        ];

        $table_postal_code = [
          '33000',
          '33100',
          '33200',
          '33300',
          '33400',
          '33500',
          '33600',
          '33700',
        ];

        User::create([
            'name' => 'Aiito',
            'email' => 'aiitoexo@gmail.com',
            'password' => '$2y$10$RslRsj4sBizFEkJAVWS3h.H5XjciDRN3whHBR18wAZ5fwyV6p3/pu'
        ]);

        for ($i = 0; $i < count($table_section); $i++) {
            SectionMenu::create([
                'name' => $table_section[$i],
                'img' => 'https://placeimg.com/480/480/nature'
            ]);
        }

        for ($i = 0; $i < count($table_ingredient); $i++) {
            Ingredient::create([
                'name' => $table_ingredient[$i],
            ]);
        }

        for ($i = 0; $i < count($table_allergen); $i++) {
            Allergen::create([
                'name' => $table_allergen[$i],
                'img' => 'https://placeimg.com/480/480/nature'
            ]);
        }

        $all_tva = [
            [
                'name_tva' => 'Nourriture',
                'tva' => '10.00'
            ],
            [
                'name_tva' => 'Alcool',
                'tva' => '20'
            ],
            [
                'name_tva' => 'Soft',
                'tva' => '5.5'
            ],
        ];

        foreach ($all_tva as $tva) {
            TvaRestaurant::create($tva);
        }

        MenuItem::factory(50)->create();

        $all_menu = MenuItem::all();
        $all_ingredient = Ingredient::all();
        $count_ingredient = count($table_ingredient);

        for ($i = 0; $i < count($all_menu); $i++) {
            $rand = rand(3, 5);
            for ($j = 0; $j < $rand; $j++) {
                IngredientRecipe::create([
                    'menu_id' => $i + 1,
                    'ingredient_id' => $all_ingredient[$j]->id
                ]);
            }
        }

        $all_allergen = Allergen::all();
        $count_allergen = count($table_allergen);

        for ($i = 0; $i < count($all_menu); $i++) {
            $rand = rand(1, ($count_allergen - 1));
            for ($j = 0; $j < $rand; $j++) {
                AllergenRecipe::create([
                    'menu_id' => $i + 1,
                    'allergen_id' => $all_allergen[$j]->id
                ]);
            }
        }

        for ($i = 0; $i < count($table_postal_code); $i++) {
            Postal::create([
               'postal_code' => $table_postal_code[$i]
            ]);
        }

    }
}
