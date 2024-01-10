<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login</title>
</head>
<body>
    @if (session('error'))
        <div class="alert alert-danger">
            <b>Oops!</b> {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <div class="sign-in-sign-up">
            <form action="{{ url('/login') }}" method="POST" class="sign-in-form">
                @csrf
                <h2 class="title">Sign in</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username" name="username" required>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" name="password" required>
                </div>  
                <input type="submit" value="login" class="btn input-button">
            </form>
            
            <form action="{{ url('/register') }}" method="POST" class="sign-up-form">
                @csrf
                <h2 class="title">Sign Up</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username" name="username" required>
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Email" name="email" required>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" name="password" required>
                </div>  
                <input type="submit" value="Sign Up" class="btn input-button">
            </form>
        </div>
        <div class="panel-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Ingin bergabung dengan kami?</h3>
                    <p>Bergabunglah dengan kami dan pesan tempat restauran agar tidak perlu reservasi manual lagi!</p>
                    <button class="btn" id="sign-in-btn">Sign in</button>
                </div>
                <img src="{{ asset('img/signin.svg') }}" alt="sign-in-icon" class="image">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Member of Brand?</h3>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Blanditiis placeat animi saepe, minus vero voluptatibus!</p>
                    <button class="btn" id="sign-up-btn">Sign up</button>
                </div>
                <img src="{{ asset('img/signup.svg') }}" alt="sign-up-icon" class="image">
            </div>
        </div>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>