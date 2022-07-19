# Project Name
> (describe purpose of this project)

Summary of the project. This is the first thing you read when you view this
project. This is a great place to summarize the goals or intentions of this
project. Generally speaking, this section is optional, but is a nice way to
get a snapshot of what this project is about.

Also include information on the maturity of the project, like when it was
launched, what its current production environment is like, and who it is
maintained by.

## Features

What are all the bells and whistles that are significant or unique to this
project?

* What's the main functionality
* What new thing does this project provide?
* What unique feature does this project include?

## Overview

Describe the architecture in which this project fits, and point to any other
repositories that are make up the full stack of software. Describe how each
piece fits together.

## Requirements

List any and all requirements, include hardware, server software, and
third-party libraries.

List also if retrieve of specific configuration is required prior launching
the project (Eg. obtain a copy of database, obtain specific settings from
the vault).

## Development

A quick introduction of the minimal setup you need to get the application up
and running.

### Frontend

Frontend commands
```console
# Install dependencies
$ npm install

# Bundle dependencies in dev mode with HMR enable
$ npm run dev
```

Here you should say more thoroughly what actually happens when you execute
the above instructions.

### Deployment / Release

Describe here the strategy followed by this project in relation to deployment
and releases. You can also describe the branching approach.

Eg. environment-specific branches, CI/CD with push-to-deploy approach,
production restrictions and how releases are prepared, etc.

## Configurations

Here you should write what are all of the configurations a user can enter
when using the project, and which file each config is set if applicable.

## Linters and code formatters
We are using a series of tools to prettify and lint the code we write:

- Husky: to install and run the pre-commit hooks
- PHPStan: to do static analysis check on PHP code
- PHP-CS-Fixer: to remove unused dependencies and do some basic formatting
- Prettier: to fully format the code
- Blast: if installed, we run it to test if it's compilable
- Eslint: TODO: not done yet, we need a FEE to help doing this the right way
- Git conflict markers: the pre-commit checker tool also checks if the developer didn't stage any Git conflicted files by looking for conflict markers on the staged files.
 
These tools are executed automatically on every commit, only on staged files (except for Blast), and for it to work you need to make sure you executed. Composer and NPM are responsible for making sure husky is installed. And these commands are also available if a developer needs to run the commands manually:

Global commands:

- composer lint
- composer format

Specific commands:

- composer phpstan
- composer eslint (TODO)
- composer prettier
- composer blast
- composer php-cs-fixer

Commands execution also generates a log file with the result at tools/logs/<tool-name>.log, you can check for PHPStan errors on this file, for example.

**TODO: do we need to have the same commands on NPM?** 
