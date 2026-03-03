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

/* view_store.html.twig */
class __TwigTemplate_b214afced0fb0d288583b3d017c3f9c4 extends Template
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
    <title>";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 5), "html", null, true);
        yield "</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <script src=\"https://cdn.tailwindcss.com\"></script>
    <link rel=\"stylesheet\" href=\"https://unpkg.com/leaflet/dist/leaflet.css\"/>
    <script src=\"https://unpkg.com/leaflet/dist/leaflet.js\"></script>
</head>
<body class=\"bg-yellow-400 min-h-screen font-sans\">

<header class=\"bg-red-700 text-white p-4 flex justify-between items-center shadow-lg\">
    <h1 class=\"text-2xl font-bold\">";
        // line 14
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 14), "html", null, true);
        yield "</h1>
    <a href=\"/\"
       class=\"bg-white text-red-700 font-bold px-4 py-2 rounded-lg hover:bg-gray-100 transition\">
        Retour
    </a>
</header>

<main class=\"p-8\">
    <div class=\"bg-white rounded-2xl shadow-2xl p-6 border-4 border-red-700 max-w-3xl mx-auto space-y-4\">

        <!-- Image -->
        ";
        // line 25
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 25)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 26
            yield "            <img src=\"";
            yield (((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 26), 0, 5) == "data:")) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 26), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(("data:image/jpeg;base64," . CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 26)), "html", null, true)));
            yield "\"
                 alt=\"";
            // line 27
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 27), "html", null, true);
            yield "\"
                 class=\"w-full h-64 object-cover rounded-2xl\">
        ";
        }
        // line 30
        yield "
        <!-- Infos -->
        <div class=\"space-y-2\">
            <p><strong>Description:</strong> ";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "description", [], "any", false, false, false, 33), "html", null, true);
        yield "</p>
            <p><strong>Date d'ouverture:</strong> ";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "date", [], "any", false, false, false, 34), "html", null, true);
        yield "</p>
            <p><strong>Avis:</strong> ";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "avis", [], "any", false, false, false, 35), "html", null, true);
        yield "/5 ⭐</p>
            <p><strong>Contact:</strong> ";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "contactNom", [], "any", false, false, false, 36), "html", null, true);
        yield " – ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "contactEmail", [], "any", false, false, false, 36), "html", null, true);
        yield "</p>
        </div>

        <!-- Carte -->
        <div id=\"map\" class=\"w-full h-64 rounded-2xl\"></div>

        <!-- Actions -->
        <div class=\"flex gap-4 mt-4\">
            <a href=\"/store/";
        // line 44
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "id", [], "any", false, false, false, 44), "html", null, true);
        yield "/edit\"
               class=\"bg-yellow-500 text-white px-4 py-2 rounded-xl hover:bg-yellow-600 transition\">
                Modifier
            </a>
            <a href=\"/store/";
        // line 48
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "id", [], "any", false, false, false, 48), "html", null, true);
        yield "/delete\"
               class=\"bg-red-600 text-white px-4 py-2 rounded-xl hover:bg-red-700 transition\"
               onclick=\"return confirm('Confirmer la suppression ?')\">
                Supprimer
            </a>
        </div>
    </div>
</main>

<script>
    // Carte OpenStreetMap avec Leaflet
    const map = L.map('map').setView([";
        // line 59
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "latitude", [], "any", false, false, false, 59), "html", null, true);
        yield ", ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "longitude", [], "any", false, false, false, 59), "html", null, true);
        yield "], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
    L.marker([";
        // line 64
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "latitude", [], "any", false, false, false, 64), "html", null, true);
        yield ", ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "longitude", [], "any", false, false, false, 64), "html", null, true);
        yield "]).addTo(map)
        .bindPopup('";
        // line 65
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 65), "html", null, true);
        yield "')
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
        return "view_store.html.twig";
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
        return array (  154 => 65,  148 => 64,  138 => 59,  124 => 48,  117 => 44,  104 => 36,  100 => 35,  96 => 34,  92 => 33,  87 => 30,  81 => 27,  76 => 26,  74 => 25,  60 => 14,  48 => 5,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>{{ store.nom }}</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <script src=\"https://cdn.tailwindcss.com\"></script>
    <link rel=\"stylesheet\" href=\"https://unpkg.com/leaflet/dist/leaflet.css\"/>
    <script src=\"https://unpkg.com/leaflet/dist/leaflet.js\"></script>
</head>
<body class=\"bg-yellow-400 min-h-screen font-sans\">

<header class=\"bg-red-700 text-white p-4 flex justify-between items-center shadow-lg\">
    <h1 class=\"text-2xl font-bold\">{{ store.nom }}</h1>
    <a href=\"/\"
       class=\"bg-white text-red-700 font-bold px-4 py-2 rounded-lg hover:bg-gray-100 transition\">
        Retour
    </a>
</header>

<main class=\"p-8\">
    <div class=\"bg-white rounded-2xl shadow-2xl p-6 border-4 border-red-700 max-w-3xl mx-auto space-y-4\">

        <!-- Image -->
        {% if store.photo %}
            <img src=\"{{ store.photo[:5] == 'data:' ? store.photo : 'data:image/jpeg;base64,' ~ store.photo }}\"
                 alt=\"{{ store.nom }}\"
                 class=\"w-full h-64 object-cover rounded-2xl\">
        {% endif %}

        <!-- Infos -->
        <div class=\"space-y-2\">
            <p><strong>Description:</strong> {{ store.description }}</p>
            <p><strong>Date d'ouverture:</strong> {{ store.date }}</p>
            <p><strong>Avis:</strong> {{ store.avis }}/5 ⭐</p>
            <p><strong>Contact:</strong> {{ store.contactNom }} – {{ store.contactEmail }}</p>
        </div>

        <!-- Carte -->
        <div id=\"map\" class=\"w-full h-64 rounded-2xl\"></div>

        <!-- Actions -->
        <div class=\"flex gap-4 mt-4\">
            <a href=\"/store/{{ store.id }}/edit\"
               class=\"bg-yellow-500 text-white px-4 py-2 rounded-xl hover:bg-yellow-600 transition\">
                Modifier
            </a>
            <a href=\"/store/{{ store.id }}/delete\"
               class=\"bg-red-600 text-white px-4 py-2 rounded-xl hover:bg-red-700 transition\"
               onclick=\"return confirm('Confirmer la suppression ?')\">
                Supprimer
            </a>
        </div>
    </div>
</main>

<script>
    // Carte OpenStreetMap avec Leaflet
    const map = L.map('map').setView([{{ store.latitude }}, {{ store.longitude }}], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
    L.marker([{{ store.latitude }}, {{ store.longitude }}]).addTo(map)
        .bindPopup('{{ store.nom }}')
        .openPopup();
</script>

</body>
</html>", "view_store.html.twig", "/var/www/html/src/View/view_store.html.twig");
    }
}
