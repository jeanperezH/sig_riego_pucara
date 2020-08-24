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
                                <option value="nombre">Chacra</option>
                                <option value="tipo_cultiv">Tipo cultivo</option>
                                
                            </select>
                            <input type="text" v-model="buscar" @keyup.enter="listarChacra(1,buscar,criterio)" class="form-control" placeholder="Zona de cultivo" >
                            <button type="submit" class="btn btn-primary" @click="listarChacra(1,buscar,criterio)" ><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="tab-trans">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Chacra</th>
                                <th>Area</th>
                                <th>Tipo cultivo</th>
                                <th>Zona</th>
                                <th>imagen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="chacra in arrayChacra" :key="chacra.id">
                                
                                <td v-text="chacra.nombre"></td>
                                <td v-text="chacra.area_km2"></td>
                                <td v-text="chacra.tipo_cutiv"></td>
                                <td v-text="chacra.zona"></td>
                                
                                <td>
                                    <button type="button" @click="abrirModal('chacra','ver',chacra)" class="btn btn-success btn-sm" >
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
                                <p>Zonas de Cultivo</p>
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
                chacra_id:0,
                nombre : '',
                area_km2 : '',
                tipo_cultiv : '',
                imagen : '',
                arrayChacra:[],
                modal : 0,
                tituloModal :'',
                tipoAccion:0,
                errorChacra:0,
                errorMostrarMsjChacra:[],
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
            listarChacra(page,buscar,criterio){
                let me = this;
                var url='/chacras?page=' + page+'&buscar=' +buscar+'&criterio='+criterio;
                
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayChacra=respuesta.chacras.data;
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
                me.listarChacra(page,buscar,criterio);
                
            },
            
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "chacra":{
                        switch(accion){
                            
                            case 'ver':{
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Ver chacra';
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
                this.area_km2='';
                this.tipo_cultiv='';
                this.zona='';
                this.imagen='';
                
            }
        },
        mounted() {
            this.listarChacra(1,this.buscar,this.criterio);
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
