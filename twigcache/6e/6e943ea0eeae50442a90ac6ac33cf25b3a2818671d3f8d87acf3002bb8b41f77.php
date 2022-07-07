<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* test.twig */
class __TwigTemplate_03389fce71e5b92b576f427bc0e88cf317cebd8cd0224feac6db83e6da29d6ec extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\">
    <title> <?= \$t ?> </title>
</head>
<header>

</header>
<body>
<p>Prénom: ";
        // line 11
        echo twig_escape_filter($this->env, ($context["firstname"] ?? null), "html", null, true);
        echo "</p>
</body>
<footer>

</footer>
</html>
";
    }

    public function getTemplateName()
    {
        return "test.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 11,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "test.twig", "C:\\laragon\\www\\Unlinkedout\\views\\twig\\test.twig");
    }
}
