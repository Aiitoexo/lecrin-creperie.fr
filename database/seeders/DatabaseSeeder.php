<?php

namespace Database\Seeders;

use App\Models\ActiveExtra;
use App\Models\ActiveTypeCommand;
use App\Models\Allergen;
use App\Models\AllergenRecipe;
use App\Models\CategoryDrink;
use App\Models\CategoryIngredient;
use App\Models\Drink;
use App\Models\ExtraMenuItems;
use App\Models\Ingredient;
use App\Models\IngredientRecipe;
use App\Models\MenuItem;
use App\Models\Postal;
use App\Models\SectionMenu;
use App\Models\TvaRestaurant;
use App\Models\TypeItem;
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
            'Breizh Enfant',
            'Box Apéro',
            'Accompagnement',
            'Croc Dessert',
            'Boisson'
        ];

        $all_category = [
            'Galette',
            'Viande',
            'Sauce',
            'Fromage',
            'Legume',
            'Fruit',
            'Sauce dessert',
        ];

        for ($i = 0; $i < count($all_category); $i++) {
            CategoryIngredient::create([
                'category' => $all_category[$i],
            ]);
        }

        $all_type_items = [
            [
                'type_item' => 'Nourriture'
            ],
            [
                'type_item' => 'Boisson'
            ]
        ];

        foreach ($all_type_items as $type_item) {
            TypeItem::create($type_item);
        }

        $table_ingredient = [
            [
                'name' => 'Blinis de sarrasin',
                'category_ingredients_id' => 1
            ],
            [
                'name' => 'Blinis froment',
                'category_ingredients_id' => 1
            ],
            [
                'name' => 'Pancakes froment',
                'category_ingredients_id' => 1
            ],
            [
                'name' => 'Crêpe froment',
                'category_ingredients_id' => 1
            ],
            [
                'name' => 'Steak haché',
                'category_ingredients_id' => 2
            ],
            [
                'name' => 'Double steak haché',
                'category_ingredients_id' => 2
            ],
            [
                'name' => 'Poulet pané',
                'category_ingredients_id' => 2
            ],
            [
                'name' => 'Jambon blanc',
                'category_ingredients_id' => 2
            ],
            [
                'name' => 'Poitrine fumée',
                'category_ingredients_id' => 2
            ],
            [
                'name' => 'Saumon fumé',
                'category_ingredients_id' => 2
            ],
            [
                'name' => 'Oeuf',
                'category_ingredients_id' => 2
            ],
            [
                'name' => 'Cheddar',
                'category_ingredients_id' => 4
            ],
            [
                'name' => 'Raclette',
                'category_ingredients_id' => 4
            ],
            [
                'name' => 'Mozzarela',
                'category_ingredients_id' => 4
            ],
            [
                'name' => 'Fromage fouetté',
                'category_ingredients_id' => 4
            ],
            [
                'name' => 'Tomate',
                'category_ingredients_id' => 5
            ],
            [
                'name' => 'Salade',
                'category_ingredients_id' => 5
            ],
            [
                'name' => 'Oignon rouge',
                'category_ingredients_id' => 5
            ],
            [
                'name' => 'Poivron',
                'category_ingredients_id' => 5
            ],
            [
                'name' => 'Galette de pomme de terre',
                'category_ingredients_id' => 5
            ],
            [
                'name' => 'Champignon',
                'category_ingredients_id' => 5
            ],
            [
                'name' => 'Pommes cuire au beurre',
                'category_ingredients_id' => 6
            ],
            [
                'name' => 'Banane',
                'category_ingredients_id' => 6
            ],
            [
                'name' => 'Caramel au beurre salé',
                'category_ingredients_id' => 7
            ],
            [
                'name' => 'Chocolat maison',
                'category_ingredients_id' => 7
            ],
        ];

        $table_allergen = [
            'Gluten',
            'Crustacé',
            'Oeuf',
            'Poisson',
            'Arachide',
            'Soja',
            'Lait',
            'Fruit a coques',
            'Céleri',
            'Moutarde',
            'Graine de sésame',
            'Anhydride sulfureux et sulfites',
            'Lupin',
            'Mollusque'
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
            'name' => 'admin',
            'email' => 'admintest@gmail.com',
            'password' => '$2y$10$ziuWuOuA.cJsSz56DbrhkeLbPHIqFk6OPEQ.rX2n0kU7qdOT/Up/C'
        ]);

        for ($i = 0; $i < count($table_section); $i++) {
            SectionMenu::create([
                'name' => $table_section[$i],
                'img' => 'https://placeimg.com/480/480/nature'
            ]);
        }

        foreach ($table_ingredient as $ingredient) {
            Ingredient::create($ingredient);
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

        $all_category_drinks = [
            [
                'category' => 'Canette'
            ],
            [
                'category' => 'Canette Alcool'
            ],
            [
                'category' => 'Petite Bouteille'
            ],
            [
                'category' => 'Grande Bouteille'
            ],
            [
                'category' => 'Grande Bouteille Alcool'
            ]
        ];

        foreach ($all_category_drinks as $category) {
            CategoryDrink::create($category);
        }

        MenuItem::factory(50)->create();

        $all_menu = MenuItem::where('section_id', '!=', 7)->get();
        $all_ingredient = Ingredient::all();
        $count_ingredient = count($table_ingredient);

        for ($i = 0; $i < count($all_menu); $i++) {
            $rand_extra = rand(1, 3);

            if ($rand_extra === 2) {
                $data_extra['menu_id'] = $all_menu[$i]->id;
                $data_extra['price_extra_ht'] = rand(5, 20);
                $tva = TvaRestaurant::findOrFail($all_menu[$i]->tva_id);

                $data_extra['tva_id'] = $tva->id;
                $data_extra['price_extra_tva'] = ($data_extra['price_extra_ht'] * $tva->tva) / 100;
                $data_extra['price_extra_ttc'] = $data_extra['price_extra_ht'] + $data_extra['price_extra_tva'];

                ExtraMenuItems::create($data_extra);
            }

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

        $active_command = [
          'active_command_livraison' => true,
          'active_command_emporter' => true,
        ];

        ActiveTypeCommand::create($active_command);

        $active_extras = [
            'active_extras' => true
        ];

        ActiveExtra::create($active_extras);
    }
}
