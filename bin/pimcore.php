#!/usr/bin/env php
<?php
/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Enterprise License (PEL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     GPLv3 and PEL
 */

use Pimcore\Cli\Command;
use Pimcore\Cli\Console\Application;
use Stecman\Component\Symfony\Console\BashCompletion\CompletionCommand;

// only run on PHP >= 7.1
$requiredVersion = '7.1';
if (version_compare(PHP_VERSION, $requiredVersion, '<')) {
    file_put_contents('php://stderr', sprintf(
        "Pimcore CLI Tools require PHP 7.1 version or higher. Your current PHP version is: %s\n",
        PHP_VERSION
    ));

    exit(1);
}

// CLI has no memory/time limits
@ini_set('memory_limit', -1);
@ini_set('max_execution_time', -1);
@ini_set('max_input_time', -1);

require_once __DIR__ . '/../vendor/autoload.php';

$application = new Application('Pimcore CLI Tools');
$application->addCommands([
    new CompletionCommand(),
    new Command\VersionCommand(),
    new Command\SelfUpdateCommand(),
    new Command\Config\DebugModeCommand(),
    new Command\Pimcore5\MigrationCheatsheetCommand(),
    new Command\Pimcore5\CheckRequirementsCommand(),
    new Command\Pimcore5\MigrateFilesystemCommand(),
    new Command\Pimcore5\MigrateAreabrickCommand(),
    new Command\Pimcore5\UpdateDbReferencesCommand(),
    new Command\Pimcore5\RenameViewsCommand(),
    new Command\Pimcore5\ProcessViewsCommand(),
    new Command\Pimcore5\ProcessControllersCommand(),
    new Command\Pimcore5\FixConfigCommand(),
]);

$application->run();
