<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="{$css}/font-face.css" rel="stylesheet" media="all">
    <link href="{$vendor}/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="{$vendor}/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="{$vendor}/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{$vendor}/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{$vendor}/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="{$vendor}/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="{$vendor}/wow/animate.css" rel="stylesheet" media="all">
    <link href="{$vendor}/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="{$vendor}/slick/slick.css" rel="stylesheet" media="all">
    <link href="{$vendor}/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="{$vendor}/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">


    <!-- Main CSS-->
    <link href="{$css}/theme.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        body {
            opacity: 0.95 !important;

        }

        #map {
            height: 400px;
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="{$css}/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="{$js}/leaflet-routing-machine.js"></script>
    <script src="{$js}/lrm-graphhopper-1.2.0.min.js"></script>


</head>

<body class="animsition" style="background-image: url('../../assets/images/background.jpg') !important;
background-repeat: no-repeat;background-size: cover;
    background-position: center;">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        {include file="includes/headerMobile.tpl"}
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        {include file="includes/menu_sidebar.tpl"}
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            {include file="includes/header.tpl"}
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                {php}

                Rotas::get_Pagina();

                {/php}
            </div>

        </div>

        <!-- Jquery JS-->
        <script src="{$vendor}/jquery-3.2.1.min.js"></script>
        <!-- Bootstrap JS-->
        <script src="{$vendor}/bootstrap-4.1/popper.min.js"></script>
        <script src="{$vendor}/bootstrap-4.1/bootstrap.min.js"></script>
        <!-- Vendor JS       -->
        <script src="{$vendor}/slick/slick.min.js">
        </script>
        <script src="{$vendor}/wow/wow.min.js"></script>
        <script src="{$vendor}/animsition/animsition.min.js"></script>
        <script src="{$vendor}/bootstrap-progressbar/bootstrap-progressbar.min.js">
        </script>
        <script src="{$vendor}/counter-up/jquery.waypoints.min.js"></script>
        <script src="{$vendor}/counter-up/jquery.counterup.min.js">
        </script>
        <script src="{$vendor}/circle-progress/circle-progress.min.js"></script>
        <script src="{$vendor}/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="{$vendor}/chartjs/Chart.bundle.min.js"></script>
        <script src="{$vendor}/select2/select2.min.js">
        </script>
        <script type="text/javascript" src="node_modules/validator/validator.min.js"></script>
        <script src="{$js}/sweetalert2@10.js"></script>
        <script src="{$js}/config/index.js"></script>
        <script src="{$js}/Requisicao/index.js"></script>
        <script src="{$js}/Relatorios/index.js"></script>


        <!-- Main JS-->
        <script src="{$js}/main.js"></script>

</body>

</html>
<!-- end document-->