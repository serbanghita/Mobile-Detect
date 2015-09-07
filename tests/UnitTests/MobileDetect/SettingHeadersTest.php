<?php
namespace MobileDetectTests\UnitTests\MobileDetect;

use MobileDetect\MobileDetect;

class SettingHeadersTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Setting a specific header known header is return by getHeader
     */
    public function testSettingASpecificHeaderKnownHeaderIsReturnByGetHeader()
    {
        $md = new MobileDetect();
        $md->setHeader('ua-cpu', 'ARM');
        $this->assertEquals('ARM', $md->getHeader('ua-cpu'));
    }


    /**
     * Setting an unknown header will throw an exception.
     * @expectedException \MobileDetect\Exception\InvalidArgumentException
     */
    public function testSettingAnUnknownHeaderWillThrowAnException()
    {
        $md = new MobileDetect();
        $md->setHeader('ua-wtf', 'Stuff');
    }

    /**
     * Trying to get a non-existent header will return NULL.
     */
    public function testTryingToGetANonExistentHeaderWillReturnNULL()
    {
        $md = new MobileDetect();
        $this->assertEquals(null, $md->getHeader('whatever-header'));
    }

    /**
     * setHeader sets and standardizes the name of the header
     */
    public function testSetHeaderSetsAndStandardizesTheNameOfTheHeader()
    {
        $detect = new MobileDetect();
        $detect->setHeader('Authorization', 'Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==');
        $detect->setHeader('Content-Type', 'application/x-www-form-urlencoded  ');
        $detect->setHeader('Warning', '199 Miscellaneous warning');

        $this->assertEquals($detect->getHeader('authorization'), 'Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ==');
        $this->assertEquals($detect->getHeader('content-type'), 'application/x-www-form-urlencoded');
        $this->assertEquals($detect->getHeader('warning'), '199 Miscellaneous warning');
    }
}