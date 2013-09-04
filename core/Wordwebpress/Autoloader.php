<?php
/**
 *
 * @author    Welington Sampaio { @link http://welington.zaez.net/ }
 * @category  Wordwebpress
 * @package   Wordwebpress
 * @license   http://w2p.zaez.net/license
 * @version   1.0
 */

/**
 * Loader for autoloading classes
 * 
 * @author Welington Sampaio { @link http://welington.zaez.net/ }
 * @since 0.2
 *
 */
class Wordwebpress_Autoloader
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
    	spl_autoload_register(array($this, 'autoload'));
    }

    /**
     * Autoloads a class
     *
     * This method aims to load files and classes as soon as possible, so no additional
     * checks occur - e.g. whether or not the file exists nor whether or not the class
     * exists in the file.
     *
     * @param string $class
     * @return bool
     */
    public function autoload($class)
    {
        // E.g. "Wordwebpress_Core" --> "Wordwebpress/Core.php"
        $file = __FILE__;
        $path = realpath(dirname(__FILE__).'/../');
        $filename = str_replace(array('_', '\\'), DIRECTORY_SEPARATOR, $class) . '.php';
        
        if ( file_exists( W2P_CORE_PATH . DIRECTORY_SEPARATOR . $filename ) )
        {
        	$isLoaded = true;
        	include_once W2P_CORE_PATH . DIRECTORY_SEPARATOR . $filename;
        }
        return (false !== $isLoaded);
    }
}