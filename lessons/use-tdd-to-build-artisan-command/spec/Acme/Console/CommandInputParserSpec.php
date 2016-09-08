<?php

namespace spec\Acme\Console;

use Acme\Console\CommandInput;
use Acme\Console\CommandInputParser;
use PhpSpec\ObjectBehavior;

class CommandInputParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CommandInputParser::class);
    }

    function it_returns_an_instance_of_command_input()
    {
        $this->parse('Foo/Bar/MyCommand', 'username, email')
            ->shouldBeAnInstanceOf(CommandInput::class);
    }

    function it_parses_the_name_of_the_class()
    {
        $input = $this->parse('Foo/Bar/MyCommand', 'username, email');

        $input->className->shouldBe('MyCommand');
    }

    function it_parses_the_namespace_of_the_class()
    {
        $input = $this->parse('Foo/Bar/MyCommand', 'username, email');

        $input->namespace->shouldBe('Foo\Bar');
    }

    function it_parses_the_properties_of_the_class()
    {
        $input = $this->parse('Foo/Bar/MyCommand', 'username, email');

        $input->properties->shouldBe(['username', 'email']);
    }
}
