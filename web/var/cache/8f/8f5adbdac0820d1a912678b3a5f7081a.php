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
            'javascripts' => [$this, 'block_javascripts'],
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
                            <button onclick=\"deleteUser('";
            // line 42
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "id", [], "any", false, false, false, 42), "html", null, true);
            yield "', '";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "name", [], "any", false, false, false, 42), "html", null, true);
            yield "')\"
                                    class=\"bg-red-700 text-white px-4 py-2 rounded-lg font-bold hover:bg-red-900 transition shadow-sm border-2 border-transparent focus:ring-2 focus:ring-red-400\"
                                    aria-label=\"Supprimer l'utilisateur ";
            // line 44
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["user"], "name", [], "any", false, false, false, 44), "html", null, true);
            yield "\">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                ";
            $context['_iterated'] = true;
        }
        // line 49
        if (!$context['_iterated']) {
            // line 50
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
        // line 56
        yield "                </tbody>
            </table>
        </div>
    </div>
";
        yield from [];
    }

    // line 62
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 63
        yield "    <script>
        /**
         * Logique de suppression d'un utilisateur
         * @param {string} id - L'identifiant de l'utilisateur
         * @param {string} name - Le nom pour la confirmation
         */
        async function deleteUser(id, name) {
            if (!confirm(`Êtes-vous sûr de vouloir supprimer l'utilisateur \"\${name}\" ? Cette action est irréversible.`)) {
                return;
            }

            try {
                const response = await fetch(`/users/delete/\${id}`, {
                    method: 'DELETE'
                });

                if (response.ok) {
                    // On recharge pour mettre à jour la liste
                    window.location.reload();
                } else {
                    const errorData = await response.json();
                    alert(\"Erreur : \" + (errorData.error || \"Impossible de supprimer l'utilisateur.\"));
                }
            } catch (error) {
                console.error(\"Erreur réseau :\", error);
                alert(\"Erreur de connexion au serveur.\");
            }
        }
    </script>
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
        return array (  174 => 63,  167 => 62,  158 => 56,  147 => 50,  145 => 49,  135 => 44,  128 => 42,  122 => 39,  117 => 37,  112 => 35,  108 => 34,  105 => 33,  100 => 32,  86 => 20,  73 => 8,  71 => 7,  64 => 6,  53 => 4,  42 => 2,);
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
                            <button onclick=\"deleteUser('{{ user.id }}', '{{ user.name }}')\"
                                    class=\"bg-red-700 text-white px-4 py-2 rounded-lg font-bold hover:bg-red-900 transition shadow-sm border-2 border-transparent focus:ring-2 focus:ring-red-400\"
                                    aria-label=\"Supprimer l'utilisateur {{ user.name }}\">
                                Supprimer
                            </button>
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

{% block javascripts %}
    <script>
        /**
         * Logique de suppression d'un utilisateur
         * @param {string} id - L'identifiant de l'utilisateur
         * @param {string} name - Le nom pour la confirmation
         */
        async function deleteUser(id, name) {
            if (!confirm(`Êtes-vous sûr de vouloir supprimer l'utilisateur \"\${name}\" ? Cette action est irréversible.`)) {
                return;
            }

            try {
                const response = await fetch(`/users/delete/\${id}`, {
                    method: 'DELETE'
                });

                if (response.ok) {
                    // On recharge pour mettre à jour la liste
                    window.location.reload();
                } else {
                    const errorData = await response.json();
                    alert(\"Erreur : \" + (errorData.error || \"Impossible de supprimer l'utilisateur.\"));
                }
            } catch (error) {
                console.error(\"Erreur réseau :\", error);
                alert(\"Erreur de connexion au serveur.\");
            }
        }
    </script>
{% endblock %}", "users.html.twig", "/var/www/html/src/View/users.html.twig");
    }
}
