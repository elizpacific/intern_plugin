<?php

namespace Mageplaza\Payment\Model;

use Composer\Package\BasePackage;
use Composer\Package\PackageInterface;
use Composer\Repository\RepositoryInterface;
use Composer\Semver\Constraint\ConstraintInterface;
use JetBrains\PhpStorm\Internal\TentativeType;
use Magento\Store\Model\ScopeInterface;

class DefaultConfigProvider implements RepositoryInterface
{
    public function getConfig()
    {
        return [
            'foo' => [
                'bar' => 'data',
            ],
        ];

        return $config;
    }

    public function count(): int
    {
        // TODO: Implement count() method.
    }

    public function hasPackage(PackageInterface $package)
    {
        // TODO: Implement hasPackage() method.
    }

    public function findPackage($name, $constraint)
    {
        // TODO: Implement findPackage() method.
    }

    public function findPackages($name, $constraint = null)
    {
        // TODO: Implement findPackages() method.
    }

    public function getPackages()
    {
        // TODO: Implement getPackages() method.
    }

    public function loadPackages(array $packageNameMap, array $acceptableStabilities, array $stabilityFlags, array $alreadyLoaded = array())
    {
        // TODO: Implement loadPackages() method.
    }

    public function search($query, $mode = 0, $type = null)
    {
        // TODO: Implement search() method.
    }

    public function getProviders($packageName)
    {
        // TODO: Implement getProviders() method.
    }

    public function getRepoName()
    {
        // TODO: Implement getRepoName() method.
    }
}
