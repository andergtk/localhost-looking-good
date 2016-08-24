# Localhost Looking Good

> There is no place like 127.0.0.1

![Localhost homepage](http://i.imgur.com/j6tgbHO.png)

Localhost with a looking good and showing the status of the Virtual Hosts.

## Features

+ Display the localhost projects looking good.
+ Show the Virtual Hosts status.
+ Display the subdirectories, that don't have a index file, looking good.
+ Theme options to let the localhost so you.
+ Display custom 404 page.

## Supported

+ Nginx and Apache web servers.
+ Linux based O.S and Mac OS.
+ Partial support for Windows (just shows the projects).

## Install

### 1. Get the files

Clone the repository into localhost root directory:

```bash
# Change directory
cd /var/www

# Clone into
git clone https://github.com/andergtk/localhost-looking-good.git .
```

Or [Download a ZIP](https://github.com/andergtk/localhost-looking-good/archive/master.zip)
and extract the files to the same folder.

### 2. Set up a Virtual Host

See a sample for [Nginx](.localhost/sample-nginx.conf) or [Apache](.localhost/sample-apache.conf).

For **Nginx** the configuration file should have this lines:

```nginx
index index.php index.html /.index.php;

error_page 404 /.localhost/404.php;

location / {
  autoindex on;
}
```

For **Apache**:

```apache
DirectoryIndex index.php index.html /.index.php

ErrorDocument 404 /.localhost/404.php
```

### 3. Update permissions (optional)

Just if you have problems to save settings.

Execute the following line in terminal, changing the path `/var/www` to your
localhost root directory.

```bash
sudo find /var/www -type d -exec chmod 775 {} + && sudo find /var/www -type f -exec chmod 664 {} +
```

### 4. On browser

Open the localhost page and click on the gear button to set up with your
preferences.

### 5. Done!

Any questions or suggestions please contact us.

## License

[MIT License](LICENSE)
