<?php

namespace Nip\Form\Tests\Integration;

use Nip\Form\Form;
use Nip\Form\Tests\AbstractTest;

/**
 * Test Symfony Form Component Integration
 *
 * These tests verify that our forms work with Symfony Form component APIs
 * while maintaining backward compatibility with the existing Nip Form API.
 */
class SymfonyIntegrationTest extends AbstractTest
{
    /**
     * Test that forms support Symfony's all() method
     */
    public function testAllMethodReturnsElements()
    {
        $form = new Form();
        $form->add('username', 'Username', 'input');
        $form->add('email', 'Email', 'input');

        $elements = $form->all();

        $this->assertIsArray($elements);
        $this->assertCount(2, $elements);
        $this->assertTrue($form->has('username'));
        $this->assertTrue($form->has('email'));
    }

    /**
     * Test that forms support Symfony's has() method
     */
    public function testHasMethodChecksElementExistence()
    {
        $form = new Form();
        $form->add('username', 'Username', 'input');

        $this->assertTrue($form->has('username'));
        $this->assertFalse($form->has('password'));
    }

    /**
     * Test that forms support Symfony's get() method
     */
    public function testGetMethodReturnsElement()
    {
        $form = new Form();
        $form->add('username', 'Username', 'input');

        $element = $form->get('username');

        $this->assertNotNull($element);
        $this->assertEquals('username', $element->getName());
    }

    /**
     * Test that forms support Symfony's remove() method
     */
    public function testRemoveMethodRemovesElement()
    {
        $form = new Form();
        $form->add('username', 'Username', 'input');
        $form->add('email', 'Email', 'input');

        $this->assertTrue($form->has('username'));
        
        $form->remove('username');

        $this->assertFalse($form->has('username'));
        $this->assertTrue($form->has('email'));
    }

    /**
     * Test Symfony's getData() and setData() methods
     */
    public function testGetDataAndSetData()
    {
        $form = new Form();
        $form->add('username', 'Username', 'input');
        $form->add('email', 'Email', 'input');

        $data = [
            'username' => 'john_doe',
            'email' => 'john@example.com',
        ];

        $form->setData($data);

        $this->assertEquals('john_doe', $form->get('username')->getValue());
        $this->assertEquals('john@example.com', $form->get('email')->getValue());
    }

    /**
     * Test Symfony's submit() method
     */
    public function testSubmitMethod()
    {
        $form = new Form();
        $form->add('username', 'Username', 'input');
        $form->add('email', 'Email', 'input');

        $this->assertFalse($form->isSubmitted());

        $submittedData = [
            'username' => 'jane_doe',
            'email' => 'jane@example.com',
        ];

        $form->submit($submittedData);

        $this->assertTrue($form->isSubmitted());
        $this->assertEquals('jane_doe', $form->get('username')->getValue());
        $this->assertEquals('jane@example.com', $form->get('email')->getValue());
    }

    /**
     * Test Symfony's isRoot() and getRoot() methods
     */
    public function testIsRootAndGetRoot()
    {
        $form = new Form();
        
        $this->assertTrue($form->isRoot());
        $this->assertSame($form, $form->getRoot());
        $this->assertNull($form->getParent());
    }

    /**
     * Test Symfony's getConfig() method
     */
    public function testGetConfigMethod()
    {
        $form = new Form();
        $config = $form->getConfig();

        $this->assertNotNull($config);
        // Config should return the form itself for our implementation
        $this->assertSame($form, $config);
    }

    /**
     * Test Symfony's createView() method
     */
    public function testCreateViewMethod()
    {
        $form = new Form();
        $view = $form->createView();

        // For backward compatibility, createView returns the form itself
        $this->assertNotNull($view);
    }

    /**
     * Test createBuilder() method returns a builder adapter
     */
    public function testCreateBuilderMethod()
    {
        $form = new Form();
        $builder = $form->createBuilder();

        $this->assertInstanceOf(\Nip\Form\Adapter\SymfonyFormBuilderAdapter::class, $builder);
    }

    /**
     * Test that builder can add fields fluently
     */
    public function testBuilderFluentInterface()
    {
        $form = new Form();
        $builder = $form->createBuilder();

        $builder
            ->add('username', 'input', [])
            ->add('email', 'input', [])
            ->add('password', 'password', []);

        $resultForm = $builder->getForm();

        $this->assertTrue($resultForm->has('username'));
        $this->assertTrue($resultForm->has('email'));
        $this->assertTrue($resultForm->has('password'));
    }

    /**
     * Test backward compatibility - existing API still works
     */
    public function testBackwardCompatibilityWithExistingAPI()
    {
        $form = new Form();
        
        // Old API should still work
        $form->add('username', 'Username', 'input', true, ['value' => 'test']);

        $this->assertTrue($form->hasElement('username'));
        $this->assertNotNull($form->getElement('username'));
        
        // New Symfony-compatible API should also work
        $this->assertTrue($form->has('username'));
        $this->assertNotNull($form->get('username'));
    }
}
