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

/* login.html.twig */
class __TwigTemplate_6d118ecbf71cf7a8df2242ff41544d38 extends Template
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
    <title>Connexion - Lego App</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <script src=\"https://cdn.tailwindcss.com\"></script>
</head>

<body class=\"bg-yellow-400 min-h-screen flex items-center justify-center font-sans\">

<main class=\"w-full flex items-center justify-center p-4\">

    <section
            class=\"bg-white shadow-2xl rounded-2xl w-full max-w-md p-8 border-4 border-red-700\"
            aria-labelledby=\"login-title\"
    >

        <!-- Titre principal -->
        <header class=\"text-center mb-6\">
            <h1 id=\"login-title\" class=\"text-3xl font-extrabold text-red-700\">
                Connexion à votre espace LEGO
            </h1>
        </header>

        ";
        // line 26
        if (array_key_exists("error", $context)) {
            // line 27
            yield "            <div
                    class=\"bg-red-100 border-2 border-red-700 text-red-800 px-4 py-3 rounded-lg mb-4 text-sm\"
                    role=\"alert\"
                    aria-live=\"assertive\"
            >
                <strong>Erreur :</strong> ";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error"] ?? null), "html", null, true);
            yield "
            </div>
        ";
        }
        // line 35
        yield "
        <form action=\"/login\" method=\"POST\" novalidate class=\"space-y-6\">

            <!-- Email -->
            <div>
                <label
                        for=\"email\"
                        class=\"block text-sm font-bold text-gray-800 mb-2\"
                >
                    Adresse e-mail
                </label>

                <input
                        type=\"email\"
                        name=\"email\"
                        id=\"email\"
                        required
                        aria-required=\"true\"
                        autocomplete=\"email\"
                        class=\"w-full px-4 py-3 rounded-xl border-2 border-gray-500
                               focus:border-red-700 focus:ring-4 focus:ring-red-300
                               outline-none transition\"
                >
            </div>

            <!-- Mot de passe -->
            <div>
                <label
                        for=\"password\"
                        class=\"block text-sm font-bold text-gray-800 mb-2\"
                >
                    Mot de passe
                </label>

                <input
                        type=\"password\"
                        name=\"password\"
                        id=\"password\"
                        required
                        aria-required=\"true\"
                        autocomplete=\"current-password\"
                        class=\"w-full px-4 py-3 rounded-xl border-2 border-gray-500
                               focus:border-red-700 focus:ring-4 focus:ring-red-300
                               outline-none transition\"
                >
            </div>

            <!-- Bouton -->
            <button
                    type=\"submit\"
                    class=\"w-full bg-red-700 hover:bg-red-800
                           text-white font-bold py-3 rounded-xl shadow-lg
                           focus:outline-none focus:ring-4 focus:ring-yellow-300
                           transition\"
            >
                Se connecter
            </button>

        </form>

        <footer class=\"mt-6 text-center text-sm text-gray-700\">
            © 2026 Lego App
        </footer>

    </section>

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
        return "login.html.twig";
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
        return array (  84 => 35,  78 => 32,  71 => 27,  69 => 26,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <title>Connexion - Lego App</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <script src=\"https://cdn.tailwindcss.com\"></script>
</head>

<body class=\"bg-yellow-400 min-h-screen flex items-center justify-center font-sans\">

<main class=\"w-full flex items-center justify-center p-4\">

    <section
            class=\"bg-white shadow-2xl rounded-2xl w-full max-w-md p-8 border-4 border-red-700\"
            aria-labelledby=\"login-title\"
    >

        <!-- Titre principal -->
        <header class=\"text-center mb-6\">
            <h1 id=\"login-title\" class=\"text-3xl font-extrabold text-red-700\">
                Connexion à votre espace LEGO
            </h1>
        </header>

        {% if error is defined %}
            <div
                    class=\"bg-red-100 border-2 border-red-700 text-red-800 px-4 py-3 rounded-lg mb-4 text-sm\"
                    role=\"alert\"
                    aria-live=\"assertive\"
            >
                <strong>Erreur :</strong> {{ error }}
            </div>
        {% endif %}

        <form action=\"/login\" method=\"POST\" novalidate class=\"space-y-6\">

            <!-- Email -->
            <div>
                <label
                        for=\"email\"
                        class=\"block text-sm font-bold text-gray-800 mb-2\"
                >
                    Adresse e-mail
                </label>

                <input
                        type=\"email\"
                        name=\"email\"
                        id=\"email\"
                        required
                        aria-required=\"true\"
                        autocomplete=\"email\"
                        class=\"w-full px-4 py-3 rounded-xl border-2 border-gray-500
                               focus:border-red-700 focus:ring-4 focus:ring-red-300
                               outline-none transition\"
                >
            </div>

            <!-- Mot de passe -->
            <div>
                <label
                        for=\"password\"
                        class=\"block text-sm font-bold text-gray-800 mb-2\"
                >
                    Mot de passe
                </label>

                <input
                        type=\"password\"
                        name=\"password\"
                        id=\"password\"
                        required
                        aria-required=\"true\"
                        autocomplete=\"current-password\"
                        class=\"w-full px-4 py-3 rounded-xl border-2 border-gray-500
                               focus:border-red-700 focus:ring-4 focus:ring-red-300
                               outline-none transition\"
                >
            </div>

            <!-- Bouton -->
            <button
                    type=\"submit\"
                    class=\"w-full bg-red-700 hover:bg-red-800
                           text-white font-bold py-3 rounded-xl shadow-lg
                           focus:outline-none focus:ring-4 focus:ring-yellow-300
                           transition\"
            >
                Se connecter
            </button>

        </form>

        <footer class=\"mt-6 text-center text-sm text-gray-700\">
            © 2026 Lego App
        </footer>

    </section>

</main>

</body>
</html>", "login.html.twig", "/var/www/html/src/View/login.html.twig");
    }
}
