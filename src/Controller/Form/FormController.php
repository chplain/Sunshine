<?php

namespace App\Controller\Form;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\DomCrawler\Crawler;

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
     * @return \Symfony\Component\HttpFoundation\Response
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

    /**
     * 测试
     * @Route("/test", name="form_test")
     */
    public function formTest()
    {
        $htmlContent = '
         <form name="form_new" method="post" class="ui form form-horizontal">
            <div id="form-canvas" class="canvas ui grid ui-droppable ui-state-highlight">
                <div class="four column row">
                    <div class="column droppable ui-droppable ui-state-highlight">
                        <div>
                            <label for="form_1041261421" class="required">1041261421</label>
                            <input type="text" id="form_1041261421" name="form[1041261421]" required="required">
                        </div>
                    </div>
                    <div class="column droppable ui-droppable ui-state-highlight">
                        <div>
                            <label for="form_963218159" class="required">963218159</label>
                            <input type="text" id="form_963218159" name="form[963218159]" required="required">
                        </div>
                    </div>
                    <div class="column droppable ui-droppable ui-state-highlight">
                        <div>
                            <label for="form_1562378445" class="required">1562378445</label>
                            <input type="text" id="form_1562378445" name="form[1562378445]" required="required">
                        </div>
                    </div>
                    <div class="column droppable ui-droppable ui-state-highlight">
                        <div>
                            <label for="form_129652884" class="required">129652884</label>
                            <input type="text" id="form_129652884" name="form[129652884]" required="required">
                        </div>
                    </div>
                </div>
                <div class="one column row">
                    <div class="column droppable ui-droppable ui-state-highlight">
                        <div>
                            <label for="form_1648947770" class="required">1648947770</label>
                            <textarea id="form_1648947770" name="form[1648947770]" required="required"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        ';

        $crawler = new Crawler($htmlContent);
        $input = $crawler->filter('input');
        $textArea = $crawler->filter('textarea');
        foreach($input as $item) {
            dump($item->getAttribute("id"));
            dump($item->getAttribute("name"));
        }
        
        foreach($textArea as $item) {
            dump($item->getAttribute("id"));
        }

        return new Response("test");
    }
}
