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
                    <form action="" onsubmit="return false;">
                        <h2>Sign In</h2>
                        <input type="number" name="" placeholder="Phone Number" />
                        <input type="password" name="" placeholder="Password" />
                        <input type="submit" name="" value="Login" />
                        <p class="signup">
                            Don't have an account ?
                            <a href="#" onclick="toggleForm();">Sign Up.</a>
                        </p>
                    </form>
                </div>
            </div>
            <div class="user signupBx">
                <div class="formBx">
                    <form action="" onsubmit="return false;">
                        <h2>Create an account</h2>
                        <input type="number" name="" placeholder="Phone Number" />
                        <input type="email" name="" placeholder="Email Address" />
                        <input type="password" name="" placeholder="Create Password" />
                        <input type="password" name="" placeholder="Confirm Password" />
                        <input type="submit" name="" value="Sign Up" />
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