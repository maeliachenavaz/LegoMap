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

/* pdf/store_export.html.twig */
class __TwigTemplate_3cfa5fb5f12e0f89c05cab06ae6c289a extends Template
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
<html>
<head>
    <meta charset=\"UTF-8\">
    <style>
        body { font-family: sans-serif; color: #333; }
        .header { background: #b91c1c; color: white; padding: 20px; text-align: center; }
        .content { padding: 30px; }
        .store-name { color: #b91c1c; font-size: 28px; border-bottom: 2px solid #eee; }
        .info-grid { margin-top: 20px; width: 100%; }
        .info-grid td { padding: 10px; border-bottom: 1px solid #eee; }
        .label { font-weight: bold; color: #666; text-transform: uppercase; font-size: 12px; }
        .photo { width: 100%; max-height: 300px; object-fit: cover; margin-bottom: 20px; }
    </style>
</head>
<body>
<div class=\"header\">
    <h1>LEGO Map - Fiche Boutique</h1>
</div>

<div class=\"content\">
    ";
        // line 22
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 22)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 23
            yield "        <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "photo", [], "any", false, false, false, 23), "html", null, true);
            yield "\" class=\"photo\" alt=\"photo de la boutique\">
    ";
        }
        // line 25
        yield "
    <h2 class=\"store-name\">";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "nom", [], "any", false, false, false, 26), "html", null, true);
        yield "</h2>
    <p>";
        // line 27
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "description", [], "any", false, false, false, 27), "html", null, true);
        yield "</p>

    <table class=\"info-grid\">
        <tr>
            <td class=\"label\">Ouverture</td>
            <td>";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "date", [], "any", false, false, false, 32), "html", null, true);
        yield "</td>
        </tr>
        <tr>
            <td class=\"label\">Note Client</td>
            <td>";
        // line 36
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "avis", [], "any", false, false, false, 36), "html", null, true);
        yield " / 5</td>
        </tr>
        <tr>
            <td class=\"label\">Contact</td>
            <td>";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "contactNom", [], "any", false, false, false, 40), "html", null, true);
        yield " (";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, ($context["store"] ?? null), "contactEmail", [], "any", false, false, false, 40), "html", null, true);
        yield ")</td>
        </tr>
        <tr>
            <td class=\"label\">Adresse</td>
            <td style=\"font-size: 14px; line-height: 1.4;\">
                ";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["address"] ?? null), "html", null, true);
        yield "
            </td>
        </tr>
    </table>
</div>
</body>
</html>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "pdf/store_export.html.twig";
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
        return array (  112 => 45,  102 => 40,  95 => 36,  88 => 32,  80 => 27,  76 => 26,  73 => 25,  67 => 23,  65 => 22,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\">
    <style>
        body { font-family: sans-serif; color: #333; }
        .header { background: #b91c1c; color: white; padding: 20px; text-align: center; }
        .content { padding: 30px; }
        .store-name { color: #b91c1c; font-size: 28px; border-bottom: 2px solid #eee; }
        .info-grid { margin-top: 20px; width: 100%; }
        .info-grid td { padding: 10px; border-bottom: 1px solid #eee; }
        .label { font-weight: bold; color: #666; text-transform: uppercase; font-size: 12px; }
        .photo { width: 100%; max-height: 300px; object-fit: cover; margin-bottom: 20px; }
    </style>
</head>
<body>
<div class=\"header\">
    <h1>LEGO Map - Fiche Boutique</h1>
</div>

<div class=\"content\">
    {% if store.photo %}
        <img src=\"{{ store.photo }}\" class=\"photo\" alt=\"photo de la boutique\">
    {% endif %}

    <h2 class=\"store-name\">{{ store.nom }}</h2>
    <p>{{ store.description }}</p>

    <table class=\"info-grid\">
        <tr>
            <td class=\"label\">Ouverture</td>
            <td>{{ store.date }}</td>
        </tr>
        <tr>
            <td class=\"label\">Note Client</td>
            <td>{{ store.avis }} / 5</td>
        </tr>
        <tr>
            <td class=\"label\">Contact</td>
            <td>{{ store.contactNom }} ({{ store.contactEmail }})</td>
        </tr>
        <tr>
            <td class=\"label\">Adresse</td>
            <td style=\"font-size: 14px; line-height: 1.4;\">
                {{ address }}
            </td>
        </tr>
    </table>
</div>
</body>
</html>", "pdf/store_export.html.twig", "/var/www/html/src/View/pdf/store_export.html.twig");
    }
}
