<?php

namespace Database\Seeders;

use App\Models\Drink;
use App\Models\Exercise;
use App\Models\ExerciseCategory;
use App\Models\ExerciseProgram;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\Mother;
use App\Models\User;
use App\Models\Weight;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class WorldSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // === MOTHERS ===

        // #1 ALICE
        $userAlice = User::create([
            'name' => 'Alice Gelsomini',
            'email' => 'alice@prova.it',
            'password' => bcrypt('password'),
        ]);


                $motherAlice = Mother::create([
                    'name' => $userAlice->name,
                    'user_id' => $userAlice->id,
                    'birthday' => '21 agosto 1986',
                    'height' => 171,
                    //'weight_id' =>
                    'is_pregnant' => false,
                    //'pregnancy_months' =>
                    'baby_months' => 2,
                ]);

                /*$weight = Weight::create([
                    'mother_id' => $motherAlice->id,
                    'weight' => 70,
                ]);

                $motherAlice->weight_id=$weight->id;
                $motherAlice->save();*/


        // #2 AMBRA
        $userAmbra = User::create([
            'name' => 'Ambra Fumero',
            'email' => 'ambra@prova.it',
            'password' => bcrypt('password'),
        ]);


                $motherAmbra = Mother::create([
                    'name' => $userAmbra->name,
                    'user_id' => $userAmbra->id,
                    'birthday' => '17 gennaio 1979',
                    'height' => 165,
                    //'weight_id' => ,
                    'is_pregnant' => false,
                    //'pregnancy_months' =>
                    'baby_months' => 4,
                ]);

               /* $weight = Weight::create([
                    'mother_id' => $motherAmbra->id,
                    'weight' => 64,
                ]);

                $motherAmbra->weight_id=$weight->id;
                $motherAmbra->save();*/


        // #3 BARBARA
        $userBarbara = User::create([
            'name' => 'Barbara Ronco',
            'email' => 'barbara@prova.it',
            'password' => bcrypt('password'),
        ]);

                $motherBarbara = Mother::create([
                    'name' => $userBarbara->name,
                    'user_id' => $userBarbara->id,
                    'birthday' => '8 settembre 1991',
                    'height' => 169,
                    //'weight_id' => ,
                    'is_pregnant' => true,
                    'pregnancy_months' => 7,
                    //'baby_months' =>
                ]);

               /* $weight = Weight::create([
                    'mother_id' => $motherBarbara->id,
                    'weight' => 69,
                ]);

                $motherBarbara->weight_id=$weight->id;
                $motherBarbara->save();*/


        // #4 BENEDETTA
        $userBenedetta = User::create([
            'name' => 'Benedetta Rossi',
            'email' => 'benedetta@prova.it',
            'password' => bcrypt('password'),
        ]);


                $motherBenedetta = Mother::create([
                    'name' => $userBenedetta->name,
                    'user_id' => $userBenedetta->id,
                    'birthday' => '3 giugno 1992',
                    'height' => 175,
                    //'weight_id' => ,
                    'is_pregnant' => true,
                    'pregnancy_months' => 5,
                    //'baby_months' =>
                ]);

              /*  $weight = Weight::create([
                    'mother_id' => $motherBenedetta->id,
                    'weight' => 69,
                ]);

                $motherBenedetta->weight_id=$weight->id;
                $motherBenedetta->save();*/


        // === FOOD CATEGORIES===
        $foodCatPrimi = FoodCategory::create([
            'name' => 'Primo piatto'
        ]);

        $foodCatSecondi = FoodCategory::create([
            'name' => 'Secondo piatto'
        ]);

        $foodCatFruit = FoodCategory::create([
            'name' => 'Frutta'
        ]);

        $foodCatVegetable = FoodCategory::create([
            'name' => 'Verdura'
        ]);

        $foodCatDessert = FoodCategory::create([
            'name' => 'Dolce'
        ]);


        // === FOOD ===

        $foodAlmond = Food::create([
            'name' => 'Mandorla',
            'food_category_id' => $foodCatFruit->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/almond.png',
            'cal_grams' => 593,
            //'cal_piece' =>
        ]);

        $foodApple = Food::create([
            'name' => 'Mela',
            'food_category_id' => $foodCatFruit->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/apple_red.png',
            //'cal_grams' => 52,
            'cal_piece' => 130,
        ]);

        $foodAvocado = Food::create([
            'name' => 'Avocado',
            'food_category_id' => $foodCatFruit->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/avocado.png',
            //'cal_grams' => 160,
            'cal_piece' => 480,
        ]);

        $foodBanana = Food::create([
            'name' => 'Banana',
            'food_category_id' => $foodCatFruit->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/banana.png',
            //'cal_grams' => 89,
            'cal_piece' => 71,
        ]);

        $foodOrange = Food::create([
            'name' => 'Arancia',
            'food_category_id' => $foodCatFruit->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/orange.png',
            //'cal_grams' => 47,
            'cal_piece' => 61,
        ]);


        // ==============


        $foodArtichoke = Food::create([
            'name' => 'Carciofo',
            'food_category_id' => $foodCatVegetable->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/artichoke.png',
            'cal_grams' => 47,
            //'cal_piece' =>
        ]);

        $foodCarrot = Food::create([
            'name' => 'Carota',
            'food_category_id' => $foodCatVegetable->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/carrot.png',
            'cal_grams' => 41,
            //'cal_piece' => ,
        ]);

        $foodLettuce = Food::create([
            'name' => 'Lattuga',
            'food_category_id' => $foodCatVegetable->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/lettuce.png',
            'cal_grams' => 15,
            //'cal_piece' =>
        ]);

        $foodTomato = Food::create([
            'name' => 'Pomodoro',
            'food_category_id' => $foodCatVegetable->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/tomato.png',
            'cal_grams' => 17,
            //'cal_piece' =>
        ]);

        $foodCucumber = Food::create([
            'name' => 'Zucchino',
            'food_category_id' => $foodCatVegetable->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/cucumber.png',
            'cal_grams' => 11,
            //'cal_piece' =>
        ]);


        // ==============


        $foodBacon = Food::create([
            'name' => 'Bacon',
            'food_category_id' => $foodCatSecondi->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/bacon.png',
            'cal_grams' => 468,
            //'cal_piece' => ,
        ]);

        $foodSteack = Food::create([
            'name' => 'Bistecca',
            'food_category_id' => $foodCatSecondi->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/steak_raw.png',
            'cal_grams' => 271,
            //'cal_piece' => ,
        ]);

        $foodChickenMeat = Food::create([
            'name' => 'Pollo',
            'food_category_id' => $foodCatSecondi->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/chicken_leg.png',
            'cal_grams' => 239,
            //'cal_piece' => ,
        ]);

        $foodCrab = Food::create([
            'name' => 'Granchio',
            'food_category_id' => $foodCatSecondi->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/crab.png',
            'cal_grams' => 83,
            //'cal_piece' => 28,
        ]);

        $foodFishFillet = Food::create([
            'name' => 'Filetto di pesce',
            'food_category_id' => $foodCatSecondi->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/fish_fillet.png',
            'cal_grams' => 232,
            //'cal_piece' => ,
        ]);


        // ==============

        $foodPasta = Food::create([
            'name' => 'Pasta',
            'food_category_id' => $foodCatPrimi->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/spaghetti.png',
            'cal_grams' => 131,
            //'cal_piece' => ,
        ]);

        $foodRice = Food::create([
            'name' => 'Riso',
            'food_category_id' => $foodCatPrimi->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/rice.png',
            'cal_grams' => 130,
            //'cal_piece' => ,
        ]);

        $foodPizza = Food::create([
            'name' => 'Pizza',
            'food_category_id' => $foodCatPrimi->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/pizza.png',
            //'cal_grams' => 266,
            'cal_piece' => 850,
        ]);

        $foodVegetableSoup = Food::create([
            'name' => 'Minestrone',
            'food_category_id' => $foodCatPrimi->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/soup.png',
            'cal_grams' => 34,
            //'cal_piece' => ,
        ]);


        // ==============

        $foodBananaSplit= Food::create([
            'name' => 'Banana Split',
            'food_category_id' => $foodCatDessert->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/banana_split.png',
            //'cal_grams' => 131,
            'cal_piece' => 1000,
        ]);

        $foodCheesecake = Food::create([
            'name' => 'Cheesecake',
            'food_category_id' => $foodCatDessert->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/cake_slice.png',
            //'cal_grams' => 321,
            'cal_piece' => 825,
        ]);

        $foodCookie = Food::create([
            'name' => 'Cookie',
            'food_category_id' => $foodCatDessert->id,
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/food/chocolate_chip_cookie.png',
            //'cal_grams' => 502,
            'cal_piece' => 35,
        ]);



        // === DRINKS ===

        $drinkRedWine = Drink::create([
            'name' => 'Vino Rosso',
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/drink/red_wine.png',
            'cal_ml' => 67,
        ]);

        $drinkWhiteWine = Drink::create([
            'name' => 'Vino Bianco',
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/drink/white_wine.png',
            'cal_ml' => 66,
        ]);

        $drinkMilk = Drink::create([
            'name' => 'Latte',
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/drink/glass_of_milk.png',
            'cal_ml' => 52,
        ]);

        $drinkCocaCola = Drink::create([
            'name' => 'Coca Cola',
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/drink/cola_drink.png',
            'cal_ml' => 42,
        ]);

        $drinkOrangeJuice = Drink::create([
            'name' => 'Spremuta di arancia',
            'url_image' => 'http://fitmoms.thenonsensefactory.it/images/drink/orange_juice.png',
            'cal_ml' => 47,
        ]);






        // === EXERCISES ===

        // CATEGORY #1: ABS P
        $exerciseCategoryAbsP = ExerciseCategory::create([
            'name' => 'Addominali',
            'description' => 'Allenamento addominale pre-parto',
            'is_pregnant' => true,
            'start_month' => 2,
            'end_month' => 4,
        ]);

                $exerciseAbsPlankP = Exercise::create([
                    'name' => 'Plank',
                    'description' => 'Posizione prona con i gomiti poggiati a terra che formano un angolo di 90 gradi col terreno. Mantenere la posizione.',
                    'exercise_seconds' => '120',
                    'exercise_category_id' => $exerciseCategoryAbsP->id,
                    'repetitions' => 4,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Cover_Plank.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Square_Plank.png',
                    //'url_video' =>
                ]);

                $exerciseAbsCrisscrossCrunchesP = Exercise::create([
                    'name' => 'Crisscross Crunches',
                    'description' => 'Posizione supina dove il gomito va incontro al ginocchio opposto, alternatamente',
                    'exercise_seconds' => '120',
                    'exercise_category_id' => $exerciseCategoryAbsP->id,
                    'repetitions' => 4,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Cover_CrisscrossCrunches.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Square_CrisscrossCrunches.png',
                    //'url_video' =>
                ]);

                $exerciseAbsLegFlipP = Exercise::create([
                    'name' => 'Leg Flip',
                    'description' => 'Posizione supina, gambe distese e leggermente rialzate da terra. Far oscillare le gambe in alto e in basso mantenendole distese',
                    'exercise_seconds' => '90',
                    'exercise_category_id' => $exerciseCategoryAbsP->id,
                    'repetitions' => 4,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Cover_Leg_Flip.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Square_Leg_Flip.png',
                    //'url_video' =>
                ]);

                $exerciseAbsToeTouchesP = Exercise::create([
                    'name' => 'Toe Touches',
                    'description' => 'Posizione supina, distese verso il soffitto e con le mani si va a toccare la punta dei piedi',
                    'exercise_seconds' => '120',
                    'exercise_category_id' => $exerciseCategoryAbsP->id,
                    'repetitions' => 4,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Cover_Toe_Touches.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Square_Toe_Touches.png',
                    //'url_video' =>
                ]);

                $exerciseAbsReverseCrunchP = Exercise::create([
                    'name' => 'Reverse Crunch',
                    'description' => 'Posizione supina con gambe alzate a 90 gradi. Mani dietro la testa, rialzare il petto e portarlo verso le ginocchia.',
                    'exercise_seconds' => '90',
                    'exercise_category_id' => $exerciseCategoryAbsP->id,
                    'repetitions' => 4,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Cover_Reverse_Crunch.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Square_Reverse_Crunch.png',
                    //'url_video' =>
                ]);


        // CATEGORY #2: ABS NP
        $exerciseCategoryAbsNP = ExerciseCategory::create([
            'name' => 'Addominali',
            'description' => 'Allenamento addominale post-parto',
            'is_pregnant' => false,
            'start_month' => 2,
            'end_month' => 4,
        ]);

                $exerciseAbsPlankNP = Exercise::create([
                    'name' => 'Plank',
                    'description' => 'Posizione prona con i gomiti poggiati a terra che formano un angolo di 90 gradi col terreno. Mantenere la posizione.',
                    'exercise_seconds' => '90',
                    'exercise_category_id' => $exerciseCategoryAbsNP->id,
                    'repetitions' => 3,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Cover_Plank.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Square_Plank.png',
                    //'url_video' =>
                ]);

                $exerciseAbsCrisscrossCrunchesNP = Exercise::create([
                    'name' => 'Crisscross Crunches',
                    'description' => 'Posizione supina dove il gomito va incontro al ginocchio opposto, alternatamente',
                    'exercise_seconds' => '120',
                    'exercise_category_id' => $exerciseCategoryAbsNP->id,
                    'repetitions' => 2,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Cover_CrisscrossCrunches.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Square_CrisscrossCrunches.png',
                    //'url_video' =>
                ]);

                $exerciseAbsLegFlipNP = Exercise::create([
                    'name' => 'Leg Flip',
                    'description' => 'Posizione supina, gambe distese e leggermente rialzate da terra. Far oscillare le gambe in alto e in basso mantenendole distese',
                    'exercise_seconds' => '90',
                    'exercise_category_id' => $exerciseCategoryAbsNP->id,
                    'repetitions' => 2,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Cover_Leg_Flip.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Square_Leg_Flip.png',
                    //'url_video' =>
                ]);

                $exerciseAbsToeTouchesNP = Exercise::create([
                    'name' => 'Toe Touches',
                    'description' => 'Posizione supina, distese verso il soffitto e con le mani si va a toccare la punta dei piedi',
                    'exercise_seconds' => '90',
                    'exercise_category_id' => $exerciseCategoryAbsNP->id,
                    'repetitions' => 2,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Cover_Toe_Touches.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Square_Toe_Touches.png',
                    //'url_video' =>
                ]);

                $exerciseAbsReverseCrunchNP = Exercise::create([
                    'name' => 'Reverse Crunch',
                    'description' => 'Posizione supina con gambe alzate a 90 gradi. Mani dietro la testa, rialzare il petto e portarlo verso le ginocchia.',
                    'exercise_seconds' => '90',
                    'exercise_category_id' => $exerciseCategoryAbsNP->id,
                    'repetitions' => 2,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Cover_Reverse_Crunch.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Abs/Square_Reverse_Crunch.png',
                    //'url_video' =>
                ]);



        // CATEGORY #3: STEP P
        $exerciseCategoryStepP = ExerciseCategory::create([
            'name' => 'Step',
            'description' => 'Allenamento gambe su step durante la gravidanza',
            'is_pregnant' => true,
            'start_month' => 4,
            'end_month' => 6,
        ]);

                $exerciseStepFrontKickP = Exercise::create([
                    'name' => 'Step Front Kick',
                    'description' => "In aggiunta allo step base, si distende la gamba in avanti",
                    'exercise_seconds' => '90',
                    'exercise_category_id' => $exerciseCategoryStepP->id,
                    'repetitions' => 2,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Cover_Step_Front_Kick.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Square_Step_Front_Kick.png',
                    //'url_video' =>

                ]);

                $exerciseStepBasicP = Exercise::create([
                    'name' => 'Step Base',
                    'description' => 'I piedi salgono e scendono in maniera alternata dallo step',
                    'exercise_seconds' => '90',
                    'exercise_category_id' => $exerciseCategoryStepP->id,
                    'repetitions' => 2,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Cover_Step_Basic.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Square_Step_Basic.png',
                    //'url_video' =>
                ]);

                $exerciseStepHamCurlP = Exercise::create([
                    'name' => "Step Ham Curl",
                    'description' => "In aggiunta allo step base, si piega la camba andando a colpire il gluteo con il tallone",
                    'exercise_seconds' => '90',
                    'exercise_category_id' => $exerciseCategoryStepP->id,
                    'repetitions' => 2,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Cover_Step_Ham_Curl.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Square_Step_Ham Curl.png',
                    //'url_video' =>
                ]);

                $exerciseStepKneeLiftP = Exercise::create([
                    'name' => "Step Knee Lift",
                    'description' => "In aggiunta allo step base, si alza il ginocchio piegato di 90 gradi",
                    'exercise_seconds' => '90',
                    'exercise_category_id' => $exerciseCategoryStepP->id,
                    'repetitions' => 2,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Cover_Step_Knee_Lift.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Square_Step_Knee_Lift.png',
                    //'url_video' =>
                ]);

                $exerciseStepLegBackP = Exercise::create([
                    'name' => "Step Leg Back",
                    'description' => "In aggiunta allo step base, si distende la gamba in avanti. Le braccia si distendono in avanti per tenere l'equilibrio",
                    'exercise_seconds' => '30',
                    'exercise_category_id' => $exerciseCategoryStepP->id,
                    'repetitions' => 2,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Cover_Step_Leg_Back.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Square_Step_Leg_Back.png',
                    //'url_video' =>
                ]);


        // CATEGORY #4: STEP NP
        $exerciseCategoryStepNP = ExerciseCategory::create([
            'name' => 'Step',
            'description' => 'Allenamento gambe su step durante la gravidanza',
            'is_pregnant' => false,
            'start_month' => 4,
            'end_month' => 6,
        ]);

                $exerciseStepFrontKickNP = Exercise::create([
                    'name' => 'Step Front Kick',
                    'description' => "In aggiunta allo step base, si distende la gamba in avanti",
                    'exercise_seconds' => '120',
                    'exercise_category_id' => $exerciseCategoryStepNP->id,
                    'repetitions' => 4,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Cover_Step_Front_Kick.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Square_Step_Front_Kick.png',
                    //'url_video' =>
                ]);

                $exerciseStepBasicNP = Exercise::create([
                    'name' => 'Step Base',
                    'description' => 'I piedi salgono e scendono in maniera alternata dallo step',
                    'exercise_seconds' => '180',
                    'exercise_category_id' => $exerciseCategoryStepNP->id,
                    'repetitions' => 3,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Cover_Step_Basic.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Square_Step_Basic.png',
                    //'url_video' =>
                ]);

                $exerciseStepHamCurlNP = Exercise::create([
                    'name' => "Step Ham Curl",
                    'description' => "In aggiunta allo step base, si piega la camba andando a colpire il gluteo con il tallone",
                    'exercise_seconds' => '180',
                    'exercise_category_id' => $exerciseCategoryStepP->id,
                    'repetitions' => 3,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Cover_Step_Ham_Curl.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Square_Step_Ham Curl.png',
                    //'url_video' =>

                ]);

                $exerciseStepKneeLiftNP = Exercise::create([
                    'name' => "Step Knee Lift",
                    'description' => "In aggiunta allo step base, si alza il ginocchio piegato di 90 gradi",
                    'exercise_seconds' => '180',
                    'exercise_category_id' => $exerciseCategoryStepP->id,
                    'repetitions' => 3,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Cover_Step_Knee_Lift.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Square_Step_Knee_Lift.png',
                    //'url_video' =>
                ]);

                $exerciseStepLegBackNP = Exercise::create([
                    'name' => "Step Leg Back",
                    'description' => "In aggiunta allo step base, si distende la gamba in avanti. Le braccia si distendono in avanti per tenere l'equilibrio",
                    'exercise_seconds' => '60',
                    'exercise_category_id' => $exerciseCategoryStepP->id,
                    'repetitions' => 2,
                    'url_cover_video' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Cover_Step_Leg_Back.png',
                    'url_cover_square' => 'http://fitmoms.thenonsensefactory.it/images/exercise/Step/Square_Step_Leg_Back.png',
                    //'url_video' =>
                ]);

                /*
        // CATEGORY #5: BACK P
        $exerciseCategoryBackP = ExerciseCategory::create([
            'name' => 'Schiena',
            'description' => 'Allenamento per la schiena',
            'is_pregnant' => true,
            'start_month' => 4,
            'end_month' => 6,
        ]);

        $exerciseBackCat = Exercise::create([
            'name' => 'Il gatto',
            'description' => "In posizione di quadrupedia, inarcare la schiena verso l’alto mentre si inspira fino al proprio massimo ed espirando inarcarla nell’altro senso fino al proprio massimo.",
            'exercise_seconds' => '90',
            'exercise_category_id' => $exerciseCategoryBackP->id,
            'repetitions' => 2,
        ]);

        $exerciseBackLateralTwist = Exercise::create([
            'name' => 'Torsioni laterali',
            'description' => "Distesi su un fianco si ruota il braccio superiore e la testa verso il lato opposto alle gambe e si resta in posizione respirando qualche secondo",
            'exercise_seconds' => '60',
            'exercise_category_id' => $exerciseCategoryBackP->id,
            'repetitions' => 2,
        ]);



        // CATEGORY #6: BACK NP
        $exerciseCategoryBackP = ExerciseCategory::create([
            'name' => 'Schiena',
            'description' => 'Allenamento per la schiena',
            'is_pregnant' => false,
            'start_month' => 4,
            'end_month' => 6,
        ]);

                $exerciseBackCat = Exercise::create([
                    'name' => 'Il gatto',
                    'description' => "In posizione di quadrupedia, inarcare la schiena verso l’alto mentre si inspira fino al proprio massimo ed espirando inarcarla nell’altro senso fino al proprio massimo.",
                    'exercise_seconds' => '120',
                    'exercise_category_id' => $exerciseCategoryBackP->id,
                    'repetitions' => 3,
                ]);

                $exerciseBackLateralTwist = Exercise::create([
                    'name' => 'Torsioni laterali',
                    'description' => "Distesi su un fianco si ruota il braccio superiore e la testa verso il lato opposto alle gambe e si resta in posizione respirando qualche secondo",
                    'exercise_seconds' => '90',
                    'exercise_category_id' => $exerciseCategoryBackP->id,
                    'repetitions' => 2,
                ]);

                */



        $exerciseProgram1 = ExerciseProgram::create([
            'name' => 'Gravidanza 1-3 mesi',
            'description' => 'Allenamento per donne in gravidanza, mesi 1-3',
            'is_pregnant' => true,
            'start_month' => 0,
            'end_month' => 3,
        ]);

        $exerciseProgram1->exercises()->attach($exerciseAbsPlankP);
        $exerciseProgram1->exercises()->attach($exerciseAbsCrisscrossCrunchesP);
        $exerciseProgram1->exercises()->attach($exerciseStepFrontKickP);
        $exerciseProgram1->exercises()->attach($exerciseStepBasicP);
        $exerciseProgram1->exercises()->attach($exerciseAbsReverseCrunchP);



        $exerciseProgram2 = ExerciseProgram::create([
            'name' => 'Gravidanza 4-6 mesi',
            'description' => 'Allenamento per donne in gravidanza, mesi 4-6',
            'is_pregnant' => true,
            'start_month' => 4,
            'end_month' => 6,
        ]);

        $exerciseProgram2->exercises()->attach($exerciseAbsLegFlipP);
        $exerciseProgram2->exercises()->attach($exerciseAbsToeTouchesP);
        $exerciseProgram2->exercises()->attach($exerciseStepKneeLiftP);
        $exerciseProgram2->exercises()->attach($exerciseStepLegBackP);
        $exerciseProgram2->exercises()->attach($exerciseStepHamCurlP);


        $exerciseProgram3 = ExerciseProgram::create([
            'name' => 'Post parto 1-3 mesi',
            'description' => 'Allenamento per neo mamme, mesi 1-3',
            'is_pregnant' => false,
            'start_month' => 0,
            'end_month' => 3,
        ]);

        $exerciseProgram3->exercises()->attach($exerciseAbsPlankNP);
        $exerciseProgram3->exercises()->attach($exerciseAbsCrisscrossCrunchesNP);
        $exerciseProgram3->exercises()->attach($exerciseStepFrontKickNP);
        $exerciseProgram3->exercises()->attach($exerciseStepBasicNP);
        $exerciseProgram3->exercises()->attach($exerciseAbsReverseCrunchNP);



        $exerciseProgram4= ExerciseProgram::create([
            'name' => 'Post parto 4-6 mesi',
            'description' => 'Allenamento per neo mamme, mesi 4-6',
            'is_pregnant' => false,
            'start_month' => 4,
            'end_month' => 6,
        ]);

        $exerciseProgram4->exercises()->attach($exerciseAbsLegFlipNP);
        $exerciseProgram4->exercises()->attach($exerciseAbsToeTouchesNP);
        $exerciseProgram4->exercises()->attach($exerciseStepKneeLiftNP);
        $exerciseProgram4->exercises()->attach($exerciseStepLegBackNP);
        $exerciseProgram4->exercises()->attach($exerciseStepHamCurlNP);

    }



}
