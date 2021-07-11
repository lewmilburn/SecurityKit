# PHPDataSecurity
PHPDataSecurity is a modified version of the Saturn Security System (https://github.com/lmwnweb/saturn).

## How to use PHPDataSecurity
If you're connecting to PHPDataSecurity from the root folder, use:
```php
include __DIR__.'/PHPDataSecurity/main.php';
```
If you're connecting to PHPDataSecurity from a sub-folder, you'll need to include some `/../` depending on how deep in sub-folders the file is.
```php
include __DIR__.'/../PHPDataSecurity/main.php';
```
To check if it's connected, you can assign the `$pdsConnectCheck` variable and set it to true.
```php
$pdsConnectCheck = true;
include __DIR__.'/../PHPDataSecurity/main.php';
```
This will output a message and halt the program after the message has been sent, so don't forget to remove the variable line before pushing to production!!

## How to use Checksums

### Generate Checksum

This function generates a checksum for data provided to it. $data should be the data that you want to create a checksum for. If you need to check a checksum, use the checksum_validate method shown above.

```php
$data = 'Hello World';
$checksum = checksum_generate($data);
```

### Validate / 'Check' Checksum

This function validates checksums generated using checksum_generate match the data that needs to be checked. In this example, we're checking 'Hello World' against it's checksum. We pass the data and the checksum that we want to compare into the function, and recieve a true/false response. 
`$data` should be the data that you want to validate, `$checksum` should be a pre-generated checksum for this data. If you need to generate a checksum, use the checksum_generate method shown above.

```php
$data = 'Hello World';
$checksum = '2c74fd17edafd80e8447b0d46741ee243b7eb74dd2149a0ab1b9246fb30382f27e853d8585719e0e67cbda0daa8f51671064615d645ae27acb15bfb1447f459b';

if (checksum_validate($data, $checksum) == true) {
    /* The checksum is valid / correct */
} else {
    /* The checksum is invalid / incorrect */
}
```

## How to use Data Checker

Simply send the variable used to hold the data through the function, and it's result will be checked and cleaned. See out the example below to learn how to integrate Input Checking into your code.
```php
$userInput = $_POST['input'];
$secureInput = checkData('DEFAULT', $userInput);
unset($userInput);
```
Here's a brief explaination of what's going on at Line 3:
- $secureInput is your new, checked and cleaned input ready to interface with the rest of the program.
- $secureInput = checkData('DEFAULT', $userInput); is the function.
- DEFAULT is the function's mode, see the next section for more modes and what they do.
- $userInput is the input that needs to be cleaned and checked.

### Always Blocked
Certain elements are always blocked regardless of the mode selected.
- External CSS via <link> and @import are disabled.
- External <script> tags are disabled.
- PHP and SQL Commands are disabled.
- Access to external CSS and JS is availiable in the Administration panel.

### Modes

**DEFAULT (Recommended)**
  
```php
$secureInput = checkData('DEFAULT', $userInput);
```
  
Allows No Code.
  
*Block All is the default mode. This blocks SQL Injection, Cross-site Scripting, HTML Code Injection, CSS Code Injection, JS Code Injection and PHP Code Injection. Rich Text Editors may run into issues using this mode. We highly recommend using this mode when sanitising plain text inputs such as logins, forms and more that do not require rich text editors or HTML content to pass through.*
  
  
**HTML**
  
```php
$secureInput = checkData('HTML', $userInput);
```
  
Allows HTML.
  
*Sometimes, inputs require HTML such as rich text editors. This mode allows HTML to pass through, but not JavaScript and CSS. JavaScript and CSS are both still disabled. Plain text editors (<textarea> <input> for names, emails, passwords, etc.) should use Block All unless they specificially require HTML content to pass through.*
  
  
**CSS**
  
```php
$secureInput = checkData('CSS', $userInput);
```
  
Allows HTML and CSS.
  
*As well as allowing HTML, this mode also enables CSS in the document.*

  
**TAGCSS**
  
```php
$secureInput = checkData('TAGCSS', $userInput);
```
  
Allows HTML and Tagged CSS.
  
*Allows HTML tags to contain tag-specific CSS (eg. <span style="color:blue;">) but disallow the use of <style> tags.*
  
**JS**
  
```php
$secureInput = checkData('JS', $userInput);
```
  
Allows HTML and JavaScript.
  
*As well as allowing HTML, this mode also enables inline JavaScript, external JavaScript is blocked.*

**ALL**
  
```php
$secureInput = checkData('ALL', $userInput);
```
  
Allows HTML, CSS, Tagged CSS and JavaScript.
  
*Allows all server-safe content to pass through. HTML, CSS and JavaScript content is allowed. External CSS, JavaScript and the tag is blocked.*
