<?php

namespace App\Component\Templates\Generator;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * Reference from SensioGeneratorBundle and MakeBundle, Thank you all:)
 * 参考了 SensioGeneratorBundle 和 MakeBundle，谢谢你们:)
 */
class Generator extends GeneratorInterface
{
    private $fileManager;

    public function generate(): void
    {
        
    }

    /**
     * Render temlpate with parameter
     * 用指定参数渲染模板
     */
    protected function render($template, $parameter)
    {
        $twig = $this->getTwigEnviroment();

        return $twig->render($template, $parameter);
    }

    /**
     * Render template with parameter to target file
     * 用指定参数渲染模板到目标文件
     */
    protected function renderFile($template, $target, $parameters)
    {
        self::mkdir(dirname($target));
        return self::dump($target, $this->render($template, $parameters));
    }

    /**
     * Create the specific directory
     * 创建指定的目录
     */
    protected static function mkdir($dir): void
    {
        $fs = new Filesystem();
        if (!$fs->exists($fullPath)) {
            try {
                $fs->mkdir($fullPath);
            } catch (IOExceptionInterface $e) {
                echo "An error occurred while creating your directory at ".$e->getPath();
            }
        }
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
