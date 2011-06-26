<?php
/**
 * @license Copyright 2010 Robert Allen
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

define(
    'TESTS_FIXTURES_DIR',
    realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'fixtures/Jazsl/')
);
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(dirname(__FILE__) . '/../library'),
    get_include_path(),
)));
require_once 'Zend/Loader/Autoloader.php';
$loader = Zend_Loader_Autoloader::getInstance();
$loader->registerNamespace(array('PHPUnit_','Jazsl_'));

$testConfig = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'TestConfiguration.php';
if (is_readable($testConfig)) {
    require_once $testConfig;
} else {
    require_once $testConfig.'.default';
}

