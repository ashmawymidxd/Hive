<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset(app('settings')->logo_path) }}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
    <title>Document</title>
</head>

<body style="background-color: {{ app('preferences')->ui_theme_color }}">

    <div class="container mt-5">
        <div class="row">
            <div class="bg-white border shadow-0 p-5 rounded-5">
                <div class="d-flex align-items-center justify-content-between">
                    <h1 class="fw-bold"><span class="text-primary">Welcome '</span> To {{ app('settings')->hotel_name }}
                        Dashboard</h1>
                    <span class="badge badge-primary rounded-pill px-3 py-2">
                        <i class="fas fa-check-circle me-1"></i> {{ app('settings')->year_built }}
                    </span>
                </div>
                <p class="text-secondary">{{ app('settings')->hotel_description }} </p>
                <div class="d-flex gap-2">
                    <i class="fa fa-star text-primary"></i>
                    <i class="fa fa-star text-primary"></i>
                    <i class="fa fa-star text-primary"></i>
                    <i class="fa fa-star text-primary"></i>
                    <i class="fa fa-star text-info"></i>
                </div>
                <a href="{{route('login-admin')}}" class="btn btn-light border shadow-0  mt-5"> Login</a>
            </div>
            <div class="bg-white border shadow-0 p-3 rounded-5 mt-5 px-5">
                <div class="d-flex align-items-center justify-content-between">
                    <span>Copy &copy; right by ahmed hassan</span>
                    <button class="btn btn-primary shadow-0 btn-rounded">Profile</button>

                </div>
            </div>
        </div>
    </div>

</body>

</html>
