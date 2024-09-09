#!/bin/bash
mkdir $1
cd $1
chmod 757 $1
echo $2 | cat > index.php
chmod 757 index.php

mkdir css
mkdir css/user
echo " " | cat > css/user/estilo.css
mkdir css/admin
echo " " | cat > css/admin/estilo.css
chmod 757 css
chmod 757 css/user
chmod 757 css/admin
chmod 757 css/user/estilo.css
chmod 757 css/admin/estilo.css

mkdir img
mkdir img/avatars
mkdir img/buttons
mkdir img/products
mkdir img/pets
chmod 757 img
chmod 757 img/avatars
chmod 757 img/buttons
chmod 757 img/products
chmod 757 img/pets

mkdir js
mkdir js/validations
echo " " | cat > js/validations/login.js
echo " " | cat > js/validations/register.js
mkdir js/effects
echo " " | cat > js/effects/panels.js
chmod 757 js

mkdir tpl
echo " " | cat > tpl/main.tpl
echo " " | cat > tpl/login.tpl
echo " " | cat > tpl/register.tpl
echo " " | cat > tpl/panel.tpl
echo " " | cat > tpl/profile.tpl
echo " " | cat > tpl/crud.tpl
chmod 757 tpl

mkdir php
echo " " | cat > php/create.php
echo " " | cat > php/read.php
echo " " | cat > php/update.php
echo " " | cat > php/delete.php
echo " " | cat > php/dbconect.php
chmod 757 php
echo "==> Proyecto guardado como "$1