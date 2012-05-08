<?php

/**
 * Easy way to show FLASH messages
 * @author Junior GROSSI <juninhogr@gmail.com>
 * @link http://juniorgrossi.com
 * @version 0.5
 */
class FlashMessenger
{
    /**
     * ID for NOTICE messages 
     */
    const MESSAGE_NOTICE = 1;
    
    /**
     * ID for ERROR messages 
     */
    const MESSAGE_ERROR = 2;
    
    /**
     * ID for WARNING messages 
     */
    const MESSAGE_WARNING = 3;
    
    /**
     * Values for default classes
     * @var type 
     */
    protected $_classesNames = array(
        self::MESSAGE_NOTICE  => 'Notice',
        self::MESSAGE_ERROR   => 'Error',
        self::MESSAGE_WARNING => 'Warning',
    );
    
    /**
     * Instance for Singleton pattern
     * @var FlashMessenger 
     */
    protected static $_instance;
    
    /**
     * Default class name for rendering
     * @var string 
     */
    protected $_defaultClassName = 'flashMessenger';
    
    /**
     * Messages to be displayed
     * @var array 
     */
    protected $_messages = null;
    
    /**
     * Constructor method. Private for prevent new instance 
     */
    private function __construct()
    {
        @session_start();
    }
    
    /**
     * Preventing from clone
     * @return FlashMessenger 
     */
    public function __clone()
    {
        return self::getInstance();
    }
    
    /**
     * Singleton implementation
     * @return FlashMessenger 
     */
    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            $class = __CLASS__;
            self::$_instance = new $class();
        }
        return self::$_instance;
    }
    
    /**
     * Init function for initial logic
     * @param array $config 
     */
    public static function init(array $config = null)
    {
        $instance = self::getInstance();
        if (isset($config['defaultClassName'])) {
            $instance->_defaultClassName = $config['defaultClassName'];
        }
        $instance->_storeMessages();
    }
    
    /**
     * Return the class name (notice, error or warning)
     * @param integer $type
     * @return string 
     */
    protected function _getClassName($type)
    {
        $class = $this->_classesNames[$type];
        return $this->_defaultClassName . $class;
    }
    
    /**
     * Add a new flash messenger
     * @param string $message
     * @param int $type notice, error or warning
     */
    public static function addMessage($message, $type = self::MESSAGE_NOTICE)
    {
        $_SESSION['FlashMessenger'][$type] = $message;
    }
    
    /**
     * Remove messages from SESSION and store locally 
     */
    protected function _storeMessages()
    {
        if (isset($_SESSION['FlashMessenger'])) {
            $this->_messages = $_SESSION['FlashMessenger'];
            unset($_SESSION['FlashMessenger']);
        }
    }
    
    /**
     * Return the last message
     * @param int $type notice, error or warning
     * @return string 
     */
    public static function getMessage($type = self::MESSAGE_NOTICE)
    {
        $instance = self::getInstance();
        if (isset($instance->_messages[$type])) {
            return $instance->_messages[$type];
        }
    }
    
    /**
     * Echo the last message inside a div tag with custom class name
     * @param int $type 
     */
    public static function renderMessage($type = self::MESSAGE_NOTICE)
    {
        $instance = self::getInstance();
        $className = $instance->_getClassName($type);
        $message = self::getMessage($type);
        
        if (!empty($message)) {
            $template = sprintf('<div class="%s %s">%s</div>', $instance->_defaultClassName, $className, $message);
            echo $template;
        }
    }
    
}