<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\MacroNamespace;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Sandbox\SecurityNotAllowedTestError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* themes/custom/gamestore_pro/templates/layout/page.html.twig */
class __TwigTemplate_56dd8d0b8527b935eac4ac2e5c707225 extends Template
{
    private Source $source;
    /**
     * @var array<string, MacroNamespace>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        $this->sandbox = $env->getExtension(SandboxExtension::class)->getChecker();
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 7
        yield "<div class=\"gs-page\">

  <header class=\"gs-header\">
    <div class=\"gs-container gs-header__inner\">
      <a class=\"gs-brand\" href=\"";
        // line 11
        yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["front_page"] ?? null), "html", null, true);
        yield "\" rel=\"home\">
        <span class=\"gs-brand__mark\">G</span>
        <span class=\"gs-brand__name\">Game Store</span>
      </a>

      <nav class=\"gs-nav\" aria-label=\"Main\">
        ";
        // line 17
        yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 17), "html", null, true);
        yield "
      </nav>

      <div class=\"gs-account\">
        ";
        // line 21
        yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "secondary_menu", [], "any", false, false, true, 21), "html", null, true);
        yield "
        ";
        // line 22
        yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 22), "html", null, true);
        yield "
      </div>
    </div>
  </header>

  ";
        // line 27
        if ((((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "highlighted", [], "any", false, false, true, 27)) && $tmp instanceof Markup ? (string) $tmp : $tmp) || (($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumb", [], "any", false, false, true, 27)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) || (($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "help", [], "any", false, false, true, 27)) && $tmp instanceof Markup ? (string) $tmp : $tmp))) {
            // line 28
            yield "    <div class=\"gs-container gs-top\">
      ";
            // line 29
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumb", [], "any", false, false, true, 29), "html", null, true);
            yield "
      ";
            // line 30
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "highlighted", [], "any", false, false, true, 30), "html", null, true);
            yield "
      ";
            // line 31
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "help", [], "any", false, false, true, 31), "html", null, true);
            yield "
    </div>
  ";
        }
        // line 34
        yield "
  <main class=\"gs-main\">
    <a id=\"main-content\" tabindex=\"-1\"></a>
    <div class=\"gs-container gs-main__inner\">
      <div class=\"gs-content\">
        ";
        // line 39
        yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 39), "html", null, true);
        yield "
      </div>
      ";
        // line 41
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 41)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 42
            yield "        <aside class=\"gs-sidebar\">
          ";
            // line 43
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 43), "html", null, true);
            yield "
        </aside>
      ";
        }
        // line 46
        yield "    </div>
  </main>

  <footer class=\"gs-footer\">
    <div class=\"gs-container gs-footer__inner\">
      ";
        // line 51
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer", [], "any", false, false, true, 51)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 52
            yield "        ";
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer", [], "any", false, false, true, 52), "html", null, true);
            yield "
      ";
        } else {
            // line 54
            yield "        <p>&copy; ";
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
            yield " ";
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["site_name"] ?? null), "html", null, true);
            yield ". Games, consoles en accessoires.</p>
      ";
        }
        // line 56
        yield "    </div>
  </footer>

</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["front_page", "page", "site_name"]);        return; yield;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/custom/gamestore_pro/templates/layout/page.html.twig";
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
    public function getDefaultEscapeStrategy(): string|false
    {
        return "html";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  144 => 56,  136 => 54,  130 => 52,  128 => 51,  121 => 46,  115 => 43,  112 => 42,  110 => 41,  105 => 39,  98 => 34,  92 => 31,  88 => 30,  84 => 29,  81 => 28,  79 => 27,  71 => 22,  67 => 21,  60 => 17,  51 => 11,  45 => 7,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/custom/gamestore_pro/templates/layout/page.html.twig", "/var/www/html/web/themes/custom/gamestore_pro/templates/layout/page.html.twig");
    }
    
    public function ensureSecurityChecked(): void
    {
        if ($this->sandbox->isSandboxed($this->source)) {
            $this->checkSecurity();
        }
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 27];
        static $filters = ["escape" => 11, "date" => 54];
        static $functions = [];
        static $tests = [];

        try {
            $this->sandbox->checkSecurity(
                [0 => "if"],
                [0 => "escape", 1 => "date"],
                [],
                [],
                $this->source
            );
        } catch (SecurityError $e) {
            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            } elseif ($e instanceof SecurityNotAllowedTestError && isset($tests[$e->getTestName()])) {
                $e->setTemplateLine($tests[$e->getTestName()]);
            }

            throw $e;
        }

    }
}
