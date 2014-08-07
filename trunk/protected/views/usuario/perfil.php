MIS DATOS DE PERFIL CON MI MODAL
<script>
    function viewModal(url)
    {
        var urlLista = baseUrl + "index.php?r=" + url;
        $.ajax({
            type: "POST",
            url: urlLista,
            success: function(data) {
                console.log(data);
                showModalData(data);

            }
        });
    }
    function showModalData(html) {
        $("#mainModal").html(html);

        $("#mainModal").modal("show");

    }

    function mostrar()
    {
   
   var dt =  'DATOS POR SEPARADO</div><div class="modal-footer"><a onClick="alert(&quot;aasd&quot;)" class="btn btn-success"><i class="icon-ok"></i> Guardar</a>    <a data-dismiss="modal" class="btn"><i class="icon-remove"></i> Cancel</a></div>' 

        $("#mainModal").html(dt);
        $("#mainModal").modal("show");
    }
</script>

<div class=''>
    <div class='text-center'>
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'id' => 'add-Oportunidad',
            'label' => 'Registrar',
            'encodeLabel' => false,
            'icon' => 'tag',
            'htmlOptions' => array(
                'onClick' => 'viewModal("usuario/RegistroPerfilModal")',
            ),
        ));

        $this->widget('bootstrap.widgets.TbButton', array(
            'type' => 'success',
            'icon' => 'ok',
            'label' => Yii::t('AweCrud.app', 'Mostrar '),
//        'label' => $model->isNewRecord ? Yii::t('AweCrud.app', 'Create') : Yii::t('AweCrud.app', 'Save'),
            'htmlOptions' => array(
                'onClick' => 'mostrar()')
        ));
        ?>
    </div>
</div>



