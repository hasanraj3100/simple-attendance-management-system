<?php if(isset($error)): ?>
<div class='errors'>
  <p> <?=$error?> </p>
</div>
<?php endif; ?>

<div class="login-form">
  <form action='' method='post'>
    <h1 class='login-head'>Login</h1>
    <div class="content">
      <div class="input-field">
        <input type="text" placeholder="Email" name='username'>
      </div>
      <div class="input-field">
        <input type="password" placeholder="Password" name='password'>
      </div>
      <a href="#" class="link">Forgot Your Password?</a>
    </div>
    <div class="action">
      <button type='submit'>Login</button>
      
    </div>
  </form>
</div>