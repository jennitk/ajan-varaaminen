<?php 
require_once "config.php";
include('includes/head.php');

// Define variables and initialize with empty values
$tpid = $pvm = $klo = "";

//katsotaan tuleeko id oikein
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($link, $_GET['id']);
    $select = "SELECT * FROM terapeutit WHERE users_fk=$id";
    $tulos = mysqli_query($link, $select);
    $tp = mysqli_fetch_assoc($tulos);
    mysqli_free_result($tulos);
  
}


    if(isset($_POST['teeVaraus'])){
  // TERAPEUTIN KALENTERI tauluun vievä osio
  for ($i = 0; $i < count($_POST['aika']); $i++) {

    $sql = "INSERT INTO terapeutin_kalenteri (kalenteri_fk,tp_fk) VALUES ((SELECT kalenteri_id FROM kalenteri WHERE kalenteri_pvm = ? AND kalenteri_kellonaika = ?), ?)";

    if($stmt = mysqli_prepare($link, $sql)){
      mysqli_stmt_bind_param($stmt, "sss", $pvm, $klo, $tpid);
      
      //parametrit
      $tpid = $tp['tp_id'];
      $pvm = $_POST['pvm'];
      $klo = $_POST['aika'][$i];

      if(mysqli_stmt_execute($stmt)){
          echo "Records inserted successfully.";
      } else{
          echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
      }
  } 
  else{
    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($link);
  }
}
}


?>

<div class="container">
<br>
<br>
<div class="row"  style="height: 300px;">


<div class="col-8">
<h3 style="margin-top:35px">Olet varaamassa aikaa terapeutille <?php echo $tp['tp_etunimi']; echo " " ;echo $tp['tp_sukunimi'] ?>.
<br>
<h5 style="font-weight: lighter; font-style: italic;"><?php echo $tp['tp_esittelyteksti'];?></h5>
<br> 
<h3 style="font-weight: lighter;">Sähköpostiosoite: <?php echo $tp['tp_email'];?></h3>

</div>
<div class="col-3">
<?php 
$id=$tp['users_fk'];
$kuva = "SELECT users_fk, imagename FROM uploadedimage WHERE users_fk='$id'";
$tulos = $link->query($kuva);
$kuvat= mysqli_fetch_all($tulos, MYSQLI_ASSOC);

mysqli_free_result($tulos);
foreach ($kuvat as $kuva){
$imgname = ($kuva['imagename']);
}
$folder='ladatutkuvat/'
?>
<img class="card-img-top" style="width: 300px; height: 300px; background-repeat: no-repeat; " src="<?php echo $folder.$imgname?>">
</div>
</div>
 <br>
 <h3>Kalenterista näet vapaana olevat ajat.</h3>
 <br>
    <div class="row">
        <div class="col-sm-6">
            <form method="post">
                
                <div class="form-group">
                    <label>Syötä pvm tai valitse kalenterista</label>
                    <input type="text" id="datepicker" name="pvm" value="<?php echo $pvm; ?>">
                </div>

        </div>



        <div class="col-sm-6">

            <div class="form-group" style="margin-top:90px";>
                <div style="border-style:solid; border-radius: 10px; border-width: 1px; margin-top: 5px;">
                    <div class="form-check" style="margin-left: 10px;">
                        <input class="form-check-input" type="checkbox" name="aika[]" value="8:00 - 9:00">
                        <label class="form-check-label" for="invalidCheck2">
                            8:00 - 9:00
                        </label>
                    </div>
                </div>
                <div style="border-style:solid; border-radius: 10px; border-width: 1px; margin-top: 5px;">
                    <div class="form-check" style="margin-left: 10px;">
                        <input class="form-check-input" type="checkbox" name="aika[]" value="9:00 - 10:00">
                        <label class="form-check-label" for="invalidCheck2">
                            9:00 - 10:00
                        </label>
                    </div>
                </div>
                <div style="border-style:solid; border-radius: 10px; border-width: 1px; margin-top: 5px;">
                    <div class="form-check" style="margin-left: 10px;">
                        <input class="form-check-input" type="checkbox" name="aika[]" value="10:00 - 11:00">
                        <label class="form-check-label" for="invalidCheck2">
                            10:00 - 11:00
                        </label>
                    </div>
                </div>
                <div style="border-style:solid; border-radius: 10px; border-width: 1px; margin-top: 5px;">
                    <div class="form-check" style="margin-left: 10px;">
                        <input class="form-check-input" type="checkbox" name="aika[]" value="11:00 - 12:00">
                        <label class="form-check-label" for="invalidCheck2">
                            11:00 - 12:00
                        </label>
                    </div>
                </div>
                <div style="border-style:solid; border-radius: 10px; border-width: 1px; margin-top: 5px;">
                    <div class="form-check" style="margin-left: 10px;">
                        <input class="form-check-input" type="checkbox" name="aika[]" value="12:00 - 13:00">
                        <label class="form-check-label" for="invalidCheck2">
                            12:00 - 13:00
                        </label>
                    </div>
                </div>
                <div style="border-style:solid; border-radius: 10px; border-width: 1px; margin-top: 5px;">
                    <div class="form-check" style="margin-left: 10px;">
                        <input class="form-check-input" type="checkbox" name="aika[]" value="13:00 - 14:00">
                        <label class="form-check-label" for="invalidCheck2">
                            13:00 - 14:00
                        </label>
                    </div>
                </div>
                <div style="border-style:solid; border-radius: 10px; border-width: 1px; margin-top: 5px;">
                    <div class="form-check" style="margin-left: 10px;">
                        <input class="form-check-input" type="checkbox" name="aika[]" value="14:00 - 15:00">
                        <label class="form-check-label" for="invalidCheck2">
                            14:00 - 15:00
                        </label>
                    </div>
                </div>
                <div style="border-style:solid; border-radius: 10px; border-width: 1px; margin-top: 5px;">
                    <div class="form-check" style="margin-left: 10px;">
                        <input class="form-check-input" type="checkbox" name="aika[]" value="15:00 - 16:00">
                        <label class="form-check-label" for="invalidCheck2">
                            15:00 - 16:00
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                  <input type="submit" name="teeVaraus" class="btn btn-info btnKirjaudu" style="margin-top:30px"; id="btnTeeVaraus" onchange="blockFunktio(this)" value="Tee varaus">
                </div>
            </div>
        </div>
    </div>
</div>



</form>
<div class="col-sm">

</div>
</div>

<div class="container">

    <div id="tbVaraustiedot">
        <div>
            <p>Täytä allaolevat henkilötietosi varataksesi ajan:</p>
        </div>
        <div class="">
            <label for="validationDefault01">Etunimi</label>
            <input type="text" class="form-control" id="tbxEtunimi" required>
            <div>
                <label for="validationDefault03">Sukunimi</label>
                <input type="text" class="form-control" id="tbxSukunimi" required>
            </div>
            <div>
                <label for="validationDefault03">Osoite</label>
                <input type="text" class="form-control" id="tbxKaupunki" required>
            </div>
            <div>
                <label for="exampleInputEmail1">Sähköpostiosoite</label>
                <input type="email" class="form-control" id="tbxSähköpostiosoite" required>
            </div>
            <div>
                <label for="exampleInputEmail1">Puhelinnumero</label>
                <input type="email" class="form-control" id="tbxSähköpostiosoite" required>
            </div>
        </div>
        <button class="btn btn-info btnVaraa"> Lähetä </button>

    </div>
</div>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="Pictures/datepicker-fi.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>

<script>

$("#btnTeeVaraus").on("click",function(e) {
  e.preventDefault();
  $("#tbVaraustiedot").show();
  console.log("hei");
});
</script>



<script>
$(function() {
    $('#datepicker1').datepicker($.extend({
            minDate: new Date()
        },
        $.datepicker.regional['fi']
    ));
});
</script>
<script src="
  https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(document).ready(function() {
    $("#datepicker").change(function() {
        var date = $('#datepicker').datepicker({
            format: 'yyyy-mm-dd'
        }).val();
        console.log(date);
        $("#teksti").text("Valittu päivämäärä: " + date);
    });
});
</script>

<script>
$('#datepicker').datepicker({
    minDate: new Date(1995, 12, 1),
    maxDate: new Date(2022, 11, 31),
    dateFormat: 'yy-mm-dd',
    onSelect: function(dateText, inst) {
        var value = $("input[name='pvm']").val(dateText)[0].value;
        var res = value.replace(/\//g, "-");
        console.log(res);
    }
});
</script>



<?php  //suljetaan tietokantayhteys
 mysqli_close($link); ?>

<?php include('includes/footer.php')?>