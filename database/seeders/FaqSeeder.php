<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Comment consommer les thés bien-être Cleaner ?',
                'answer' => 'Nous recommandons d\'infuser 1 cuillère à café de mélange dans une eau à 85-90°C pendant 5 à 7 minutes. Pour de meilleurs résultats détox et énergie, consommez 1 à 2 tasses par jour, de préférence le matin à jeun et l\'après-midi.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Vos ingrédients sont-ils 100 % naturels ?',
                'answer' => 'Oui, sans aucun compromis. Tous nos mélanges sont formulés à partir de feuilles de thé, d\'herbes, d\'épices et de fruits scrupuleusement sélectionnés. Sans arômes artificiels ni conservateurs.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Quels sont les délais et tarifs de livraison ?',
                'answer' => 'Les commandes sont expédiées sous 24h à 48h ouvrées. La livraison standard est offerte à partir de 50 € d\'achat. Pour toute commande inférieure, un tarif fixe de 5 € s\'applique.',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Comment suivre ma commande ?',
                'answer' => 'Dès l\'expédition de votre colis, vous recevez un e-mail contenant votre numéro de suivi en temps réel. Vous pouvez également nous contacter directement sur WhatsApp pour une assistance rapide.',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'question' => 'Quels moyens de paiement acceptez-vous ?',
                'answer' => 'Nous acceptons les paiements sécurisés par Carte Bancaire (Visa, MasterCard, Amex) ainsi que la livraison contre remboursement selon votre secteur.',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faqData) {
            Faq::updateOrCreate(
                ['question' => $faqData['question']],
                $faqData
            );
        }
    }
}
