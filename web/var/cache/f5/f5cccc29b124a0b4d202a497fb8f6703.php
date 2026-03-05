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

/* Template/list_item.html.twig */
class __TwigTemplate_7a478d21ffe183f5ac4d4ac604034445 extends Template
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
        if (Twig\Extension\CoreExtension::testEmpty(($context["stores"] ?? null))) {
            // line 2
            yield "    <div class=\"col-span-full bg-white p-12 rounded-2xl text-center shadow-inner border-2 border-dashed border-gray-300\">
        <p class=\"text-xl text-gray-600 font-medium\">Aucun store trouvé pour votre recherche.</p>
    </div>
";
        } else {
            // line 6
            yield "    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["stores"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
                // line 7
                yield "        <li>
            <article>
                <a href=\"/store/";
                // line 9
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["store"], "id", [], "any", false, false, false, 9), "html", null, true);
                yield "\" class=\"group relative bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:scale-[1.03] hover:border-red-700 border-4 border-transparent block focus:ring-offset-4 focus:ring-offset-yellow-400\">

                    ";
                // line 12
                yield "                    <div class=\"w-full h-48 bg-gray-200 overflow-hidden\">
                        ";
                // line 13
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["store"], "photo", [], "any", false, false, false, 13)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 14
                    yield "                            <img src=\"";
                    yield (((Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["store"], "photo", [], "any", false, false, false, 14), 0, 5) == "data:")) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["store"], "photo", [], "any", false, false, false, 14), "html", null, true)) : ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(("data:image/jpeg;base64," . CoreExtension::getAttribute($this->env, $this->source, $context["store"], "photo", [], "any", false, false, false, 14)), "html", null, true)));
                    yield "\"
                                 alt=\"Façade du store ";
                    // line 15
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["store"], "nom", [], "any", false, false, false, 15), "html", null, true);
                    yield "\"
                                 class=\"w-full h-full object-cover transition-transform duration-500 group-hover:scale-110\">
                        ";
                } else {
                    // line 18
                    yield "                            <div class=\"w-full h-full flex items-center justify-center bg-gray-300\">
                                <span class=\"text-5xl\">🧱</span>
                            </div>
                        ";
                }
                // line 22
                yield "                    </div>

                    ";
                // line 25
                yield "                    <div class=\"p-6 space-y-3\">
                        <h3 class=\"font-bold text-2xl text-red-800 group-hover:text-red-700\">";
                // line 26
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["store"], "nom", [], "any", false, false, false, 26), "html", null, true);
                yield "</h3>
                        <div class=\"flex items-center gap-2 bg-gray-50 px-3 py-1 rounded-full w-fit border border-gray-200\">
                            <span class=\"text-xl font-black text-gray-700\">";
                // line 28
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["store"], "avis", [], "any", false, false, false, 28), "html", null, true);
                yield " / 5</span>
                            <span class=\"text-amber-500 text-2xl\">★</span>
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
        }
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "Template/list_item.html.twig";
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
        return array (  98 => 28,  93 => 26,  90 => 25,  86 => 22,  80 => 18,  74 => 15,  69 => 14,  67 => 13,  64 => 12,  59 => 9,  55 => 7,  50 => 6,  44 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% if stores is empty %}
    <div class=\"col-span-full bg-white p-12 rounded-2xl text-center shadow-inner border-2 border-dashed border-gray-300\">
        <p class=\"text-xl text-gray-600 font-medium\">Aucun store trouvé pour votre recherche.</p>
    </div>
{% else %}
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
                            <div class=\"w-full h-full flex items-center justify-center bg-gray-300\">
                                <span class=\"text-5xl\">🧱</span>
                            </div>
                        {% endif %}
                    </div>

                    {# Zone Détails #}
                    <div class=\"p-6 space-y-3\">
                        <h3 class=\"font-bold text-2xl text-red-800 group-hover:text-red-700\">{{ store.nom }}</h3>
                        <div class=\"flex items-center gap-2 bg-gray-50 px-3 py-1 rounded-full w-fit border border-gray-200\">
                            <span class=\"text-xl font-black text-gray-700\">{{ store.avis }} / 5</span>
                            <span class=\"text-amber-500 text-2xl\">★</span>
                        </div>
                    </div>
                </a>
            </article>
        </li>
    {% endfor %}
{% endif %}", "Template/list_item.html.twig", "/var/www/html/src/View/Template/list_item.html.twig");
    }
}
