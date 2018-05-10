<?php

namespace App\Controller\Form;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Class FormController
 * @package App\Controller\Form
 *
 * @Route("form")
 */
class FormController extends Controller
{
    /**
     * @Route("/new", name="form_form")
     */
    public function index()
    {
        return $this->render('form/form/index.html.twig', [
            'controller_name' => 'FormController',
        ]);
    }

    /**
     * FormType 渲染的 html
     *
     * @Route("/ajax/gethtml/{type}", options={"expose"=true}, name="form_html")
     * @param $type
     * @return  Symfony\Component\HttpFoundation\Response
     */
    public function formTypeHtml($type)
    {
        switch ($type) {
            case "Text":
                $typeClass = TextType::class;
                break;
            case "TextArea":
                $typeClass = TextareaType::class;
                break;
        }

        $id = mt_rand();
        $formFull = $this->createFormBuilder()->add($id, $typeClass)->getForm();
        $form = $formFull->get($id);
        return $this->render("form/form/type.html.twig", ['formView' => $form->createView()]);
    }
}
