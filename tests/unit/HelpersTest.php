<?php

class HelpersTest extends TestCase
{

    public function __construct()
    {
        parent::__construct();
    }

    public function setUp()
    {

    }

    public function tearDown()
    {
    }

    public function testCommaListToArray()
    {
        $input    = '1,2, 3';
        $output   = commaListToArray($input);
        $expected = ['1', '2', '3'];

        $this->assertEquals($expected, $output);
    }

    public function testArrayToCommaList()
    {
        $input    = ['1', '2', '3'];
        $output   = arrayToCommaList($input);
        $expected = '1,2,3';

        $this->assertEquals($expected, $output);
    }

}
