class Carrito{
    //add producto car
    comprarProducto(e){
        //console.log("error--");
        e.preventDefault();
        try{
            if(e.target.classList.contains('agregar-carrito')){
                console.log("execute");
                const producto = e.target.parentElement.parentElement.parentElement.parentElement;
                //this.leerDatosProducto(producto);
                console.log(producto);
            }else{
                console.log("no se pudo capturar evento");
            }
        }catch (error){
            console.log(error);
        }
    }
}