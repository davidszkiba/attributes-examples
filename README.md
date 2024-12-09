# Why?

Imagine you have a User class with a username field. Now, what if you want to ensure that:

  - The username is at least 3 characters long
  - Contains only letters and numbers
  - Is not empty

You could write this validation code directly in the class:

```php
class User {
    private string $username;

    public function setUsername(string $username) {
        if (empty($username)) {
            throw new ValidationException('Username cannot be empty');
        }
        if (strlen($username) < 3) {
            throw new ValidationException('Username must be at least 3 characters');
        }
        if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
            throw new ValidationException('Username can only contain letters and numbers');
        }
        $this->username = $username;
    }
}
```

But this has several problems:

  - The validation rules are buried in the code
  - They're mixed with the business logic
  - You need to write validation code for every property
  - It's hard to get an overview of all rules
  - You can't easily reuse these rules

What if instead you could write:

```php
class User {
    #[NotEmpty]
    #[MinLength(3)]
    #[Pattern('^[a-zA-Z0-9]+$')]
    private string $username;
}
```

This is:

  - Declarative - you say what you want, not how to do it
  - Visible at a glance
  - Reusable across different classes
  - Separate from your business logic
  - Easy to maintain and modify

This is where attributes come in - they let us add metadata to our code that can be used to automatically generate behavior :)

# Annotations vs Attributes

## Writing metadata

### The "old" way with annotations

```php
class User {
    /**
     * @NotEmpty
     * @MinLength(3)
     * @Pattern("^[a-zA-Z0-9]+$")
     */
    private string $username;
}
```

### The "new" way with attributes

```php
class User {
    #[NotEmpty]
    #[MinLength(3)]
    #[Pattern("^[a-zA-Z0-9]+$")]
    private string $username;
}
```

## Reading metadata

### Reading annotations (requires doctrine/annotations)

```php
use Doctrine\Common\Annotations\AnnotationReader;

$reader = new AnnotationReader();
$property = new ReflectionProperty(User::class, 'username');
$annotations = $reader->getPropertyAnnotations($property);

foreach ($annotations as $annotation) {
    // Annotation objects were created by parsing comments
    $annotation->validate($value);
}
```

### Reading attributes (built into PHP)

```php
$user = new User("john", "john@example.com", "password123");
$property = new ReflectionProperty(User::class, 'username');
$attributes = $property->getAttributes();

foreach ($attributes as $attribute) {
    $validator = $attribute->newInstance();
    $value = $property->getValue($user);  // Pass the instance here
    $validator->validate($value);
}
```

## Key takeaways annotations vs attributes


### For developers adding metadata:

 - Syntax is very similar
 - Both are declarative
 - Both achieve the same goal
 - Attributes are slightly more concise
 - Attributes get syntax highlighting and IDE support

### For framework/library developers:

 - Attributes are built into PHP - no external parser needed
 - No more parsing text from comments
 - Type-safe and validated at compile time
 - Better performance
 - Simpler implementation


# Examples

You can browse the code of this repository branch-by-branch:

 - Branch [01-single-attribute](https://github.com/davidszkiba/attributes-examples/tree/01-single-attribute) shows a minimal, simple example.
 - Branch [02-multiple-validators](https://github.com/davidszkiba/attributes-examples/tree/02-multiple-validators) adds new attributes
 - Branch [03-payment-processors-factory](https://github.com/davidszkiba/attributes-examples/tree/03-payment-processors-factory) shows how you can use attributes to create
a payment factory that automatically detects classes that provide payment
methods.
 - Branch [04-add-klarna](https://github.com/davidszkiba/attributes-examples/tree/04-add-klarna) shows how easy it is to add a new payment processor.

 # Resources

 - [General Reflection API documentation](https://www.php.net/manual/en/reflectionclass.construct.php)
 - [getAttributes documentation](https://www.php.net/manual/en/reflectionclass.getattributes.php)
