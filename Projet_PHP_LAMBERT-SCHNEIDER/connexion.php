
<?php error_reporting ( E_ALL ^ E_NOTICE);

try
{
  $adress = 'mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=lamber235u_IUTNews; charset=utf8';
  $log = 'lamber235u_appli';
  $motdepasse = 'AnArchie5718@/';

  $objPdo = new PDO($adress,$log,$motdepasse);
}
catch( Exception $exception )
 {
    die($exception->getMessage());
  }


?>
