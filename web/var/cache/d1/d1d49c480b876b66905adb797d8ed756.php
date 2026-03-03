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

        <button type=\"submit\" class=\"bg-red-800 text-white font-bold px-6 py-3 rounded-xl hover:bg-red-900 transition focus:ring-4 focus:ring-red-300\">
            Filtrer
        </button>

        <a href=\"/\" class=\"bg-white text-red-800 font-bold px-6 py-3 rounded-xl hover:bg-gray-100 transition border-2 border-red-800 flex items-center justify-center\">
            Réinitialiser
        </a>
    </form>

    ";
        // line 52
        yield "    ";
        if (Twig\Extension\CoreExtension::testEmpty(($context["stores"] ?? null))) {
            // line 53
            yield "        <div class=\"bg-white p-12 rounded-2xl text-center shadow-inner border-2 border-dashed border-gray-300\" role=\"status\">
            <p class=\"text-xl text-gray-600 font-medium\">Aucun store trouvé pour votre recherche.</p>
        </div>
    ";
        } else {
            // line 57
            yield "        <ul class=\"grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8\" aria-label=\"Liste des boutiques LEGO\">
            ";
            // line 58
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["stores"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
                // line 59
                yield "                <li>
                    <article>
                        <a href=\"/store/";
                // line 61
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["store"], "id", [], "any", false, false, false, 61), "html", null, true);
                yield "\" class=\"group relative bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:scale-[1.03] hover:border-red-700 border-4 border-transparent block focus:ring-offset-4 focus:ring-offset-yellow-400\">

                            ";
                // line 64
                yield "                            <div class=\"w-full h-48 bg-gray-200 overflow-hidden\">
                                ";
                // line 65
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["store"], "photo", [], "any", false, false, false, 65)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 66
                    yield "                                    <img src=\"";
                    yield (((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["store"], "photo", [], "any", false, false, false, 66), 0, 5) == "data:")) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["store"], "photo", [], "any", false, false, false, 66), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(("data:image/jpeg;base64," . CoreExtension::getAttribute($this->env, $this->source, $context["store"], "photo", [], "any", false, false, false, 66)), "html", null, true)));
                    yield "\"
                                         alt=\"Façade du store ";
                    // line 67
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["store"], "nom", [], "any", false, false, false, 67), "html", null, true);
                    yield "\"
                                         class=\"w-full h-full object-cover transition-transform duration-500 group-hover:scale-110\">
                                ";
                } else {
                    // line 70
                    yield "                                    <div class=\"w-full h-full flex items-center justify-center bg-gray-300\" aria-hidden=\"true\">
                                        <span class=\"text-5xl\">🧱</span>
                                    </div>
                                ";
                }
                // line 74
                yield "                            </div>

                            ";
                // line 77
                yield "                            <div class=\"p-6 space-y-3\">
                                <h3 class=\"font-bold text-2xl text-red-800 group-hover:text-red-700\">";
                // line 78
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["store"], "nom", [], "any", false, false, false, 78), "html", null, true);
                yield "</h3>

                                <div class=\"flex items-center gap-2 bg-gray-50 px-3 py-1 rounded-full w-fit border border-gray-200\"
                                     aria-label=\"Note de ";
                // line 81
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["store"], "avis", [], "any", false, false, false, 81), "html", null, true);
                yield " sur 5\">
                                    <span class=\"text-xl font-black text-gray-700\" aria-hidden=\"true\">";
                // line 82
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["store"], "avis", [], "any", false, false, false, 82), "html", null, true);
                yield " / 5</span>
                                    <span class=\"text-amber-500 text-2xl\" aria-hidden=\"true\">★</span>
                                </div>
                            </div>
                        </a>
                    </article>
                </li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['store'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 90
            yield "        </ul>
    ";
        }
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
        return array (  209 => 90,  195 => 82,  191 => 81,  185 => 78,  182 => 77,  178 => 74,  172 => 70,  166 => 67,  161 => 66,  159 => 65,  156 => 64,  151 => 61,  147 => 59,  143 => 58,  140 => 57,  134 => 53,  131 => 52,  113 => 38,  107 => 37,  90 => 23,  81 => 16,  72 => 8,  70 => 7,  63 => 6,  52 => 4,  41 => 2,);
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

        <button type=\"submit\" class=\"bg-red-800 text-white font-bold px-6 py-3 rounded-xl hover:bg-red-900 transition focus:ring-4 focus:ring-red-300\">
            Filtrer
        </button>

        <a href=\"/\" class=\"bg-white text-red-800 font-bold px-6 py-3 rounded-xl hover:bg-gray-100 transition border-2 border-red-800 flex items-center justify-center\">
            Réinitialiser
        </a>
    </form>

    {# Affichage des résultats #}
    {% if stores is empty %}
        <div class=\"bg-white p-12 rounded-2xl text-center shadow-inner border-2 border-dashed border-gray-300\" role=\"status\">
            <p class=\"text-xl text-gray-600 font-medium\">Aucun store trouvé pour votre recherche.</p>
        </div>
    {% else %}
        <ul class=\"grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8\" aria-label=\"Liste des boutiques LEGO\">
            {% for store in stores %}
                <li>
                    <article>
                        <a href=\"/store/{{ store.id }}\" class=\"group relative bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:scale-[1.03] hover:border-red-700 border-4 border-transparent block focus:ring-offset-4 focus:ring-offset-yellow-400\">

                            {# Zone Image #}
                            <div class=\"w-full h-48 bg-gray-200 overflow-hidden\">
                                {% if store.photo %}
                                    <img src=\"{{ store.photo[:5] == 'data:' ? store.photo : 'data:image/jpeg;base64,' ~ store.photo }}\"
                                         alt=\"Façade du store {{ store.nom }}\"
                                         class=\"w-full h-full object-cover transition-transform duration-500 group-hover:scale-110\">
                                {% else %}
                                    <div class=\"w-full h-full flex items-center justify-center bg-gray-300\" aria-hidden=\"true\">
                                        <span class=\"text-5xl\">🧱</span>
                                    </div>
                                {% endif %}
                            </div>

                            {# Zone Détails #}
                            <div class=\"p-6 space-y-3\">
                                <h3 class=\"font-bold text-2xl text-red-800 group-hover:text-red-700\">{{ store.nom }}</h3>

                                <div class=\"flex items-center gap-2 bg-gray-50 px-3 py-1 rounded-full w-fit border border-gray-200\"
                                     aria-label=\"Note de {{ store.avis }} sur 5\">
                                    <span class=\"text-xl font-black text-gray-700\" aria-hidden=\"true\">{{ store.avis }} / 5</span>
                                    <span class=\"text-amber-500 text-2xl\" aria-hidden=\"true\">★</span>
                                </div>
                            </div>
                        </a>
                    </article>
                </li>
            {% endfor %}
        </ul>
    {% endif %}
{% endblock %}", "home.html.twig", "/var/www/html/src/View/home.html.twig");
    }
}
