<?php
// Date + traduction twig
use Twig\Extra\Intl\IntlExtension;
require_once(ABSPATH . '/vendor/autoload.php');
/*$loader = new \Twig\Loader\FilesystemLoader(ABSPATH . '/views/twig');
$twig = new \Twig\Environment($loader, [
    'cache' => ABSPATH . '/twigcache'
]);
$twig->load('test.twig');
echo $twig->render('test.twig', ['firstname' => 'Pépino']);
die();*/
require_once ('functions/auth.php');
class View
{
    private $_file;
    private $_t;
    private $loader;
    private $twig;
    private $action;

    public function __construct($action)
    {
        $this->action = $action;
        $this->_file = 'views/view'.$action.'.twig';
        $this->loader = new \Twig\Loader\FilesystemLoader(ABSPATH . '/views');
        $this->twig = new \Twig\Environment($this->loader, [
            'cache' => false
        ]);
        $this->twig->addExtension(new IntlExtension());
        $this->twig->load('view'.$action.'.twig');


    }
    public function generate($data)
    {

        $user = getConnect();
        $data['url'] = 'http://localhost/Unlinkedout';
        if ( !empty($user)) {
            $data['idUser'] = $user->getID();
            $data['role']   = $user->getRole();
            $data['avatar'] = $user->getAvatar();
        }
        echo $this->twig->render('viewMenu.twig',$data);
        echo $this->twig->render('view'.$this->action.'.twig', $data);
      //  $content = $this->generateFile($this->_file,$data);
       // $view =$this->generateFile('views/template.php',array('t'=> $this->_t,'content'=> $content));
       // echo $view;
    }

    private function generateFile($file,$data)
    {
        if(file_exists($file))
        {
            extract($data);
            ob_start();
            require $file;
            return ob_get_clean();
        }
        else
            throw new Exception('Fichier '.$file.' introuvable');
    }
}