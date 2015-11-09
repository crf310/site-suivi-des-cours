<?php

namespace Virgule\Bundle\MainBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Student;

/**
 * Description of StudentToNumberTransformer
 *
 * @author guillaume
 */
class StudentToNumberTransformer implements DataTransformerInterface {

    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om) {
        $this->om = $om;
    }

    /**
     * Transforms an object (student) to a string (number).
     *
     * @param  Student|null $issue
     * @return string
     */
    public function transform($student) {
        if (null === $student) {
            return "";
        }

        return $student->getId();
    }

    /**
     * Transforms a string (number) to an object (student).
     *
     * @param  string $number
     *
     * @return Student|null
     *
     * @throws TransformationFailedException if object (student) is not found.
     */
    public function reverseTransform($number) {
        if (!$number) {
            return null;
        }

        $student = $this->om
                ->getRepository('VirguleMainBundle:Student')
                ->findOneBy(array('id' => $number))
        ;

        if (null === $student) {
            throw new TransformationFailedException(sprintf(
                            'A student with ID "%s" does not exist!', $number
            ));
        }

        return $student;
    }

}
