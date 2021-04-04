<?php
    class Layout{

        private $IsRoot;

        public function __construct($isRoot = false)
        {
            $this->IsRoot = $isRoot;
        }

    function printHeader(){

        $Directory = ($this->IsRoot) ? "" : "../";

        $header = <<<EOF

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Estudiantes</title>
        
            <link rel="stylesheet" href="{$Directory}assets/CSS/style.css">
            <link rel="stylesheet" href="{$Directory}assets/CSS/bootstrap/bootstrap.min.css">
            <script src="https://kit.fontawesome.com/597ca9d7c7.js" crossorigin="anonymous"></script>
        </head>
        
        <body>
            <nav class="navbar navbar-dark bg-primary fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand text-white" href="{$Directory}index.php"><h2><strong><i class="fas fa-street-view h2"></i> StudentsPOO</strong></h2></a>
                </div>
            </nav>
            <main class="container margin-top-9">

EOF;

    echo $header;
    }


    function printFooter(){

        $Directory = ($this->IsRoot) ? "" : "../";

        $footer = <<<EOF

        </main>      

        <script src="{$Directory}assets/JavaScript/jquery/jquery-3.5.1.min.js"></script>
        <script src="{$Directory}assets/JavaScript/bootstrap/bootstrap.min.js"></script>
    
    </body>
    </html>

EOF;

    echo $footer;
    }
}