<?php

use App\Controllers\AuthController as AuthController;
use App\Controllers\V1\AuthorController as AuthorController;
use App\Controllers\V1\BookController as BookController;
use App\Controllers\V1\CategoryController as CategoryController;
use Core\Router;

// Routes for Book Controller BookController books
Router::get('api/v1/books')
    ->controller(BookController::class)
    ->action('index'); // Get a full list
Router::get('api/v1/books/{id:\d+}')
    ->controller(BookController::class)
    ->action('show'); // Get by ID
Router::post('api/v1/books')
    ->controller(BookController::class)
    ->action('store'); // Create a new
Router::put('api/v1/books/{id:\d+}/update')
    ->controller(BookController::class)
    ->action('update'); // Update details by ID
Router::delete('api/v1/books/{id:\d+}/delete')
    ->controller(BookController::class)
    ->action('destroy'); // Delete by ID

// Routes for Author Controller
Router::get('api/v1/authors')
    ->controller(AuthorController::class)
    ->action('index'); // Get a full list
Router::get('api/v1/authors/{id:\d+}')
    ->controller(AuthorController::class)
    ->action('show'); // Get by ID
Router::post('api/v1/authors/store')
    ->controller(AuthorController::class)
    ->action('store'); // Create a new
Router::put('api/v1/authors/{id:\d+}/update')
    ->controller(AuthorController::class)
    ->action('update'); // Update details by ID
Router::delete('api/v1/authors/{id:\d+}/delete')
    ->controller(AuthorController::class)
    ->action('delete'); // Delete by ID

// Routes for Category Controller
Router::get('api/v1/categories')
    ->controller(CategoryController::class)
    ->action('index'); // Get a full list
Router::get('api/v1/categories/{id:\d+}')
    ->controller(CategoryController::class)
    ->action('show'); // Get by ID
Router::post('api/v1/categories/store')
    ->controller(CategoryController::class)
    ->action('store'); // Create a new
Router::put('api/v1/categories/{id:\d+}/update')
    ->controller(CategoryController::class)
    ->action('update'); // Update details by ID
Router::delete('api/v1/categories/{id:\d+}/delete')
    ->controller(CategoryController::class)
    ->action('delete'); // Delete by ID

// Routes for Auth Controller
Router::post('api/auth')
    ->controller(AuthController::class)
    ->action('auth'); // User login
Router::post('api/auth/register')
    ->controller(AuthController::class)
    ->action('register'); // User registration
