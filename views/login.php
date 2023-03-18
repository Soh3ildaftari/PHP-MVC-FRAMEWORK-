 <?php ?>
 <form action="" method="post">
  <div class="mb-3">
    <label class="form-label">Email address</label>
    <input type="text" class="form-control" name="userName" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="pass" class="form-control">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" name="save" class="form-check-input">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
  <a href="/register">Have no Account?</a>
</form>
