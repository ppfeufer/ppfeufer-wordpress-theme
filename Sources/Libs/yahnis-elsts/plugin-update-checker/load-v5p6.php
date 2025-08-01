<?php

namespace Ppfeufer\Theme\Ppfeufer\Libs\YahnisElsts\PluginUpdateChecker\v5p6;

use YahnisElsts\PluginUpdateChecker\v5\PucFactory as MajorFactory;
use Ppfeufer\Theme\Ppfeufer\Libs\YahnisElsts\PluginUpdateChecker\v5p6\PucFactory as MinorFactory;

require __DIR__ . '/Puc/v5p6/Autoloader.php';
new Autoloader();

require __DIR__ . '/Puc/v5p6/PucFactory.php';
require __DIR__ . '/Puc/v5/PucFactory.php';

//Register classes defined in this version with the factory.
foreach (
	array(
		'Plugin\\UpdateChecker' => Plugin\UpdateChecker::class,
		'Theme\\UpdateChecker'  => Theme\UpdateChecker::class,

		'Vcs\\PluginUpdateChecker' => Vcs\PluginUpdateChecker::class,
		'Vcs\\ThemeUpdateChecker'  => Vcs\ThemeUpdateChecker::class,

		'GitHubApi'    => Vcs\GitHubApi::class,
		'BitBucketApi' => Vcs\BitBucketApi::class,
		'GitLabApi'    => Vcs\GitLabApi::class,
	)
	as $pucGeneralClass => $pucVersionedClass
) {
	MajorFactory::addVersion($pucGeneralClass, $pucVersionedClass, '5.6');
	//Also add it to the minor-version factory in case the major-version factory
	//was already defined by another, older version of the update checker.
	MinorFactory::addVersion($pucGeneralClass, $pucVersionedClass, '5.6');
}

