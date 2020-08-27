<template>
    <main class="main">
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-8">
                        <center><h2>ZONA 3 - RIOS</h2></center>
                        <div class="input-group">
                            <select class="form-control col-md-4" v-model="criterio" >
                                <option value="nombre_rio">Rio</option>
                                <option value="tipo_rio">Tipo rio</option>
                                
                            </select>
                            <input type="text" v-model="buscar" @keyup.enter="listarRio(1,buscar,criterio)" class="form-control" placeholder="rio a buscar" >
                            <button type="submit" class="btn btn-primary" @click="listarRio(1,buscar,criterio)" ><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="tab-trans table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Rio</th>
                                <th>Tipo rio</th>
                                <th>Longitud</th>
                                <th>zona</th>
                                <th>imagen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="rio in arrayRio" :key="rio.id">
                                
                                <td v-text="rio.nombre_rio"></td>
                                <td v-text="rio.tipo_rio"></td>
                                <td v-text="rio.longitud_m  + ' m'"></td>
                                <td v-text="rio.zona"></td>
                                <td>
                                    <button type="button" @click="abrirModalActualizar('rio','actualizar',rio)" class="btn btn-info btn-sm" >
                                    <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button type="button" @click="abrirModal('rio','ver',rio)" class="btn btn-success btn-sm" >
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
                      <label class="col-md-3 form-control-label" for="text-input">Nombre río</label>
                    <div class="col-md-9">
                      <input type="text" v-model="nombre_rio" class="form-control" placeholder="Río X">                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Tipo de rio</label>
                    <div class="col-md-9">
                      <input type="text" v-model="tipo_rio" class="form-control" placeholder="principal">                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Longitud</label>
                    <div class="col-md-9">
                      <input type="text" v-model="longitud_m" class="form-control" placeholder="100">                                        
                    </div>
                  </div>
                  
                  <!--<div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input" >Imagen</label>
                    <div class="col-md-9">
                      <input type="file" id="imagen" ref="imagen" v-on:change="img()" class="form-control" accept="image/*"/>
                    </div>
                  </div>-->
                        
                  <div v-show="errorRio" class="form-group row div-error">
                    <div class="text-center text-error">
                      <div v-for="error in errorMostrarMsjRio" :key="error" v-text="error">

                      </div>
                    </div>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
              
              <button type="button" v-if="tipoAccion==2" class="btn btn-success" @click="actualizarRio()">Actualizar</button>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Inicio del modal ver imagen y detalles-->
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
                                <h2>IMAGEN</h2>
                                <img :src="this.imagen" width="100%">
                            </center>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <center>
                                <h2>DETALLES</h2>
                                <h6 class="card-text text-left">Nombre del río: <div class="text-modalVerImagen"><td v-text="nombre_rio"></td></div> </h6>
                                <h6 class="card-text text-left">Tipo de río:<td v-text="tipo_rio" class="text-modalVerImagen"></td></h6>
                                <h6 class="card-text text-left">Longitud:<td v-text="longitud_m" class="text-modalVerImagen"></td></h6>
                            </center>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
                    <!-- poner imagen -->
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
                rio_id:0,
                gid : 0,
                nombre_rio : '',
                tipo_rio : '',
                longitud_m : '',
                imagen:null,
                zona : '',
                geom : '',
                arrayRio:[],
                modal : 0,
                modalActualizar:0,
                tituloModal :'',
                tipoAccion:0,
                errorRio:0,
                errorMostrarMsjRio:[],
                pagination :{
                    'total' :0,
                    'current_page' :0,
                    'per_Page' :0,
                    'last_page' :0,
                    'from' :0,
                    'to' :0,
                },
                offset:3,
                criterio: 'nombre_rio',
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
            listarRio(page,buscar,criterio){
                let me = this;
                var url='/rios/3?page=' + page+'&buscar=' +buscar+'&criterio='+criterio;
                
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayRio=respuesta.rios.data;
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
                me.listarRio(page,buscar,criterio);
                
            },
            actualizarRio(){
                /*if(this.validarRio()){
                    return;
                }*/

                let me = this;
                axios.put('/rios/actualizar' ,{
                    'gid':this.gid,
                    'id':this.rio_id,
                    'nombre_rio':this.nombre_rio,
                    'tipo_rio':this.tipo_rio,
                    'longitud_m':this.longitud_m,
                    'imagen':this.imagen,
                    'zona':this.zona,
                    'geom':this.geom,
                    
                }).then(function(response){
                    me.cerrarModal();
                    me.listarRio(1,'','nombre_rio');
                }).catch(function(error){
                    console.log(error);
                })
            },
            abrirModalActualizar(modelo, accion, data=[]){
                switch(modelo){
                    case "rio":{
                        switch(accion){
                            case 'actualizar':{
                                this.modalActualizar = 1;
                                this.tituloModal="Actualizar " + data['nombre_rio'];
                                this.tipoAccion=2;
                                                              
                                this.gid=data['gid'];
                                this.rio_id=data['id'];
                                this.nombre_rio=data['nombre_rio'];
                                this.tipo_rio=data['tipo_rio'];
                                this.longitud_m=data['longitud_m'];
                                this.imagen = data['imagen'];
                                this.zona=data['zona'];
                                this.geom = data['geom'];
                                break;
                            }
                        }
                    }
                }
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "rio":{
                        switch(accion){
                            
                            case 'ver':{
                                this.modal=1;
                                this.tituloModal="Detalles del " + data['nombre_rio'];
                                
                                this.rio_id=data['id'];
                                this.nombre_rio=data['nombre_rio'];
                                this.tipo_rio=data['tipo_rio'];
                                this.longitud_m=data['longitud_m'];
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
                this.rio_id=0;
                this.gid = 0;
                this.nombre_rio = '';
                this.tipo_rio = '';
                this.longitud_m = '';
                this.imagen=null;
                this.zona = '';
                this.geom = '';
            }
        },
        mounted() {
            this.listarRio(1,this.buscar,this.criterio);
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
    .text-modalVerImagen{
      color: blue !important;
    }
</style>
