<form class="form-signin" method="post" action="/reg">
  <img class="mb-4" src="/docs/4.3.1/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>
  <div class="form-group">
  	<input type="text" name="names" id="inputName" class="form-control" placeholder="Ваше имя" required="" autofocus="" value="<?=$_POST['names']?>">
  </div>
  <div class="form-group">
  	<input type="email" name="emails" id="inputEmail" class="form-control" placeholder="Ваш e-mail" required="" value="<?=$_POST['email']?>">
  </div>
  <div class="form-group">
  	<input type="password" name="passwords" id="inputPassword" class="form-control" placeholder="Ваш пароль" required="">
  </div>
  
  <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
  <p class="mt-5 mb-3 text-muted">&copy; <?=date('Y')?></p>
</form>