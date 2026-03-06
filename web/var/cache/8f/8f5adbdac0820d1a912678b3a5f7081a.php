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

/* users.html.twig */
class __TwigTemplate_37596a590a792be25352fe955cc8eb30 extends Template
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
        yield "Utilisateurs";
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
        <div>
            <h2 class=\"text-3xl font-extrabold text-red-900\">Gestion des Utilisateurs</h2>
            <p class=\"text-gray-900 font-medium\">Liste des comptes clients (non-administrateurs)</p>
        </div>
        <a href=\"/users/create\"
           class=\"bg-red-800 text-white font-bold px-6 py-3 rounded-xl hover:bg-red-900 transition shadow-md focus:ring-4 focus:ring-red-400\">
            <span aria-hidden=\"true\">+</span> Ajouter un utilisateur
        </a>
    </div>

    ";
        // line 20
        yield "    <div class=\"bg-white rounded-2xl shadow-2xl overflow-hidden border-4 border-red-700\">
        <div class=\"overflow-x-auto\">
            <table class=\"w-full text-left border-collapse\">
                <caption class=\"sr-only\">Liste des utilisateurs et actions de gestion</caption>
                <thead class=\"bg-gray-100 border-b-2 border-gray-200\">
                <tr>
                    <th scope=\"col\" class=\"p-4 font-bold text-gray-800 text-lg\">Nom</th>
                    <th scope=\"col\" class=\"p-4 font-bold text-gray-800 text-lg\">Email</th>
                    <th scope=\"col\" class=\"p-4 font-bold text-gray-800 text-lg text-right\">Actions</th>
                </tr>
                </thead>
                <tbody class=\"divide-y divide-gray-200\">
                ";
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["users"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 33
            yield "                    <tr class=\"hover:bg-yellow-50 transition\">
                        <td class=\"p-4 text-gray-900 font-semibold\">";
            // line 34
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "name", [], "any", false, false, false, 34), "html", null, true);
            yield "</td>
                        <td class=\"p-4 text-gray-700\">";
            // line 35
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "email", [], "any", false, false, false, 35), "html", null, true);
            yield "</td>
                        <td class=\"p-4 text-right space-x-2\">
                            <a href=\"/users/edit/";
            // line 37
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 37), "html", null, true);
            yield "\"
                               class=\"inline-block bg-blue-700 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-900 transition shadow-sm border-2 border-transparent focus:ring-2 focus:ring-blue-400\"
                               aria-label=\"Modifier l'utilisateur ";
            // line 39
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "name", [], "any", false, false, false, 39), "html", null, true);
            yield "\">
                                Modifier
                            </a>

                            <form action=\"/users/delete/";
            // line 43
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 43), "html", null, true);
            yield "\" method=\"POST\" class=\"inline-block\"
                                  onsubmit=\"return confirm('Attention : Vous allez supprimer l\\'utilisateur ";
            // line 44
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "name", [], "any", false, false, false, 44), "html", null, true);
            yield ". Cette action est irréversible. Voulez-vous continuer ?');\">
                                <input type=\"hidden\" name=\"csrf_token\" value=\"";
            // line 45
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["csrf_token"] ?? null), "html", null, true);
            yield "\">

                                <button type=\"submit\"
                                        class=\"bg-red-700 text-white px-4 py-2 rounded-lg font-bold hover:bg-red-900 transition shadow-sm border-2 border-transparent focus:ring-2 focus:ring-red-400\">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                ";
            $context['_iterated'] = true;
        }
        // line 54
        if (!$context['_iterated']) {
            // line 55
            yield "                    <tr>
                        <td colspan=\"3\" class=\"p-12 text-center text-gray-600 italic bg-gray-50\">
                            Aucun utilisateur trouvé.
                        </td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['user'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 61
        yield "                </tbody>
            </table>
        </div>
    </div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "users.html.twig";
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
        return array (  163 => 61,  152 => 55,  150 => 54,  136 => 45,  132 => 44,  128 => 43,  121 => 39,  116 => 37,  111 => 35,  107 => 34,  104 => 33,  99 => 32,  85 => 20,  72 => 8,  70 => 7,  63 => 6,  52 => 4,  41 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# templates/users/index.html.twig #}
{% extends 'base.html.twig' %}

{% block title %}Utilisateurs{% endblock %}

{% block body %}
    {# En-tête de la page #}
    <div class=\"flex justify-between items-center mb-8 flex-wrap gap-4\">
        <div>
            <h2 class=\"text-3xl font-extrabold text-red-900\">Gestion des Utilisateurs</h2>
            <p class=\"text-gray-900 font-medium\">Liste des comptes clients (non-administrateurs)</p>
        </div>
        <a href=\"/users/create\"
           class=\"bg-red-800 text-white font-bold px-6 py-3 rounded-xl hover:bg-red-900 transition shadow-md focus:ring-4 focus:ring-red-400\">
            <span aria-hidden=\"true\">+</span> Ajouter un utilisateur
        </a>
    </div>

    {# Tableau des utilisateurs #}
    <div class=\"bg-white rounded-2xl shadow-2xl overflow-hidden border-4 border-red-700\">
        <div class=\"overflow-x-auto\">
            <table class=\"w-full text-left border-collapse\">
                <caption class=\"sr-only\">Liste des utilisateurs et actions de gestion</caption>
                <thead class=\"bg-gray-100 border-b-2 border-gray-200\">
                <tr>
                    <th scope=\"col\" class=\"p-4 font-bold text-gray-800 text-lg\">Nom</th>
                    <th scope=\"col\" class=\"p-4 font-bold text-gray-800 text-lg\">Email</th>
                    <th scope=\"col\" class=\"p-4 font-bold text-gray-800 text-lg text-right\">Actions</th>
                </tr>
                </thead>
                <tbody class=\"divide-y divide-gray-200\">
                {% for user in users %}
                    <tr class=\"hover:bg-yellow-50 transition\">
                        <td class=\"p-4 text-gray-900 font-semibold\">{{ user.name }}</td>
                        <td class=\"p-4 text-gray-700\">{{ user.email }}</td>
                        <td class=\"p-4 text-right space-x-2\">
                            <a href=\"/users/edit/{{ user.id }}\"
                               class=\"inline-block bg-blue-700 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-900 transition shadow-sm border-2 border-transparent focus:ring-2 focus:ring-blue-400\"
                               aria-label=\"Modifier l'utilisateur {{ user.name }}\">
                                Modifier
                            </a>

                            <form action=\"/users/delete/{{ user.id }}\" method=\"POST\" class=\"inline-block\"
                                  onsubmit=\"return confirm('Attention : Vous allez supprimer l\\'utilisateur {{ user.name }}. Cette action est irréversible. Voulez-vous continuer ?');\">
                                <input type=\"hidden\" name=\"csrf_token\" value=\"{{ csrf_token }}\">

                                <button type=\"submit\"
                                        class=\"bg-red-700 text-white px-4 py-2 rounded-lg font-bold hover:bg-red-900 transition shadow-sm border-2 border-transparent focus:ring-2 focus:ring-red-400\">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                {% else %}
                    <tr>
                        <td colspan=\"3\" class=\"p-12 text-center text-gray-600 italic bg-gray-50\">
                            Aucun utilisateur trouvé.
                        </td>
                    </tr>
                {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
{% endblock %}
", "users.html.twig", "/var/www/html/src/View/users.html.twig");
    }
}
