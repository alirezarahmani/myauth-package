myauth-package
==============

Simple Authentication Package for Laravel 5.0. I've made this for sitepoint `deep dive in laravel Packages` Article.

Directions:
---
to use this package you would know about two main method and two properties.

 - **Login**: login() method can automatically get Post which include `username` and `password` input or You can do it manually like this : ``MyAuth::login(array('username'=>'Alireza@isawesome.me','password'=>'test');`` If argument leave empty It'll search for POST input. 
 - **logout**: just call it. :)
 - 
 - **$redirect_login**  or **$redirect_logout**: are properties for changing directory after login/out action.
