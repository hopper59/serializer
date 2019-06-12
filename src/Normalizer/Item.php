<?php

namespace App\Normalizer;

use App\Entity\Item as EntityItem;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class Item implements NormalizerInterface, DenormalizerInterface
{
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return $this->normalizer->denormalize(data, $class, $format, $context);
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return false;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        if ($object->isInStock()) {
            return $this->normalizer->normalize($object, $format, $context);
        }
        return null;
    }

    public function supportsNormalization($data, $format = null)
    {
        return ($data instanceOf EntityItem);
    }
}
