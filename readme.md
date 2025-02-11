# CRUD Generator for Laravel

`crud-generator` is a Laravel library that helps you generate CRUD (Create, Read, Update, Delete) operations automatically from a migration file.

## Features
- Automatically generate **Model**, **Controller**, **Routes**, and **Views** from a migration file.
- Creating resource, request, repository, and models
- Easy to use with an Artisan command.
- Highly customizable.

## Installation

### 1. Add the Library to Your Project
If the library is published on Packagist, you can install it using:
```bash
composer require suryahadiningrat/crud-generator

## Documentation

### 1. Publish Config
Publishing configuration using:
```bash
php artisan vendor:publish --tag=crud-generator-config

### 2. Running CRUD Generator
Run the CRUD Generator with:
```bash
php artisan crud-generator:generate --migration=CHANGE_WITH_YOUR_MIGRATION_RELATIVE_PATH