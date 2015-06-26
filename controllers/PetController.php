<?php

/**
 * Description of PetController
 *
 * @author thymo
 */

namespace Menagerie;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DomainLayer\Form\Type\PetType;
use DomainLayer\Entity\Pet;

class PetController {

    public function createForm(Request $request, Application $app) {
        $pet = new Pet();
        $form = $app['form.factory']->createBuilder(new PetType(), $pet, ['csrf_protection' => false])->getForm(); 
        $form->handleRequest($request);
        
        if ('POST' == $request->getMethod()) {
            if ($form->isValid()) {
                try {
                    return ($app['domain.repository']['pet']->save($pet)) ? $app->redirect('/vendor/index.php/pet/create') :
                            $app->abort(404, 'operação abortada');
                } catch (Exception $e) {
                    $error[] = 'Erro ao persistir dados';
                }
            }
        }
        //mostra o formulário
        return $app['twig']->render('create.html', ['form' => $form->createView()]);
    }
    
    public function executeDeathAge(Application $app){
       $result = $app['domain.repository']['pet']->findDeathAge();
       return new Response(json_encode($result));
    }
    
    public function executeBirthdaysByMonth(Request $request, Application $app){
       $result = $app['domain.repository']['pet']->findBirthdaysByMonth($request->attributes->get('month'));
       return new Response(json_encode($result));
    }
}
