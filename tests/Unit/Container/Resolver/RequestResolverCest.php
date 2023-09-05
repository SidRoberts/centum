<?php

namespace Tests\Unit\Container\Resolver;

use Centum\Container\Exception\FileGroupNotFoundException;
use Centum\Http\Data;
use Centum\Http\File;
use Centum\Http\FileGroup;
use Centum\Http\Files;
use Centum\Http\Request;
use Centum\Router\Router;
use Tests\Support\Controllers\ParametersController;
use Tests\Support\Http\Forms\UploadForm;
use Tests\Support\UnitTester;

/**
 * @covers \Centum\Container\Resolver\RequestResolver
 */
class RequestResolverCest
{
    public function test(UnitTester $I): void
    {
        $container = $I->grabContainer();

        $router = new Router($container);

        $group = $router->group();

        $group->get("/", ParametersController::class, "requestFromContainer");

        $request = new Request("/");

        $response = $router->handle($request);

        $I->assertEquals(
            $request::class,
            $response->getContent()
        );
    }



    public function testFiles(UnitTester $I): void
    {
        $data = new Data([]);



        $fileGroup = new FileGroup("images");

        $file1 = new File("image1.png", "image/png", 123, "/tmp/php/php1aaa11", UPLOAD_ERR_OK);
        $file2 = new File("image2.png", "image/png", 456, "/tmp/php/php2aaa22", UPLOAD_ERR_OK);

        $fileGroup->add($file1);
        $fileGroup->add($file2);

        $files = new Files(
            [
                $fileGroup,
            ]
        );



        $form = $I->buildForm(UploadForm::class, $data, $files);

        $I->assertEquals(
            $fileGroup,
            $form->getImages()
        );
    }

    public function testFilesNotSet(UnitTester $I): void
    {
        $data  = new Data([]);
        $files = new Files();

        $I->expectFormThrowable(
            FileGroupNotFoundException::class,
            UploadForm::class,
            $data,
            $files
        );
    }
}
