# Localhost Looking Good

![Homepage Localhost](http://i.imgur.com/fjfbkgK.png)

Localhost with a looking good and showing the status of the Virtual Hosts.

## Features

+ [x] Display the localhost projects looking good.
+ [x] Show the Virtual Hosts status.
+ [x] Display the subdirectories, that don't have a index file, looking good.
+ [ ] Display custom error messages.

## Installing

Requires apache installed.

Clone the repository into localhost root directory:

```bash
git clone https://github.com/andergtk/localhost-looking-good.git /var/www
```

Make sure that the directory is empty.

Or [download a zip](https://github.com/andergtk/localhost-looking-good/archive/master.zip) and extract the files to the same folder.

## Setup

The only file that you need change something is in `.localhost/config.php`.

If you have installed Apache in another directory (not in `/etc/apache2`) you should change the value of the constant `APACHE_DIR` to the correct path.

You can add files to be hidden in the display by adding them in `$ignore` array.

## Contributing

Any suggestions of correction or improvement are wellcome.

## License

The [MIT License](LICENSE).

