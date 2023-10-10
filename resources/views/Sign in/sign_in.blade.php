<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MunchMate - Sign-in</title>
    <link rel="stylesheet" href="{{asset('css/sign_in.css')}}">
</head>

<body>
    <section>
        <div class="container">
            <div class="user signinBx">
                <div class="imgBx"><img src="{{asset('logo/Untitled design.png')}}" alt="" /></div>
                <div class="formBx">
                    <form action="{{route('login')}}" method="POST">
                        @csrf

                        <h2>Sign In</h2>
                        <input type="number" name="phone" value="{{ old('phone') }}" placeholder="Phone Number" />
                        <input type="password" name="pass" placeholder="Password" />
                        @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{Session::get('error')}}
                        </div>
                        @endif
                        <input type="submit" name="login" value="Login" />
                        <p class="signup">
                            Don't have an account ?
                            <a href="#" onclick="toggleForm();">Sign Up.</a>
                        </p>
                    </form>
                </div>
            </div>
            <div class="user signupBx">
                <div class="formBx">
                    <form action="{{route('signup')}}" method="POST">
                        @csrf
                        <h2>Create an account</h2>
                        <input type="text" name="username" placeholder="Your Name" />
                        <input type="number" name="phone" placeholder="Phone Number" />
                        <input type="email" name="email" placeholder="Email Address" />
                        <input type="password" name="pass" placeholder="Create Password" />
                        <input type="password" name="cpass" placeholder="Confirm Password" />
                        <input type="submit" name="signup" value="Sign Up" />
                        <p class="signup">
                            Already have an account ?
                            <a href="#" onclick="toggleForm();">Sign in.</a>
                        </p>
                    </form>
                </div>
                <div class="imgBx"><img src="{{asset('logo/Untitled design.png')}}" alt="" /></div>
            </div>
        </div>
    </section>
    <script>
        const toggleForm = () => {
        const container = document.querySelector('.container');
        container.classList.toggle('active');
      };
    </script>
</body>

</html>