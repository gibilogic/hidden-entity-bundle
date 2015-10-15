<?php

/**
 * @package     Gibilogic\HiddenEntityBundle
 * @subpackage  Form\DataTransformer
 * @author      GiBiLogic <info@gibilogic.com>
 * @authorUrl   http://www.gibilogic.com
 */

namespace Gibilogic\HiddenEntityBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * EntityToIdTransformer class.
 *
 * @see \Symfony\Component\Form\DataTransformerInterface
 */
class EntityToIdTransformer implements DataTransformerInterface
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager $objectManager
     */
    protected $objectManager;

    /**
     * @var string $class
     */
    protected $class;

    /**
     * Constructor.
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $objectManager
     * @param string $class
     */
    public function __construct(ObjectManager $objectManager, $class)
    {
        $this->objectManager = $objectManager;
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($entity)
    {
        if (null === $entity) {
            return null;
        }

        return $entity->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($id)
    {
        if (!$id) {
            return null;
        }

        $entity = $this->objectManager->getRepository($this->class)->find($id);
        if (null === $entity) {
            throw new TransformationFailedException();
        }

        return $entity;
    }
}
