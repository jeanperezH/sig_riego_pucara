<template>
    <main class="main">
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-8">
                        <h2 class="text-center">Zona 1 - COMPUERTAS</h2>
                        
                        <div class="input-group">
                            <select class="form-control col-md-4" v-model="criterio" >
                                <option value="nombre">compuerta</option>
                                <option value="hora_inici">Hora Apertura</option>
                                <option value="hora_final">Hora Cierre</option>
                                
                            </select>
                            <input type="text" class="form-control" v-model="buscar" @keyup.enter="listarCompuerta(1,buscar,criterio)"  placeholder="texto a buscar" >
                            <button type="submit" class="btn btn-primary" @click="listarCompuerta(1,buscar,criterio)" ><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="tab-trans table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Compuerta</th>
                                <th>Hora Apertura</th>
                                <th>Hora Cierre</th>
                                <th>zona</th>
                                <th>UTMX</th>
                                <th>UTMY</th>
                                <th>imagen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="compuerta in arrayCompuerta" :key="compuerta.id">
                                
                                <td v-text="compuerta.nombre"></td>
                                <td v-text="compuerta.hora_inici"></td>
                                <td v-text="compuerta.hora_final"></td>
                                <td v-text="compuerta.zona"></td>
                                <td v-text="compuerta.utmx"></td>
                                <td v-text="compuerta.utmy"></td>
                                
                                <td>
                                    <button type="button" @click="abrirModalActualizar('valvula','actualizar',compuerta)" class="btn btn-info btn-sm" >
                                    <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button type="button" @click="abrirModal('compuerta','ver',compuerta)" class="btn btn-success btn-sm" >
                                    <i class="icon-eye"></i>
                                    </button> &nbsp;
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                
                <nav>
                    <ul class="pagination">
                        <li class="page-item" v-if="pagination.current_page > 1">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                        </li>
                        <li class="page-item " v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                        </li>
                        
                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>
    <!--Inicio del modal actualizar-->
    <div class="modal fade"  tabindex="-1" :class="{'actualizar' : modalActualizar}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
              <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Nombre válvula</label>
                    <div class="col-md-9">
                      <input type="text" v-model="nombre" class="form-control" placeholder="Válvula X">                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Hora Apertura</label>
                    <div class="col-md-9">
                      <input type="text" v-model="hora_inici" class="form-control" placeholder="8:00 - 10:00">                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Hora Cierre</label>
                    <div class="col-md-9">
                      <input type="text" v-model="hora_final" class="form-control" placeholder="lunes - viernes">                                        
                    </div>
                  </div>
                  
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">UTMX</label>
                    <div class="col-md-9">
                      <input type="text" v-model="utmx" class="form-control" placeholder="">                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">UTMY</label>
                    <div class="col-md-9">
                      <input type="text" v-model="utmy" class="form-control" placeholder="">                                        
                    </div>
                  </div>

                  <!--<div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input" >Imagen</label>
                    <div class="col-md-9">
                      <input type="file" id="imagen" ref="imagen" v-on:change="img()" class="form-control" accept="image/*"/>
                    </div>
                  </div>-->
                        
                  <div v-show="errorCompuerta" class="form-group row div-error">
                    <div class="text-center text-error">
                      <div v-for="error in errorMostrarMsjCompuerta" :key="error" v-text="error">

                      </div>
                    </div>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
              <!--<button type="button" v-if="tipoAccion==1" class="btn btn-success" @click="registrarGallo()">Guardar</button>-->
              <button type="button" v-if="tipoAccion==2" class="btn btn-success" @click="actualizarCompuerta()">Actualizar</button>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Inicio del modal ver Imagen y detalles-->
    <div class="modal fade"  tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <center>
                                <h2>Foto</h2>
                                <img :src="this.imagen" width="100%">
                            </center>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <center>
                                <h2>DETALLES</h2>
                                <h6 class="card-text text-left">Compuerta: <div class="text-modalVerImagen"><td v-text="nombre"></td></div> </h6>
                                <h6 class="card-text text-left">Hora de Apertura:<td v-text="hora_inici" class="text-modalVerImagen"></td></h6>
                                <h6 class="card-text text-left">Hora de Cierre:<td v-text="hora_final" class="text-modalVerImagen"></td></h6>
                            </center>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
                    
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
    
</main>
</template>

<script>
    export default {
        data(){
            return{
                compuerta_id:0,
                gid : 0,
                nombre : '',
                hora_inici : '',
                zona : '',
                hora_final : '',
                utmx : '',
                utmy : '',
                imagen:null,
                geom : '',
                arrayCompuerta:[],
                modal : 0,
                modalActualizar : 0,
                tituloModal :'',
                tipoAccion:0,
                
                errorCompuerta:0,
                errorMostrarMsjCompuerta:[],
                pagination :{
                    'total' :0,
                    'current_page' :0,
                    'per_Page' :0,
                    'last_page' :0,
                    'from' :0,
                    'to' :0,
                },
                offset:3,
                criterio: 'nombre',
                buscar:''
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //calcula los elementos de la paginacion
            pagesNumber: function(){
                if(!this.pagination.to){return [];}
                var from = this.pagination.current_page - this.offset;
                if(from<1){
                    from=1;
                }
                var to = from + (this.offset * 2);
                if(to >=this.pagination.last_page){
                    to=this.pagination.last_page;
                }
                var pagesArrary=[];
                while(from<=to){
                    pagesArrary.push(from);
                    from++;
                }
                return pagesArrary;
            }
        },
        methods: {
            listarCompuerta(page,buscar,criterio){
                let me = this;
                var url='/compuertas?page=' + page+'&buscar=' +buscar+'&criterio='+criterio;
                
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayCompuerta=respuesta.compuertas.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            img() {
            this.imagen = this.$refs.imagen.files[0];
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //actualiza la pagina actual
                me.pagination.current_page = page;
                //
                me.listarCompuerta(page,buscar,criterio);
                
            },
            actualizarCompuerta(){
                /*if(this.validarCompuerta()){
                    return;
                }*/

                let me = this;
                axios.put('/compuertas/actualizar' ,{
                    'gid':this.gid,
                    'id':this.compuerta_id,
                    'nombre':this.nombre,
                    'hora_inici':this.hora_inici,
                    'hora_final':this.hora_final,
                    'zona':this.zona,
                    'utmx':this.utmx,
                    'utmy':this.utmy,
                    'imagen':this.imagen,
                    'geom':this.geom,
                }).then(function(response){
                    me.cerrarModal();
                    me.listarCompuerta(1,'','nombre');
                }).catch(function(error){
                    console.log(error);
                })
            },
            /*validarCompuerta(){
                this.errorDocente=0;
                this.errorMostrarMsjDocente=[];
                if(!this.nombres || !this.apellidos ) this.errorMostrarMsjDocente.push("Los campos no pueden estar vacíos");
                if(this.errorMostrarMsjDocente.length) this.errorDocente=1;
                return this.errorDocente;
            },*/
            abrirModalActualizar(modelo, accion, data=[]){
                switch(modelo){
                    case "valvula":{
                        switch(accion){
                            case 'actualizar':{
                                this.modalActualizar = 1;
                                this.tituloModal="Actualizar " + data['nombre'];
                                this.tipoAccion=2;
                                this.gid=data['gid'];
                                this.compuerta_id=data['id'];
                                this.nombre=data['nombre'];
                                this.hora_inici=data['hora_inici'];
                                this.hora_final=data['hora_final'];
                                this.zona=data['zona'];
                                this.utmx=data['utmx'];
                                this.utmy=data['utmy'];
                                this.imagen = data['imagen'];
                                this.geom = data['geom'];
                                break;
                            }
                        }
                    }
                }
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "compuerta":{
                        switch(accion){
                            
                            case 'ver':{
                                
                                this.modal=1;
                                this.tituloModal="Detalles de la " + data['nombre'];
                                //this.tipoAccion=2;
                                this.nombre = data['nombre'];
                                this.hora_inici = data['hora_inici'];
                                this.hora_final = data['hora_final'];
                                this.compuerta_id=data['id'];
                                this.imagen = data['imagen'];
                                var rename ="";
                                var letra = String.fromCharCode(92);
                                rename = this.imagen.replace(letra ,'_');
                                for (var i=0; i<this.imagen.length; i++){
                                    rename = rename.replace(letra ,'_');
                                }
                                rename = rename.replace(':' ,'_');
                                this.imagen = "images/" + rename;
                                break;
                            }
                        }
                    }
                }
            },
            cerrarModal(){
                this.modal=0;
                this.modalActualizar=0;
                this.tituloModal='';
                this.gid=0;
                this.compuerta_id='';
                this.nombre='';
                this.hora_inici='';
                this.hora_final='';
                this.zona='';
                this.utmx='';
                this.utmy='';
                this.imagen = null;
                this.geom='';
            }
        },
        mounted() {
            this.listarCompuerta(1,this.buscar,this.criterio);
        }
    }
</script>
<style>
    .modal-content{
        
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .actualizar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red;
        font-weight: bold;
    }
</style>
