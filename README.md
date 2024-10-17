<h1 align="center">Tower of Hanoi</h1>
<p align="center"> A simple pyramid puzzle</p>

<p>&nbsp;</p>

## Download Instruction

> Application Requirements
* PHP >= 8.2
* A web server like Apache or Nginx
* Composer for dependency management.

1. Clone the project.

```
git clone https://github.com/infinitypaul/tower_of_hanoi.git projectname
```

2. Install dependencies via composer.

```
composer install 
```

4. Run php server.

```
php artisan serve
```

<p>&nbsp;</p>

Enjoy!


## Api Usage

Notes:
- http://localhost:8000/ is your base URL. Replace it with your server's base URL if necessary.
- No persistence is needed across requests. The game resets if the server restarts.

```
GET http://localhost:8000/api/state
```
Description: Retrieves the current state of the Tower of Hanoi game, including the positions of the disks on the rods and whether the game is over.



```
POST http://localhost:8000/api/move/{from}/{to}
```
Description: Moves a disk from one rod (from) to another rod (to).

Where:
* {from}: The rod from which you want to move a disk (1-based index).
* {to}: The rod to which you want to move the disk (1-based index).

### Testing
```
php artisan test
```
You should see the results of the tests, ensuring that the application works as expected.

### Static Analysis
This project uses PHPStan for static code analysis to ensure code quality and prevent errors
```
vendor/bin/phpstan analyse

```
### License

The  Tower of Hanoi is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)



