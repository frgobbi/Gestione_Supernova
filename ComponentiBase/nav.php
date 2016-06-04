<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function navLog($percorso) {
    $link = $percorso;
    ?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Torneo Supernova</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../Home/home.php">Torneo Supernova</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="../Login_Logout/logout.php"><i class="fa fa-power-off"></i> Logout &nbsp; </a>
            </li>
        </ul>
        <?php
        require 'barraLaterale.php';
        barraLaterale($_SESSION['tipo'],$link);
        ?>
    </nav>
    <?php

}

function navUnlog() {
    ?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">

            <a class="navbar-brand" href="index.php">Torneo Supernova</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <form class="navbar-form navbar-right" id="login" role="form" method="post" action="Login_Logout/login.php">
                <div class="form-group">
                    <input type="text"  name="user"placeholder="Username" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="pass" placeholder="Password" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Sign in</button>
                <button id="badje" class="btn btn-success" type="button" onclick="window.location.href='Login_Logout/badge.php'"> Sign in with Badge </button>
            </form>
        </ul>
    </nav>
    <?php
}


function navUnlogPublic() {
    ?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">

            <a class="navbar-brand" href="../index.php">Supernova 3.0</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <form class="navbar-form navbar-right" id="login" role="form" method="post" action="../Login_Logout/login.php">
                <div class="form-group">
                    <input type="text"  name="user"placeholder="Username" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="pass" placeholder="Password" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Sign in</button>
                <button id="badje" class="btn btn-success" type="button" onclick="window.location.href='../Login_Logout/badge.php'"> Sign in with Badje </button>
            </form>
        </ul>
    </nav>
    <?php
}