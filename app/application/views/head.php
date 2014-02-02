<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>CRC Robotics Judging</title>
    <link rel="shortcut icon" href="http://www.robo-crc.ca/sites/robo-crc.ca/files/danland_favicon.ico" type="image/x-icon">
    <meta name="robots" content="noindex,nofollow" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">

    <script type="text/javascript" src="<?= base_url() ?>static/js/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>static/js/jquery-ui-1.10.0.custom.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href="<?= base_url() ?>static/styles/jquery-ui-1.10.0.custom.min.css" rel='stylesheet' type='text/css'>

    <script>
        $(function() {
            // Create sliders for rating, where they exist
            $( ".slider" ).slider({
                range: "min",
                value:1,
                min: 1,
                max: 5,
                step: 1,
                slide: function( event, ui ) {
                    $(this).siblings(":text").val(ui.value);
                }
            });

            $('.big-button, :input[type=submit]').button();

            $('.ui-state-highlight').click(function(){
                $(this).fadeOut();
            });

            $('.progressbar').each(function () {
                $(this).progressbar();
                $(this).progressbar('option', "value", parseInt(($(this).attr('data-value') / 5 * 100), 10));
            });

            $(".sortable").sortable({
                stop: function( event, ui ) {
                    var sorted_schools = Array();
                    $('.sortable .school').each(function(){
                        sorted_schools.push($(this).attr('id').replace('element', ''));
                    });
                    $('#sort_order').val(sorted_schools);
                    console.dir(sorted_schools);
                }
            });
            $(".sortable").disableSelection();

            // Set up the initial value
            var sorted_schools = Array();
            $('.sortable .school').each(function(){
                sorted_schools.push($(this).attr('id').replace('element', ''));
            });
            $('#sort_order').val(sorted_schools);
        });
    </script>

    <style>
        body, html {
            height: 100%;
        }

        body {
            font-family: 'Roboto Condensed', sans-serif;
            font-size: 1em;
            margin: 0;
            padding: 0;
        }

        body > header > h1 {
            padding: 0 5px;
            margin: 0;
            width: 100%;
            height: auto;
            background: #1A87B9;
            color: white;
        }

        fieldset {
            border-radius: 5px;
            margin-bottom: 10px;
        }

        legend {
            font-size: 2em;
        }

        #container {
            padding: 20px;
        }

        #content {
            padding: 20px;
        }

        #codeigniter_profiler
        {
            font-size: smaller;
        }

        .slider
        {
            width: 30%;
        }

        .progressbar
        {
            width: 5em;
            height: 1em;
            margin-left: 1em;
            vertical-align: middle;
            position: relative;
            display: inline-block;
        }

        .boolean
        {
            width: 1em;
            height: 1em;
            margin-left: 1em;
            vertical-align: middle;
            position: relative;
            display: inline-block;
            border: 1px solid black;
            border-radius: 3px;
        }

        .true
        {
            background-color: green;
        }

        .false
        {
            background-color: red;
        }

        .comments
        {
            display: block;
            clear: both;
            margin-left: 1em;
            font-size: 0.8em;
            font-weight: normal;
        }

        .todo-warning
        {
            padding: 0 3em;
            text-transform: uppercase;
            margin-left: 3em;
            color: red;
            border: 0.2em dashed yellow;
        }

        .schoollink
        {
            text-decoration: underline;
        }

        .input-hidden
        {
            display: none;
        }

        .sortable-element
        {
            margin-bottom: 5px;
            padding: 10px;
            border-style: solid;
            border-radius: 3px;
            border-width: 1px;
            cursor: crosshair;
        }

        nav ul {
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
            width: 40%;
        }

        nav.main-menu li {
            border-radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            margin: 30px !important;
            height: 3em;
            line-height: 1.6em;

            list-style: none;
            font-size: 2em;
            text-align: center;

            background:#25A6E1;
            background:-moz-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
            background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#25A6E1),color-stop(100%,#188BC0));
            background:-webkit-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
            background:-o-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
            background:-ms-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
            background:linear-gradient(top,#25A6E1 0%,#188BC0 100%);
        }

        nav.main-menu li:hover {
            background: #25A6E1;
        }

        nav li a {
            /*display: block;*/
            color: #fff;
            text-decoration: none;
            padding: 20px 0;
            height: 100%;
            width: 100%;
            display: block;
        }

        .ui-state-highlight {
            margin: 20px;
            padding: 1em;
        }

        .sortable-element:before {
            content:
        }

        .ui-icon {
            float: left;
            margin-right: .3em;
        }

        #results {

        }

        #missing li {
            border: 1px solid red;
            border-radius: 2px;
            line-height: 1.2em;
            margin: 5px 0;
            padding: 3px;
        }

        section table {
            text-align: center;
        }

        table thead {
            background: blue;
            color: white;
        }

        table tbody tr:nth-child(1) {background: lightblue}
        table tbody tr:nth-child(2) {background: lightblue}
        table tbody tr:nth-child(3) {background: lightblue}

        /*table tbody td:nth-child(1) {color: white}*/

        table tbody tr td {padding: 15px;}

        .top-buttons {
            position: absolute;
            right: 2px;
            top: 2px;
            padding: 0 1px;
            font-size: 1.6em;
            font-size: 1.6em;
        }

        .top-buttons div {
            padding: 0 5px;
            margin: 0 2px;
            border-radius: 3px;
        }

        .top-buttons div:hover {
            background-color: blue;
        }

        .help-button {
            float: left;
            border: 2px yellow double;
            display: none;
        }

        .help-button a {
            color: white;
            text-decoration: none !important;
        }

        .logout-button {
            float: left;
            border: 2px white double;
        }

        .logout-button a {
            color: white;
            text-decoration: none !important;
        }

        #flags
        {
            border: 2px solid red;
            border-radius: 5px;
            display: inline-block;
            padding:10px;
        }

        .cards
        {
            margin: 15px;
            padding: 10px 5px;
            border: 1px solid grey;
            border-radius: 5px;
        }

        .card .axis
        {
            line-height: 2em;
        }

        .card .value
        {
            font-size: 1.2em;
        }

        .card .comment
        {
            font-style: italic;
        }

        /*#results table tr td:nth-child(3) {visibility: hidden;}*/
        /*#results table tr th:nth-child(3) {visibility: hidden;}*/
    </style>

</head>
<body>
<header>
    <h1>
        Velistic 2013
    </h1>
    <div class="top-buttons">
        <div class="help-button">
            <a href="mailto:michael@robo-crc.ca?subject=Judging%20help!"><?= lang('help-menu'); ?></a>
        </div>
        <?php if ($this->session->userdata('validated')) { ?>
        <div class="logout-button">
            <a href="<?= base_url(); ?>login/logout"><?= lang('logout-menu'); ?></a>
        </div>
        <?php };?>
    </div>
</header>