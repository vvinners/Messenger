# Messenger is an API Collection for Email and SMS.

----
## What API included?
Currently, we only support SendGrid and Nexmo for basic function of sending messages.

----
## Installation
```composer require vvinners/messenger```

**Setup .env**
```
NEXMO_API_KEY

NEXMO_API_SECRET

SENDGRID_API_KEY

MESSENGER_FROM_EMAIL

MESSENGER_FROM_NAME
```

----
## Usage
```php
use vvinners\Messenger;

$to = [
    "name" => $user->name,
    "email" => $user->email
];

Messenger::sendMail($to, $subject, $content);


Messenger::sendSMS($phone_number, $content);
```
