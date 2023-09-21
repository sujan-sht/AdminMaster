<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from w3crm.dexignzone.com/xhtml/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 11 May 2023 09:14:23 GMT -->
<head>
    @include('admin.layouts.components.assets.meta')


    @include('admin.layouts.components.assets.links')

</head>
<body class="authentication-bg pb-0">

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">

                    @include('auth.components.logo')


                    <!-- title-->
                    <h4 class="mt-3">Reset Password</h4>
                    <p class="text-muted mb-4">Enter your email address and we'll send you an email with instructions to reset your password.</p>

                    @if (session('status'))
                        <p class="text-muted mb-4"> {{session('status')}} </p>
                    @else
                        <!-- form -->
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input class="form-control" type="email" id="email" name="email" value="{{old('email')}}" placeholder="Enter your email">
                                @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="mb-0 text-center d-grid">
                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-lock-reset"></i> Reset Password </button>
                            </div>
                        </form>
                        <!-- end form-->
                    @endif
                    <!-- Footer-->
                    <footer class="footer footer-alt">
                        <p class="text-muted">Back to <a href="{{route('login')}}" class="text-muted ms-1"><b>Log In</b></a></p>
                    </footer>

                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">I love the color!</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i> It's a elegent templete. I love it very much! . <i class="mdi mdi-format-quote-close"></i>
                </p>
                <p>
                    - Hyper Admin User
                </p>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>


    @include('admin.layouts.components.assets.scripts')



</body>

</html>
