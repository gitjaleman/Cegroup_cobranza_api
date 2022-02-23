<?php

  Router::add("index",                  "ApiController",  "index");
  Router::add("login",                  "ApiController",  "login");
  Router::add("g_asesor",               "ApiController",  "g_asesor");
  Router::add("g_operacion",            "ApiController",  "g_operacion");
  Router::add("g_telefonos",            "ApiController",  "g_telefonos");
  Router::add("g_gestiones",            "ApiController",  "g_gestiones");
  Router::add("g_aportes",              "ApiController",  "g_aportes");
  Router::add("g_acuerdos",             "ApiController",  "g_acuerdos");
  Router::add("g_estados",              "ApiController",  "g_estados");
  Router::add("g_alertas",              "ApiController",  "g_alertas");
  Router::add("g_resumen",              "ApiController",  "g_resumen");
  Router::add("g_mensaje",              "ApiController",  "g_mensaje");
  Router::add("b_data",                 "ApiController",  "b_data");
  Router::add("b_acuerdos",             "ApiController",  "b_acuerdos");
  Router::add("b_alertas",              "ApiController",  "b_alertas");
  Router::add("b_datafilter",           "ApiController",  "b_datafilter");
  Router::add("b_resumen",              "ApiController",  "b_resumen");
  Router::add("d_cartera",              "ApiController",  "d_cartera");
  Router::add("d_campana",              "ApiController",  "d_campana");
  Router::add("d_usuario",              "ApiController",  "d_usuario");
  Router::add("d_usuario_cambio",       "ApiController",  "d_usuario_cambio");
  Router::add("admin_asesor",           "ApiController",  "admin_asesor");
  

?>