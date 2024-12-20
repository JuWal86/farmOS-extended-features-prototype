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

/* themes/gin/templates/navigation/toolbar--gin--secondary.html.twig */
class __TwigTemplate_197e96f3435169f15ea8075754430041 extends Template
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
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 23
        yield "
";
        // line 25
        if ((($_v0 = (($_v1 = $context) && is_array($_v1) || $_v1 instanceof ArrayAccess && in_array($_v1::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v1["#secondary"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, $context, "#secondary", [], "array", false, false, true, 25))) && is_array($_v0) || $_v0 instanceof ArrayAccess && in_array($_v0::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v0["tabs"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, (($_v2 = $context) && is_array($_v2) || $_v2 instanceof ArrayAccess && in_array($_v2::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v2["#secondary"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, $context, "#secondary", [], "array", false, false, true, 25)), "tabs", [], "array", false, false, true, 25))) {
            // line 26
            yield "  ";
            $context["tabs"] = (($_v3 = (($_v4 = $context) && is_array($_v4) || $_v4 instanceof ArrayAccess && in_array($_v4::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v4["#secondary"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, $context, "#secondary", [], "array", false, false, true, 26))) && is_array($_v3) || $_v3 instanceof ArrayAccess && in_array($_v3::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v3["tabs"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, (($_v5 = $context) && is_array($_v5) || $_v5 instanceof ArrayAccess && in_array($_v5::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v5["#secondary"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, $context, "#secondary", [], "array", false, false, true, 26)), "tabs", [], "array", false, false, true, 26));
        }
        // line 28
        if ((($_v6 = (($_v7 = $context) && is_array($_v7) || $_v7 instanceof ArrayAccess && in_array($_v7::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v7["#secondary"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, $context, "#secondary", [], "array", false, false, true, 28))) && is_array($_v6) || $_v6 instanceof ArrayAccess && in_array($_v6::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v6["trays"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, (($_v8 = $context) && is_array($_v8) || $_v8 instanceof ArrayAccess && in_array($_v8::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v8["#secondary"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, $context, "#secondary", [], "array", false, false, true, 28)), "trays", [], "array", false, false, true, 28))) {
            // line 29
            yield "  ";
            $context["trays"] = (($_v9 = (($_v10 = $context) && is_array($_v10) || $_v10 instanceof ArrayAccess && in_array($_v10::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v10["#secondary"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, $context, "#secondary", [], "array", false, false, true, 29))) && is_array($_v9) || $_v9 instanceof ArrayAccess && in_array($_v9::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v9["trays"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, (($_v11 = $context) && is_array($_v11) || $_v11 instanceof ArrayAccess && in_array($_v11::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v11["#secondary"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, $context, "#secondary", [], "array", false, false, true, 29)), "trays", [], "array", false, false, true, 29));
        }
        // line 31
        yield "
<div";
        // line 32
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", ["toolbar", "toolbar-secondary"], "method", false, false, true, 32), "setAttribute", ["id", "toolbar-administration-secondary"], "method", false, false, true, 32), 32, $this->source), "html", null, true);
        yield ">
  <nav";
        // line 33
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["toolbar_attributes"] ?? null), "addClass", ["toolbar-bar", "clearfix"], "method", false, false, true, 33), "setAttribute", ["id", "toolbar-bar"], "method", false, false, true, 33), 33, $this->source), "html", null, true);
        yield ">
    <h2 class=\"visually-hidden\">";
        // line 34
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["toolbar_heading"] ?? null), 34, $this->source), "html", null, true);
        yield "</h2>

    ";
        // line 36
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["tabs"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["tab"]) {
            // line 37
            yield "      ";
            $context["tray"] = (($_v12 = ($context["trays"] ?? null)) && is_array($_v12) || $_v12 instanceof ArrayAccess && in_array($_v12::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v12[$context["key"]] ?? null) : CoreExtension::getAttribute($this->env, $this->source, ($context["trays"] ?? null), $context["key"], [], "array", false, false, true, 37));
            // line 38
            yield "      ";
            $context["user_menu"] = (((($_v13 = CoreExtension::getAttribute($this->env, $this->source, ($context["tray"] ?? null), "links", [], "any", false, false, true, 38)) && is_array($_v13) || $_v13 instanceof ArrayAccess && in_array($_v13::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v13["user_links"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["tray"] ?? null), "links", [], "any", false, false, true, 38), "user_links", [], "array", false, false, true, 38))) ? ("user-menu") : (false));
            // line 39
            yield "      ";
            $context["item_id"] = [];
            // line 40
            yield "
      ";
            // line 41
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((($_v14 = (($_v15 = CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "link", [], "any", false, false, true, 41)) && is_array($_v15) || $_v15 instanceof ArrayAccess && in_array($_v15::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v15["#attributes"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "link", [], "any", false, false, true, 41), "#attributes", [], "array", false, false, true, 41))) && is_array($_v14) || $_v14 instanceof ArrayAccess && in_array($_v14::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v14["class"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, (($_v16 = CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "link", [], "any", false, false, true, 41)) && is_array($_v16) || $_v16 instanceof ArrayAccess && in_array($_v16::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v16["#attributes"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "link", [], "any", false, false, true, 41), "#attributes", [], "array", false, false, true, 41)), "class", [], "array", false, false, true, 41)));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 42
                yield "        ";
                if (CoreExtension::inFilter("icon-", $context["item"])) {
                    // line 43
                    yield "          ";
                    $context["item_id"] = Twig\Extension\CoreExtension::merge($this->sandbox->ensureToStringAllowed(($context["item_id"] ?? null), 43, $this->source), [("toolbar-id--" . $this->sandbox->ensureToStringAllowed($context["item"], 43, $this->source))]);
                    // line 44
                    yield "        ";
                }
                // line 45
                yield "      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['key'], $context['item'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 46
            yield "
      ";
            // line 47
            $context["tab_id"] = (((($_v17 = CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "link", [], "any", false, false, true, 47)) && is_array($_v17) || $_v17 instanceof ArrayAccess && in_array($_v17::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v17["#id"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "link", [], "any", false, false, true, 47), "#id", [], "array", false, false, true, 47))) ? (("toolbar-tab--" . $this->sandbox->ensureToStringAllowed((($_v18 = CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "link", [], "any", false, false, true, 47)) && is_array($_v18) || $_v18 instanceof ArrayAccess && in_array($_v18::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v18["#id"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "link", [], "any", false, false, true, 47), "#id", [], "array", false, false, true, 47)), 47, $this->source))) : (""));
            // line 48
            yield "      ";
            $context["tab_classes"] = Twig\Extension\CoreExtension::merge($this->sandbox->ensureToStringAllowed(($context["item_id"] ?? null), 48, $this->source), ["toolbar-tab", $this->sandbox->ensureToStringAllowed(($context["user_menu"] ?? null), 48, $this->source), $this->sandbox->ensureToStringAllowed(($context["tab_id"] ?? null), 48, $this->source)]);
            // line 49
            yield "
      ";
            // line 50
            $context["denylist_items"] = ["toolbar-id--toolbar-icon-menu"];
            // line 53
            yield "
      ";
            // line 55
            yield "      ";
            if (!CoreExtension::inFilter((($_v19 = ($context["item_id"] ?? null)) && is_array($_v19) || $_v19 instanceof ArrayAccess && in_array($_v19::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v19[0] ?? null) : CoreExtension::getAttribute($this->env, $this->source, ($context["item_id"] ?? null), 0, [], "array", false, false, true, 55)), ($context["denylist_items"] ?? null))) {
                // line 56
                yield "        <div";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "attributes", [], "any", false, false, true, 56), "addClass", [($context["tab_classes"] ?? null)], "method", false, false, true, 56), 56, $this->source), "html", null, true);
                if (CoreExtension::inFilter("tour-toolbar-tab", CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "attributes", [], "any", false, false, true, 56), "class", [], "any", false, false, true, 56))) {
                    yield " id=\"toolbar-tab-tour\"";
                }
                yield ">
          ";
                // line 57
                if (((($_v20 = ($context["item_id"] ?? null)) && is_array($_v20) || $_v20 instanceof ArrayAccess && in_array($_v20::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v20[0] ?? null) : CoreExtension::getAttribute($this->env, $this->source, ($context["item_id"] ?? null), 0, [], "array", false, false, true, 57)) == "toolbar-id--toolbar-icon-user")) {
                    // line 58
                    yield "            ";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["user_picture"] ?? null), 58, $this->source), "html", null, true);
                    yield "
          ";
                } else {
                    // line 60
                    yield "            ";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["tab"], "link", [], "any", false, false, true, 60), 60, $this->source), "html", null, true);
                    yield "
          ";
                }
                // line 62
                yield "          <div";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["tray"] ?? null), "attributes", [], "any", false, false, true, 62), 62, $this->source), "html", null, true);
                yield ">
            ";
                // line 63
                if (CoreExtension::getAttribute($this->env, $this->source, ($context["tray"] ?? null), "label", [], "any", false, false, true, 63)) {
                    // line 64
                    yield "              <nav class=\"toolbar-lining clearfix\" role=\"navigation\" aria-label=\"";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["tray"] ?? null), "label", [], "any", false, false, true, 64), 64, $this->source), "html", null, true);
                    yield "\">
                <h3 class=\"toolbar-tray-name visually-hidden\">";
                    // line 65
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["tray"] ?? null), "label", [], "any", false, false, true, 65), 65, $this->source), "html", null, true);
                    yield "</h3>
            ";
                } else {
                    // line 67
                    yield "              <nav class=\"toolbar-lining clearfix\" role=\"navigation\">
            ";
                }
                // line 69
                yield "            ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["tray"] ?? null), "links", [], "any", false, false, true, 69), 69, $this->source), "html", null, true);
                yield "
            </nav>
          </div>
        </div>
      ";
            }
            // line 74
            yield "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['key'], $context['tab'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
        yield "  </nav>
  ";
        // line 76
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["remainder"] ?? null), 76, $this->source), "html", null, true);
        yield "
</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["_context", "attributes", "toolbar_attributes", "toolbar_heading", "user_picture", "remainder"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/gin/templates/navigation/toolbar--gin--secondary.html.twig";
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
        return array (  190 => 76,  187 => 75,  181 => 74,  172 => 69,  168 => 67,  163 => 65,  158 => 64,  156 => 63,  151 => 62,  145 => 60,  139 => 58,  137 => 57,  129 => 56,  126 => 55,  123 => 53,  121 => 50,  118 => 49,  115 => 48,  113 => 47,  110 => 46,  104 => 45,  101 => 44,  98 => 43,  95 => 42,  91 => 41,  88 => 40,  85 => 39,  82 => 38,  79 => 37,  75 => 36,  70 => 34,  66 => 33,  62 => 32,  59 => 31,  55 => 29,  53 => 28,  49 => 26,  47 => 25,  44 => 23,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/gin/templates/navigation/toolbar--gin--secondary.html.twig", "/opt/drupal/web/themes/gin/templates/navigation/toolbar--gin--secondary.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 25, "set" => 26, "for" => 36);
        static $filters = array("escape" => 32, "merge" => 43);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set', 'for'],
                ['escape', 'merge'],
                [],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
