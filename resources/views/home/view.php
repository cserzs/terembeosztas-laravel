<div class="container">

<h2 class="is-size-2 has-text-centered has-text-weight-bold"><?=$osztaly->nev?></h2>


<table class="table is-fullwidth has-text-centered is-bordered is-hoverable is-narrow catalog-table">
<thead class="has-text-weight-bold">
    <tr>
        <td></td>
        <td>Hétfő</td>
        <td>Kedd</td>
        <td>Szerda</td>
        <td>Csütörtök</td>
        <td>Péntek</td>
    </tr>
</thead>
<tbody>
    <?php for($idopont = 0; $idopont < 9; $idopont++): ?>
    <tr>
        <td class="has-text-weight-bold"><?=$idopont ?>.</td>
        <?php for($nap = 0; $nap < 5; $nap++): ?>
            <td>
                <?php $count = count($teremrend[$nap][$idopont]); ?>
                
                <?php if ($count == 1): ?>
                    <?=$teremrend[$nap][$idopont][0] ?>

                <?php elseif ($count > 1): ?>
                    <div class="columns catalog-cell">
                    <?php foreach($teremrend[$nap][$idopont] as $terem): ?>
                        <div class="column hatarolo"><?=$terem ?></div>
                    <?php endforeach; ?>
                    </div>

                <?php endif; ?>
            </td>
        <?php endfor; ?>
    </tr>
    <?php endfor; ?>
</tbody>
</table>

</div>
