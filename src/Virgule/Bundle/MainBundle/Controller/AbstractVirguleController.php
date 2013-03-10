<?php
namespace Virgule\Bundle\MainBundle\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Description of VirguleController
 *
 * @author guillaume
 */
abstract class AbstractVirguleController extends Controller {
     
    protected function paginate($entities, $page=1) {
        $pagerfanta = new Pagerfanta(new ArrayAdapter($entities));
        $pagerfanta->setMaxPerPage($this->container->parameters['pager_nb_results']);

        try {
            $pagerfanta->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            throw new NotFoundHttpException();
        }

        return array('entities' => $pagerfanta);        
    }
    
    protected function getSelectedSemesterId()  {
        return $this->getRequest()->getSession()->get('currentSemester')->getId();
    }
    
    protected function getListBreak($count, $break=2) {
        return (int)($count / $break) + $count % $break;
    }
}

?>
