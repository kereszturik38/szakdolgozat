<div class="container mx-auto w-50 h-100">
    <form action="?page=register" method="post">

        <div class="form-group">
            <label for="username">Username*</label>
            <input type="text" id="username" name="username" class="form-control" required maxlength="30"/>
        </div>

        <div class="form-group">
            <label for="email">E-mail*</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="name@example.com" required maxlength="30"/>
        </div>

        <div class="form-group">
            <label for="password">Password*</label>
            <input type="password" id="password" name="password" class="form-control" required maxlength="32"/>
        </div>


        <button class="btn btn-primary mt-5" type="submit" name="submit" value="submit">Register</button>


    </form>
    <small>Already have an account? <a href="index.php?page=login">Login</a></small>
</div>