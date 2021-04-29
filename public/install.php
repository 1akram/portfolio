<?php
ini_set('max_execution_time', 300);

 $envExamplePath=__DIR__.'/../.env.example';
 $envPath=__DIR__.'/../.env';
 $vandorPath=__DIR__.'/../vendor';




if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  $step = $_POST['step'];
  if (empty($step)) {
    echo json_encode([
        'code'=>1,
        'msg'=>"",
        'data'=>null
        ]);
    return ;
  } 
  switch ($step) {
    case "1":
        if (!file_exists($vandorPath)){
            
            chdir('../');
            exec("composer install --optimize-autoloader --no-dev" ,$output,$return_var); 
            if($return_var==1){//9 vendor file not installed
                echo json_encode([
                    'code'=>9,
                    'msg'=>"",
                    'data'=>null
                    ]);
                return ;
            }
        }
        echo json_encode([
            'code'=>0,
            'msg'=>"",
            'data'=>null
            ]);
        return ;
    case "2":
        function envWrite($key,$value,$path) {
            file_put_contents(
                $path,
                str_replace($key, $key.$value, file_get_contents($path))
            );
        }
        if (!file_exists($envPath)){
            $dbHost = $_POST['dbHost'];
            $dbPort = $_POST['dbPort'];
            $dbName = $_POST['dbName'];
            $dbUserName = $_POST['dbUserName'];
            $dbPassword = $_POST['dbPassword'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            try {
            $conn = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUserName, $dbPassword);
             
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn = null; 
            } catch(PDOException $e) {//10 db connection error
                echo "Connection failed: " . $e->getMessage();
                echo json_encode([
                    'code'=>10,
                    'msg'=>"Connection failed: " . $e->getMessage(),
                    'data'=>null
                    ]);
                return ;
             
            }
            
            chdir('../');
            $return_var= copy($envExamplePath,$envPath);

        
            if($return_var!=1) {//code 11 -> problem in copy env file;
                echo json_encode([
                    'code'=>11,
                    'msg'=>"",
                    'data'=>null
                    ]);
                return ;
            }


            envWrite('APP_ENV=','production',$envPath);
            envWrite('APP_DEBUG=','false',$envPath);
            envWrite('APP_URL=',(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]",$envPath);
            envWrite('DB_HOST=',$dbHost,$envPath);
            envWrite('DB_PORT=',$dbPort,$envPath);
            envWrite('DB_DATABASE=',$dbName,$envPath);
            envWrite('DB_USERNAME=',$dbUserName,$envPath);
            envWrite('DB_PASSWORD=',$dbPassword,$envPath);
            envWrite('INITIAL_EMAIL=',$email,$envPath);
            envWrite('INITIAL_PASSWORD=',$password,$envPath);
            exec(" php artisan key:generate",$output,$return_var);
            if($return_var==1) //code 12 -> problem in key ;
            {
                echo json_encode([
                    'code'=>12,
                    'msg'=>"",
                    'data'=>null
                    ]);
                return ;
            }
            exec(" php artisan storage:link" ,$output,$return_var);
            if($return_var==1)//code 13 -> problem in storage link;
            {
                echo json_encode([
                    'code'=>13,
                    'msg'=>"",
                    'data'=>null
                    ]);
                return ;
            }
            exec("php artisan migrate:refresh --seed --force " ,$output,$return_var);
            if($return_var==1) //code 14 -> problem in migrateion;
            {
                echo json_encode([
                    'code'=>14,
                    'msg'=>"",
                    'data'=>null
                    ]);
                return ;
            }
        }
         
        echo json_encode([
            'code'=>0,
            'msg'=>"",
            'data'=>null
            ]);
        return ;
         
      
     
    default:
   
        echo json_encode([
            'code'=>1,
            'msg'=>"",
            'data'=>null
            ]);
        return ;
     
  } 
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Script Installer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        html {
            height: 100%;
        }

    </style>
     
   
 

</head>

<body>
 
    <div class="container">

<?php if (file_exists($vandorPath)&&file_exists($envPath)){?> 

    <div class="row text-center justify-content-center align-items-center">
        <div class="col-md-12 m-5 text-center">
            <h1 class="">your secript is installed</h1>
            <span>back to home page </span><a class="btn btn-success" href="/">here</a>
        </div>
    </div>

<?php }else if (!file_exists($vandorPath)){ ?> 

    <div class="row text-center justify-content-center align-items-center">
        <div class="col-md-12 m-5 text-center">
            <h1 class="">step one install requerd packages</h1>
            <span>this can take some time </span>
        </div>
        <div class="col-md-12">
            <form id="installPackages"><input type="hidden" name="step" value="1"></form>
            <button id="installPackage" type="button" class="btn btn-primary">install now</button>
        </div>
    </div>

<?php }else if( !file_exists($envPath)){?>

    <div class="row text-center justify-content-center align-items-center">
            <div class="col-md-12 m-5 text-center">
                <h1 class="">step two stup configeration</h1>
                <span>this can take some time </span>
            </div>
            <div class="col-md-12 ">
                <form id="dbConfig">
                    <input type="hidden" name="step" value="2">
                    <div class="form-group">
                      <label for="dbHost">database host</label>
                      <input id="dbHost" name="dbHost" type="text" class="form-control" required placeholder="database host">
                    </div>
                    <div class="form-group">
                        <label for="dbPort">database port</label>
                        <input id="dbPort" name="dbPort" type="text" class="form-control" required value="3306"  placeholder="database port">
                    </div>
                    <div class="form-group">
                        <label for="dbName">database name</label>
                        <input id="dbName" name='dbName' type="text" class="form-control" required placeholder="database name">
                    </div>
                    <div class="form-group">
                        <label for="dbUserName">database user name</label>
                        <input id="dbUserName" name="dbUserName" type="text" class="form-control" required placeholder="database user name">
                    </div>
                    <div class="form-group">
                        <label for="dbPassword">database password</label>
                        <input id="dbPassword" name="dbPassword" type="text" class="form-control" required placeholder="database password">
                    </div>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input id="email" name="email" type="email" class="form-control" required placeholder="your email">
                    </div>
                    <div class="form-group">
                        <label for="password">password</label>
                        <input id="password" name="password" type="text" class="form-control" required placeholder="your password">
                    </div>
                  </form>
                  <button id="config" type="button" class="btn btn-primary">config</button>
            </div>
        </div>

    </div>
  

<?php }?>



 






  


   
    <div>
        <script src="/js/jquery3.5.1.min.js"></script>
        <script>
        $(document).ready(function () {
            
            $("#config").click(function () {
                form = $('#dbConfig') ;
                 
                $.ajax({
                method:'POST',
               // cache:false,
                // url:"dddP.php",
                data: form.serialize(),
                success: function (data,status,xhr) {
                  
                    location.reload();
                },
                error: function (xhr,status,error) {
                    location.reload();
                },
            }); 
            });


            $("#installPackage").click(function () {
                form = $('#installPackages') ;
                 
                $.ajax({
                method:'POST',
                data: form.serialize(),
                success: function (data,status,xhr) {
                    location.reload();
                },
                error: function (xhr,status,error) {
                    location.reload();
                },
            }); 
            });

            

        });  
        </script>
    </div>
</body>
 

</html>

