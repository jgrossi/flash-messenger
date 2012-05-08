FlashMessenger
==============

A simple PHP class to render flash messenger in a easy way

Basic Usage
-----------

    <?php
    
    require_once 'lib/FlashMessenger.php';
    FlashMessenger::init();

    /*
     * Your logic here
     */

    FlashMessenger::addMessage('Comment successfully approved!');
    // here you can redirect to a success page
    
    FlashMessenger::renderMessage(); // echo <div class="flashMessenger flashMessengerNotice">Comment successfully approved!</div>


Messages Type
-------------
    
### Options

You can add custom message types. Acctually the class supports NOTICE, ERROR and WARNING messages.

    FlashMessenger::addMessage('Comment not saved. Try again later.', FlashMessenger::MESSAGE_ERROR);
    FlashMessenger::addMessage('Warning message here', FlashMessenger::MESSAGE_WARNING);

Remember you must set the message you want to render:

    FlashMessenger::renderMessage(FlashMessenger::MESSAGE_ERROR); // display error messages
    FlashMessenger::renderMessage(FlashMessenger::MESSAGE_WARNING); // display warning messages


Custom Class Name
-----------------

You can set your custom class name using the init method.

    require_once 'lib/FlashMessenger.php';
    FlashMessenger::init(array(
      'defaultClassName' => 'myClassName'
    ));

This code will render the div tag with custom class:
    
    // this will echo <div class="myClassName myClassNameNotice">YOUR MESSAGE HERE</div>
    FlashMessenger::renderMessage();
      
      
      
      
      
      