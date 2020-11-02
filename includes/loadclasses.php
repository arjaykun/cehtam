<?php

  function myAutoloader($class) {
      include_once 'classes/'.$class.'.php';
  }

  spl_autoload_register('myAutoloader');

