<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AgenticController extends Controller
{
    /**
     * Return Markdown response helper.
     */
    private function markdownResponse(string $content): Response
    {
        return response($content, 200, [
            'Content-Type' => 'text/markdown; charset=UTF-8',
            'X-Agentic-Format' => 'llms.txt-v1',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * Full aggregated markdown view for LLMs (llms-full.txt).
     */
    public function llmsFull()
    {
        $categories = Category::visible()->get();
        $products = Product::published()->with(['variants', 'primaryCategory'])->get();
        $collections = Collection::visible()->with('products')->get();
        $faqs = Faq::active()->orderBy('order', 'asc')->get();

        $md = [];
        $md[] = "# Cleaner — Maison de Thés Bien-être (Fichier Complet pour IA/Agents)\n";
        $md[] = "## À propos de Cleaner";
        $md[] = "Cleaner est une maison française dédiée aux thés et infusions d'exception 100% naturelles. Nos formules sont sans arômes artificiels ni conservateurs, pensées pour sublimer vos rituels détox, minceur, énergie et sommeil.\n";

        $md[] = "## Catalogue Produits (" . count($products) . " références)";
        foreach ($products as $p) {
            $md[] = "### " . $p->name;
            $md[] = "- **URL HTML** : " . url('/produits/' . $p->slug);
            $md[] = "- **URL Markdown** : " . url('/llms/produits/' . $p->slug);
            $md[] = "- **Prix** : " . number_format((float)$p->price, 2, '.', '') . " " . (session('currency') ?: 'EUR');
            $md[] = "- **Catégorie** : " . ($p->primaryCategory ? $p->primaryCategory->name : 'Général');
            $md[] = "- **Statut** : " . ($p->stock_status === 'in_stock' ? 'En stock' : 'Rupture');
            $md[] = "- **Description** : " . strip_tags($p->short_description ?: $p->description);
            if ($p->variants->count() > 0) {
                $md[] = "- **Déclinaisons** : " . implode(', ', $p->variants->pluck('name')->toArray());
            }
            $md[] = "";
        }

        $md[] = "## Collections Thématiques";
        foreach ($collections as $c) {
            $md[] = "### " . $c->name;
            $md[] = "- **Description** : " . strip_tags($c->description);
            $md[] = "- **Nombre de produits** : " . $c->products->count();
            $md[] = "";
        }

        $md[] = "## Foire Aux Questions (FAQ)";
        foreach ($faqs as $faq) {
            $md[] = "#### Q: " . $faq->question;
            $md[] = "R: " . $faq->answer . "\n";
        }

        $md[] = "## Support & Contact";
        $md[] = "- **Email** : contact@cleaner.fr";
        $md[] = "- **Horaire** : Du lundi au vendredi, 9h - 18h";
        $md[] = "- **WhatsApp Direct** : https://wa.me/237682826160";

        return $this->markdownResponse(implode("\n", $md));
    }

    /**
     * Home page markdown representation.
     */
    public function index()
    {
        $bestSellers = Product::published()->featured()->take(4)->get();
        if ($bestSellers->isEmpty()) {
            $bestSellers = Product::published()->take(4)->get();
        }

        $md = [];
        $md[] = "# Cleaner — Thés bien-être détox, minceur & énergie\n";
        $md[] = "Bienvenue chez Cleaner, votre maison de thés bien-être d'exception. Recettes 100% naturelles pour votre rituel quotidien.\n";
        
        $md[] = "## Produits Mis en Avant (Best-Sellers)";
        foreach ($bestSellers as $p) {
            $md[] = "- **[" . $p->name . "](" . url('/llms/produits/' . $p->slug) . ")** — " . number_format((float)$p->price, 2, '.', '') . " " . session('currency', 'EUR');
            $md[] = "  " . strip_tags($p->short_description ?: $p->description);
        }

        $md[] = "\n## Accès Rapide";
        $md[] = "- [Explorer toute la Boutique](/llms/boutique)";
        $md[] = "- [Découvrir nos Collections](/llms/collections)";
        $md[] = "- [En savoir plus sur Notre Maison](/llms/notre-maison)";
        $md[] = "- [Foire Aux Questions](/llms/faq)";

        return $this->markdownResponse(implode("\n", $md));
    }

    /**
     * Boutique catalogue markdown.
     */
    public function boutique(Request $request)
    {
        $query = Product::published()->with(['variants', 'primaryCategory']);
        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('primaryCategory', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $products = $query->get();
        $categories = Category::visible()->get();

        $md = [];
        $md[] = "# Catalogue Boutique Cleaner\n";
        $md[] = "Explorez notre gamme d'infusions détox, mélanges minceur et accessoires de préparation.\n";

        $md[] = "## Catégories Disponibles";
        foreach ($categories as $cat) {
            $md[] = "- [" . $cat->name . "](/llms/boutique?category=" . $cat->slug . ")";
        }

        $md[] = "\n## Liste des Produits (" . count($products) . " articles)";
        foreach ($products as $p) {
            $md[] = "### [" . $p->name . "](/llms/produits/" . $p->slug . ")";
            $md[] = "- **Prix** : " . number_format((float)$p->price, 2, '.', '') . " " . session('currency', 'EUR');
            $md[] = "- **Statut** : " . ($p->stock_status === 'in_stock' ? 'En Stock' : 'Rupture de Stock');
            $md[] = "- **Aperçu** : " . strip_tags($p->short_description ?: $p->description);
            $md[] = "";
        }

        return $this->markdownResponse(implode("\n", $md));
    }

    /**
     * Single product markdown details.
     */
    public function product($slug)
    {
        $product = Product::where('slug', $slug)
            ->published()
            ->with(['variants', 'reviews', 'primaryCategory'])
            ->firstOrFail();

        $md = [];
        $md[] = "# " . $product->name . "\n";
        $md[] = "**Catégorie** : " . ($product->primaryCategory ? $product->primaryCategory->name : 'Thé Bien-être');
        $md[] = "**Prix** : " . number_format((float)$product->price, 2, '.', '') . " " . session('currency', 'EUR');
        $md[] = "**Statut Stock** : " . ($product->stock_status === 'in_stock' ? 'En Stock (Disponible)' : 'Rupture de Stock');
        if ($product->sku) {
            $md[] = "**Référence SKU** : " . $product->sku;
        }

        $md[] = "\n## Description";
        $md[] = strip_tags($product->description ?: $product->short_description);

        if ($product->variants->count() > 0) {
            $md[] = "\n## Déclinaisons & Formats";
            foreach ($product->variants as $v) {
                $varPrice = $product->price + $v->price;
                $md[] = "- **" . $v->name . "** : " . number_format((float)$varPrice, 2, '.', '') . " " . session('currency', 'EUR') . ($v->sku ? " (SKU: " . $v->sku . ")" : "");
            }
        }

        if ($product->reviews->count() > 0) {
            $md[] = "\n## Avis Clients (" . $product->reviews->count() . " avis)";
            foreach ($product->reviews->take(5) as $rev) {
                $md[] = "- **" . $rev->reviewer_name . "** (" . $rev->rating . "/5) : " . $rev->comment;
            }
        }

        $md[] = "\n---\n[Commander ce produit (Lien HTML)](" . url('/produits/' . $product->slug) . ")";

        return $this->markdownResponse(implode("\n", $md));
    }

    /**
     * Collections list markdown.
     */
    public function collections()
    {
        $collections = Collection::visible()->with('products')->get();

        $md = [];
        $md[] = "# Collections Thématiques Cleaner\n";
        $md[] = "Des assemblages sur-mesure de thés pour accompagner chaque moment de votre journée.\n";

        foreach ($collections as $col) {
            $md[] = "## [" . $col->name . "](/llms/collections/" . $col->slug . ")";
            $md[] = strip_tags($col->description);
            $md[] = "- Contient " . $col->products->count() . " produit(s)\n";
        }

        return $this->markdownResponse(implode("\n", $md));
    }

    /**
     * Single collection markdown.
     */
    public function collection($slug)
    {
        $collection = Collection::where('slug', $slug)->visible()->with('products')->firstOrFail();

        $md = [];
        $md[] = "# Collection : " . $collection->name . "\n";
        $md[] = strip_tags($collection->description) . "\n";

        $md[] = "## Produits de la Collection (" . $collection->products->count() . ")";
        foreach ($collection->products as $p) {
            $md[] = "### [" . $p->name . "](/llms/produits/" . $p->slug . ")";
            $md[] = "- **Prix** : " . number_format((float)$p->price, 2, '.', '') . " " . session('currency', 'EUR');
            $md[] = "- " . strip_tags($p->short_description ?: $p->description);
            $md[] = "";
        }

        return $this->markdownResponse(implode("\n", $md));
    }

    /**
     * About / Notre Maison markdown.
     */
    public function about()
    {
        $md = [];
        $md[] = "# Notre Maison & Engagements Qualité — Cleaner\n";
        $md[] = "## Notre Histoire";
        $md[] = "Cleaner a été fondée avec une conviction simple : offrir des infusions et thés d'une pureté exceptionnelle pour le bien-être du corps et de l'esprit.\n";
        $md[] = "## Nos Engagements";
        $md[] = "- **100 % Naturel** : Feuilles entières, herbes et fruits séchés de première qualité sans aucun arôme synthétique.";
        $md[] = "- **Éco-responsabilité** : Emballages respectueux de l'environnement.";
        $md[] = "- **Transparence** : Ingrédients tracés et rigoureusement contrôlés.\n";

        return $this->markdownResponse(implode("\n", $md));
    }

    /**
     * FAQ markdown.
     */
    public function faq()
    {
        $faqs = Faq::active()->orderBy('order', 'asc')->get();

        $md = [];
        $md[] = "# Foire Aux Questions (FAQ) — Cleaner\n";
        $md[] = "Retrouvez toutes les réponses concernant la préparation de nos thés, les livraisons et les règlements.\n";

        foreach ($faqs as $faq) {
            $md[] = "### Q: " . $faq->question;
            $md[] = "R: " . $faq->answer . "\n";
        }

        return $this->markdownResponse(implode("\n", $md));
    }

    /**
     * Contact markdown.
     */
    public function contact()
    {
        $md = [];
        $md[] = "# Contactez-nous & Support Client — Cleaner\n";
        $md[] = "Notre équipe est disponible pour répondre à vos questions et vous conseiller.\n";
        $md[] = "- **Adresse E-mail** : contact@cleaner.fr";
        $md[] = "- **Horaires d'ouverture** : Du lundi au vendredi de 9h à 18h";
        $md[] = "- **Assistance WhatsApp en direct** : https://wa.me/33600000000";
        $md[] = "- **Formulaire en ligne** : " . url('/contact');

        return $this->markdownResponse(implode("\n", $md));
    }
}
