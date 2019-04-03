# Illuxat
A PHP library for Illuxat.com. The goal of this repository is to give the ability for developers to use our apis properly and easier.
<br><br>
Our apis are mainly related to [xat](https://xat.com). If you don't know what's xat; then xat is a fun social networking site with the coolest online chat box.
## Getting Started
To get started, you need to install it and you have 2 choices on install it.

**First solution - Composer:**

We have made a package that you can find [here](https://packagist.org/packages/xsloom/illuxat) or you can simply run this command:

```
composer require xsloom/illuxat
```

Make sure to have composer installed!

**Second solution:** 

Or If you feel too lazy to run it through composer, you can directly clone this repository and run ``composer install``.
## How to use?
That's simple, even a newbie would understand! 😄 

Here is an example of use:

```
require_once 'vendor/autoload.php'; 

use Illuxat\Illuxatlib;

$latest = Illuxatlib::getLatest();

print_r($latest);
```

Basically, we do require autoload and then we initialize the Illuxatlib class from the Illuxat namespace. On this example, i'm calling the ```getLatest()``` function to return the information of the latest xat power.

The output would be this one:

<img src="https://i.imgur.com/kG2HVY6.png" alt="screenshot">

## Functions list
On this part, you can find the list of available functions. In the future, we are planning to add more functions/features.

**Coming soon**

## Contribution
We know that things are never perfect. If you find an issue or if you have a suggestion to improve, feel free to open a pull request and i'll take a look at it quickly.
## Authors
* **Clément** - [xSlOom](https://github.com/xSlOom)
## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details
