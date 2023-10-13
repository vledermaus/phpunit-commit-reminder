<?php

declare(strict_types=1);

namespace Vledermaus\PHPUnitCommitReminder;

use CzProject\GitPhp\Git;
use CzProject\GitPhp\GitRepository;
use PHPUnit\Runner\Extension\Extension as ExtensionInterface;
use PHPUnit\Runner\Extension\Facade;
use PHPUnit\Runner\Extension\ParameterCollection;
use PHPUnit\TextUI\Configuration\Configuration;

final class Extension implements ExtensionInterface
{
    public function bootstrap(Configuration $configuration, Facade $facade, ParameterCollection $parameters): void
    {
        if ($configuration->noOutput() || empty($_SERVER['PWD']) || $configuration->noExtensions()) {
            return;
        }

        $printer = new Printer();
        if (is_null($repository = $this->getRepository())) {
            $printer->error('Could not find git repository.');

            return;
        }

        $application = new Application($printer, $repository);

        $facade->registerTracer(new Tracer($application));
    }

    private function getRepository(): ?GitRepository
    {
        try {
            $git = new Git();

            return $git->open($_SERVER['PWD']);
        } catch (\Exception $e) {
            return null;
        }
    }
}
