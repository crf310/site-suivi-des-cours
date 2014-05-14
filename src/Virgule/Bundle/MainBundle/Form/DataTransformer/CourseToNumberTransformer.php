<?php

namespace Virgule\Bundle\MainBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Virgule\Bundle\MainBundle\Entity\Course;

/**
 * Description of CourseToNumberTransformer
 *
 * @author guillaume
 */
class CourseToNumberTransformer implements DataTransformerInterface {

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
     * Transforms an object (course) to a string (number).
     *
     * @param  Student|null $issue
     * @return string
     */
    public function transform($course) {
        if (null === $course) {
            return "";
        }

        return $course->getId();
    }

    /**
     * Transforms a string (number) to an object (course).
     *
     * @param  string $number
     *
     * @return Course|null
     *
     * @throws TransformationFailedException if object (course) is not found.
     */
    public function reverseTransform($number) {
        if (!$number) {
            return null;
        }

        $course = $this->om
                ->getRepository('VirguleMainBundle:Course')
                ->findOneBy(array('id' => $number))
        ;

        if (null === $course) {
            throw new TransformationFailedException(sprintf(
                            'A course with ID "%s" does not exist!', $number
            ));
        }

        return $course;
    }

}