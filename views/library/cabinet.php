<h1 align = "center">Личный кабинет </h1>


<form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail">Email</label>
      <input type="email" class="form-control" id="inputEmail" value='<?php echo Yii::$app->user->identity->email?>'>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Логин</label>
      <input type="text" class="form-control" id="inputUsername" value="<?php echo Yii::$app->user->identity->username?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputName">Имя</label>
      <input type="text" class="form-control" id="inputName" value="">
    </div>
    <div class="form-group col-md-6">
      <label for="inputSurname">Фамилия</label>
      <input type="text" class="form-control" id="inputSurname" value="">
    </div>
  </div>


  <button  type="submit" class="btn btn-primary">Обновить данные</button>

</form>