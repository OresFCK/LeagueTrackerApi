<?php

namespace App\Api;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ApiSerializer extends Serializer {
    public function __construct()
    {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $encoders = [new JsonEncoder()];
        $metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);
        $normalizers = [new DateTimeNormalizer(), new ObjectNormalizer($classMetadataFactory, $metadataAwareNameConverter)];
        parent::__construct($normalizers, $encoders);
    }
}