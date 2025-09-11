<?php

use app\nucleo\neutrons\models\Model;
use app\nucleo\protons\gears\alerts\Flash;
use app\nucleo\protons\gears\login\Login;
use app\nucleo\protons\gears\Redirect;
use app\eletrons\validate\Sanitize;

function dd($dump)
{
  var_dump($dump);
  die();
}

function toJason($data)
{
  header('Content-Type: application/json');
  echo json_encode($data);
}

function validate($validate)
{
  $validate = new $validate();

  $validate->validate();

  return $validate;
}

function request($field = null)
{
  $sanitized = new Sanitize;

  if(!is_null($field)){
    return $sanitized->sanitized()->$field;
  }
  return $sanitized->sanitized();
}

function auth(Model $model)
{
  return (new Login)->login($model);
}

function redirect($target)
{
  return Redirect::redirect($target);
}

function back()
{
  return Redirect::back();
}

function flash($messages)
{
  return Flash::add($messages);
}

function message($index)
{
  return Flash::get($index);
}

function loggedUser() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function loggedAdmin() {
    return isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']);
}

