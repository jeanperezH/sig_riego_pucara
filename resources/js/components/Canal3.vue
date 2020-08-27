<template>
    <main class="main">
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-8">
                        <center><h2>ZONA 3 - CANALES DE RIEGO</h2></center>
                        <div class="input-group">
                            <select class="form-control col-md-4" v-model="criterio" >
                                <option value="nombre">Canal de riego</option>
                                <option value="valv_in">Válvula apertura</option>
                                
                            </select>
                            <input type="text" v-model="buscar" @keyup.enter="listarCanal(1,buscar,criterio)" class="form-control" placeholder="Canal de riego 1" >
                            <button type="submit" class="btn btn-primary" @click="listarCanal(1,buscar,criterio)" ><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="tab-trans table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Canal de riego</th>
                                <th>Longitud</th>
                                <th>Zona</th>
                                <th>Válvula Apertura</th>
                                
                                <th>imagen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="canal in arrayCanal" :key="canal.id">
                                
                                <td v-text="canal.nombre"></td>
                                <td v-text="canal.longitud  + ' m'"></td>
                                <td v-text="canal.zona"></td>
                                <td v-text="canal.valvula_in"></td>
                                
                                <td>
                                    <button type="button" @click="abrirModalActualizar('canal','actualizar',canal)" class="btn btn-info btn-sm" >
                                    <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    <button type="button" @click="abrirModal('canal','ver',canal)" class="btn btn-success btn-sm" >
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
                      <label class="col-md-3 form-control-label" for="text-input">Canal de riego</label>
                    <div class="col-md-9">
                      <input type="text" v-model="nombre" class="form-control" placeholder="canal de riego X">                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Longitud</label>
                    <div class="col-md-9">
                      <input type="text" v-model="longitud" class="form-control" placeholder="100">                                        
                    </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input">Válvula de apertura</label>
                    <div class="col-md-9">
                      <input type="text" v-model="valvula_in" class="form-control" placeholder="válvula x">                                        
                    </div>
                  </div>
                  
                  <!--<div class="form-group row">
                      <label class="col-md-3 form-control-label" for="text-input" >Imagen</label>
                    <div class="col-md-9">
                      <input type="file" id="imagen" ref="imagen" v-on:change="img()" class="form-control" accept="image/*"/>
                    </div>
                  </div>-->
                        
                  <div v-show="errorCanal" class="form-group row div-error">
                    <div class="text-center text-error">
                      <div v-for="error in errorMostrarMsjCanal" :key="error" v-text="error">

                      </div>
                    </div>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" @click="cerrarModal()">Cerrar</button>
              
              <button type="button" v-if="tipoAccion==2" class="btn btn-success" @click="actualizarCanal()">Actualizar</button>
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
                                <h2>Imagen</h2>
                                <img :src="this.imagen" width="100%">
                            </center>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <center>
                                <h2>DETALLES</h2>
                                <h6 class="card-text text-left">Canal de riego: <div class="text-modalVerImagen"><td v-text="nombre"></td></div> </h6>
                                <h6 class="card-text text-left">Válvula de apertura:<td v-text="valvula_in" class="text-modalVerImagen"></td></h6>
                                
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
                canal_id:0,
                gid:0,
                nombre : '',
                longitud : '',
                zona : '',
                imagen : '',
                valvula_in : '',
                
                geom:'',
                arrayCanal:[],
                modal : 0,
                modalActualizar:0,
                tituloModal :'',
                tipoAccion:0,
                errorCanal:0,
                errorMostrarMsjCanal:[],
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
            listarCanal(page,buscar,criterio){
                let me = this;
                var url='/canales/3?page=' + page+'&buscar=' +buscar+'&criterio='+criterio;
                
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayCanal=respuesta.canales.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //actualiza la pagina actual
                me.pagination.current_page = page;
                //
                me.listarCanal(page,buscar,criterio);
                
            },
            actualizarCanal(){
                /*if(this.validarCanal()){
                    return;
                }*/

                let me = this;
                axios.put('/canales/actualizar' ,{
                    'gid':this.gid,
                    'id':this.canal_id,
                    'nombre':this.nombre,
                    'longitud':this.longitud,
                    'valvula_in':this.valvula_in,
                    
                    'imagen':this.imagen,
                    'zona':this.zona,
                    'geom':this.geom,
                    
                }).then(function(response){
                    me.cerrarModal();
                    me.listarCanal(1,'','nombre');
                }).catch(function(error){
                    console.log(error);
                })
            },
            abrirModalActualizar(modelo, accion, data=[]){
                switch(modelo){
                    case "canal":{
                        switch(accion){
                            case 'actualizar':{
                                this.modalActualizar = 1;
                                this.tituloModal="Actualizar " + data['nombre'];
                                this.tipoAccion=2;
                                                              
                                this.gid=data['gid'];
                                this.canal_id=data['id'];
                                this.nombre=data['nombre'];
                                this.longitud=data['longitud'];
                                this.zona=data['zona'];
                                this.imagen = data['imagen'];
                                this.valvula_in = data['valvula_in'];
                                
                                this.geom = data['geom'];
                                break;
                            }
                        }
                    }
                }
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "canal":{
                        switch(accion){
                            
                            case 'ver':{
                                this.modal=1;
                                this.tituloModal="Detalles del " + data['nombre'];
                                
                                this.nombre = data['nombre'];
                                this.valvula_in = data['valvula_in'];
                                this.canal_id=data['id'];
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
                this.gid=0;
                this.canal_id=0;
                this.tituloModal='';
                this.nombre='';
                this.longitud='';
                this.zona='';
                this.imagen='';
                this.valvula_in='';
                
                this.geom='';
            }
        },
        mounted() {
            this.listarCanal(1,this.buscar,this.criterio);
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
