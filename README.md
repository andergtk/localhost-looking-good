# Localhost Looking Good

![](http://i.imgur.com/3OBpiSb.png)

Localhost with a looking good and showing the status of the Virtual Hosts.

## Installing

Requires apache installed.

Clone the repository into localhost root directory:

```bash
git clone https://github.com/andergtk/localhost-looking-good.git /var/www
```

Make sure that the directory is empty.

Or [download a zip](https://github.com/andergtk/localhost-looking-good/archive/master.zip) and extract the files to the same folder.

## Setup

The only file that you need change something is in `.localhost/index.php`.

If you have installed Apache in another directory (not in `/etc/apache2`) you should change the value of the constant `APACHE_DIR` to the correct path.

You can change the projects directory in the constant `HOME_DIR`.

## Contributing

Any suggestions of correction, improvement or translation (yeah, I'm BR) are wellcome.

## License

The MIT License (MIT)
