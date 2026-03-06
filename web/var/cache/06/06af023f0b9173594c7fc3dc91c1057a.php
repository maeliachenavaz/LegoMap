<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* store_detail.html.twig */
class __TwigTemplate_c38933fb96fcdfb57c4d7ebc287d751b extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Détails du store - ";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 5), "html", null, true);
        yield " - LEGO Map</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <script src=\"https://cdn.tailwindcss.com\"></script>
    <link rel=\"stylesheet\" href=\"https://unpkg.com/leaflet/dist/leaflet.css\" />
    <script src=\"https://unpkg.com/leaflet/dist/leaflet.js\"></script>
    <style>
        *:focus-visible {
            outline: 3px solid #1a365d !important;
            outline-offset: 2px;
        }
        #map { z-index: 1; }
    </style>
</head>
<body class=\"bg-yellow-400 min-h-screen font-sans text-gray-900\">

<a href=\"#main-content\" class=\"sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-white text-red-800 p-4 z-50 rounded-lg shadow-lg font-bold\">
    Aller au contenu principal
</a>

<header class=\"bg-red-700 text-white p-4 flex justify-between items-center shadow-lg\" role=\"banner\">
    <h1 class=\"text-2xl font-bold\">LEGO Map</h1>
    <nav aria-label=\"Navigation de retour\">
        <a href=\"/\"
           class=\"bg-white text-red-800 font-bold px-4 py-2 rounded-lg hover:bg-gray-100 transition border-2 border-transparent\">
            Retour <span class=\"sr-only\">à la liste des stores</span>
        </a>
    </nav>
</header>

<main id=\"main-content\" class=\"p-8 max-w-4xl mx-auto\" role=\"main\">
    <article class=\"bg-white rounded-2xl shadow-2xl overflow-hidden border-4 border-red-800\">

        <div class=\"w-full h-64 overflow-hidden bg-gray-200\">
            ";
        // line 38
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 38)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 39
            yield "                <img src=\"";
            yield (((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 39), 0, 5) == "data:")) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 39), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(("data:image/jpeg;base64," . CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 39)), "html", null, true)));
            yield "\"
                     alt=\"Photographie de la boutique ";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 40), "html", null, true);
            yield "\"
                     class=\"w-full h-full object-cover\">
            ";
        } else {
            // line 43
            yield "                <div class=\"w-full h-full flex items-center justify-center text-gray-500 italic\" aria-hidden=\"true\">
                    Aucune photographie disponible pour ce store
                </div>
            ";
        }
        // line 47
        yield "        </div>

        <div class=\"p-6 space-y-6\">
            <header>
                <h2 class=\"text-3xl font-black text-red-800 mb-2\">";
        // line 51
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 51), "html", null, true);
        yield "</h2>
                <p class=\"text-lg text-gray-700 leading-relaxed\">";
        // line 52
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "description", [], "any", false, false, false, 52), "html", null, true);
        yield "</p>
            </header>

            <hr class=\"border-gray-200\" aria-hidden=\"true\">

            <dl class=\"grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-3\">
                <div class=\"flex flex-col border-b border-gray-100 pb-2\">
                    <dt class=\"text-sm font-bold text-gray-500 uppercase tracking-wide\">Date d'ouverture</dt>
                    <dd class=\"text-gray-900 font-medium\">";
        // line 60
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "date", [], "any", false, false, false, 60), "html", null, true);
        yield "</dd>
                </div>
                <div class=\"flex flex-col border-b border-gray-100 pb-2\">
                    <dt class=\"text-sm font-bold text-gray-500 uppercase tracking-wide\">Note des clients</dt>
                    <dd class=\"text-gray-900 font-bold flex items-center gap-1\">
                        <span class=\"text-gray-900 font-medium\">";
        // line 65
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "avis", [], "any", false, false, false, 65), "html", null, true);
        yield " / 5</span>
                        <span class=\"text-amber-600 text-2xl\" aria-hidden=\"true\">★</span>
                        <span class=\"sr-only\">étoiles sur 5</span>
                    </dd>
                </div>
                <div class=\"flex flex-col border-b border-gray-100 pb-2\">
                    <dt class=\"text-sm font-bold text-gray-500 uppercase tracking-wide\">Contact</dt>
                    <dd class=\"text-gray-900 font-medium\">";
        // line 72
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "contactNom", [], "any", false, false, false, 72), "html", null, true);
        yield "</dd>
                    <dd><a href=\"mailto:";
        // line 73
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "contactEmail", [], "any", false, false, false, 73), "html", null, true);
        yield "\" class=\"text-blue-700 hover:underline font-medium\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "contactEmail", [], "any", false, false, false, 73), "html", null, true);
        yield "</a></dd>
                </div>
            </dl>

            <section aria-labelledby=\"map-title\">
                <h3 id=\"map-title\" class=\"sr-only\">Localisation sur la carte</h3>
                <div id=\"map\"
                     class=\"w-full h-80 rounded-xl shadow-inner border-2 border-gray-200\"
                     role=\"application\"
                     aria-label=\"Carte interactive affichant l'emplacement du store ";
        // line 82
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 82), "html", null, true);
        yield "\">
                </div>
                <p class=\"text-xs text-gray-500 mt-2 italic\">
                    Utilisez les touches fléchées pour déplacer la carte et les touches + et - pour zoomer.
                </p>
            </section>

            <footer class=\"flex flex-wrap gap-4 mt-8 pt-6 border-t-2 border-gray-100\">
                <a href=\"/store/";
        // line 90
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "id", [], "any", false, false, false, 90), "html", null, true);
        yield "/edit\"
                   class=\"bg-blue-700 text-white font-bold px-6 py-3 rounded-xl hover:bg-blue-800 transition shadow-md focus:ring-4 focus:ring-blue-300\">
                    Modifier les informations
                </a>

                <form method=\"POST\" action=\"/store/";
        // line 95
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "id", [], "any", false, false, false, 95), "html", null, true);
        yield "/delete\"
                      onsubmit=\"return confirm('Êtes-vous sûr de vouloir supprimer définitivement le store ";
        // line 96
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 96), "html", null, true);
        yield " ?');\">
                    <input type=\"hidden\" name=\"csrf_token\" value=\"";
        // line 97
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["csrf_token"] ?? null), "html", null, true);
        yield "\">
                    <button type=\"submit\"
                            class=\"bg-red-800 text-white font-bold px-6 py-3 rounded-xl hover:bg-red-900 transition shadow-md focus:ring-4 focus:ring-red-300\">
                        Supprimer le store
                    </button>
                </form>

                <a href=\"/store/";
        // line 104
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "id", [], "any", false, false, false, 104), "html", null, true);
        yield "/pdf\"
                   class=\"bg-gray-800 text-white font-bold px-6 py-3 rounded-xl hover:bg-black transition shadow-md focus:ring-4 focus:ring-gray-400 flex items-center gap-2\">
                    Générer la fiche PDF
                </a>
            </footer>
        </div>
    </article>
</main>

<script>
    const lat = ";
        // line 114
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "latitude", [], "any", false, false, false, 114), "html", null, true);
        yield ";
    const lon = ";
        // line 115
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "longitude", [], "any", false, false, false, 115), "html", null, true);
        yield ";

    const map = L.map('map', {
        scrollWheelZoom: false
    }).setView([lat, lon], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href=\"https://www.openstreetmap.org/copyright\">OpenStreetMap</a>',
        maxZoom: 19,
    }).addTo(map);

    const marker = L.marker([lat, lon]).addTo(map)
        .bindPopup(\"<strong>";
        // line 127
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 127), "html", null, true);
        yield "</strong><br>Boutique LEGO\")
        .openPopup();
</script>

</body>
</html>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "store_detail.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  229 => 127,  214 => 115,  210 => 114,  197 => 104,  187 => 97,  183 => 96,  179 => 95,  171 => 90,  160 => 82,  146 => 73,  142 => 72,  132 => 65,  124 => 60,  113 => 52,  109 => 51,  103 => 47,  97 => 43,  91 => 40,  86 => 39,  84 => 38,  48 => 5,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Détails du store - {{ store.nom }} - LEGO Map</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <script src=\"https://cdn.tailwindcss.com\"></script>
    <link rel=\"stylesheet\" href=\"https://unpkg.com/leaflet/dist/leaflet.css\" />
    <script src=\"https://unpkg.com/leaflet/dist/leaflet.js\"></script>
    <style>
        *:focus-visible {
            outline: 3px solid #1a365d !important;
            outline-offset: 2px;
        }
        #map { z-index: 1; }
    </style>
</head>
<body class=\"bg-yellow-400 min-h-screen font-sans text-gray-900\">

<a href=\"#main-content\" class=\"sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-white text-red-800 p-4 z-50 rounded-lg shadow-lg font-bold\">
    Aller au contenu principal
</a>

<header class=\"bg-red-700 text-white p-4 flex justify-between items-center shadow-lg\" role=\"banner\">
    <h1 class=\"text-2xl font-bold\">LEGO Map</h1>
    <nav aria-label=\"Navigation de retour\">
        <a href=\"/\"
           class=\"bg-white text-red-800 font-bold px-4 py-2 rounded-lg hover:bg-gray-100 transition border-2 border-transparent\">
            Retour <span class=\"sr-only\">à la liste des stores</span>
        </a>
    </nav>
</header>

<main id=\"main-content\" class=\"p-8 max-w-4xl mx-auto\" role=\"main\">
    <article class=\"bg-white rounded-2xl shadow-2xl overflow-hidden border-4 border-red-800\">

        <div class=\"w-full h-64 overflow-hidden bg-gray-200\">
            {% if store.photo %}
                <img src=\"{{ store.photo[:5] == 'data:' ? store.photo : 'data:image/jpeg;base64,' ~ store.photo }}\"
                     alt=\"Photographie de la boutique {{ store.nom }}\"
                     class=\"w-full h-full object-cover\">
            {% else %}
                <div class=\"w-full h-full flex items-center justify-center text-gray-500 italic\" aria-hidden=\"true\">
                    Aucune photographie disponible pour ce store
                </div>
            {% endif %}
        </div>

        <div class=\"p-6 space-y-6\">
            <header>
                <h2 class=\"text-3xl font-black text-red-800 mb-2\">{{ store.nom }}</h2>
                <p class=\"text-lg text-gray-700 leading-relaxed\">{{ store.description }}</p>
            </header>

            <hr class=\"border-gray-200\" aria-hidden=\"true\">

            <dl class=\"grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-3\">
                <div class=\"flex flex-col border-b border-gray-100 pb-2\">
                    <dt class=\"text-sm font-bold text-gray-500 uppercase tracking-wide\">Date d'ouverture</dt>
                    <dd class=\"text-gray-900 font-medium\">{{ store.date }}</dd>
                </div>
                <div class=\"flex flex-col border-b border-gray-100 pb-2\">
                    <dt class=\"text-sm font-bold text-gray-500 uppercase tracking-wide\">Note des clients</dt>
                    <dd class=\"text-gray-900 font-bold flex items-center gap-1\">
                        <span class=\"text-gray-900 font-medium\">{{ store.avis }} / 5</span>
                        <span class=\"text-amber-600 text-2xl\" aria-hidden=\"true\">★</span>
                        <span class=\"sr-only\">étoiles sur 5</span>
                    </dd>
                </div>
                <div class=\"flex flex-col border-b border-gray-100 pb-2\">
                    <dt class=\"text-sm font-bold text-gray-500 uppercase tracking-wide\">Contact</dt>
                    <dd class=\"text-gray-900 font-medium\">{{ store.contactNom }}</dd>
                    <dd><a href=\"mailto:{{ store.contactEmail }}\" class=\"text-blue-700 hover:underline font-medium\">{{ store.contactEmail }}</a></dd>
                </div>
            </dl>

            <section aria-labelledby=\"map-title\">
                <h3 id=\"map-title\" class=\"sr-only\">Localisation sur la carte</h3>
                <div id=\"map\"
                     class=\"w-full h-80 rounded-xl shadow-inner border-2 border-gray-200\"
                     role=\"application\"
                     aria-label=\"Carte interactive affichant l'emplacement du store {{ store.nom }}\">
                </div>
                <p class=\"text-xs text-gray-500 mt-2 italic\">
                    Utilisez les touches fléchées pour déplacer la carte et les touches + et - pour zoomer.
                </p>
            </section>

            <footer class=\"flex flex-wrap gap-4 mt-8 pt-6 border-t-2 border-gray-100\">
                <a href=\"/store/{{ store.id }}/edit\"
                   class=\"bg-blue-700 text-white font-bold px-6 py-3 rounded-xl hover:bg-blue-800 transition shadow-md focus:ring-4 focus:ring-blue-300\">
                    Modifier les informations
                </a>

                <form method=\"POST\" action=\"/store/{{ store.id }}/delete\"
                      onsubmit=\"return confirm('Êtes-vous sûr de vouloir supprimer définitivement le store {{ store.nom }} ?');\">
                    <input type=\"hidden\" name=\"csrf_token\" value=\"{{ csrf_token }}\">
                    <button type=\"submit\"
                            class=\"bg-red-800 text-white font-bold px-6 py-3 rounded-xl hover:bg-red-900 transition shadow-md focus:ring-4 focus:ring-red-300\">
                        Supprimer le store
                    </button>
                </form>

                <a href=\"/store/{{ store.id }}/pdf\"
                   class=\"bg-gray-800 text-white font-bold px-6 py-3 rounded-xl hover:bg-black transition shadow-md focus:ring-4 focus:ring-gray-400 flex items-center gap-2\">
                    Générer la fiche PDF
                </a>
            </footer>
        </div>
    </article>
</main>

<script>
    const lat = {{ store.latitude }};
    const lon = {{ store.longitude }};

    const map = L.map('map', {
        scrollWheelZoom: false
    }).setView([lat, lon], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href=\"https://www.openstreetmap.org/copyright\">OpenStreetMap</a>',
        maxZoom: 19,
    }).addTo(map);

    const marker = L.marker([lat, lon]).addTo(map)
        .bindPopup(\"<strong>{{ store.nom }}</strong><br>Boutique LEGO\")
        .openPopup();
</script>

</body>
</html>", "store_detail.html.twig", "/var/www/html/src/View/store_detail.html.twig");
    }
}
