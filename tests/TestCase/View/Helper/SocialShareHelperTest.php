<?php

namespace SocialShare\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\Network\Request;
use Cake\View\View;
use SocialShare\View\Helper\SocialShareHelper;

class SocialShareHelperTest extends TestCase
{

    /**
     * @return void
     */
    public function testServices()
    {
        $SocialShare = new SocialShareHelper(new View);
        $result = $SocialShare->services();
        $this->assertNotEmpty($result);
    }

    /**
     * @return void
     */
    public function testIcon()
    {
        $SocialShare = new SocialShareHelper(new View);
        $icon = $SocialShare->icon('facebook');
        $expected = '<i class="fa fa-facebook"></i>';
        $this->assertSame($expected, $icon);
    }

    /**
     * @return void
     */
    public function testIconClassCanBeOverridden()
    {
        $SocialShare = new SocialShareHelper(new View);
        $expected = '<i class="fa fa-whatsapp-square"></i>';
        $icon = $SocialShare->icon('whatsapp', ['icon_class' => 'fa fa-whatsapp-square']);
        $this->assertSame($expected, $icon);
    }

    /**
     * @return void
     */
    public function testLinks()
    {
        $SocialShare = $this->getMockBuilder(SocialShareHelper::class)
            ->setMethods(['href'])
            ->setConstructorArgs([new View()])
            ->getMock();
        $SocialShare->expects($this->once())
            ->method('href')
            ->willReturn('https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fexample.com');

        $expected = '<a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fexample.com" target="_blank">Share</a>';
        $this->assertEquals(
            $expected,
            $SocialShare->link(
                'facebook',
                'Share',
                'http://example.com'
            )
        );
    }

    /**
     * @return void
     */
    public function testFa()
    {
        $SocialShare = $this->getMockBuilder(SocialShareHelper::class)
            ->setMethods(['href'])
            ->setConstructorArgs([new View()])
            ->getMock();
        $SocialShare->expects($this->once())
            ->method('href')
            ->willReturn('https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fexample.com');

        $expected = '<a href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fexample.com" target="_blank"><i class="fa fa-facebook"></i></a>';
        $this->assertEquals(
            $expected,
            $SocialShare->fa(
                'facebook',
                'http://example.com'
            )
        );
    }
}
