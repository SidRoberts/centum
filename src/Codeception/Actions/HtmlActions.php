<?php

namespace Centum\Codeception\Actions;

use Centum\Http\Data;
use Centum\Http\Request;
use Codeception\Exception\ModuleException;
use DOMDocument;
use DOMElement;
use Exception;
use PHPUnit\Framework\Assert;

trait HtmlActions
{
    abstract public function grabResponseContent(): string;



    public function grabTextContent(): string
    {
        $domDocument = $this->getDomDocument();

        return $domDocument->textContent ?? "";
    }



    /**
     * @param array<string, mixed> $data
     */
    public function submitForm(string $id, array $data = []): void
    {
        if (!$this->currentURI) {
            throw new ModuleException($this, "Page not loaded.");
        }

        $currentURI = $this->currentURI;

        $form = $this->grabElement($id);

        if (!$form) {
            throw new Exception("no form");
        }

        $uri = $form->getAttribute("action") ?: $currentURI;

        $method = $form->getAttribute("method");
        $method = strtoupper($method) ?: "GET";

        $data = new Data($data);

        $request = new Request($uri, $method, $data);

        $this->handleRequest($request);
    }



    public function see(string $needle): void
    {
        $textContent = $this->grabTextContent();

        Assert::assertStringContainsString($needle, $textContent);
    }

    public function dontSee(string $needle): void
    {
        $textContent = $this->grabTextContent();

        Assert::assertStringNotContainsString($needle, $textContent);
    }



    public function seeInSource(string $needle): void
    {
        $textContent = $this->grabResponseContent();

        Assert::assertStringContainsString($needle, $textContent);
    }

    public function dontSeeInSource(string $needle): void
    {
        $textContent = $this->grabResponseContent();

        Assert::assertStringNotContainsString($needle, $textContent);
    }



    public function seeInPageTitle(string $needle): void
    {
        Assert::assertStringContainsString(
            $needle,
            $this->grabPageTitle()
        );
    }

    public function dontSeeInPageTitle(string $needle): void
    {
        Assert::assertStringNotContainsString(
            $needle,
            $this->grabPageTitle()
        );
    }

    public function grabPageTitle(): string
    {
        $domDocument = $this->getDomDocument();

        if (!$domDocument) {
            return "";
        }

        $titleElement = $domDocument->getElementsByTagName("title")->item(0);

        if (!$titleElement) {
            return "";
        }

        return trim($titleElement->textContent);
    }



    public function seeElement(string $id): void
    {
        Assert::assertNotNull(
            $this->grabElement($id)
        );
    }

    public function dontSeeElement(string $id): void
    {
        Assert::assertNull(
            $this->grabElement($id)
        );
    }

    public function grabElement(string $id): DOMElement|null
    {
        $domDocument = $this->getDomDocument();

        if (!$domDocument) {
            return null;
        }

        return $domDocument->getElementById($id);
    }



    protected function getDomDocument(): DOMDocument|null
    {
        $content = $this->grabResponseContent();

        if (!$content) {
            return null;
        }

        $domDocument = new DOMDocument();

        $domDocument->loadHTML($content);

        return $domDocument;
    }
}
