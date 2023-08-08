<?php

namespace Centum\Codeception\Actions;

use Centum\Http\Data;
use Centum\Http\Request;
use Centum\Interfaces\Http\FilesInterface;
use Codeception\Exception\ModuleException;
use Exception;
use PHPUnit\Framework\Assert;
use Symfony\Component\DomCrawler\Crawler;

trait HtmlActions
{
    abstract public function grabResponseContent(): string;



    public function grabTextContent(): string
    {
        $crawler = $this->getCrawler();

        if (!$crawler) {
            return "";
        }

        return $crawler->text();
    }



    /**
     * @param array<string, mixed> $data
     */
    public function submitForm(string $selector, array $data = [], FilesInterface $files = null): void
    {
        if (!$this->currentURI) {
            throw new ModuleException($this, "Page not loaded.");
        }

        $form = $this->grabElement($selector);

        if (!$form) {
            throw new Exception("no form");
        }

        /** @var array<array-key, array<string>> */
        $attributes = $form->extract(["action", "method"]);

        $uri = $attributes[0][0] ?: $this->currentURI;

        $method = $attributes[0][1] ?: "GET";
        $method = strtoupper($method);

        $data = new Data($data);

        $request = new Request($uri, $method, $data, null, null, $files);

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
        $crawler = $this->getCrawler();

        if (!$crawler) {
            return "";
        }

        $title = $crawler->filter("title");

        if ($title->count() === 0) {
            return "";
        }

        $title = $title->first()->html();

        return trim($title);
    }



    public function seeElement(string $selector): void
    {
        Assert::assertNotNull(
            $this->grabElement($selector)
        );
    }

    public function dontSeeElement(string $selector): void
    {
        Assert::assertNull(
            $this->grabElement($selector)
        );
    }

    public function grabElement(string $selector): Crawler|null
    {
        $crawler = $this->getCrawler();

        if (!$crawler) {
            return null;
        }

        $matches = $crawler->filter($selector);

        if ($matches->count() === 0) {
            return null;
        }

        return $matches->first();
    }



    protected function getCrawler(): Crawler|null
    {
        $content = $this->grabResponseContent();

        if (!$content) {
            return null;
        }

        $crawler = new Crawler($content);

        return $crawler;
    }
}
