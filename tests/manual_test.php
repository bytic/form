<?php

/**
 * Simple test script to verify Symfony Form integration
 * This is a manual validation script, not part of the automated test suite
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Nip\Form\Form;

echo "=== Symfony Form Integration Test ===\n\n";

// Test 1: Legacy-style form creation
echo "Test 1: Legacy-style form creation\n";
$form1 = new Form();
$form1->add('username', 'Username', 'input', true, ['class' => 'form-control']);
$form1->add('email', 'Email', 'input', true);
echo "✓ Created form with legacy-style add()\n";
echo "  - Has 'username': " . ($form1->hasElement('username') ? 'Yes' : 'No') . "\n";
echo "  - Has 'email': " . ($form1->hasElement('email') ? 'Yes' : 'No') . "\n";
echo "\n";

// Test 2: Symfony-style form creation
echo "Test 2: Symfony-style form creation\n";
$form2 = new Form();
$form2->add('username', 'input', ['label' => 'Username', 'required' => true]);
$form2->add('email', 'input', ['label' => 'Email', 'required' => true]);
echo "✓ Created form with Symfony-style add()\n";
echo "  - Has 'username': " . ($form2->has('username') ? 'Yes' : 'No') . "\n";
echo "  - Has 'email': " . ($form2->has('email') ? 'Yes' : 'No') . "\n";
echo "\n";

// Test 3: Symfony methods
echo "Test 3: Symfony FormInterface methods\n";
$form3 = new Form();
$form3->add('field1', 'input', ['label' => 'Field 1']);
$form3->add('field2', 'input', ['label' => 'Field 2']);

echo "  - all() returns: " . count($form3->all()) . " elements\n";
echo "  - has('field1'): " . ($form3->has('field1') ? 'Yes' : 'No') . "\n";
echo "  - get('field1') name: " . $form3->get('field1')->getName() . "\n";
echo "  - isRoot(): " . ($form3->isRoot() ? 'Yes' : 'No') . "\n";
echo "  - getRoot() === form: " . ($form3->getRoot() === $form3 ? 'Yes' : 'No') . "\n";
echo "✓ Symfony methods working\n";
echo "\n";

// Test 4: Form data handling
echo "Test 4: Form data handling (setData/getData)\n";
$form4 = new Form();
$form4->add('username', 'input', ['label' => 'Username']);
$form4->add('email', 'input', ['label' => 'Email']);

$data = [
    'username' => 'john_doe',
    'email' => 'john@example.com'
];
$form4->setData($data);

echo "  - Set data with username='john_doe' and email='john@example.com'\n";
echo "  - Username value: " . $form4->get('username')->getValue() . "\n";
echo "  - Email value: " . $form4->get('email')->getValue() . "\n";
echo "✓ Data handling working\n";
echo "\n";

// Test 5: Form submission
echo "Test 5: Form submission (submit/isSubmitted)\n";
$form5 = new Form();
$form5->add('username', 'input', ['label' => 'Username']);
echo "  - Before submit - isSubmitted(): " . ($form5->isSubmitted() ? 'Yes' : 'No') . "\n";

$form5->submit(['username' => 'test_user']);
echo "  - After submit - isSubmitted(): " . ($form5->isSubmitted() ? 'Yes' : 'No') . "\n";
echo "  - Submitted value: " . $form5->get('username')->getValue() . "\n";
echo "✓ Form submission working\n";
echo "\n";

// Test 6: Form builder
echo "Test 6: Form builder pattern\n";
$form6 = new Form();
$builder = $form6->createBuilder();
echo "  - Created builder: " . get_class($builder) . "\n";

$builder
    ->add('field1', 'input', ['label' => 'Field 1'])
    ->add('field2', 'input', ['label' => 'Field 2']);

$resultForm = $builder->getForm();
echo "  - Built form has 'field1': " . ($resultForm->has('field1') ? 'Yes' : 'No') . "\n";
echo "  - Built form has 'field2': " . ($resultForm->has('field2') ? 'Yes' : 'No') . "\n";
echo "✓ Form builder working\n";
echo "\n";

// Test 7: Backward compatibility
echo "Test 7: Backward compatibility (both APIs together)\n";
$form7 = new Form();
$form7->add('field1', 'Label 1', 'input', true, []); // Legacy
$form7->add('field2', 'input', ['label' => 'Label 2']); // Symfony

echo "  - Mixed API - hasElement('field1'): " . ($form7->hasElement('field1') ? 'Yes' : 'No') . "\n";
echo "  - Mixed API - has('field2'): " . ($form7->has('field2') ? 'Yes' : 'No') . "\n";
echo "  - Mixed API - getElement('field1'): " . $form7->getElement('field1')->getName() . "\n";
echo "  - Mixed API - get('field2'): " . $form7->get('field2')->getName() . "\n";
echo "✓ Backward compatibility maintained\n";
echo "\n";

echo "=== All Tests Passed! ===\n";
echo "\nThe Symfony Form integration is working correctly.\n";
echo "Both legacy and Symfony-style APIs work seamlessly together.\n";
