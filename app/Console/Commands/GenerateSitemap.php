<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Génère le sitemap.xml du site';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(1.0))
            ->add(Url::create('/boutique')
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.9))
            ->add(Url::create('/collections')
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8))
            ->add(Url::create('/contact')
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.5));

        foreach (Category::where('is_visible', true)->get() as $category) {
            $sitemap->add(Url::create('/boutique?category=' . $category->slug)
                ->setLastModificationDate($category->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8));
        }

        foreach (Collection::where('is_visible', true)->get() as $collection) {
            $sitemap->add(Url::create('/collections/' . $collection->slug)
                ->setLastModificationDate($collection->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.7));
        }

        foreach (Product::published()->get() as $product) {
            $sitemap->add(Url::create('/produits/' . $product->slug)
                ->setLastModificationDate($product->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap généré avec succès.');

        return self::SUCCESS;
    }
}
