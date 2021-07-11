# PHPDataSecurity
PHPDataSecurity is a modified version of the Saturn Security System (https://github.com/lmwnweb/saturn).

## How to use PHPDataSecurity
If you're connecting to PHPDataSecurity from the root folder, use:
```php
<?php
  include __DIR__.'/PHPDataSecurity/main.php';
?>
```
If you're connecting to PHPDataSecurity from a sub-folder, you'll need to include some `/../` depending on how deep in sub-folders the file is.
```php
<?php
  include __DIR__.'/../PHPDataSecurity/main.php';
?>
```
To check if it's connected, you can assign the `$pdsConnectCheck` variable and set it to true.
```php
<?php
  $pdsConnectCheck = true;
  include __DIR__.'/../PHPDataSecurity/main.php';
?>
```

## How to use Input Checking

Input checking is carried out by a PHP function built into Saturn, simply send the variable used to hold the data through the function, and it's result will be checked and cleaned. See out the example below to learn how to integrate Input Checking into your plugin or theme.
```php
<?php
  $userInput = $_POST['input'];
  $secureInput = checkData('DEFAULT', $userInput);
  unset($userInput);
?>
```
Here's a brief explaination of what's going on at Line 3:
$secureInput is your new, checked and cleaned input ready to interface with the rest of the program.
$secureInput = checkInput('DEFAULT', $userInput); is the function.
DEFAULT is the function's mode, see the next section for more modes and what they do.
$userInput is the input that needs to be cleaned and checked.

### Always Blocked
Certain elements are always blocked regardless of the mode selected.
- External CSS via <link> and @import are disabled.
- External <script> tags are disabled.
- PHP and SQL Commands are disabled.
- Access to external CSS and JS is availiable in the Administration panel.

### Modes

**DEFAULT (Recommended)**
  
`$secureInput = checkData('DEFAULT', $userInput);`
  
Allows No Code.
  
*Block All is the default mode. This blocks SQL Injection, Cross-site Scripting, HTML Code Injection, CSS Code Injection, JS Code Injection and PHP Code Injection. Rich Text Editors may run into issues using this mode. We highly recommend using this mode when sanitising plain text inputs such as logins, forms and more that do not require rich text editors or HTML content to pass through.*
  
  
**HTML**
  
`$secureInput = checkData('HTML', $userInput);`
  
Allows HTML.
  
*Sometimes, inputs require HTML such as rich text editors. This mode allows HTML to pass through, but not JavaScript and CSS. JavaScript and CSS are both still disabled. Plain text editors (<textarea> <input> for names, emails, passwords, etc.) should use Block All unless they specificially require HTML content to pass through.*
  
  
**CSS**
  
`$secureInput = checkData('CSS', $userInput);`
  
Allows HTML and CSS.
  
*As well as allowing HTML, this mode also enables CSS in the document.*

  
**TAGCSS**
  
`$secureInput = checkData('TAGCSS', $userInput);`
  
Allows HTML and Tagged CSS.
  
*Allows HTML tags to contain tag-specific CSS (eg. <span style="color:blue;">) but disallow the use of <style> tags.*
  
**JS**
  
`$secureInput = checkData('JS', $userInput);`
  
Allows HTML and JavaScript.
  
*As well as allowing HTML, this mode also enables inline JavaScript, external JavaScript is blocked.*

**ALL**
  
`$secureInput = checkData('ALL', $userInput);`
  
Allows HTML, CSS, Tagged CSS and JavaScript.
  
*Allows all server-safe content to pass through. HTML, CSS and JavaScript content is allowed. External CSS, JavaScript and the tag is blocked.*
