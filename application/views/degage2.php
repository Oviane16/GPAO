<?php


if($etape->ETAPE == 'CONTROLE' || $etape->ETAPE == 'CONTROLE ECH'|| $etape->ETAPE == 'CONTROLE WEB')
{?>

    <tr>
        <td style=" color: #61cf50;">
            Controle non traité:
        </td>
        <td>
            <?php if(isset($data_nb_notraite_c)){ echo $data_nb_notraite_c[$i-1]['nb_notraite_c']; } ?>
        </td>
    </tr>
    <tr>
        <td style=" color: #61cf50;">
            Controle En cours:
        </td>
        <td>
            <?php if(isset($data_nb_encours_c)){ echo $data_nb_encours_c[$i-1]['nb_encours_c']; } ?>
        </td>
    </tr>
    <tr>
        <td style=" color: #61cf50;">
            Controle fini:
        </td>
        <td>
            <?php if(isset($data_nb_fini_c)){ echo $data_nb_fini_c[$i-1]['nb_fini_c']; } ?>
        </td>
    </tr>

<?php}
if($etape->ETAPE == 'FORMATAGE' )
{?>
    <tr>
        <td style=" color: #ea7156;">
            Formatage non traité:
        </td>
        <td>
            <?php if(isset($data_nb_notraite_fo)){ echo $data_nb_notraite_fo[$i-1]['nb_notraite_fo']; } ?>
        </td>
    </tr>
    <tr>
        <td style=" color: #ea7156;">
            Formatage En cours:
        </td>
        <td>
            <?php if(isset($data_nb_encours_fo)){ echo $data_nb_encours_fo[$i-1]['nb_encours_fo']; } ?>
        </td>
    </tr>
    <tr>
        <td style=" color: #ea7156;">
            Formatage fini:
        </td>
        <td>
            <?php if(isset($data_nb_fini_fo)){ echo $data_nb_fini_fo[$i-1]['nb_fini_fo']; } ?>
        </td>
    </tr>
<?php}
if($etape->ETAPE == 'RECHERCHE' || $etape->ETAPE == 'LECTURE' )
{?>
    <tr>
        <td style=" color: #d7d467;">
            Lecture non traité:
        </td>
        <td>
            <?php if(isset($data_nb_notraite_lec)){ echo $data_nb_notraite_lec[$i-1]['nb_notraite_lec']; } ?>
        </td>
    </tr>
    <tr>
        <td style=" color: #d7d467;">
            Lecture En cours:
        </td>
        <td>
            <?php if(isset($data_nb_encours_lec)){ echo $data_nb_encours_lec[$i-1]['nb_encours_lec']; } ?>
        </td>
    </tr>
    <tr>
        <td style=" color: #d7d467;">
            Lecture fini:
        </td>
        <td>
            <?php if(isset($data_nb_fini_lec)){ echo $data_nb_fini_lec[$i-1]['nb_fini_lec']; } ?>
        </td>
    </tr>
<?php}
if($etape->ETAPE == 'LIVRAISON')
{?>

    <tr>
        <td style=" color: #44c0d7;">
            Livraison non traité:
        </td>
        <td>
            <?php if(isset($data_nb_notraite_li)){ echo $data_nb_notraite_li[$i-1]['nb_notraite_li']; } ?>
        </td>
    </tr>
    <tr>
        <td style=" color: #44c0d7;">
            Livraison En cours:
        </td>
        <td>
            <?php if(isset($data_nb_encours_li)){ echo $data_nb_encours_li[$i-1]['nb_encours_li']; } ?>
        </td>
    </tr>
    <tr>
        <td style=" color: #44c0d7;">
            Livraison fini:
        </td>
        <td>
            <?php if(isset($data_nb_fini_li)){ echo $data_nb_fini_li[$i-1]['nb_fini_li']; } ?>
        </td>
    </tr>

<?php}
?>