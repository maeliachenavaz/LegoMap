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

/* home.html.twig */
class __TwigTemplate_b3b06af40c9e61424fb105288fb7f31a extends Template
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

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 2
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("base.html.twig", 2);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Accueil";
        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 7
        yield "    ";
        // line 8
        yield "    <div class=\"flex justify-between items-center mb-8 flex-wrap gap-4\">
        <h2 class=\"text-3xl font-extrabold text-red-900\">Liste des Stores</h2>
        <a href=\"/store/create\" class=\"bg-red-800 text-white font-bold px-6 py-3 rounded-xl hover:bg-red-900 transition shadow-md focus:ring-4 focus:ring-red-300\">
            + Ajouter un store
        </a>
    </div>

    ";
        // line 16
        yield "    <form method=\"GET\" action=\"/\" class=\"flex flex-col md:flex-row gap-4 mb-8 items-stretch\" role=\"search\">
        <div class=\"flex-1 flex flex-col gap-1\">
            <label for=\"search-input\" class=\"sr-only\">Rechercher un store par nom ou ville</label>
            <input
                    id=\"search-input\"
                    type=\"text\"
                    name=\"q\"
                    value=\"";
        // line 23
        yield (((array_key_exists("q", $context) &&  !(null === $context["q"]))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["q"], "html", null, true)) : (""));
        yield "\"
                    placeholder=\"Rechercher par nom ou ville...\"
                    class=\"w-full px-4 py-3 rounded-xl border-2 border-gray-300 focus:border-red-700 outline-none shadow-sm transition-colors\"
            >
        </div>

        <div class=\"flex flex-col gap-1\">
            <label for=\"sort-select\" class=\"sr-only\">Trier les résultats</label>
            <select
                    id=\"sort-select\"
                    name=\"sort\"
                    class=\"px-4 py-3 rounded-xl border-2 border-gray-300 focus:border-red-700 outline-none shadow-sm bg-white\"
            >
                <option value=\"\">Trier par avis</option>
                <option value=\"desc\" ";
        // line 37
        if ((($context["sort"] ?? null) == "desc")) {
            yield "selected";
        }
        yield ">⭐ Mieux noté → Moins bien noté</option>
                <option value=\"asc\" ";
        // line 38
        if ((($context["sort"] ?? null) == "asc")) {
            yield "selected";
        }
        yield ">⭐ Moins bien noté → Mieux noté</option>
            </select>
        </div>

        <a href=\"/\" class=\"bg-white text-red-800 font-bold px-6 py-3 rounded-xl hover:bg-gray-100 transition border-2 border-red-800 flex items-center justify-center\">
            Réinitialiser
        </a>
    </form>

    <ul id=\"store-results-container\" class=\"grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8\" aria-label=\"Liste des boutiques LEGO\">
        ";
        // line 48
        yield from $this->load("Template/list_item.html.twig", 48)->unwrap()->yield($context);
        // line 49
        yield "    </ul>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const sortSelect = document.getElementById('sort-select');
            const storeList = document.getElementById('store-results-container');
            let timeout = null;

            const updateResults = () => {
                const query = searchInput.value;
                const sort = sortSelect.value;

                storeList.style.opacity = '0.5';

                const url = `/?q=\${encodeURIComponent(query)}&sort=\${encodeURIComponent(sort)}`;

                fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                    .then(response => response.text())
                    .then(html => {
                        storeList.innerHTML = html;
                        storeList.style.opacity = '1';
                    });
            };

            searchInput.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(updateResults, 300);
            });

            sortSelect.addEventListener('change', updateResults);
        });
    </script>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "home.html.twig";
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
        return array (  130 => 49,  128 => 48,  113 => 38,  107 => 37,  90 => 23,  81 => 16,  72 => 8,  70 => 7,  63 => 6,  52 => 4,  41 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# templates/stores/index.html.twig #}
{% extends 'base.html.twig' %}

{% block title %}Accueil{% endblock %}

{% block body %}
    {# En-tête de la section principale #}
    <div class=\"flex justify-between items-center mb-8 flex-wrap gap-4\">
        <h2 class=\"text-3xl font-extrabold text-red-900\">Liste des Stores</h2>
        <a href=\"/store/create\" class=\"bg-red-800 text-white font-bold px-6 py-3 rounded-xl hover:bg-red-900 transition shadow-md focus:ring-4 focus:ring-red-300\">
            + Ajouter un store
        </a>
    </div>

    {# Formulaire de recherche et filtrage #}
    <form method=\"GET\" action=\"/\" class=\"flex flex-col md:flex-row gap-4 mb-8 items-stretch\" role=\"search\">
        <div class=\"flex-1 flex flex-col gap-1\">
            <label for=\"search-input\" class=\"sr-only\">Rechercher un store par nom ou ville</label>
            <input
                    id=\"search-input\"
                    type=\"text\"
                    name=\"q\"
                    value=\"{{ q ?? '' }}\"
                    placeholder=\"Rechercher par nom ou ville...\"
                    class=\"w-full px-4 py-3 rounded-xl border-2 border-gray-300 focus:border-red-700 outline-none shadow-sm transition-colors\"
            >
        </div>

        <div class=\"flex flex-col gap-1\">
            <label for=\"sort-select\" class=\"sr-only\">Trier les résultats</label>
            <select
                    id=\"sort-select\"
                    name=\"sort\"
                    class=\"px-4 py-3 rounded-xl border-2 border-gray-300 focus:border-red-700 outline-none shadow-sm bg-white\"
            >
                <option value=\"\">Trier par avis</option>
                <option value=\"desc\" {% if sort == 'desc' %}selected{% endif %}>⭐ Mieux noté → Moins bien noté</option>
                <option value=\"asc\" {% if sort == 'asc' %}selected{% endif %}>⭐ Moins bien noté → Mieux noté</option>
            </select>
        </div>

        <a href=\"/\" class=\"bg-white text-red-800 font-bold px-6 py-3 rounded-xl hover:bg-gray-100 transition border-2 border-red-800 flex items-center justify-center\">
            Réinitialiser
        </a>
    </form>

    <ul id=\"store-results-container\" class=\"grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8\" aria-label=\"Liste des boutiques LEGO\">
        {% include 'Template/list_item.html.twig' %}
    </ul>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const sortSelect = document.getElementById('sort-select');
            const storeList = document.getElementById('store-results-container');
            let timeout = null;

            const updateResults = () => {
                const query = searchInput.value;
                const sort = sortSelect.value;

                storeList.style.opacity = '0.5';

                const url = `/?q=\${encodeURIComponent(query)}&sort=\${encodeURIComponent(sort)}`;

                fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                    .then(response => response.text())
                    .then(html => {
                        storeList.innerHTML = html;
                        storeList.style.opacity = '1';
                    });
            };

            searchInput.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(updateResults, 300);
            });

            sortSelect.addEventListener('change', updateResults);
        });
    </script>
{% endblock %}", "home.html.twig", "/var/www/html/src/View/home.html.twig");
    }
}
