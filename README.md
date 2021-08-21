#QMA server
Simple game server with php without socket programming. Uses the Api request post(json).
#What does this code do?
1. Register the user as a guest registration or with the desired username and password
2. Login 1 Time
3. Add/remove friend
4. Find game
5. Leaderboard
6. Game control like who won .etc
7. In App Purchase
8. Setting
9. Request play
10. User info
#Installation SETP by STEP

1.Upload/Import database.sql (mysql)
2.Change database/password/user in config.php
```php
$dbhost = 'localhost';
$dbuser = 'databaseuser';
$dbpass = 'databasepassword';
$dbname = 'databasename';
```
3.Upload php file on your own server
4.Setup Api link in unity c#
sample
https://192.168.1.100/api
or
https://google.com/api
#Disadvantages
I do not know why I did not use the socket for the section while playing the game
so you can change this section with socket for faster response
#Advantages
you can run your game server for your game with 2.5$ server with 100 online players.

