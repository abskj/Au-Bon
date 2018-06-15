<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <link rel="stylesheet" href="./css/dashboard.css">

    <title>AU-BON</title>
</head>
<body>

    <div id="main" class=" row">
        <div class="col m3 offset-m2 s8 offset-s2 white">
            <div class="row">
                <h3 class="heading ">Login</h3>
            </div>
            <form action="/login" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                    <input  name="username" id="user_name" type="text" class="validate">
                    <label for="user_name">User Name</label>
                  </div>
            </div>
            <div class="row">
                    <div class="input-field col s12">
                            <i class="material-icons prefix">lock</i>
                            <input name="password" id="password" type="password" class="validate">
                            <label for="password">Password</label>
                          </div>
            </div>
            <button type="submit" class="btn waves red">Login</button>
            </form>
        </div>
    </div>
</body>
<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<script src="/js/login.js"></script>
</html>
