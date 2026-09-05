<?php

namespace Database\Seeders;

use App\Models\Category;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                "name" => "Thé minceur",
                "slug" => "the-minceur",
                "position" => 1,
                "is_visible" => true,
                "description" => "Notre sélection de thés minceur associe thé vert et plantes délicates pour accompagner vos objectifs bien-être. À savourer dans le cadre d'une alimentation équilibrée et d'un mode de vie sain.",
                "seo_title" => "Thé minceur | Votre allié bien-être au quotidien",
                "seo_description" => "Découvrez nos thés minceur aux saveurs délicates. Un rituel plaisir pour accompagner vos objectifs bien-être, à savourer chaud ou glacé.",
            ],
            [
                "name" => "Thé Détox",
                "slug" => "the-detox",
                "position" => 2,
                "is_visible" => true,
                "description" => "Des recettes détox équilibrées, mêlant thé vert, plantes et agrumes, pour un moment de légèreté et de plaisir à tout moment de la journée.",
                "seo_title" => "Thé détox | Infusions légèreté et plaisir",
                "seo_description" => "Craquez pour nos thés détox aux notes fraîches et végétales. Le compagnon idéal de vos pauses bien-être, en cure ou au quotidien.",
            ],
            [
                "name" => "Thé pour ventre plat",
                "slug" => "the-ventre-plat",
                "position" => 3,
                "is_visible" => true,
                "description" => "Des thés et infusions légers, élaborés avec des plantes traditionnellement appréciées pour la digestion et la sensation de légèreté après les repas.",
                "seo_title" => "Thé ventre plat | Infusions légèreté & digestion",
                "seo_description" => "Savourez nos thés ventre plat aux plantes digestives. Une pause légère et gourmande pour vous sentir bien après chaque repas.",
            ],
            [
                "name" => "Thé fraîcheur",
                "slug" => "the-fraicheur",
                "position" => 4,
                "is_visible" => true,
                "description" => "Thés et infusions à déguster froids : des recettes fruitées et désaltérantes, parfaites en thé glacé maison, été comme hiver.",
                "seo_title" => "Thé fraîcheur | Thés glacés & infusions froides",
                "seo_description" => "Découvrez nos thés fraîcheur à infuser à froid. Des recettes fruitées et désaltérantes pour des thés glacés maison savoureux.",
            ],
        ];

        foreach ($categories as $data) {
            Category::updateOrCreate(
                ["slug" => $data["slug"]],
                $data
            );
        }
    }
}
