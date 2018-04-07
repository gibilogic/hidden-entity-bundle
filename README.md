# GiBiLogic HiddenEntityBundle

A small bundle that contains a ready-to-use hidden entity form type for Symfony.

This is basically an hidden form type that's used to store an entity ID; a transformer will manage the ID-to-entity and entity-to-ID conversions by using the ObjectManager of Doctrine ORM.

## Installation

Add this bundle to the composer.json of your application with the console command:

```bash
composer require gibilogic/hidden-entity-bundle
```

Or, if you are using `composer.phar`, use the console command:

```bash
php composer.phar require gibilogic/hidden-entity-bundle
```

## Usage

Inside one of your form, simply add a new `hidden_entity` field to the builder:

```php
/**
 * {@inheritdoc}
 */
public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        // ..
        ->add('category', HiddenEntityType::class, [
            'required' => true,
            'class' => 'AppBundle:Category'
        ])
        // ..
    ;
}
```

The `class` options is mandatory and must contain your entity's class name (as shown in the example above).
