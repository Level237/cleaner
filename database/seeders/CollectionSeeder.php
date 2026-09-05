<?php

namespace Database\Seeders;

use App\Models\Collection;

use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = [
            [
                "name" => "Best-sellers",
                "slug" => "best-sellers",
                "position" => 1,
                "is_visible" => true,
                "description" => "Les thés préférés de nos clients : minceur, détox, ventre plat et fraîcheur. Des valeurs sûres plébiscitées pour leurs saveurs et leur qualité.",
                "seo_title" => "Best-sellers | Nos thés les plus aimés",
                "seo_description" => "Découvrez les thés préférés de nos clients : minceur, détox, ventre plat et fraîcheur. Les valeurs sûres de la maison.",
            ],
            [
                "name" => "Coffrets & Idées Cadeaux",
                "slug" => "coffrets-cadeaux",
                "position" => 2,
                "is_visible" => true,
                "description" => "Des coffrets de thé élégants réunissant nos meilleures recettes. Le cadeau bien-être idéal pour toutes les occasions.",
                "seo_title" => "Coffret thé & idées cadeaux bien-être",
                "seo_description" => "Offrez un coffret de thé : sélection minceur, détox, fraîcheur. Le cadeau bien-être idéal pour toutes les occasions.",
            ],
            [
                "name" => "Sélection Bio",
                "slug" => "selection-bio",
                "position" => 3,
                "is_visible" => true,
                "description" => "Des thés et infusions issus de l'agriculture biologique. Des recettes naturelles, sans arômes artificiels, pour un plaisir authentique.",
                "seo_title" => "Thés & infusions bio | Sélection naturelle",
                "seo_description" => "Explorez notre sélection de thés et infusions bio. Des recettes naturelles, sans arômes artificiels, pour un plaisir authentique.",
            ],
            [
                "name" => "Rituel du Soir",
                "slug" => "rituel-du-soir",
                "position" => 4,
                "is_visible" => true,
                "description" => "Des thés et infusions doux, sans théine, pour accompagner vos soirées et votre moment de détente avant le coucher.",
                "seo_title" => "Thé du soir | Rituel détente & légèreté",
                "seo_description" => "Des thés et infusions doux, sans théine, pour accompagner vos soirées. Le rituel parfait avant le coucher.",
            ],
            [
                "name" => "Nouveautés",
                "slug" => "nouveautes",
                "position" => 5,
                "is_visible" => true,
                "description" => "Nos dernières créations : nouvelles recettes minceur, détox, ventre plat et fraîcheur. Le meilleur de la maison en avant-première.",
                "seo_title" => "Nouveautés thé | Les dernières créations",
                "seo_description" => "Découvrez nos dernières créations : nouvelles recettes minceur, détox, ventre plat et fraîcheur. En avant-première.",
            ],
        ];

        foreach ($collections as $data) {
            Collection::updateOrCreate(
                ["slug" => $data["slug"]],
                $data
            );
        }
    }
}
