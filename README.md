# 👩‍💻 REST API for maintaining messages

## About api-messages-php
The following statements are true about a message:
* it has a non-guessable identifier (UUID v4),
* it can contain characters coming from different languages,
* it does not support the usage of html tags,
* it has a maximum number of chars (255 characters),
* e-mail(s) and http link(s) can be part of the message,
* it has an internal counter of how many times the message was
retrieved (unsigned number)

## System dependencies
* built on macOS Catalina Version 10.15.3
* PHP 7.3.11
* mysql Ver 8.0.23 for osx10.15 on x86_64 (Homebrew)

## Database creation
* mysql

## Prerequsites
In order to use the API run it on your local machine. Run the apache server with the command `sudo apachectl start` and run the mysql server for example by running the command `mysql.server start` (depending on how mysql was installed, this may vary from machine to machine).

Move the project folder api-messages-php into your Sites folder (~/Sites). If you don't have a Sites folder create one and change your server settings accordingly.

## Using api-messages
The API responds to different types of requests, which will be explained below.
Use a “Rest Client” like Postman.

### 1. Get UUIDs of all messages
add the following URL path: `http://localhost/api/message/read.php`<br> 
### 2. Get one message by UUID
add the following URL path and a specific UUID: `http://localhost/api/message/read_one.php?uuid=UUID`<br>
### 3. Update a specific message by UUID
add the following URL path: `http://localhost/api/message/update.php`<br> 
Set the body to `raw` and choose `JSON`\
In JSON format type the keys `"content"` and `"uuid"` with the new text `"this is a great update"` and the UUID as string into the body.<br>
Example:<br>
`{ "content": "this is a great update",
   "uuid": "73dc381a-6ba5-11eb-889f-294d09474895"
 }`
### 4. Create a new message
add the following URL path: `http://localhost/api/message/create.php`<br>
in JSON format type the key `"content"` and the some text `"this is a new message"` into the body.<br>
Example:<br>
`{ "content": "this is a new message" }`
### 5. Delete a message by UUID
add the following URL path: `http://localhost/api/message/delete.php`<br> 
Set the body to `raw` and choose `JSON`.<br>
In JSON format type `"uuid" UUID as string into the body`<br>
Example:<br>
`{
   "uuid": "73dc381a-6ba5-11eb-889f-294d09474895"
 }`

## License
GNU General Public License

