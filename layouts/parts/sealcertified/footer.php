<div style=" margin-top: 90px;">
    <table style="width: 100%;">
        <tr>
            <td class="td-format" >
               <span class="info-link-certified">
               Acesse o link abaixo para acessar o comprovante desta declaração:
               </span>
               <label for="">
                    <a href="<?php echo $app->createUrl('seal','printsealrelation',[$relation->id]); ?>" class="link-selo-cuidar-melhor">
                        <?php echo $app->createUrl('seal','printsealrelation',[$relation->id]); ?>
                    </a>    
               </label>
            </td>
            <td class="td-format" >

            </td>
            <td  class="td-format" >
                <p>
                    <span class="info-link-certified">
                    Escola de Saúde Pública do Ceará Paulo Marcelo Martins Rodrigues Av. Antônio Justa, 3161 - Meireles • CEP: 60.165-090 Fortaleza / CE • Fone: (85) 3101.1398
                    </span>
                </p>
            </td>
        </tr>
    </table>
</div>
<img src="<?php echo PLUGINS_PATH.'SealCertified/assets/img/sealcertified/rodape.png'; ?>" style=" margin-bottom: 30mm; width: 100%;
bottom: 0; left: 0;">

</body>
</html>