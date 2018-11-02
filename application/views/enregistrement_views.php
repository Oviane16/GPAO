<legend>Enregistrement de travail</legend>
<div id="form_lot">
    <form method="POST" action="">
        <fieldset>
            <table>
                <tr>
                    <td>
                    <label>Matricule:</label>
                        <input name="extension" id="extension" class="span1" type="text"  value="">
                    </td>
                    <td>        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    </td>
                    <td>
                        <label>Pass:</label>
                        <input name="chemin" id="chemin" class="span2" type="password"value="">
                    </td>
                </tr>
                </table>
            <table>
                <tr>
                    <td>
                        <label>Nom:</label>
                        <input name="extension" id="extension" class="span3" type="text"  value="">
                    </td>
                    <td>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <label>Prénom:</label>
                        <input name="extension" id="extension" class="span3" type="text"  value="">
                    </td>
                <tr>
            </table>
            <table>
                <tr>
                    <td>
                        <label>Pseudo:</label>
                            <input name="export" id="export" class="span2" type="text" >
                    </td>
                    <td>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                    <td>
                        <label>Fonction:</label>
                        <input name="export" id="export" class="span2" type="text" >
                    </td>
                </tr>
            </table>


              <table>
                <tr>
                    <td>
                        <label>Commande:</label>
                            <select name="traitement"  id="traitement" >
                                <option>             </option>
                                <option>CHDO001</option>
                                <option>CHDO002</option>
                                <option>CHDH001</option>
                            </select>
                    </td>
                    <td></td>

                    <td>
                        <label>Etape:</label>
                        <select name="traitement"  id="traitement">
                                <option>IMAGE</option>
                                <option>TEXTE</option>
                                <option>COUPON</option>
                                <option >ANNUAIRE</option>
                                <option >WEB</option>
                            </select>

                    </td>
                </tr>
            </table>
<button type="button" id="preparation" class="btn btn-info" name="afficher">Enregistrer </button>
        </fieldset>
    </form>
</div>