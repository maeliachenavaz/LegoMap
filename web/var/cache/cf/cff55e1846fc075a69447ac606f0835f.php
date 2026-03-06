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

/* user_form.html.twig */
class __TwigTemplate_3f899298e52851a6e0e27060389a9d43 extends Template
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
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield " - LEGO Map</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <script src=\"https://cdn.tailwindcss.com\"></script>
    <style>
        /* Focus visible pour la navigation au clavier */
        *:focus-visible {
            outline: 3px solid #1a365d !important;
            outline-offset: 2px;
        }
    </style>
</head>
<body class=\"bg-yellow-400 min-h-screen font-sans text-gray-900\">

<main class=\"max-w-md mx-auto mt-20 px-4\" role=\"main\">
    <div class=\"bg-white p-8 rounded-2xl shadow-2xl border-4 border-red-800\">
        <h1 class=\"text-2xl font-black text-red-800 mb-6\">";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield "</h1>

        ";
        // line 22
        if (array_key_exists("error", $context)) {
            // line 23
            yield "            <div class=\"bg-red-50 border-l-4 border-red-700 text-red-900 px-4 py-3 rounded mb-6\" role=\"alert\">
                <p class=\"font-bold\">Erreur :</p>
                <p>";
            // line 25
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error"] ?? null), "html", null, true);
            yield "</p>
            </div>
        ";
        }
        // line 28
        yield "
        <form method=\"POST\" class=\"space-y-5\">
            <input type=\"hidden\" name=\"csrf_token\" value=\"";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["csrf_token"] ?? null), "html", null, true);
        yield "\">

            <div>
                <label for=\"name\" class=\"block font-bold text-gray-900 mb-1\">Nom complet</label>
                <input type=\"text\" id=\"name\" name=\"name\"
                       value=\"";
        // line 35
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "name", [], "any", true, true, false, 35) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "name", [], "any", false, false, false, 35)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "name", [], "any", false, false, false, 35), "html", null, true)) : (""));
        yield "\" required
                       aria-required=\"true\"
                       class=\"w-full p-3 border-2 border-gray-400 rounded-xl focus:border-red-700 outline-none transition-colors\">
            </div>

            <div>
                <label for=\"email\" class=\"block font-bold text-gray-900 mb-1\">Adresse Email</label>
                <input type=\"email\" id=\"email\" name=\"email\"
                       value=\"";
        // line 43
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "email", [], "any", true, true, false, 43) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "email", [], "any", false, false, false, 43)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["user"] ?? null), "email", [], "any", false, false, false, 43), "html", null, true)) : (""));
        yield "\" required
                       aria-required=\"true\"
                       class=\"w-full p-3 border-2 border-gray-400 rounded-xl focus:border-red-700 outline-none transition-colors\">
            </div>

            ";
        // line 48
        if ((($tmp =  !($context["user"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 49
            yield "                <div>
                    <label for=\"password\" class=\"block font-bold text-gray-900 mb-1\">Mot de passe</label>
                    <input type=\"password\" id=\"password\" name=\"password\"
                           required aria-required=\"true\"
                           class=\"w-full p-3 border-2 border-gray-400 rounded-xl focus:border-red-700 outline-none transition-colors\">
                    <p class=\"text-sm text-gray-600 mt-1\">Le mot de passe doit contenir au moins 8 caractères.</p>
                </div>
            ";
        } else {
            // line 57
            yield "                <div class=\"bg-blue-50 p-3 rounded-lg border border-blue-200\">
                    <p class=\"text-sm text-blue-800\">Laissez les champs tels quels pour conserver les informations actuelles.</p>
                </div>
            ";
        }
        // line 61
        yield "
            <div class=\"flex flex-col sm:flex-row gap-4 pt-4\">
                <button type=\"submit\"
                        class=\"flex-1 bg-red-800 text-white font-black py-3 rounded-xl hover:bg-red-900 transition shadow-md focus:ring-4 focus:ring-red-400\">
                    Enregistrer
                </button>
                <a href=\"/users\"
                   class=\"flex-1 bg-gray-200 text-gray-900 text-center py-3 rounded-xl font-bold hover:bg-gray-300 transition border-2 border-transparent\">
                    Annuler <span class=\"sr-only\">et revenir à la liste</span>
                </a>
            </div>
        </form>
    </div>
</main>

</body>
</html>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "user_form.html.twig";
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
        return array (  132 => 61,  126 => 57,  116 => 49,  114 => 48,  106 => 43,  95 => 35,  87 => 30,  83 => 28,  77 => 25,  73 => 23,  71 => 22,  66 => 20,  48 => 5,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>{{ title }} - LEGO Map</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <script src=\"https://cdn.tailwindcss.com\"></script>
    <style>
        /* Focus visible pour la navigation au clavier */
        *:focus-visible {
            outline: 3px solid #1a365d !important;
            outline-offset: 2px;
        }
    </style>
</head>
<body class=\"bg-yellow-400 min-h-screen font-sans text-gray-900\">

<main class=\"max-w-md mx-auto mt-20 px-4\" role=\"main\">
    <div class=\"bg-white p-8 rounded-2xl shadow-2xl border-4 border-red-800\">
        <h1 class=\"text-2xl font-black text-red-800 mb-6\">{{ title }}</h1>

        {% if error is defined %}
            <div class=\"bg-red-50 border-l-4 border-red-700 text-red-900 px-4 py-3 rounded mb-6\" role=\"alert\">
                <p class=\"font-bold\">Erreur :</p>
                <p>{{ error }}</p>
            </div>
        {% endif %}

        <form method=\"POST\" class=\"space-y-5\">
            <input type=\"hidden\" name=\"csrf_token\" value=\"{{ csrf_token }}\">

            <div>
                <label for=\"name\" class=\"block font-bold text-gray-900 mb-1\">Nom complet</label>
                <input type=\"text\" id=\"name\" name=\"name\"
                       value=\"{{ user.name ?? '' }}\" required
                       aria-required=\"true\"
                       class=\"w-full p-3 border-2 border-gray-400 rounded-xl focus:border-red-700 outline-none transition-colors\">
            </div>

            <div>
                <label for=\"email\" class=\"block font-bold text-gray-900 mb-1\">Adresse Email</label>
                <input type=\"email\" id=\"email\" name=\"email\"
                       value=\"{{ user.email ?? '' }}\" required
                       aria-required=\"true\"
                       class=\"w-full p-3 border-2 border-gray-400 rounded-xl focus:border-red-700 outline-none transition-colors\">
            </div>

            {% if not user %}
                <div>
                    <label for=\"password\" class=\"block font-bold text-gray-900 mb-1\">Mot de passe</label>
                    <input type=\"password\" id=\"password\" name=\"password\"
                           required aria-required=\"true\"
                           class=\"w-full p-3 border-2 border-gray-400 rounded-xl focus:border-red-700 outline-none transition-colors\">
                    <p class=\"text-sm text-gray-600 mt-1\">Le mot de passe doit contenir au moins 8 caractères.</p>
                </div>
            {% else %}
                <div class=\"bg-blue-50 p-3 rounded-lg border border-blue-200\">
                    <p class=\"text-sm text-blue-800\">Laissez les champs tels quels pour conserver les informations actuelles.</p>
                </div>
            {% endif %}

            <div class=\"flex flex-col sm:flex-row gap-4 pt-4\">
                <button type=\"submit\"
                        class=\"flex-1 bg-red-800 text-white font-black py-3 rounded-xl hover:bg-red-900 transition shadow-md focus:ring-4 focus:ring-red-400\">
                    Enregistrer
                </button>
                <a href=\"/users\"
                   class=\"flex-1 bg-gray-200 text-gray-900 text-center py-3 rounded-xl font-bold hover:bg-gray-300 transition border-2 border-transparent\">
                    Annuler <span class=\"sr-only\">et revenir à la liste</span>
                </a>
            </div>
        </form>
    </div>
</main>

</body>
</html>", "user_form.html.twig", "/var/www/html/src/View/user_form.html.twig");
    }
}
