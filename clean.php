<?php

if(file_exists('session.madeline'))      unlink('session.madeline');
if(file_exists('session.madeline.lock')) unlink('session.madeline.lock');
if(file_exists('madeline.phar'))         unlink('madeline.phar');
if(file_exists('madeline.phar.version')) unlink('madeline.phar.version');
if(file_exists('madeline.php'))          unlink('madeline.php');
if(file_exists('MadelineProto.log'))     unlink('MadelineProto.log');
