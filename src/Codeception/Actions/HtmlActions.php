<?php

namespace Centum\Codeception\Actions;

use Centum\Http\Data;
use Centum\Http\Method;
use Centum\Http\Request;
use Centum\Interfaces\Http\FilesInterface;
use Codeception\Exception\ModuleException;
use Exception;
use PHPUnit\Framework\Assert;
use Symfony\Component\DomCrawler\Crawler;

/**
 * HTML Actions
 */
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
     * @param array<non-empty-string, mixed> $data
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
        $method = mb_strtoupper($method);
        $method = Method::from($method);

        $data = new Data($data);

        $request = new Request($uri, $method, $data, null, null, $files);

        $this->handleRequest($request);
    }



    /**
     * @param non-empty-string $needle
     */
    public function see(string $needle): void
    {
        $textContent = $this->grabTextContent();

        Assert::assertStringContainsString($needle, $textContent);
    }

    /**
     * @param non-empty-string $needle
     */
    public function dontSee(string $needle): void
    {
        $textContent = $this->grabTextContent();

        Assert::assertStringNotContainsString($needle, $textContent);
    }



    /**
     * @param non-empty-string $needle
     */
    public function seeInSource(string $needle): void
    {
        $textContent = $this->grabResponseContent();

        Assert::assertStringContainsString($needle, $textContent);
    }

    /**
     * @param non-empty-string $needle
     */
    public function dontSeeInSource(string $needle): void
    {
        $textContent = $this->grabResponseContent();

        Assert::assertStringNotContainsString($needle, $textContent);
    }



    /**
     * @param non-empty-string $needle
     */
    public function seeInPageTitle(string $needle): void
    {
        Assert::assertStringContainsString(
            $needle,
            $this->grabPageTitle()
        );
    }

    /**
     * @param non-empty-string $needle
     */
    public function dontSeeInPageTitle(string $needle): void
    {
        Assert::assertStringNotContainsString(
            $needle,
            $this->grabPageTitle()
        );
    }

    /**
     * Grabs the page title from the `<title>` tag. If the title is not set, an
     * empty string will be returned.
     */
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
