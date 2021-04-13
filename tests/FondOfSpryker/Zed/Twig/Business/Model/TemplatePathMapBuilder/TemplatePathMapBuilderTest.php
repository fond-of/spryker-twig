<?php

namespace FondOfSpryker\Zed\Twig\Business\Model\TemplatePathMapBuilder;

use Codeception\Test\Unit;
use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Twig\Business\Model\TemplatePathMapBuilder\TemplatePathMapBuilder as BaseTemplatePathMapBuilder;

class TemplatePathMapBuilderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Twig\Business\Model\TemplatePathMapBuilder\TemplatePathMapBuilder
     */
    protected $baseTemplatePathMapBuilderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Store
     */
    protected $storeMock;

    /**
     * @var \FondOfSpryker\Zed\Twig\Business\Model\TemplatePathMapBuilder\TemplatePathMapBuilder
     */
    protected $templatePathMapBuilder;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->baseTemplatePathMapBuilderMock = $this->getMockBuilder(BaseTemplatePathMapBuilder::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeMock = $this->getMockBuilder(Store::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->templatePathMapBuilder = new TemplatePathMapBuilder(
            $this->baseTemplatePathMapBuilderMock,
            $this->storeMock
        );
    }


    public function testBuild(): void
    {
        $templatePathMap = [
            '@ShopUi/packages/default/ProductWidget/views/catalog-product/catalog-product.twig'
                => '/var/www/spryker/releases/current/src/Pyz/Yves/ShopUi/Theme/foo/packages/default/ProductWidget/views/catalog-product/catalog-product.twig',
            '@Pyz:ShopUi/packages/default/ProductWidget/views/catalog-product/catalog-product.twig'
                => '/var/www/spryker/releases/current/src/Pyz/Yves/ShopUi/Theme/foo/packages/default/ProductWidget/views/catalog-product/catalog-product.twig',
            '@ShopUi/packages/FOO/ProductWidget/views/catalog-product/catalog-product.twig'
                => '/var/www/spryker/releases/current/src/Pyz/Yves/ShopUi/Theme/foo/packages/FOO/ProductWidget/views/catalog-product/catalog-product.twig',
            '@Pyz:ShopUi/packages/FOO/ProductWidget/views/catalog-product/catalog-product.twig'
                => '/var/www/spryker/releases/current/src/Pyz/Yves/ShopUi/Theme/foo/packages/FOO/ProductWidget/views/catalog-product/catalog-product.twig',
        ];

        $expectedTemplatePathMap = [
            '@ProductWidget/views/catalog-product/catalog-product.twig'
                => '/var/www/spryker/releases/current/src/Pyz/Yves/ShopUi/Theme/foo/packages/FOO/ProductWidget/views/catalog-product/catalog-product.twig',
            '@Pyz:ProductWidget/views/catalog-product/catalog-product.twig'
                => '/var/www/spryker/releases/current/src/Pyz/Yves/ShopUi/Theme/foo/packages/FOO/ProductWidget/views/catalog-product/catalog-product.twig',
        ];

        $this->storeMock->expects(static::atLeastOnce())
            ->method('getStoreName')
            ->willReturn('FOO');

        $this->baseTemplatePathMapBuilderMock->expects(static::atLeastOnce())
            ->method('build')
            ->willReturn($templatePathMap);

        static::assertEquals(
            $expectedTemplatePathMap,
            $this->templatePathMapBuilder->build()
        );
    }
}
