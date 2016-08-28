# Localhost Looking Good

> There is no place like 127.0.0.1

![Localhost homepage](http://i.imgur.com/j6tgbHO.png)

Localhost with a looking good and showing the status of the Virtual Hosts.

## Features

+ Displays the localhost projects looking good.
+ Shows the Virtual Hosts status.
+ Displays the subdirectories, that don't have an index file, looking good.
+ Theme options to let the localhost so you.
+ Shows some custom errors pages (like 403, 404 and 500).

## Supported

+ **Nginx** and **Apache** web servers (on any other server may not work as
  expected).
+ Linux and Unix based O.S.
+ Partial support for Windows (just shows the projects, without listing Virtual
  Hosts).

## Install

### 1. Get the files

Clone the repository into localhost root directory:

```bash
# Change directory
cd /var/www

# Clone into
git clone https://github.com/andergtk/localhost-looking-good.git .
```

Or [download](https://github.com/andergtk/localhost-looking-good/archive/master.zip)
and extract the files to the same folder.

### 2. Set up a Virtual Host

See the sample of how should be the file in your web server: [**Nginx**](.localhost/sample-nginx.conf)
or [**Apache**](.localhost/sample-apache.conf).

The required settings are:
+ 1 - Root directory.
+ 2 - Index file (`/.index.php` as last option to work in subdirectories).
+ 3 - Custom errors pages.

### 3. Update permissions (optional)

Just if you have problems to save settings.

Execute the following line in terminal, changing the path `/var/www` to your
localhost root directory.

```bash
sudo find /var/www -type d -exec chmod 775 {} + && sudo find /var/www -type f -exec chmod 664 {} +
```

### 4. On browser

Open the localhost page and click on the gear button to set with your
preferences.

### 5. Done!

Any questions or suggestions please contact us.

## License

[MIT License](LICENSE)
