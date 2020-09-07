<?php 
        require_once "./Controller/Cliente_Controller.php";
        $perfil = new clientController();
        $datos = $perfil->perfil_cliente($_SESSION['tipo_user']);
        $date = (array) $datos->fetch();
 ?>
 <script>
$(document).ready(function(){
    $(".items-category").hide();
});
</script>
<br>
<section class="container">
    <div class="col-md-12">
        <div class="card rounded-0">
            <div class="card-header">
                <h6>Comprar productos</h6>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nombre del Cliente: <p class="text-muted"><?php echo $date[0]; ?></p></label>
                            </div>
                            <div class="form-group">   
                                <label for="">Apellidos del Cliente: <p class="text-muted"><?php echo $date[1]; ?></p></label>
                            </div>
                            
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">DNI del Cliente: <p class="text-muted"><?php echo $date[7]; ?></p></label>
                            </div>
                            <div class="form-group">
                                    <label for="">Nro Cel: <p class="text-muted"><?php echo $date[5]; ?></p></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Direccion: <p class="text-muted"><?php echo $date[4]; ?></p></label>
                                </div>
                                <div class="form-group">   
                                    <label for="">Distrito: <p class="text-muted"><?php echo $date[14]; ?></p></label>
                                </div>
                                
                        </div>
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Provincia: <p class="text-muted"><?php echo $date[15]; ?></p></label>
                                </div>
                                <div class="form-group">
                                    <label for="">Departamento: <p class="text-muted"><?php echo $date[16]; ?></p></label>
                                </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-md-12" style="overflow:auto;">
                    <table class="table table-stripet">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody id="lista_car_compra">
                                
                            </tbody>
                        </table>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table">
                        <tbody><tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>S/. <p id="subtotal"></p></td>
                        </tr>
                    </tbody></table>

                    
                </div>
                <hr>
                <div class="col-md-12">
                <form action="<?php echo SERVERURL; ?>Ajax/Ajax_cliente.php"  class="formAjax" method="post">
                        <div class="row">
                        <input type="text" name="cod_cliente" style="display:none;" value="<?php echo $date['11'];?>">
                        <input type="text" name="saldo_cliente" style="display:none;" value="<?php echo $date['12'];?>">
                        <input type="text" name="precio_subtotal" id="valor_t" style="display:none;">
                        <textarea name="datos" id="datos_car" cols="30" style="display:none;" rows="10"></textarea>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-outline-success rounded-0" value="Realizar Compra">
                                </div>
                            </div>
                        </div>
                        <div class="RespuestaAjax"></div>
                    </form>
                    <script>
                    load_table();
                        function load_table(){
                            //alert("hello");
                            let productoL;

                            if(localStorage.getItem("productos") == null){
                                productoL = [];
                            }else{
                                productoL = JSON.parse(localStorage.getItem('productos'));
                            }
                            let vartam = document.getElementById('lista_car_compra');
                            let ass = productoL.length;
                            //console.log(productoL);
                            var lista = 0.0,dos = 0.0;
                            for(var a = 0; a < ass ; a++){
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <th scope="row"><img src="${productoL[a].imagen}" width=100></th>
                                    <td><p>${productoL[a].titulo}</p></td>
                                    <td><p>S/. ${(productoL[a].precio * productoL[a].cantidad).toFixed(2)}</p></td>
                                    <td><p>${productoL[a].cantidad}</p></td>                               
                                `;
                                lista = parseFloat(productoL[a].precio * productoL[a].cantidad);
                                //console.log(parseFloat(lista));
                                dos = parseFloat(dos + lista);
                                vartam.appendChild(row);
                                
                            }
                            //console.log(dos);
                            
                            document.getElementById("subtotal").innerHTML = dos;
                            document.getElementById("datos_car").innerHTML = JSON.stringify(productoL);
                            //console.log(json_decode(productoL));
                            document.getElementById("valor_t").value = dos;
                            
                        }
                </script>
                </div>
            </div>
        </div>
    </div>
</section>
