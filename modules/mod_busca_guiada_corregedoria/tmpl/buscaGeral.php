<div class="box">
    <div class="titulo-consulta-box">Consulta Aberta</div>
    <div class="form-inline" style="text-align:center;">

        <div class="col-sm-8">
            <input type="text" id="paramBusca" name="paramProcuraGeral" autocomplete="off" placeholder="Digite o que está procurando." class="form-control-sm" title="<?= $titleInput ?>" />
        </div>
        <div class="col-sm-4">
            <button class="box botao" title="Limpar os dados da pesquisa" onclick="limparBuscaGeral('<?= $subNivel ?>')">Limpar</button>
            <button class="box botao inverso" title="Realizar a pesquisa" onclick="resultadoBuscaGeral('<?= $WService ?>', '<?= $arg ?>', '<?= $origemAberta ?>','<?= $subNivel ?>', document.getElementById('paramBusca').value, <?= $paginaAberta ?>, <?= $limiteAberta ?>)">Procurar</button>
        </div>
        
    </div>
</div>
<div class="resultadoBuscaGeral" id="resultadoBuscaGeral">
</div>

<script>
    var $inputBusca = $('#paramBusca');
    $inputBusca.on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            resultadoBuscaGeral('<?= $WService ?>', '<?= $arg ?>', '<?= $origemAberta ?>', '<?= $subNivel ?>', document.getElementById('paramBusca').value, <?= $paginaAberta ?>, <?= $limiteAberta ?>)
        }
    });
</script>