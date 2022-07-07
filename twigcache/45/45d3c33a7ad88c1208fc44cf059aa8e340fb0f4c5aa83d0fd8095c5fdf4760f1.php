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

/* viewAccueil.php */
class __TwigTemplate_8c33d1fc4356f88cd8fe9d066180800a1a4ad161acd4464b3168e654c72d3c8b extends Template
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
        echo "<?php \$this->_t =\" post\";
echo '<h1>toto</h1>';
foreach (\$posts as \$p): ?>
<h2 class=\"title\"> <?= \$p->getTitle() ?> </h2>

<?php endforeach; ?>
";
    }

    public function getTemplateName()
    {
        return "viewAccueil.php";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "viewAccueil.php", "C:\\laragon\\www\\Unlinkedout\\views\\viewAccueil.php");
    }
}
