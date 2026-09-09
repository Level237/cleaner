@extends('layouts.store')

@section('content')
<!-- Section 1 : Hero -->
<div class="relative bg-[#1a2217] text-white pt-40 pb-28 overflow-hidden">
    <!-- Background Image with Editorial Dark Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('assets/maison.png') }}" alt="Maison Cleaner" class="w-full h-full object-cover opacity-30 object-center">
        <div class="absolute inset-0 bg-gradient-to-b from-[#1a2217]/90 via-[#1a2217]/75 to-[#1a2217]"></div>
    </div>
    
    <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-[#d4f977] text-xs font-bold uppercase tracking-[0.3em] mb-4">
            Maison de thés bien-être
        </p>
        <h1 class="text-4xl sm:text-6xl md:text-7xl font-serif font-light tracking-tight leading-[1.15] mb-8">
            Cleaner, la maison de thés bien-être
        </h1>
        <p class="max-w-3xl mx-auto text-base sm:text-lg md:text-xl text-gray-300 font-light leading-relaxed">
            Nous croyons qu'une tasse de thé peut transformer une journée. Alors nous avons bâti une maison entière autour de cette idée : des plantes précises, des bienfaits réels, et un plaisir gustatif qui donne envie de revenir.
        </p>
    </div>
</div>

<!-- Section 2 : Histoire (Editorial & Bespoke Layout) -->
<section class="py-28 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center">
            
            <!-- Gauche : Galerie / Visuel Éditorial -->
            <div class="lg:col-span-5 relative">
                <!-- Frame décoratif décalé -->
                <div class="absolute -inset-4 bg-[#f4fbf5] rounded-3xl -rotate-1 hidden sm:block"></div>

                <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-[#1a2217] aspect-[4/5] border border-gray-100">
                    <img src="{{ asset('assets/maison.png') }}" alt="Atelier & Maison Cleaner" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    
                    <!-- Caption éditorial discret en bas -->
                    <div class="absolute bottom-6 left-6 right-6 text-white text-xs font-light tracking-wider uppercase flex items-center justify-between border-t border-white/20 pt-4">
                        <span>Maison Cleaner</span>
                        <span class="text-[#d4f977] font-semibold">Cuvée Originale</span>
                    </div>
                </div>
            </div>

            <!-- Droite : Typography & Storytelling -->
            <div class="lg:col-span-7 space-y-8">
                <div>
                    <p class="text-[#3ab54a] text-xs font-bold uppercase tracking-[0.25em] mb-3">
                        Notre Histoire
                    </p>
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-serif text-[#1a2217] leading-tight font-normal">
                        Tout a commencé par une conviction
                    </h2>
                </div>

                <div class="space-y-6 text-gray-600 text-base lg:text-lg leading-relaxed font-light">
                    <p class="text-xl text-[#1a2217] font-serif italic border-l-2 border-[#1a2217] pl-5 py-1">
                        Cleaner est née d'un constat simple : les thés bien-être sont souvent soit décevants en goût, soit agréables mais sans vraie direction. Nous voulions réconcilier les deux.
                    </p>
                    <p>
                        Pendant des mois, nous avons parcouru des terroirs d'exception, rencontré des producteurs passionnés, goûté, ajusté et recommencé. Jusqu'à créer notre première recette emblématique : <strong class="text-[#1a2217] font-normal">Detoxia</strong>, un thé détox et énergisant qui est devenu le cœur de notre maison.
                    </p>
                    <p>
                        Aujourd'hui, Cleaner conçoit chaque thé comme une expérience globale : des plantes sélectionnées pour leur rôle précis, des bienfaits dosés avec soin, et surtout une saveur gourmande qui transforme votre rituel quotidien en un moment d'exception.
                    </p>
                </div>

                
            </div>

        </div>
    </div>
</section>

<!-- Section 3 : Bandeau Mission -->
<section class="bg-[#1a2217] py-20 text-white relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <p class="text-2xl sm:text-3xl lg:text-4xl font-serif font-light leading-relaxed text-[#f8f9f5]">
            « Rendre le bien-être quotidien accessible, à travers un rituel simple, naturel et délicieux. »
        </p>
    </div>
</section>

<!-- Section 4 : Nos 4 Engagements -->
<section class="py-28 bg-[#F8F9F5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-[#3ab54a] text-xs font-bold uppercase tracking-[0.25em] mb-3">Valeurs & Principes</p>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-serif text-[#1a2217]">Les 4 Engagements de la Maison</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
                <div>
                    <span class="text-xs font-bold text-gray-400 tracking-widest block mb-4">01</span>
                    <h3 class="text-lg font-serif font-bold text-[#1a2217] mb-3">Botanique & Pureté</h3>
                    <p class="text-sm text-gray-600 font-light leading-relaxed">
                        Une sélection rigoureuse d'ingrédients nobles, formulés sans aucun excès artificiel pour garantir un rituel sain, équilibré et bienfaisant.
                    </p>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
                <div>
                    <span class="text-xs font-bold text-gray-400 tracking-widest block mb-4">02</span>
                    <h3 class="text-lg font-serif font-bold text-[#1a2217] mb-3">Sourcing Tracé</h3>
                    <p class="text-sm text-gray-600 font-light leading-relaxed">
                        Nous choisissons nos terroirs avec soin et travaillons avec des producteurs passionnés, garantissant une traçabilité parfaite récolte après récolte.
                    </p>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
                <div>
                    <span class="text-xs font-bold text-gray-400 tracking-widest block mb-4">03</span>
                    <h3 class="text-lg font-serif font-bold text-[#1a2217] mb-3">Qualité Certifiée</h3>
                    <p class="text-sm text-gray-600 font-light leading-relaxed">
                        Notre production respecte scrupuleusement les normes internationales HACCP et ISO 22000, avec des contrôles rigoureux du sachet au consommateur.
                    </p>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
                <div>
                    <span class="text-xs font-bold text-gray-400 tracking-widest block mb-4">04</span>
                    <h3 class="text-lg font-serif font-bold text-[#1a2217] mb-3">Le Goût d'Abord</h3>
                    <p class="text-sm text-gray-600 font-light leading-relaxed">
                        Un thé bien-être efficace doit d'abord être savoureux pour devenir une habitude. La gourmandise et la fraîcheur guident chacune de nos recettes.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 5 : Sourcing en 4 étapes -->
<section class="py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-20">
            <p class="text-[#3ab54a] text-xs font-bold uppercase tracking-[0.25em] mb-3">Processus</p>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-serif text-[#1a2217]">Le Sourcing en 4 Étapes</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100">
                <span class="text-3xl font-serif text-[#3ab54a] block mb-4">01.</span>
                <h3 class="text-base font-bold text-[#1a2217] mb-2">Terroirs</h3>
                <p class="text-sm text-gray-600 font-light leading-relaxed">Identifier les régions et les producteurs partenaires reconnus pour la qualité exceptionnelle de leur sol et leur savoir-faire.</p>
            </div>

            <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100">
                <span class="text-3xl font-serif text-[#3ab54a] block mb-4">02.</span>
                <h3 class="text-base font-bold text-[#1a2217] mb-2">Récoltes</h3>
                <p class="text-sm text-gray-600 font-light leading-relaxed">Privilégier des cueillettes soignées effectuées à la saison optimale pour préserver la richesse aromatique des feuilles.</p>
            </div>

            <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100">
                <span class="text-3xl font-serif text-[#3ab54a] block mb-4">03.</span>
                <h3 class="text-base font-bold text-[#1a2217] mb-2">Dégustation</h3>
                <p class="text-sm text-gray-600 font-light leading-relaxed">Tester, analyser et comparer chaque lot de récolte avant de donner notre validation définitive.</p>
            </div>

            <div class="p-8 rounded-2xl bg-gray-50 border border-gray-100">
                <span class="text-3xl font-serif text-[#3ab54a] block mb-4">04.</span>
                <h3 class="text-base font-bold text-[#1a2217] mb-2">Assemblage</h3>
                <p class="text-sm text-gray-600 font-light leading-relaxed">Composer des assemblages harmonieux et parfaitement dosés entre vertus ciblées et plaisir gustatif.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 6 : Qualité & Standards -->
<section class="py-24 bg-[#1a2217] text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-[#d4f977] text-xs font-bold uppercase tracking-[0.25em] mb-4">Sécurité & Traçabilité</p>
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-serif font-normal mb-8">Une exigence de chaque instant</h2>
        <p class="text-gray-300 text-base sm:text-lg font-light leading-relaxed max-w-3xl mx-auto mb-12">
            Chaque lot est contrôlé, tracé et conditionné avec soin pour préserver la fraîcheur des feuilles et des aromates. Nos ateliers suivent les standards internationaux <strong class="text-white font-medium">HACCP</strong> et <strong class="text-white font-medium">ISO 22000</strong>, et chaque recette est validée après dégustation rigoureuse.
        </p>

        <!-- Badges Élégants -->
        
    </div>
</section>

<!-- Section 7 : Chiffres Clés -->
<section class="py-24 bg-white border-b border-gray-100">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center divide-x divide-gray-100">
            <div class="p-6">
                <span class="text-4xl sm:text-5xl font-serif text-[#1a2217] block mb-2">+50 000</span>
                <span class="text-xs text-gray-400 font-light uppercase tracking-wider">Tasses dégustées</span>
            </div>
            <div class="p-6">
                <span class="text-4xl sm:text-5xl font-serif text-[#3ab54a] block mb-2">100%</span>
                <span class="text-xs text-gray-400 font-light uppercase tracking-wider">Lots de récolte tracés</span>
            </div>
            <div class="p-6">
                <span class="text-4xl sm:text-5xl font-serif text-[#1a2217] block mb-2">ISO 22000</span>
                <span class="text-xs text-gray-400 font-light uppercase tracking-wider">Standard de sécurité</span>
            </div>
            <div class="p-6">
                <span class="text-4xl sm:text-5xl font-serif text-[#3ab54a] block mb-2">98%</span>
                <span class="text-xs text-gray-400 font-light uppercase tracking-wider">Clients satisfaits</span>
            </div>
        </div>
    </div>
</section>

<!-- Section 8 : CTA Final -->
<section class="py-28 bg-[#F8F9F5] text-center">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-serif text-[#1a2217]">
            Goûtez la philosophie de la maison
        </h2>
        <p class="text-gray-600 text-base sm:text-lg font-light leading-relaxed">
            Découvrez nos recettes exclusives créées pour accompagner votre rituel bien-être au quotidien.
        </p>
        <div>
            <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-10 py-5 bg-[#1a2217] text-white hover:bg-[#283324] font-medium text-base rounded-full transition-all shadow-lg shadow-black/10">
                Découvrir nos thés
            </a>
        </div>
    </div>
</section>
@endsection
