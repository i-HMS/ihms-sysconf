## Sysconf -  Interactive configuration system for PHP applications

### INTRODUCTION

Sysconf is a CLI interactive configuration system written in PHP that allows to configure application modules. It provides
a consistent approach for configuring modules and gives the user a choice of interfaces. It can configure modules before
they are installed, allowing installations and major upgrades to request all necessary information in advance, and let
you do what you want while modules are installed. Sysconf lets you, if hurry, to skip the less important questions when
installing modules.

Sysconf is only GNU/Linux OS compatible.

### REQUIREMENT

**Sysconf requires the following:**

 * GNU make
 * PHP **5.3.3** or later; we recommend using the latest PHP version whenever possible
 * PHP Iconv extension
 * Zend Framework **1.11.x** (ZF library directory **must** be correctly set in your PHP include path)
 * whiptail and/or dialog program (OPTIONAL but still recommended for better visual experience)

### USAGE

See the [confmodule library](https://github.com/i-HMS/sysconf/blob/master/confmodule "confmodule") file. A better documentation will
come soon.

#### Running demo script without installing

To run the demo script without installing sysconf, just type:

	$ make prefix=/tmp/ihms demo

**Note:** The command above will build and run the demo script. **/tmp** will be used as directory to create sysconf database.
Do not forget to run **make clean** at end to reset the source tree.

#### Installing sysconf

 To install sysconf, just type as root user:

 	# make clean
 	# make prefix=YOUR_PREFIX_PATH install

**Note:** Default value for prefix is **/usr/local**.

Sysconf is still in prototype state.

### LICENSE

The files in this archive are released under the [GPL v2](http://www.gnu.org/licenses/gpl-2.0.html "GPL v2")
You can find a copy of this license in LICENSE.txt.

### ACKNOWLEDGEMENTS

The i-HMS team would like to thank all the contributors to the i-HMS project, our corporate sponsor, and you, the i-HMS
software users.

The i-HMS team would like particularly thank **Joey Hess**, a Debian developer that is the author of the Debconf program on
which our work is based.

### AUTHORS AND CONTRIBUTORS
Laurent Declercq <l.declercq@nuxwin.com> (Author)
