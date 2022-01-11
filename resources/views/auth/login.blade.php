<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Sig In</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href=" {{ mix('css/app.css') }} ">
    <link rel="stylesheet" href=" {{ asset('css/signin.css') }} ">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>
  <body class="text-center" style="background-color:white;  background-repeat: repeat;">
    <main class="form-signin" style="border:1px solid silver; padding:20px 20px 20px 20px; box-shadow:5px 5px 5px 5px silver; border-radius:5px 5px 5px 5px; background-image:url({{ asset('assets/bg.jpg') }});">
        <form action="{{ route('login-proccess') }}" method="POST">
        @csrf
            <img class="mb-4" src="{{ asset('assets/logo1.png') }}" alt="">
            <h1 class="h2 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>

            <div class="form-floating mt-2">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <button class="w-100 btn btn-lg text-white" type="submit" style="background-color:#FB743E;">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
        </form>
    </main>
    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>
