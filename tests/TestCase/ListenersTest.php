<?php
namespace Crud\Test\TestSuite;

use Cake\Core\Plugin;
use Cake\TestSuite\TestSuite;

class ListenersTest extends TestSuite
{

    public static function suite()
    {
        $suite = new TestSuite('All CRUD listener tests');

        $testPath = ROOT . DS . 'tests' . DS . 'TestCase';
        if (!is_dir($testPath)) {
            return $suite;
        }

        $suite->addTestDirectoryRecursive($testPath . DS . 'Listener');

        return $suite;
    }
}
