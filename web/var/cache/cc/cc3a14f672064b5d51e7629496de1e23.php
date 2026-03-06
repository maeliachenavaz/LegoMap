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

/* edit_store.html.twig */
class __TwigTemplate_a62cc698a1d32ec416f192e85790b9b8 extends Template
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
    <title>Modifier le Store - ";
        // line 5
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 5), "html", null, true);
        yield " - LEGO Map</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <script src=\"https://cdn.tailwindcss.com\"></script>
    <style>
        *:focus-visible {
            outline: 3px solid #1a365d !important;
            outline-offset: 2px;
        }
    </style>
</head>
<body class=\"bg-yellow-400 min-h-screen font-sans text-gray-900 flex items-center justify-center p-4\">

<a href=\"#main-form\" class=\"sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-white text-red-700 p-4 z-50 rounded-lg shadow-lg font-bold\">
    Aller au formulaire de modification
</a>

<main class=\"w-full max-w-2xl\" id=\"main-form\" role=\"main\">
    <div class=\"bg-white p-8 rounded-2xl shadow-2xl border-4 border-red-800\">
        <h1 class=\"text-3xl font-black text-red-800 mb-6 uppercase tracking-tight\">Modifier le Store</h1>

        ";
        // line 25
        if (array_key_exists("error", $context)) {
            // line 26
            yield "            <div class=\"bg-red-50 border-l-4 border-red-700 text-red-800 px-4 py-3 rounded mb-6\" role=\"alert\">
                <p class=\"font-bold\">Erreur :</p>
                <p>";
            // line 28
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error"] ?? null), "html", null, true);
            yield "</p>
            </div>
        ";
        }
        // line 31
        yield "
        <form method=\"POST\" enctype=\"multipart/form-data\" class=\"space-y-6\">
            <input type=\"hidden\" name=\"csrf_token\" value=\"";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["csrf_token"] ?? null), "html", null, true);
        yield "\">

            <div>
                <label for=\"nom\" class=\"block font-bold mb-2 text-gray-800\">Nom du Store</label>
                <input type=\"text\" id=\"nom\" name=\"nom\" required
                       class=\"w-full border-2 border-gray-400 rounded-xl px-4 py-3 focus:border-red-700 outline-none\"
                       value=\"";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 39), "html", null, true);
        yield "\">
            </div>

            <div>
                <label for=\"description\" class=\"block font-bold mb-2 text-gray-800\">Description</label>
                <textarea id=\"description\" name=\"description\" required
                          class=\"w-full border-2 border-gray-400 rounded-xl px-4 py-3 focus:border-red-700 outline-none min-h-[100px]\">";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "description", [], "any", false, false, false, 45), "html", null, true);
        yield "</textarea>
            </div>

            <div class=\"grid grid-cols-1 md:grid-cols-2 gap-4\">
                <div>
                    <label for=\"date\" class=\"block font-bold mb-2 text-gray-800\">Date d'ouverture</label>
                    <input type=\"date\" id=\"date\" name=\"date\" required
                           class=\"w-full border-2 border-gray-400 rounded-xl px-4 py-3 focus:border-red-700 outline-none\"
                           value=\"";
        // line 53
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "date", [], "any", false, false, false, 53), "html", null, true);
        yield "\">
                </div>

                <div>
                    <label for=\"avis\" class=\"block font-bold mb-2 text-gray-800\">Avis (de 0 à 5)</label>
                    <input type=\"number\" id=\"avis\" name=\"avis\" min=\"0\" max=\"5\" required
                           class=\"w-full border-2 border-gray-400 rounded-xl px-4 py-3 focus:border-red-700 outline-none\"
                           value=\"";
        // line 60
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "avis", [], "any", false, false, false, 60), "html", null, true);
        yield "\">
                </div>
            </div>

            <fieldset class=\"bg-blue-50 border-2 border-blue-200 p-4 rounded-xl\">
                <legend class=\"font-bold text-blue-900 px-2\">Localisation du store</legend>
                <p class=\"text-sm text-blue-800 mb-3\" id=\"geo-instruction\">
                    Utilisez votre GPS pour mettre à jour la position actuelle.
                </p>
                <div class=\"flex items-center gap-4 flex-wrap\">
                    <button type=\"button\" id=\"update-position-btn\"
                            class=\"bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 font-bold transition focus:ring-4 focus:ring-blue-300\"
                            aria-describedby=\"geo-instruction\">
                        📍 Mettre à jour
                    </button>
                    <p class=\"font-mono text-sm\" id=\"coords-status\" aria-live=\"polite\">
                        <span id=\"coords-display\">";
        // line 76
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "latitude", [], "any", false, false, false, 76), "html", null, true);
        yield ", ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "longitude", [], "any", false, false, false, 76), "html", null, true);
        yield "</span>
                    </p>
                </div>
                <input type=\"hidden\" name=\"latitude\" id=\"latitude\" value=\"";
        // line 79
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "latitude", [], "any", false, false, false, 79), "html", null, true);
        yield "\">
                <input type=\"hidden\" name=\"longitude\" id=\"longitude\" value=\"";
        // line 80
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "longitude", [], "any", false, false, false, 80), "html", null, true);
        yield "\">
            </fieldset>

            <div class=\"grid grid-cols-1 md:grid-cols-2 gap-4\">
                <div>
                    <label for=\"contactNom\" class=\"block font-bold mb-2 text-gray-800\">Nom du contact</label>
                    <input type=\"text\" id=\"contactNom\" name=\"contactNom\" required
                           class=\"w-full border-2 border-gray-400 rounded-xl px-4 py-3 focus:border-red-700 outline-none\"
                           value=\"";
        // line 88
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "contactNom", [], "any", false, false, false, 88), "html", null, true);
        yield "\">
                </div>
                <div>
                    <label for=\"contactEmail\" class=\"block font-bold mb-2 text-gray-800\">Email du contact</label>
                    <input type=\"email\" id=\"contactEmail\" name=\"contactEmail\" required
                           class=\"w-full border-2 border-gray-400 rounded-xl px-4 py-3 focus:border-red-700 outline-none\"
                           value=\"";
        // line 94
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "contactEmail", [], "any", false, false, false, 94), "html", null, true);
        yield "\">
                </div>
            </div>

            <div>
                <label for=\"photo\" class=\"block font-bold mb-2 text-gray-800\">Changer la photo</label>
                <input type=\"file\" id=\"photo\" name=\"photo\" accept=\"image/*\"
                       class=\"w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-red-50 file:text-red-700 hover:file:bg-red-100\">
                ";
        // line 102
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 102)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 103
            yield "                    <div class=\"mt-4 p-2 border border-gray-200 rounded-lg inline-block\">
                        <img src=\"";
            // line 104
            yield (((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 104), 0, 5) == "data:")) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 104), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(("data:image/jpeg;base64," . CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 104)), "html", null, true)));
            yield "\"
                             alt=\"Actuelle : ";
            // line 105
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 105), "html", null, true);
            yield "\" class=\"w-32 h-32 object-cover rounded shadow-sm\">
                    </div>
                ";
        }
        // line 108
        yield "            </div>

            <div class=\"flex flex-col sm:flex-row gap-4 pt-6 border-t-2 border-gray-100\">
                <button type=\"submit\"
                        class=\"flex-[2] bg-green-700 text-white font-black py-4 rounded-xl hover:bg-green-800 transition shadow-lg text-lg uppercase tracking-wide\">
                    Enregistrer
                </button>
                <a href=\"/store/";
        // line 115
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "id", [], "any", false, false, false, 115), "html", null, true);
        yield "\"
                   class=\"flex-1 bg-gray-200 text-gray-700 text-center font-bold py-4 rounded-xl hover:bg-gray-300 transition flex items-center justify-center border-2 border-transparent focus:ring-4 focus:ring-gray-400\">
                    Annuler
                </a>
            </div>

        </form>
    </div>
</main>

<script>
    document.addEventListener(\"DOMContentLoaded\", function () {
        const btn = document.getElementById(\"update-position-btn\");
        const latInput = document.getElementById(\"latitude\");
        const lonInput = document.getElementById(\"longitude\");
        const display = document.getElementById(\"coords-display\");

        btn.addEventListener(\"click\", function () {
            btn.disabled = true;
            btn.textContent = \"⌛...\";
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude.toFixed(6);
                        const lon = position.coords.longitude.toFixed(6);
                        latInput.value = lat;
                        lonInput.value = lon;
                        display.textContent = lat + \", \" + lon;
                        btn.disabled = false;
                        btn.textContent = \"📍 OK\";
                    },
                    function(error) {
                        alert(\"Erreur GPS\");
                        btn.disabled = false;
                        btn.textContent = \"📍 Réessayer\";
                    }
                );
            }
        });
    });
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
        return "edit_store.html.twig";
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
        return array (  212 => 115,  203 => 108,  197 => 105,  193 => 104,  190 => 103,  188 => 102,  177 => 94,  168 => 88,  157 => 80,  153 => 79,  145 => 76,  126 => 60,  116 => 53,  105 => 45,  96 => 39,  87 => 33,  83 => 31,  77 => 28,  73 => 26,  71 => 25,  48 => 5,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Modifier le Store - {{ store.nom }} - LEGO Map</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <script src=\"https://cdn.tailwindcss.com\"></script>
    <style>
        *:focus-visible {
            outline: 3px solid #1a365d !important;
            outline-offset: 2px;
        }
    </style>
</head>
<body class=\"bg-yellow-400 min-h-screen font-sans text-gray-900 flex items-center justify-center p-4\">

<a href=\"#main-form\" class=\"sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-white text-red-700 p-4 z-50 rounded-lg shadow-lg font-bold\">
    Aller au formulaire de modification
</a>

<main class=\"w-full max-w-2xl\" id=\"main-form\" role=\"main\">
    <div class=\"bg-white p-8 rounded-2xl shadow-2xl border-4 border-red-800\">
        <h1 class=\"text-3xl font-black text-red-800 mb-6 uppercase tracking-tight\">Modifier le Store</h1>

        {% if error is defined %}
            <div class=\"bg-red-50 border-l-4 border-red-700 text-red-800 px-4 py-3 rounded mb-6\" role=\"alert\">
                <p class=\"font-bold\">Erreur :</p>
                <p>{{ error }}</p>
            </div>
        {% endif %}

        <form method=\"POST\" enctype=\"multipart/form-data\" class=\"space-y-6\">
            <input type=\"hidden\" name=\"csrf_token\" value=\"{{ csrf_token }}\">

            <div>
                <label for=\"nom\" class=\"block font-bold mb-2 text-gray-800\">Nom du Store</label>
                <input type=\"text\" id=\"nom\" name=\"nom\" required
                       class=\"w-full border-2 border-gray-400 rounded-xl px-4 py-3 focus:border-red-700 outline-none\"
                       value=\"{{ store.nom }}\">
            </div>

            <div>
                <label for=\"description\" class=\"block font-bold mb-2 text-gray-800\">Description</label>
                <textarea id=\"description\" name=\"description\" required
                          class=\"w-full border-2 border-gray-400 rounded-xl px-4 py-3 focus:border-red-700 outline-none min-h-[100px]\">{{ store.description }}</textarea>
            </div>

            <div class=\"grid grid-cols-1 md:grid-cols-2 gap-4\">
                <div>
                    <label for=\"date\" class=\"block font-bold mb-2 text-gray-800\">Date d'ouverture</label>
                    <input type=\"date\" id=\"date\" name=\"date\" required
                           class=\"w-full border-2 border-gray-400 rounded-xl px-4 py-3 focus:border-red-700 outline-none\"
                           value=\"{{ store.date }}\">
                </div>

                <div>
                    <label for=\"avis\" class=\"block font-bold mb-2 text-gray-800\">Avis (de 0 à 5)</label>
                    <input type=\"number\" id=\"avis\" name=\"avis\" min=\"0\" max=\"5\" required
                           class=\"w-full border-2 border-gray-400 rounded-xl px-4 py-3 focus:border-red-700 outline-none\"
                           value=\"{{ store.avis }}\">
                </div>
            </div>

            <fieldset class=\"bg-blue-50 border-2 border-blue-200 p-4 rounded-xl\">
                <legend class=\"font-bold text-blue-900 px-2\">Localisation du store</legend>
                <p class=\"text-sm text-blue-800 mb-3\" id=\"geo-instruction\">
                    Utilisez votre GPS pour mettre à jour la position actuelle.
                </p>
                <div class=\"flex items-center gap-4 flex-wrap\">
                    <button type=\"button\" id=\"update-position-btn\"
                            class=\"bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 font-bold transition focus:ring-4 focus:ring-blue-300\"
                            aria-describedby=\"geo-instruction\">
                        📍 Mettre à jour
                    </button>
                    <p class=\"font-mono text-sm\" id=\"coords-status\" aria-live=\"polite\">
                        <span id=\"coords-display\">{{ store.latitude }}, {{ store.longitude }}</span>
                    </p>
                </div>
                <input type=\"hidden\" name=\"latitude\" id=\"latitude\" value=\"{{ store.latitude }}\">
                <input type=\"hidden\" name=\"longitude\" id=\"longitude\" value=\"{{ store.longitude }}\">
            </fieldset>

            <div class=\"grid grid-cols-1 md:grid-cols-2 gap-4\">
                <div>
                    <label for=\"contactNom\" class=\"block font-bold mb-2 text-gray-800\">Nom du contact</label>
                    <input type=\"text\" id=\"contactNom\" name=\"contactNom\" required
                           class=\"w-full border-2 border-gray-400 rounded-xl px-4 py-3 focus:border-red-700 outline-none\"
                           value=\"{{ store.contactNom }}\">
                </div>
                <div>
                    <label for=\"contactEmail\" class=\"block font-bold mb-2 text-gray-800\">Email du contact</label>
                    <input type=\"email\" id=\"contactEmail\" name=\"contactEmail\" required
                           class=\"w-full border-2 border-gray-400 rounded-xl px-4 py-3 focus:border-red-700 outline-none\"
                           value=\"{{ store.contactEmail }}\">
                </div>
            </div>

            <div>
                <label for=\"photo\" class=\"block font-bold mb-2 text-gray-800\">Changer la photo</label>
                <input type=\"file\" id=\"photo\" name=\"photo\" accept=\"image/*\"
                       class=\"w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-red-50 file:text-red-700 hover:file:bg-red-100\">
                {% if store.photo %}
                    <div class=\"mt-4 p-2 border border-gray-200 rounded-lg inline-block\">
                        <img src=\"{{ store.photo[:5] == 'data:' ? store.photo : 'data:image/jpeg;base64,' ~ store.photo }}\"
                             alt=\"Actuelle : {{ store.nom }}\" class=\"w-32 h-32 object-cover rounded shadow-sm\">
                    </div>
                {% endif %}
            </div>

            <div class=\"flex flex-col sm:flex-row gap-4 pt-6 border-t-2 border-gray-100\">
                <button type=\"submit\"
                        class=\"flex-[2] bg-green-700 text-white font-black py-4 rounded-xl hover:bg-green-800 transition shadow-lg text-lg uppercase tracking-wide\">
                    Enregistrer
                </button>
                <a href=\"/store/{{ store.id }}\"
                   class=\"flex-1 bg-gray-200 text-gray-700 text-center font-bold py-4 rounded-xl hover:bg-gray-300 transition flex items-center justify-center border-2 border-transparent focus:ring-4 focus:ring-gray-400\">
                    Annuler
                </a>
            </div>

        </form>
    </div>
</main>

<script>
    document.addEventListener(\"DOMContentLoaded\", function () {
        const btn = document.getElementById(\"update-position-btn\");
        const latInput = document.getElementById(\"latitude\");
        const lonInput = document.getElementById(\"longitude\");
        const display = document.getElementById(\"coords-display\");

        btn.addEventListener(\"click\", function () {
            btn.disabled = true;
            btn.textContent = \"⌛...\";
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude.toFixed(6);
                        const lon = position.coords.longitude.toFixed(6);
                        latInput.value = lat;
                        lonInput.value = lon;
                        display.textContent = lat + \", \" + lon;
                        btn.disabled = false;
                        btn.textContent = \"📍 OK\";
                    },
                    function(error) {
                        alert(\"Erreur GPS\");
                        btn.disabled = false;
                        btn.textContent = \"📍 Réessayer\";
                    }
                );
            }
        });
    });
</script>

</body>
</html>", "edit_store.html.twig", "/var/www/html/src/View/edit_store.html.twig");
    }
}
