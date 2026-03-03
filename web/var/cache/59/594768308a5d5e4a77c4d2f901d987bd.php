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

/* base.html.twig */
class __TwigTemplate_eee4c8a9c9ead4b15e9245aa84872d75 extends Template
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
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'body' => [$this, 'block_body'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 2
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>";
        // line 7
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield " - LEGO Map</title>

    <script src=\"https://cdn.tailwindcss.com\"></script>
    <style>
        *:focus-visible {
            outline: 3px solid #1a365d !important;
            outline-offset: 2px;
        }
        @media (max-width: 767px) {
            #mobile-menu.hidden { display: none; }
            #mobile-menu.flex { display: flex; }
        }
    </style>
    ";
        // line 20
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 21
        yield "</head>
<body class=\"bg-yellow-400 min-h-screen font-sans text-gray-900\">

";
        // line 25
        yield "<a href=\"#main-content\" class=\"sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-white text-red-700 p-4 z-50 rounded-lg shadow-lg font-bold\">
    Aller au contenu principal
</a>

";
        // line 30
        yield "<header class=\"bg-red-700 text-white shadow-lg relative\" role=\"banner\">
    <div class=\"max-w-7xl mx-auto px-4 py-4\">
        <div class=\"flex justify-between items-center\">

            <div class=\"flex items-center gap-8\">
                <a href=\"/\" class=\"text-2xl font-bold hover:underline\" aria-label=\"LEGO Map - Retour à l'accueil\">
                    LEGO Map
                </a>

                <nav class=\"hidden md:block\" aria-label=\"Menu principal\">
                    <ul class=\"flex gap-4\">
                        <li>
                            <a href=\"/\"
                               class=\"px-3 py-2 rounded-lg hover:bg-red-800 transition block font-medium ";
        // line 43
        yield (((        $this->unwrap()->renderBlock("title", $context, $blocks) == "Accueil")) ? ("bg-red-900 ring-2 ring-white") : (""));
        yield "\"
                               ";
        // line 44
        if ((        $this->unwrap()->renderBlock("title", $context, $blocks) == "Accueil")) {
            yield "aria-current=\"page\"";
        }
        yield ">
                                Boutiques
                            </a>
                        </li>
                        <li>
                            <a href=\"/users\"
                               class=\"px-3 py-2 rounded-lg hover:bg-red-800 transition block font-medium ";
        // line 50
        yield (((        $this->unwrap()->renderBlock("title", $context, $blocks) == "Utilisateurs")) ? ("bg-red-900 ring-2 ring-white") : (""));
        yield "\"
                               ";
        // line 51
        if ((        $this->unwrap()->renderBlock("title", $context, $blocks) == "Utilisateurs")) {
            yield "aria-current=\"page\"";
        }
        yield ">
                                Utilisateurs
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class=\"hidden md:block\">
                <a href=\"/logout\" class=\"bg-white text-red-800 font-bold px-4 py-2 rounded-lg hover:bg-gray-100 transition border-2 border-transparent\">
                    Déconnexion
                </a>
            </div>

            ";
        // line 66
        yield "            <button id=\"burger-btn\"
                    class=\"md:hidden p-2 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-white transition\"
                    aria-expanded=\"false\"
                    aria-controls=\"mobile-menu\"
                    aria-label=\"Ouvrir le menu\">
                <svg id=\"burger-icon\" class=\"w-8 h-8\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M4 6h16M4 12h16M4 18h16\"></path>
                </svg>
                <svg id=\"close-icon\" class=\"w-8 h-8 hidden\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M6 18L18 6M6 6l12 12\"></path>
                </svg>
            </button>
        </div>

        ";
        // line 81
        yield "        <nav id=\"mobile-menu\"
             class=\"hidden flex-col gap-4 mt-4 pb-4 md:hidden border-t border-red-600 pt-4\"
             aria-label=\"Menu mobile\">
            <ul class=\"flex flex-col gap-2\">
                <li>
                    <a href=\"/\" class=\"px-4 py-3 rounded-lg hover:bg-red-800 transition block font-bold ";
        // line 86
        yield (((($context["title"] ?? null) == "Accueil")) ? ("bg-red-900") : (""));
        yield "\" ";
        if ((($context["title"] ?? null) == "Accueil")) {
            yield "aria-current=\"page\"";
        }
        yield ">
                        🛒 Stores
                    </a>
                </li>
                <li>
                    <a href=\"/users\" class=\"px-4 py-3 rounded-lg hover:bg-red-800 transition block font-bold ";
        // line 91
        yield (((($context["title"] ?? null) == "Utilisateurs")) ? ("bg-red-900") : (""));
        yield "\" ";
        if ((($context["title"] ?? null) == "Utilisateurs")) {
            yield "aria-current=\"page\"";
        }
        yield ">
                        👥 Utilisateurs
                    </a>
                </li>
            </ul>
            <a href=\"/logout\" class=\"bg-white text-red-800 text-center font-bold px-4 py-3 rounded-lg\">
                Déconnexion
            </a>
        </nav>
    </div>
</header>

";
        // line 104
        yield "<main id=\"main-content\" class=\"p-8 max-w-7xl mx-auto\" tabindex=\"-1\">
    ";
        // line 105
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 106
        yield "</main>

";
        // line 109
        yield "<footer class=\"p-8 text-center text-red-900 font-medium\" role=\"contentinfo\">
    <p>&copy; ";
        // line 110
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield " - Dashboard LEGO Map</p>
</footer>

<script>
    // Logique du menu burger
    const burgerBtn = document.getElementById('burger-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const burgerIcon = document.getElementById('burger-icon');
    const closeIcon = document.getElementById('close-icon');

    if (burgerBtn) {
        burgerBtn.addEventListener('click', () => {
            const isExpanded = burgerBtn.getAttribute('aria-expanded') === 'true';
            burgerBtn.setAttribute('aria-expanded', !isExpanded);
            burgerBtn.setAttribute('aria-label', isExpanded ? \"Ouvrir le menu\" : \"Fermer le menu\");

            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('flex');
            burgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    }
</script>
";
        // line 133
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 134
        yield "</body>
</html>";
        yield from [];
    }

    // line 7
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("title", $context)) ? (Twig\Extension\CoreExtension::default(($context["title"] ?? null), "Dashboard")) : ("Dashboard")), "html", null, true);
        yield from [];
    }

    // line 20
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 105
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 133
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "base.html.twig";
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
        return array (  266 => 133,  256 => 105,  246 => 20,  235 => 7,  229 => 134,  227 => 133,  201 => 110,  198 => 109,  194 => 106,  192 => 105,  189 => 104,  170 => 91,  158 => 86,  151 => 81,  135 => 66,  116 => 51,  112 => 50,  101 => 44,  97 => 43,  82 => 30,  76 => 25,  71 => 21,  69 => 20,  53 => 7,  46 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# templates/base.html.twig #}
<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>{% block title %}{{ title | default('Dashboard') }}{% endblock %} - LEGO Map</title>

    <script src=\"https://cdn.tailwindcss.com\"></script>
    <style>
        *:focus-visible {
            outline: 3px solid #1a365d !important;
            outline-offset: 2px;
        }
        @media (max-width: 767px) {
            #mobile-menu.hidden { display: none; }
            #mobile-menu.flex { display: flex; }
        }
    </style>
    {% block stylesheets %}{% endblock %}
</head>
<body class=\"bg-yellow-400 min-h-screen font-sans text-gray-900\">

{# 1. Lien d'évitement (Accessibilité clavier) #}
<a href=\"#main-content\" class=\"sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-white text-red-700 p-4 z-50 rounded-lg shadow-lg font-bold\">
    Aller au contenu principal
</a>

{# 2. Header / Navigation #}
<header class=\"bg-red-700 text-white shadow-lg relative\" role=\"banner\">
    <div class=\"max-w-7xl mx-auto px-4 py-4\">
        <div class=\"flex justify-between items-center\">

            <div class=\"flex items-center gap-8\">
                <a href=\"/\" class=\"text-2xl font-bold hover:underline\" aria-label=\"LEGO Map - Retour à l'accueil\">
                    LEGO Map
                </a>

                <nav class=\"hidden md:block\" aria-label=\"Menu principal\">
                    <ul class=\"flex gap-4\">
                        <li>
                            <a href=\"/\"
                               class=\"px-3 py-2 rounded-lg hover:bg-red-800 transition block font-medium {{ block('title') == 'Accueil' ? 'bg-red-900 ring-2 ring-white' : '' }}\"
                               {% if block('title') == 'Accueil' %}aria-current=\"page\"{% endif %}>
                                Boutiques
                            </a>
                        </li>
                        <li>
                            <a href=\"/users\"
                               class=\"px-3 py-2 rounded-lg hover:bg-red-800 transition block font-medium {{ block('title') == 'Utilisateurs' ? 'bg-red-900 ring-2 ring-white' : '' }}\"
                               {% if block('title') == 'Utilisateurs' %}aria-current=\"page\"{% endif %}>
                                Utilisateurs
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class=\"hidden md:block\">
                <a href=\"/logout\" class=\"bg-white text-red-800 font-bold px-4 py-2 rounded-lg hover:bg-gray-100 transition border-2 border-transparent\">
                    Déconnexion
                </a>
            </div>

            {# Bouton Burger Mobile #}
            <button id=\"burger-btn\"
                    class=\"md:hidden p-2 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-white transition\"
                    aria-expanded=\"false\"
                    aria-controls=\"mobile-menu\"
                    aria-label=\"Ouvrir le menu\">
                <svg id=\"burger-icon\" class=\"w-8 h-8\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M4 6h16M4 12h16M4 18h16\"></path>
                </svg>
                <svg id=\"close-icon\" class=\"w-8 h-8 hidden\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\" aria-hidden=\"true\">
                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M6 18L18 6M6 6l12 12\"></path>
                </svg>
            </button>
        </div>

        {# Menu Mobile #}
        <nav id=\"mobile-menu\"
             class=\"hidden flex-col gap-4 mt-4 pb-4 md:hidden border-t border-red-600 pt-4\"
             aria-label=\"Menu mobile\">
            <ul class=\"flex flex-col gap-2\">
                <li>
                    <a href=\"/\" class=\"px-4 py-3 rounded-lg hover:bg-red-800 transition block font-bold {{ title == 'Accueil' ? 'bg-red-900' : '' }}\" {% if title == 'Accueil' %}aria-current=\"page\"{% endif %}>
                        🛒 Stores
                    </a>
                </li>
                <li>
                    <a href=\"/users\" class=\"px-4 py-3 rounded-lg hover:bg-red-800 transition block font-bold {{ title == 'Utilisateurs' ? 'bg-red-900' : '' }}\" {% if title == 'Utilisateurs' %}aria-current=\"page\"{% endif %}>
                        👥 Utilisateurs
                    </a>
                </li>
            </ul>
            <a href=\"/logout\" class=\"bg-white text-red-800 text-center font-bold px-4 py-3 rounded-lg\">
                Déconnexion
            </a>
        </nav>
    </div>
</header>

{# 3. Contenu Principal #}
<main id=\"main-content\" class=\"p-8 max-w-7xl mx-auto\" tabindex=\"-1\">
    {% block body %}{% endblock %}
</main>

{# 4. Footer (Optionnel mais recommandé pour l'accessibilité) #}
<footer class=\"p-8 text-center text-red-900 font-medium\" role=\"contentinfo\">
    <p>&copy; {{ \"now\"|date(\"Y\") }} - Dashboard LEGO Map</p>
</footer>

<script>
    // Logique du menu burger
    const burgerBtn = document.getElementById('burger-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const burgerIcon = document.getElementById('burger-icon');
    const closeIcon = document.getElementById('close-icon');

    if (burgerBtn) {
        burgerBtn.addEventListener('click', () => {
            const isExpanded = burgerBtn.getAttribute('aria-expanded') === 'true';
            burgerBtn.setAttribute('aria-expanded', !isExpanded);
            burgerBtn.setAttribute('aria-label', isExpanded ? \"Ouvrir le menu\" : \"Fermer le menu\");

            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('flex');
            burgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    }
</script>
{% block javascripts %}{% endblock %}
</body>
</html>", "base.html.twig", "/var/www/html/src/View/base.html.twig");
    }
}
