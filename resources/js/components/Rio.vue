<template>
    <main class="main">
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <center><h2>ZONA 1</h2></center>
                        <div class="input-group">
                            <select class="form-control col-md-3" v-model="criterio" >
                                <option value="nombre">Rio</option>
                                <option value="tipo_rio">Ripo rio</option>
                                
                            </select>
                            <input type="text" v-model="buscar" @keyup.enter="listarRio(1,buscar,criterio)" class="form-control" placeholder="rio a buscar" >
                            <button type="submit" class="btn btn-primary" @click="listarRio(1,buscar,criterio)" ><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="tab-trans">
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
                                
                                <td v-text="rio.nombre"></td>
                                <td v-text="rio.tipo_rio"></td>
                                <td v-text="rio.longitud_m  + ' m'"></td>
                                <td v-text="rio.zona"></td>
                                <td>
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
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade"  tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col md-6">
                            <center>
                                <h2>Ubicación</h2>
                                <img src="img-compuertas/posV1-z1.png" width="80%">
                            </center>
                        </div>
                        <div class="col md-6">
                            <center>
                                <h2>Imágen</h2>
                                <img src="img-compuertas/val1-z1.jpg" width="80%">
                            </center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col md-12">
                            <center>
                                <h2>Descripción</h2><br>
                                <p>Fuente principal de agua</p>
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
                nombre : '',
                tipo_rio : '',
                longitud_m : '',
                zona : '',
                geom : '',
                arrayRio:[],
                modal : 0,
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
            listarRio(page,buscar,criterio){
                let me = this;
                var url='/rios?page=' + page+'&buscar=' +buscar+'&criterio='+criterio;
                
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayRio=respuesta.rios.data;
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
                me.listarRio(page,buscar,criterio);
                
            },
            
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "rio":{
                        switch(accion){
                            
                            case 'ver':{
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Ver Rio';
                                this.tipoAccion=2;
                                //this.compuerta_id=data['id'];
                                //this.start_at=data['start_at'];
                                //this.end_at=data['end_at'];
                                //this.dias=data['dias'];
                                break;
                            }
                        }
                    }
                }
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.tipo_rio='';
                this.longitud_m='';
                this.zona='';
                this.geom='';
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
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red;
        font-weight: bold;
    }
</style>
