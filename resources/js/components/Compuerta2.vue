<template>
    <main class="main">
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <center><h2>ZONA 2</h2></center>
                        <div class="input-group">
                            <select class="form-control col-md-3" v-model="criterio" >
                                <option value="nombre">compuerta</option>
                                <option value="start_at">Hora apertura</option>
                                <option value="end_at">Hora cierre</option>
                                <option value="dias">dia</option>
                            </select>
                            <input type="text" v-model="buscar" @keyup.enter="listarCompuerta(1,buscar,criterio)" class="form-control" placeholder="texto a buscar" >
                            <button type="submit" class="btn btn-primary" @click="listarCompuerta(1,buscar,criterio)" ><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="tab-trans">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Compuerta</th>
                                <th>horario</th>
                                <th>dias</th>
                                <th>zona</th>
                                <th>UTMX</th>
                                <th>UTMY</th>
                                <th>imagen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="compuerta in arrayCompuerta" :key="compuerta.id">
                                
                                <td v-text="compuerta.nombre"></td>
                                <td v-text="compuerta.horario"></td>
                                <td v-text="compuerta.dias"></td>
                                <td v-text="compuerta.zona"></td>
                                <td v-text="compuerta.utmx"></td>
                                <td v-text="compuerta.utmy"></td>
                                
                                <td>
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
                                <h2>Foto</h2>
                                <img :src="this.imagen" class="rounded"  width="100%">
                            </center>
                        </div>
                        <div class="col md-6">
                            <center>
                                <h2>Imágen</h2>
                                <img src="C__Users_Lenovo-ComsLabs_Downloads_300x300_IMG_20200812_160057.jpg" width="80%">
                            </center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col md-12">
                            <center>
                                <h2>Descripción</h2><br>
                                <p>Una de las compuertas mas importantes de todo el sistema de riego</p>
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
                compuerta_id:0,
                nombre : '',
                start_at : '',
                end_at : '',
                dias : '',
                imagen:null,
                arrayCompuerta:[],
                modal : 0,
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
                var url='/compuertas/2?page=' + page+'&buscar=' +buscar+'&criterio='+criterio;
                
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayCompuerta=respuesta.compuertas.data;
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
                me.listarCompuerta(page,buscar,criterio);
                
            },
            
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "compuerta":{
                        switch(accion){
                            
                            case 'ver':{
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal="Imagen y detalles de " + data['nombre'];
                                this.tipoAccion=2;
                                this.compuerta_id=data['id'];
                                this.start_at=data['start_at'];
                                this.end_at=data['end_at'];
                                this.dias=data['dias'];
                                this.imagen = data['imagen'];
                                let rename = "images/" + this.imagen;
                                this.imagen = rename;
                                //let rename = this.foto.slice(0, 1  );
                                //this.foto = "storage"+rename+"g";
                                console.log(rename);
                                break;
                            }
                        }
                    }
                }
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.compuerta='';
                this.start_at='';
                this.end_at='';
                this.dias='';
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
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red;
        font-weight: bold;
    }
</style>
