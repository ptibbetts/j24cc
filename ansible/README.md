Ansible playbooks for setting up a LEMP stack for ~~Laravel~~ CakePHP.

- Local development environment with Vagrant
- High-performance production servers
- One-command provisioning
- One-command deployments

## It's still in development

This is a fork of [Trellis](https://roots.io/trellis) but for ~~Laravel~~ CakePHP instead of WordPress. 

Major changes from Trellis:

- ~~Laravel~~ CakePHP apps **instead of** WordPress sites
- separate server for the database
- splits out the web user to a new role as it's only used on the app server
- splits out the MariaDB and app setup roles into client/code and server/database roles
- adds bash aliases to the Vagrant box
- re-adds the `provision.sh` script 
- handlers are now in their own role that other roles have as a dependency - this is because handlers *are* shared between roles **but not** shared between plays and this gets around that
- other than the MariaDB PPA it hasn't been synced with Trellis for a while

TODO:

- [ ] rollbacks
- [ ] xdebug
- [ ] cake.log file still stored in storage and not managed by logrotate

## What's included

This playbook configures the following and more:

* Ubuntu 16.04 Xenial LTS
* Nginx
* PHP 7.2
* MariaDB
* SSL support (scores an A+ on the [Qualys SSL Labs Test](https://www.ssllabs.com/ssltest/))
* Let's Encrypt integration for free SSL certificates
* HTTP/2 support (requires SSL)
* Composer
* sSMTP (mail delivery)
* MailHog
* Fail2ban
* ferm

## Requirements

Ensure all dependencies have been installed before moving on:

* [Ansible](http://docs.ansible.com/ansible/intro_installation.html#latest-releases-via-pip) 2.0.2
* [Virtualbox](https://www.virtualbox.org/wiki/Downloads) >= 4.3.10
* [Vagrant](http://www.vagrantup.com/downloads.html) >= 1.5.4
* [vagrant-bindfs](https://github.com/gael-ian/vagrant-bindfs#installation) >= 0.3.1
* [vagrant-hostmanager](https://github.com/smdahlen/vagrant-hostmanager#installation)

## Installation

```shell
# → Root folder
├── ansible/      # → Ansible / Vagrant folder
└── cake/         # → Cake app
```

All Ansible commands should be ran from the `/ansible` directory

```shell
cd ansible
```

## Servers

This playbook has been designed to have three servers in production:

- a web server consisting of application code, PHP & Nginx
- a database server with MariaDB installed

however it is possible to use only the one server, which is how the staging and development environments are setup.

## Development environment

Vagrant calls the Ansible script to provision a virtual machine for local development.

```shell
vagrant up # start Vagrant
cd /srv/www/example.com/current # all Cake  & Composer commands to be ran here
```

### Aliases

The Vagrant box comes with the following bash aliases:

- `phpspec` is an alias of `/vendor/bin/phpspec`
- `phpunit` is an alias of `/vendor/bin/phpunit`
- `json`    is an alias of `python -mjson.tool`

You can customise these aliases and add your own by editing the `/aliases` file.

## Remote server setup (staging/production)

At least one base `Ubuntu 16.04` server is required for setting up remote servers.

### _I want all services on the same server_

This is how the staging environment is setup by default.

To change the production environment you'll need to add the IP address of the server to the `/hosts/production` file under `[production]` and each of the services.

### _I want a separate server for each service_

This is the how the production environment is setup by default but you will still need to configure it to get it to work.

You must make sure each server has private networking (internal IP addresses) enabled so that communication between the servers is both faster and cheaper - you don't usually have to pay for bandwidth on the internal network.

You need to add the domain of the web server and the **external** IP addresses of the database and Redis servers to the `/hosts/production` file. Then you need to add the **private/internal** IP address of each server under the `env` section in the `/group_vars/production/cake_apps.yml` file.

This is so that you can connect to the servers with Ansible using the external IP but each server can communicate with each other using the internal network.

The database server(s), by default, will only open the SSH port. If you separate the database out to another server then the new servers will also open the port for the database.

You should SSH into each server once before you run any Ansible commands as Ansible seems to struggle accepting multiple new servers at the same time - this would be a good time to run `apt update && apt upgrade -y` before provisioning them.

### Provisioning

Ensure `hosts/{staging,production}` contains the IP address(es) of the server(s) you wish to provision and that
`group_vars/{staging,production}/{cake_apps, vault}.yml` have been configured, then you can use the provision command to call Ansible:

```shell
bin/provision.sh <environment>
```

## Deployments

Could not be easier:

```shell
bin/deploy.sh <environment> <app name>
```

## Extras

### Installing extra PHP packages

Add the package to the `php_extensions_custom` array in `roles/php/defaults/main.yml` and re-provision the app server by running `ansible-playbook server.yml -e env=production --tags=php`.

### Installing extra software packages

Add the package to the `apt_packages_custom` array in `roles/common/defaults/main.yml` and run the provisioning script again. 

`htop` is a an example of something I'd add here.