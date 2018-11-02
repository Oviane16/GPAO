<?php

function css_url($nom)
{
    return base_url() . 'assets/css/' . $nom;
}
function js_url($nom)
{
    return base_url() . 'assets/js/' . $nom;
}
function img_url($nom)
{
    return base_url() ."assets/image/". $nom;
}
function less_url($nom)
{
    return base_url() ."assets/less/". $nom;
}
?>