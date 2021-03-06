This set of ansible playbooks deploy various environment such as laravel / IBM MQ / Radius / WordPress etc. on CentOS 7.x. It is intended to run at each host to provision the localhost itself. Provisioning remote hosts are not tested.

## Prerequisite(Test Environment)

- Vagrant + VirtualBox VM running CentOS 7.8 with git and ansible 2.9.x.
- typical installation process could be like this:

```bash
mkdir XXXX
cd XXXXX
vi Vagrantfile (See below.)
vagrant up
```
And then log in to the VM as user "vagrant".

### Sample Vagrantfile:

```Vagrantfile
# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "centos/7"
  config.vm.network "private_network", ip: "192.168.56.2"
  config.vm.network :forwarded_port, guest: 22, host: 2202
  config.vm.synced_folder ".", "/vagrant", disabled: true
  config.vm.hostname = "example.local"
  config.vm.provider "virtualbox" do |vb|
    vb.memory = "1024"
    vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
  end
  config.vm.provision "shell", inline: <<-SHELL
    sudo yum -y reinstall glibc-common
    sudo yum -y install git epel-release
    sudo yum -y install ansible
  SHELL
end
```

## Prerequisite(Production Environment - AWS EC2 for example)

- Create EC2 instance from "CentOS 7 (x86_64) - with Updates HVM" AMI in AWS Marketplace 
- Log in to the instance as user "centos"
- sudo yum -y install git epel-release
- sudo yum -y install ansible

## Put this set of playbooks

```bash
$ git clone https://github.com/hotta/ansible-centos7.git
$ sudo rm -r /etc/ansible
$ cd ansible-centos7
$ sudo ln -fs $PWD /etc/ansible
```

## Customize localhost.yml if nessesary

Take a glance at group_vars/all first. If you'd like to customize any variable, you can override it by write down in host_vars/all.

```bash
$ cd host_vars
$ cp localhost.yml.tmpl localhost.yml
$ vi localhost.yml
$ cd ..
```

## Building environment 

```bash
$ ansible-playbook jobs/JOB-NAME-YOU-WANT-TO-DEPLOY.yml
```

for example, if you want to deploy laravel environment, run:

```bash
$ ansible-playbook jobs/laravel.yml
```

You may find jobs you want at [/jobs/README.md](https://github.com/hotta/ansible-centos7/tree/master/jobs).

## Components versions

### tested ( as of 2020/06/03 ).

- php-7.3.18
- composer 1.10.6
- SQLite-3.7.17 / MariaDB-10.4.13 / PostgreSQL-12
- Laravel 7.13.0 / 6.18.16
- Nginx 1.16
- WordPress 5.4.1

### Not tested ( as of 2020/06/03 ).

- Codeigniter-3.1.9
- IBM MQ 8.0.0
- FreeRadius 3.0.4
- CakePHP 3.6.11
- Sphinx 1.6.3
- GitBucket 4.22.0
- chromium 61.0.3163.100
- zabbix 4.2.6

## Dependencies in roles

- base
  - nginx
    - php
      - php-fpm
        - xdebug
      - composer
      - postgresql
        - laravel
          - supervisor
          - laravel-dusk
        - codeigniter
        - cakephp3
        - zabbix
      - mariadb
        - wordpress
        - vuedo
  - vnc
  - mq-core
    - mq-docker
    - mq-client
    - mq-server
    - mq-exploler
    - mq-php-pecl
      - mq-laravel
  - mfa
  - ldap
  - lessmd
  - php-ext
  - sphinx
  - vnc
  - openjdk
    - gitbucket
