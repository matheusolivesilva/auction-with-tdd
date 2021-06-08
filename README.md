
# Auction With TDD
This POC (prove of concept) applies TDD (Test Driven Development) to auction software.

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites
What things you need to do to run the software:
* PHP 7.4 or greater
* Composer 1.9.0
* PHPUnit 9.5.4 by Sebastian Bergmann and contributors.

### Installing and using with Docker
1. First of all, you must to have docker installed in your machine ([follow the steps in documentation](https://docs.docker.com/get-docker/))
2. Clone this repo to your local enviroment
```bash 
$ git clone https://github.com/matheusolivesilva/auction-with-tdd.git
```
3. Run ```$ docker-compose up ``` and open the file ***executed-tests.txt*** to check the result of the tests


### Installing and using with shellscript
1. Clone this repo to your local enviroment
```bash
$ git clone https://github.com/matheusolivesilva/auction-with-tdd.git
```
2. Run in the command line ```$ ./prepareapp.sh ```
3. Open the file ***executed-tests.txt*** to check the result of the tests

### Installing and using Manually
1. Clone this repo to your local enviroment
```bash
$ git clone https://github.com/matheusolivesilva/auction-with-tdd.git
```
2. Install the dependencies with ```$ composer install ```
3. Run in the command line ```$ vendor/bin/phpunit tests ```
4. Open the file ***executed-tests.txt*** to check the result of the tests

## Built With
* PHPUnit Testing Framework
* VIM Editor
* PHP
* Gitflow
* Composer

## Author
*Matheus Oliveira da Silva* - [Github](https://github.com/matheusolivesilva) | [Linkedin](https://www.linkedin.com/in/matheusoliveirasilva/)

