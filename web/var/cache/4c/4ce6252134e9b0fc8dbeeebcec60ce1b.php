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

/* store_preview.html.twig */
class __TwigTemplate_79b210e837196c723e9a4bfde4bd4447 extends Template
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
    <title>Aperçu - ";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 5), "html", null, true);
        yield "</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <script src=\"https://cdn.tailwindcss.com\"></script>
    <link rel=\"stylesheet\" href=\"https://unpkg.com/leaflet/dist/leaflet.css\" />
    <script src=\"https://unpkg.com/leaflet/dist/leaflet.js\"></script>
    <style>
        #map { height: 300px; z-index: 1; }
    </style>
</head>
<body class=\"bg-gray-50 min-h-screen p-4\">

<div class=\"max-w-3xl mx-auto bg-white shadow-2xl rounded-3xl overflow-hidden border-2 border-gray-100\">

    ";
        // line 19
        yield "    <div class=\"w-full h-56 bg-gray-200\">
        ";
        // line 20
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 20)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 21
            yield "            <img src=\"";
            yield (((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 21), 0, 5) == "data:")) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 21), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(("data:image/jpeg;base64," . CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 21)), "html", null, true)));
            yield "\"
                 alt=\"";
            // line 22
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 22), "html", null, true);
            yield "\" class=\"w-full h-full object-cover\">
        ";
        } else {
            // line 24
            yield "            <div class=\"w-full h-full flex items-center justify-center text-gray-400 italic\">Aucune photo disponible</div>
        ";
        }
        // line 26
        yield "    </div>

    <div class=\"p-8\">
        <div class=\"flex justify-between items-start mb-6\">
            <div>
                <h1 class=\"text-4xl font-black text-red-800\">";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 31), "html", null, true);
        yield "</h1>
                <p class=\"text-gray-500 font-medium\">";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "date", [], "any", false, false, false, 32), "html", null, true);
        yield "</p>
            </div>
            <div class=\"bg-amber-100 text-amber-700 px-4 py-2 rounded-2xl font-bold flex items-center gap-2\">
                ";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "avis", [], "any", false, false, false, 35), "html", null, true);
        yield " / 5 ★
            </div>
        </div>

        <p class=\"text-gray-700 leading-relaxed mb-8 text-lg\">
            ";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "description", [], "any", false, false, false, 40), "html", null, true);
        yield "
        </p>

        ";
        // line 44
        yield "        <div class=\"mb-8\">
            <h3 class=\"text-sm font-bold text-gray-400 uppercase tracking-widest mb-3\">Localisation</h3>
            <div id=\"map\" class=\"rounded-2xl border-2 border-gray-100 shadow-inner\"></div>
        </div>

        <div class=\"grid grid-cols-1 md:grid-cols-2 gap-6 mb-10\">
            <div class=\"bg-gray-50 p-4 rounded-xl\">
                <span class=\"block text-xs font-bold text-gray-400 uppercase\">Contact</span>
                <span class=\"text-gray-900 font-semibold\">";
        // line 52
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "contactNom", [], "any", false, false, false, 52), "html", null, true);
        yield "</span>
            </div>
            <div class=\"bg-gray-50 p-4 rounded-xl\">
                <span class=\"block text-xs font-bold text-gray-400 uppercase\">Email</span>
                <a href=\"mailto:";
        // line 56
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "contactEmail", [], "any", false, false, false, 56), "html", null, true);
        yield "\" class=\"text-blue-600 font-semibold hover:underline\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "contactEmail", [], "any", false, false, false, 56), "html", null, true);
        yield "</a>
            </div>
        </div>

        ";
        // line 61
        yield "        <div class=\"flex flex-col sm:flex-row gap-4\">
            <a href=\"/store/";
        // line 62
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "id", [], "any", false, false, false, 62), "html", null, true);
        yield "/pdf\"
               class=\"flex-1 text-center bg-red-800 text-white font-bold px-6 py-4 rounded-2xl hover:bg-red-900 transition shadow-lg shadow-red-200\">
                📥 Télécharger le PDF
            </a>
        </div>
    </div>
</div>

<script>
    const lat = ";
        // line 71
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "latitude", [], "any", false, false, false, 71), "html", null, true);
        yield ";
    const lon = ";
        // line 72
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "longitude", [], "any", false, false, false, 72), "html", null, true);
        yield ";
    const map = L.map('map', { scrollWheelZoom: false }).setView([lat, lon], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    L.marker([lat, lon]).addTo(map)
        .bindPopup(\"<strong>";
        // line 80
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 80), "html", null, true);
        yield "</strong>\")
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
        return "store_preview.html.twig";
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
        return array (  170 => 80,  159 => 72,  155 => 71,  143 => 62,  140 => 61,  131 => 56,  124 => 52,  114 => 44,  108 => 40,  100 => 35,  94 => 32,  90 => 31,  83 => 26,  79 => 24,  74 => 22,  69 => 21,  67 => 20,  64 => 19,  48 => 5,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Aperçu - {{ store.nom }}</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <script src=\"https://cdn.tailwindcss.com\"></script>
    <link rel=\"stylesheet\" href=\"https://unpkg.com/leaflet/dist/leaflet.css\" />
    <script src=\"https://unpkg.com/leaflet/dist/leaflet.js\"></script>
    <style>
        #map { height: 300px; z-index: 1; }
    </style>
</head>
<body class=\"bg-gray-50 min-h-screen p-4\">

<div class=\"max-w-3xl mx-auto bg-white shadow-2xl rounded-3xl overflow-hidden border-2 border-gray-100\">

    {# Image de couverture #}
    <div class=\"w-full h-56 bg-gray-200\">
        {% if store.photo %}
            <img src=\"{{ store.photo[:5] == 'data:' ? store.photo : 'data:image/jpeg;base64,' ~ store.photo }}\"
                 alt=\"{{ store.nom }}\" class=\"w-full h-full object-cover\">
        {% else %}
            <div class=\"w-full h-full flex items-center justify-center text-gray-400 italic\">Aucune photo disponible</div>
        {% endif %}
    </div>

    <div class=\"p-8\">
        <div class=\"flex justify-between items-start mb-6\">
            <div>
                <h1 class=\"text-4xl font-black text-red-800\">{{ store.nom }}</h1>
                <p class=\"text-gray-500 font-medium\">{{ store.date }}</p>
            </div>
            <div class=\"bg-amber-100 text-amber-700 px-4 py-2 rounded-2xl font-bold flex items-center gap-2\">
                {{ store.avis }} / 5 ★
            </div>
        </div>

        <p class=\"text-gray-700 leading-relaxed mb-8 text-lg\">
            {{ store.description }}
        </p>

        {# Carte Interactive #}
        <div class=\"mb-8\">
            <h3 class=\"text-sm font-bold text-gray-400 uppercase tracking-widest mb-3\">Localisation</h3>
            <div id=\"map\" class=\"rounded-2xl border-2 border-gray-100 shadow-inner\"></div>
        </div>

        <div class=\"grid grid-cols-1 md:grid-cols-2 gap-6 mb-10\">
            <div class=\"bg-gray-50 p-4 rounded-xl\">
                <span class=\"block text-xs font-bold text-gray-400 uppercase\">Contact</span>
                <span class=\"text-gray-900 font-semibold\">{{ store.contactNom }}</span>
            </div>
            <div class=\"bg-gray-50 p-4 rounded-xl\">
                <span class=\"block text-xs font-bold text-gray-400 uppercase\">Email</span>
                <a href=\"mailto:{{ store.contactEmail }}\" class=\"text-blue-600 font-semibold hover:underline\">{{ store.contactEmail }}</a>
            </div>
        </div>

        {# Actions #}
        <div class=\"flex flex-col sm:flex-row gap-4\">
            <a href=\"/store/{{ store.id }}/pdf\"
               class=\"flex-1 text-center bg-red-800 text-white font-bold px-6 py-4 rounded-2xl hover:bg-red-900 transition shadow-lg shadow-red-200\">
                📥 Télécharger le PDF
            </a>
        </div>
    </div>
</div>

<script>
    const lat = {{ store.latitude }};
    const lon = {{ store.longitude }};
    const map = L.map('map', { scrollWheelZoom: false }).setView([lat, lon], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    L.marker([lat, lon]).addTo(map)
        .bindPopup(\"<strong>{{ store.nom }}</strong>\")
        .openPopup();
</script>

</body>
</html>", "store_preview.html.twig", "/var/www/html/src/View/store_preview.html.twig");
    }
}
