<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.rtl.css">
    <link rel="stylesheet" href="css/bootstrap.rtl.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirmer un choix</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light" data-bs-theme="dark">
        <div class="container-fluid">
        <span class="navbar-brand" href="#"><img src="assets/logo.jpg" style="width: 80px;"alt="" srcset=""><span class="text-primary">Next-gen-govt</span></span>
          <div class=" navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
              
            </ul>
            <div class="row">
            <div class="col">
                    <form class="d-flex" action="page_principale.html">
                        <input type="submit" class="btn btn-light text-primary border-primary"style="border-radius:15px;" value="Acceuil">
                    </form>
                </div>
                <div class="col">
                    <form class="d-flex" action="recupfichier.html">
                        <input type="submit" class="btn btn-light text-primary border-primary"style="border-radius:15px;" value="Obtenir un document">
                    </form>
                </div> 
                <div class="col">
                    <form class="d-flex" action="deconnexion.php">
                        <input type="submit" class="btn btn-light text-primary border-primary"style="border-radius:15px;" value="Se deconnecter">
                    </form>
                </div>
            </div>
          </div>
        </div>
      </nav>
      
      <div class="row container-fluid">
        <div class="col card border-light"style="height: 350px;">
            <div class="card-header"><h3 class="text-primary text-center">Pour <?php echo $_GET['demande'];?>, il vous faut les documents suivants</h3></div>
            <div class="card-body" style="overflow-y:scroll;">Atao eto le tohiny</div>
        </div>
        <div class="col">
            <img src="assets/confirm.jpg" alt="" srcset=""style="height: 520px;">
        </div>
      </div>
</body>
</html>