<?php require '../header.php';?>
    <div class="container">

      <form class="form-signin" id="dynsel" name="dynsel" >
        <h2 class="form-signin-heading">OBJET</h2><br/>
        
        
        <input name="input-objet" type="text" id="inputObjet" class="form-control objet" placeholder="ID Objet" required autofocus onblur="verifMail(this)"><br/>
        
        <input name="nameobjet" type="text" id="nameobjet" class="form-control objet" placeholder="Nom de l'objet" required autofocus onblur="verifMail(this)">
        <br/><br/>

        <!-- T Y P E  D A T A -->
        <label></label>
        <select name="select1" id="select1" onchange="selectoption();" >
           <option selected="selected" style="width:147px">Type de données</option>
           <option>Temperature</option>
           <option>humidité</option>
           <option>Flux hydrolique</option>
           <option>Mesure Courant</option>
           <option>Autre</option>
        </select> 
        <br/><br/>

        <!-- A J O U T  ET  S U P P R I S S I O N-->
        
        <input name="title" type="text" id="title"  placeholder="Ajouter de nouveau Type" value="" size="40"  />
        <input type="button" name="add"  style="width:147px" value="Ajouter" onclick="addoption()"  onblur="verifMail(this)"/>
        <input type="button" name="del"  style="width:148px" value="Supprimer" onclick="deloption()"  onblur="verifMail(this)"/>
        <br/><br/>
        
        <!-- V A D I T I O N -->
        <input class="btn btn-danger" type="reset" value="Cancel" onclick="myreset()" >
        <button class="btn btn-primary" type="submit">Valid</button>
      </form>

    </div> <!-- /container -->

    <script src="../js/verif_saisie.js"></script>
 <?php require '../footer.php';?>
