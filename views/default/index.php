<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <h1>Hello <?php echo ($user) ? $user->username : ' Mr. Guest, please login'?>!</h1>
            </div>
        </div>
        <?php if (!$user): ?>
            <div class="row">
                <div class="col-md-12">
                    <h2>Please login or register</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Login</h2>
                    <form id="auth-form" action="/auth/login" method="post">
                        <div class="input-group">
                            <label>Username
                                <input name="username" type="text" class="form-control" placeholder="Username"
                                       value="">
                            </label>
                        </div>
                        <div class="input-group">
                            <label>Password
                                <input name="password" type="password" class="form-control" placeholder="Password">
                            </label>
                        </div>

                        <div class="input-group">
                            <label>Remember me
                                <input name="remember_me" type="checkbox" class="form-control">
                            </label>
                        </div>
                        <div class="input-group">
                            <input type="submit" name="login" value="Login" class="btb btn-primary">
                            &nbsp;
                            <input type="submit" name="login" value="Register" class="btb btn-primary" onclick="getElementById('auth-form').setAttribute('action', '/auth/register')">
                        </div>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-12">
                    <h2>You are logged in.</h2>
                    <a href="/auth/logout">Logout</a>
                </div>
            </div>
        <?php endif;?>
    </div>
</div>
