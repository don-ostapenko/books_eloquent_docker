<?php

namespace Tests\Unit;

use App\View\View;
use PHPUnit\Framework\TestCase;
use App\Support\Paths;

class ViewTest extends TestCase
{
    public function testThatViewWillReturnNeededString()
    {
        $view = new View(Paths::getTemplatePath());
        $result = $view->renderHtml('parts/header', ['title' => 'Foo Bar']);
        $this->assertStringContainsString('Foo Bar', $result);
    }
}