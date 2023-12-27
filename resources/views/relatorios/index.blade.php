<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <title>Admin</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
@extends('layout')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200 font-roboto">
    @include('layouts.sidebar')
    <div class="card-body">
        <ul class="list-group">
            <div class="table-responsive">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Relatórios</h3>
                    </div>
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <h2 class="mb-4"></h2>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <i class="fa-solid fa-print"></i>
                </div>
            </div>
        </ul>
    </div>
</div>