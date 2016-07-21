# Localhost Looking Good

> There is no place like 127.0.0.1

![Localhost homepage](http://i.imgur.com/j6tgbHO.png)

Localhost with a looking good and showing the status of the Virtual Hosts.

## Features

+ Display the localhost projects looking good.
+ Show the Virtual Hosts status.
+ Display the subdirectories, that don't have a index file, looking good.
+ Display custom 404 page.

## Supported

+ Linux based O.S.
+ Nginx and Apache web servers.

## Install

### 1. Get the files

Clone the repository into localhost root directory:

> git clone https://github.com/andergtk/localhost-looking-good.git

Or [download a ZIP](https://github.com/andergtk/localhost-looking-good/archive/master.zip)
and extract the files to the same folder.

### 2. Set up a Virtual Host

See a sample for [Nginx](.localhost/sample-nginx.conf) or for [Apache](.localhost/sample-apache.conf).

For **Nginx** da configuration file should have this lines:

```
index index.php index.html /.index.php;

error_page 404 /.localhost/404.php;

location / {
  autoindex on;
}
```

For **Apache**:

```
DirectoryIndex index.php index.html /.index.php

ErrorDocument 404 /.localhost/404.php
```

### 3. On browser

Open the [localhost](http://localhost) link and click on the gear button to set
up with your preferences.

## Contributing

Any suggestion or improvement are welcome.

## License

[GPL v3](LICENSE).
