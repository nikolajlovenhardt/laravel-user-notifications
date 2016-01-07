<?php

namespace LaravelUserNotificationsTest\Options;

use LaravelUserNotifications\Options\Options;
use PHPUnit_Framework_TestCase;

class OptionsTest extends PHPUnit_Framework_TestCase
{
    /** @var Options */
    protected $options;

    protected $demoOptions = [
        'a' => 'b',
        'c' => 'd',
    ];

    public function setUp()
    {
        $options = new Options($this->demoOptions);
        $this->options = $options;
    }

    public function testGetDefaults()
    {
        $result = $this->options->getDefaults();

        $this->assertSame([], $result);
    }

    public function testSetDefaults()
    {
        $defaults = [
            'a' => 'b'
        ];

        $this->options->setDefaults($defaults);
        $result = $this->options->getDefaults();

        $this->assertSame($defaults, $result);
    }

    public function testGetOptions()
    {
        $options = $this->demoOptions;

        $result = $this->options->getOptions();

        $this->assertSame($options, $result);
    }

    public function testSetOptions()
    {
        $newOptions = [
            'new' => 'options'
        ];

        $this->options->setOptions($newOptions);

        $result = $this->options->getOptions();

        $this->assertSame($newOptions, $result);
    }

    public function testGetOfNotExistingEntry()
    {
        $key = 'non-existing';

        $result = $this->options->get($key);

        $this->assertNull($result);
    }

    public function testGet()
    {
        $key = 'a';

        $result = $this->options->get($key);

        $this->assertSame($this->demoOptions[$key], $result);
    }

    public function testMergeAssociative()
    {
        $defaults = [
            'a' => [
                'b' => 'c'
            ],
            'c' => 'd',
        ];

        $options = [
            'a' => [
                'b' => 'd'
            ],
        ];

        $expected = [
            'a' => [
                'b' => 'd'
            ],
            'c' => 'd',
        ];

        $result = $this->options->mergeAssociative($defaults, $options);

        $this->assertSame($expected, $result);
    }
}