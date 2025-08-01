<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8" />
    <title>Roles & Permissions</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" />
</head>
<body>
    <div class="container p-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Welcome to the Roles & Permissions System</h2>
                    </div>
                    <div class="card-body">
                        <p class="text-center">This system allows you to manage user roles and permissions effectively</p>
                        <a href="{{ route('auth.admin.login') }}" class="btn btn-primary">Admin Dashboard Login</a>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>
