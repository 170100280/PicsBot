<?PHP
include_once("info/db.php");

$stmt = $conn->prepare("SELECT id,nome,email,foto FROM utilizadores");
$stmt->execute();
?>
<table>
<?PHP
$projFolder = "/programacao_para_web/21032018";
$imagem = "http://".$_SERVER["HTTP_HOST"].$projFolder;
while($result = $stmt->fetch())
{
  echo "<tr>";
    echo "<form method='POST' action='PDO/apagarRegisto.php'>";
      echo "<td><input type=\"hidden\" name=\"id\" value=\"".$result['id']."\"/></td>";
      echo "<td>".$result["nome"]."</td>";
      echo "<td>".$result["email"]."</td>";
      echo "<td><img src='".$imagem.$result["foto"]."'/></td>";
      echo "<td><input type='submit' value='X'/></td>";
    echo "</form>";
  echo "</tr>";
}

?>

</table>
<style>
img
{
  max-width:40px;
  max-height:40px;
}
</style>
