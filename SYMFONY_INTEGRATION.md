# Symfony Form Component Integration

This document describes the integration between Nip Form and Symfony Form Component, providing a compatibility layer that allows you to use Symfony Form APIs while maintaining backward compatibility with existing Nip Form code.

## Overview

The Nip Form library now includes a Symfony Form component compatibility layer that allows you to:

- Use Symfony FormInterface methods on Nip forms
- Use Symfony FormBuilder pattern for building forms
- Integrate with Symfony Form ecosystem
- Maintain 100% backward compatibility with existing code

## Installation

The Symfony Form component is already included in the dependencies:

```bash
composer require bytic/form
```

## Basic Usage

### Creating Forms (Backward Compatible)

The existing Nip Form API continues to work exactly as before:

```php
use Nip\Form\Form;

$form = new Form();
$form->add('username', 'Username', 'input', true);
$form->add('email', 'Email', 'input', true);
$form->add('password', 'Password', 'password', true);
```

### Creating Forms (Symfony Style)

The `add()` method now supports Symfony-style calling convention:

```php
use Nip\Form\Form;

$form = new Form();

// Symfony-style: add($name, $type, $options)
$form->add('username', 'input', ['label' => 'Username', 'required' => true]);
$form->add('email', 'input', ['label' => 'Email', 'required' => true]);
$form->add('password', 'password', ['label' => 'Password', 'required' => true]);

// Or use default type 'input'
$form->add('phone', null, ['label' => 'Phone Number']);
```

### Using the Form Builder Pattern

You can use the Symfony FormBuilder pattern:

```php
use Nip\Form\Form;

$form = new Form();
$builder = $form->createBuilder();

$builder
    ->add('username', 'input', ['label' => 'Username'])
    ->add('email', 'input', ['label' => 'Email'])
    ->add('password', 'password', ['label' => 'Password']);

// Get the form back
$builtForm = $builder->getForm();
```

## Symfony FormInterface Methods

The following Symfony FormInterface methods are now available on all forms:

### Element Management

```php
// Check if form has a field
if ($form->has('username')) {
    // Get a field
    $field = $form->get('username');
    
    // Remove a field
    $form->remove('username');
}

// Get all fields
$fields = $form->all();
```

### Data Handling

```php
// Set form data
$form->setData([
    'username' => 'john_doe',
    'email' => 'john@example.com'
]);

// Get form data
$data = $form->getData();

// Get normalized data
$normData = $form->getNormData();

// Get view data
$viewData = $form->getViewData();
```

### Form Submission

```php
// Submit form data
$form->submit($_POST);

// Check if form was submitted
if ($form->isSubmitted()) {
    // Check if form is valid
    if ($form->isValid()) {
        // Process form data
        $data = $form->getData();
    }
}

// Check if form is synchronized
if ($form->isSynchronized()) {
    // Form data is in sync
}
```

### Form Hierarchy

```php
// Check if form is root
if ($form->isRoot()) {
    // Get root form
    $root = $form->getRoot();
    
    // Get parent form (null for root)
    $parent = $form->getParent();
}
```

### Form Configuration

```php
// Get form configuration
$config = $form->getConfig();

// Get form type
$type = $config->getType();

// Get form options
$options = $config->getOptions();

// Check if option exists
if ($config->hasOption('required')) {
    $required = $config->getOption('required');
}
```

### Form Rendering

```php
// Create a form view for rendering
$view = $form->createView();

// In templates, you can still use the existing rendering system
echo $form->render();
```

## Service Provider Integration

The `FormServiceProvider` registers Symfony Form services in the container:

```php
use Nip\Form\FormServiceProvider;

// In your application bootstrap
$container->register(new FormServiceProvider());

// Access Symfony FormFactory
$formFactory = $container->get('form.factory');

// Access FormRegistry
$registry = $container->get('form.registry');

// Access Form Extensions
$extensions = $container->get('form.extensions');
```

## Backward Compatibility

All existing methods continue to work:

```php
$form = new Form();

// Old API - still works
$form->addElement($element);
$form->getElement('username');
$form->hasElement('username');
$form->removeElement('username');
$form->getElements();

// New Symfony API - also works
$form->add('username', 'input', []);
$form->get('username');
$form->has('username');
$form->remove('username');
$form->all();
```

## Migration Guide

### Gradual Migration

You can gradually migrate your codebase by using Symfony methods in new code while keeping existing code unchanged:

**Before:**
```php
$form->addElement($usernameElement);
if ($form->hasElement('username')) {
    $element = $form->getElement('username');
}
```

**After (Symfony style):**
```php
$form->add('username', 'input', []);
if ($form->has('username')) {
    $element = $form->get('username');
}
```

Both styles work and can coexist in the same codebase.

### Form Types

If you want to create reusable form types, you can extend `Symfony\Component\Form\AbstractType` (which `AbstractElement` already does):

```php
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'input')
            ->add('email', 'input')
            ->add('password', 'password');
    }
}
```

## Testing

Comprehensive integration tests are available in `tests/Integration/SymfonyIntegrationTest.php` that verify:

- All Symfony methods work correctly
- Backward compatibility is maintained
- Both APIs can be used together
- Data flow works as expected

Run tests with:

```bash
./vendor/bin/phpunit tests/Integration/SymfonyIntegrationTest.php
```

## Advanced Features

### Form Hierarchy

You can create nested forms using the parent/child relationship:

```php
$parentForm = new Form();
$childForm = new Form();

$childForm->setParent($parentForm);

// Check hierarchy
$childForm->isRoot(); // false
$childForm->getRoot(); // returns $parentForm
$childForm->getParent(); // returns $parentForm
```

### Form Options

Use the options system for configuration:

```php
$form->setOption('csrf_protection', true);
$form->setOption('csrf_field_name', '_token');

if ($form->getConfig()->hasOption('csrf_protection')) {
    $csrfProtection = $form->getConfig()->getOption('csrf_protection');
}
```

## Benefits

1. **Symfony Ecosystem Integration**: Use Symfony Form extensions, validators, and tools
2. **Backward Compatibility**: Existing code continues to work without changes
3. **Gradual Migration**: Migrate at your own pace
4. **Best Practices**: Follow Symfony Form component best practices
5. **Documentation**: Leverage extensive Symfony Form documentation
6. **Community**: Access to Symfony community and resources

## Limitations

This is an intermediary step. Some advanced Symfony Form features may not be fully supported yet:

- Form events (PRE_SUBMIT, POST_SUBMIT, etc.)
- Data transformers
- Form inheritance
- Embedded collections with prototypes

These features may be added in future versions.

## Next Steps

1. Start using Symfony methods in new code
2. Gradually refactor existing code when needed
3. Explore Symfony Form extensions
4. Create custom form types
5. Implement validators using Symfony Validator component

## Resources

- [Symfony Form Component Documentation](https://symfony.com/doc/current/components/form.html)
- [Symfony Form Types Reference](https://symfony.com/doc/current/reference/forms/types.html)
- [Nip Form Repository](https://github.com/bytic/form)

## Support

For issues or questions:

- Open an issue on [GitHub](https://github.com/bytic/form/issues)
- Check existing tests for usage examples
- Review Symfony Form component documentation
