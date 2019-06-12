<?php

namespace App\Serializer;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Serializer\Mapping\Loader\LoaderChain;
use Symfony\Component\Serializer\Mapping\Loader\YamlFileLoader;

//use chain loader to read and load an entier directory
class SerializerLoader extends LoaderChain
{
    public function __construct(string $directory, Finder $finder)
    {
        $loaders = $this->generateLoaders($directory, $finder);
        parent::__construct($loaders);
    }

    private function generateLoaders($directory, $finder)
    {
        $finder->in($directory)->files()->name('*.yaml');

        $loaders = [];
        foreach ($finder as $file) {
            $loader = new YamlFileLoader($file->getRealPath());
            $loaders[] = $loader;
        }

        return $loaders;
    }
}

/**
 services:
  serializer.serializer_file_loader:
    class: Datto\BcdrAPI\Serializer\YamlDirectoryLoader
    arguments:
      - "%kernel.root_dir%/config/serializer"

  serializer.metadata_factory:
    class: Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory
    arguments:
      - '@serializer.serializer_file_loader'

  serializer.entity_normalizer:
    class: Symfony\Component\Serializer\Normalizer\ObjectNormalizer
    arguments:
      - '@serializer.metadata_factory'

  serialzer.entity.get_set_normalizer:
    class: Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer
    arguments:
      - '@serializer.metadata_factory'



    namespace Datto\BcdrAPI\Serializer;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Serializer\Mapping\ClassMetadataInterface;
use Symfony\Component\Serializer\Mapping\Loader\LoaderInterface;
use Symfony\Component\Serializer\Mapping\Loader\YamlFileLoader;

class YamlDirectoryLoader implements LoaderInterface
{
    private $loaders;

    public function __construct(string $directory)
    {
        $finder = new Finder();

        $finder->in($directory)->files()->name('*.yml');

        foreach ($finder as $file) {
            $loader = new YamlFileLoader($file->getRealPath());
            $this->loaders[] = $loader;
        }
    }

    public function loadClassMetadata(ClassMetadataInterface $metadata)
    {
        $success = false;

        foreach ($this->loaders as $loader) {
            $success = $loader->loadClassMetadata($metadata) || $success;
        }

        return $success;
    }
*/
