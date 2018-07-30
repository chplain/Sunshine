<?php

namespace App\Component\Templates\Generator;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * Reference from SensioGeneratorBundle and MakeBundle, Thank you all:)
 * 参考了 SensioGeneratorBundle 和 MakeBundle，谢谢你们:)
 */
class Generator implements GeneratorInterface
{
    private $formName;
    private $skeletonDirs;
    private $rootDir;

    /**
     * 构造器
     *
     * @param String $formName 表单名称
     */
    public function __construct($formName, $rootDir)
    {
        $this->formName = $formName;
        $this->rootDir = $rootDir;

        dump($this->formName);
        dump($this->rootDir);
    }

    /**
     * Render temlpate with parameter
     * 用指定参数渲染模板
     */
    protected function render($template, $parameter)
    {
        $twig = $this->getTwigEnvironment();

        return $twig->render($template, $parameter);
    }

    /**
     * Render template with parameter to target file
     * 用指定参数渲染模板到目标文件
     */
    protected function renderFile($template, $target, $parameters)
    {
        return $this->generate($target, $this->render($template, $parameters));
    }

    /**
     * Create the specific directory
     * 创建指定的目录
     */
    public function generate($target, $content)
    {
        $fs = new Filesystem();
        $path = dirname($target);
        if (!$fs->exists($path)) {
            try {
                $fs->mkdir($path);
            } catch (IOExceptionInterface $e) {
                return new \Exception("An error occurred while creating your directory at ".$e->getPath());
            }
        }

        $fs->dumpFile($target, $content);
    }

    /**
     * Gets the twig environment that will render skeletons.
     *
     * @return \Twig_Environment
     */
    protected function getTwigEnvironment()
    {
        return new \Twig_Environment(new \Twig_Loader_Filesystem($this->skeletonDirs), array(
            'debug' => true,
            'cache' => false,
            'strict_variables' => true,
            'autoescape' => false,
        ));
    }
}
