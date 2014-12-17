<?php

namespace Pagekit\Component\Filesystem\Tests;

use Pagekit\Component\Filesystem\File;
use Pagekit\Component\Filesystem\FileLocator;

class FileLocatorTest extends \PHPUnit_Framework_TestCase
{
    protected $locator;

    public function setUp()
    {
        $this->locator = new FileLocator(__DIR__);
    }

    /**
     * @dataProvider dataGetPaths
     */
    public function testGet($path, $result, $exists)
    {
        $this->assertSame($exists, File::exists($result));
        $this->assertSame($result, $this->locator->get($path));
    }

    public function dataGetPaths()
    {
        $fixtures = __DIR__.'/Fixtures';

        return [
            ['Fixtures', $fixtures, true],
            ['/Fixtures', $fixtures, true],
            ['Fixtures/file1.txt', $fixtures.'/file1.txt', true],
            ['/Fixtures/file1.txt', $fixtures.'/file1.txt', true],
            ['Fixtures/file3.txt', false, false],
            ['/Fixtures/file3.txt', false, false]
        ];
    }

    public function testPathOverride()
    {
        $file = basename(__FILE__);

        $this->assertFalse($this->locator->get('Dir/'.$file));

        $this->locator->add('Dir', __DIR__);

        $this->assertSame(__FILE__, $this->locator->get('Dir/'.$file));
    }
}
