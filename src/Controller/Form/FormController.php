<?php

namespace App\Controller\Form;

use App\Entity\Form\Attribute;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\DomCrawler\Crawler;
use App\Entity\Form\Form;
use App\Component\Attribute\AttributeValueInterface;
use App\Entity\Admin\Options;
use App\Component\Templates\Generator\Generator;

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

        $id = time();
        $formFull = $this->createFormBuilder()->add($id, $typeClass)->getForm();
        $form = $formFull->get($id);
        return $this->render("form/form/type.html.twig", ['formView' => $form->createView()]);
    }

    /**
     * 通过Ajax提交创建的表单
     * @Route("/ajax/save", options={"expose"=true}, name="form_save")
     * @param Request $request
     * @return JsonResponse
     */
    public function saveForm(Request $request)
    {
        $json = $request->getContent();
        $em = $this->getDoctrine()->getManager();
        $optionsRepo = $em->getRepository(Options::class);

        if ($json) {
            $formHtml = json_decode($json, true);
            $formName = $formHtml['formName'];

            $form = new Form();
            $form->setName($formName);
            $em->persist($form);

            $crawler = new Crawler($formHtml['content']);

            $generator = new Generator("hello");

            $input = $crawler->filter('.form-field');
            $position = 0;
            foreach ($input as $item) {
                $position++;
                $fieldType = $item->nodeName;
                $fieldId = $item->getAttribute("id");
                $field = $item->getAttribute("fieldName");
                $fieldName = $item->getAttribute("field-name");
                $code = substr($fieldId, -10);

                dump(
                    "form name: ".$formName
                    . " field id(name): ".$fieldId
                    ." code: ".$code
                    ." field name: ".$field
                    ." field-name: ".$item->getAttribute("field-name")
                    ." field type: ". $fieldType
                    ." position: " . $position
                );

                if ($fieldType === 'input') {
                    $typeName = AttributeValueInterface::FORM_TEXT;
                    $storageType = AttributeValueInterface::STORAGE_TEXT;
                }

                $type = $optionsRepo->findOneBy(["displayName" => $typeName]);

                $attribute = new Attribute();
                $attribute->setName($fieldName)
                    ->setCode($code)
                    ->setType($type)
                    ->setStorageType($storageType)
                    ->setPosition($position)
                    ->setForm($form)
                ;

                $em->persist($attribute);
            }

            $em->flush();
        }

        $response  = ['status' => 'true'];
        return new JsonResponse($response);
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
                            <label for="form_677097963" class="required">677097963</label>
                            <input type="text" id="form_677097963" name="form[677097963]" required="required" class="form-field">
                        </div>
                        <div class="column droppable ui-droppable ui-state-highlight">
                            <label for="form_390814800" class="required">390814800</label>
                            <input type="text" id="form_390814800" name="form[390814800]" required="required" class="form-field">
                        </div>
                        <div class="column droppable ui-droppable ui-state-highlight">
                            <label for="form_40293422" class="required">40293422</label>
                            <input type="text" id="form_40293422" name="form[40293422]" required="required" class="form-field">
                        </div>
                        <div class="column droppable ui-droppable ui-state-highlight">
                            <label for="form_1935527140" class="required">1935527140</label>
                            <input type="text" id="form_1935527140" name="form[1935527140]" required="required" class="form-field">
                        </div>
                    </div>
                    <div class="one column row">
                        <div class="column droppable ui-droppable ui-state-highlight">
                            <label for="form_2028165558" class="required">2028165558</label>
                            <textarea id="form_2028165558" name="form[2028165558]" required="required" class="form-field"></textarea>
                        </div>
                    </div>
                    <div class="two column row">
                        <div class="column droppable ui-droppable ui-state-highlight">
                            <label for="form_854522251" class="required">854522251</label>
                            <input type="text" id="form_854522251" name="form[854522251]" required="required" class="form-field">
                        </div>
                        <div class="column droppable ui-droppable ui-state-highlight">
                            <label for="form_1675967255" class="required">1675967255</label>
                            <input type="text" id="form_1675967255" name="form[1675967255]" required="required" class="form-field">
                        </div>
                    </div>
                    <div class="one column row">
                        <div class="column droppable ui-droppable ui-state-highlight">
                            <label for="form_485221642" class="required">485221642</label>
                            <textarea id="form_485221642" name="form[485221642]" required="required" class="form-field"></textarea>
                        </div>
                    </div>
                </div>
            </form>
        ';

        $crawler = new Crawler($htmlContent);
        $input = $crawler->filter('.form-field');
        foreach ($input as $item) {
            dump($item->getAttribute("id"));
            dump($item->getAttribute("name"));
        }
        return new Response("test");
    }
}
