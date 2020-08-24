<template>
    <main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="container-fluid">
        <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Estudiantes
                <button type="button" @click="abrirModal('estudiante','registrar')" class="btn btn-secondary" >
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" v-model="criterio" >
                                <option value="apellidos">Apellidos</option>
                                <option value="nombres">Nombres</option>
                                <option value="codigo_matricula">Código</option>
                            </select>
                            <input type="text" v-model="buscar" @keyup.enter="listarEstudiante(1,buscar,criterio)" class="form-control" placeholder="texto a buscar" >
                            <button type="submit" class="btn btn-primary" @click="listarEstudiante(1,buscar,criterio)" ><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>Código Matricula</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="estudiante in arrayEstudiante" :key="estudiante.id">
                            <td>
                                <button type="button" @click="abrirModal('estudiante','actualizar',estudiante)" class="btn btn-warning btn-sm" >
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                            </td>
                            <td v-text="estudiante.apellidos"></td>
                            <td v-text="estudiante.nombres"></td>
                            <td v-text="estudiante.codigo_matricula"></td>
                            
                        </tr>
                        
                    </tbody>
                </table>
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
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Apellidos</label>
                            <div class="col-md-9">
                                <input type="text" v-model="apellidos" class="form-control" placeholder="Apellidos del estudiante">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nombres</label>
                            <div class="col-md-9">
                                <input type="text" v-model="nombres" class="form-control" placeholder="Nombre del estudiante">
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Código Matricula</label>
                            <div class="col-md-9">
                                <input type="text" v-model="codigo_matricula" class="form-control" placeholder="2000100200A">
                                
                            </div>
                        </div>
                        
                        <div v-show="errorEstudiante" class="form-group row" div-error >
                            
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjEstudiante" :key="error" v-text="error">
                                    </div>
                                </div>
                            
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarEstudiante()">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarEstudiante()">Actualizar</button>
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
                estudiante_id:0,
                nombres : '',
                apellidos : '',
                codigo_matricula : '',
                arrayEstudiante:[],
                modal : 0,
                tituloModal :'',
                tipoAccion:0,
                errorEstudiante:0,
                errorMostrarMsjEstudiante:[],
                pagination :{
                    'total' :0,
                    'current_page' :0,
                    'per_Page' :0,
                    'last_page' :0,
                    'from' :0,
                    'to' :0,
                },
                offset:3,
                criterio: 'apellidos',
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
            listarEstudiante(page,buscar,criterio){
                let me = this;
                var url='/estudiantes?page=' + page+'&buscar=' +buscar+'&criterio='+criterio;
                
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayEstudiante=respuesta.estudiantes.data;
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
                me.listarEstudiante(page,buscar,criterio);
                
            },
            registrarEstudiante(){
                if(this.validarEstudiante()){
                    return;
                }

                let me = this;
                axios.post('/estudiantes/registrar' ,{
                    'apellidos':this.apellidos,
                    'nombres':this.nombres,
                    'codigo_matricula':this.codigo_matricula,
                }).then(function(response){
                    me.cerrarModal();
                    me.listarEstudiante(1,'','apellidos');
                }).catch(function(error){
                    console.log(error);
                })
            },
            actualizarEstudiante(){
                if(this.validarEstudiante()){
                    return;
                }

                let me = this;
                axios.put('/estudiantes/actualizar' ,{
                    'apellidos':this.apellidos,
                    
                    'nombres':this.nombres,
                    
                    'codigo_matricula':this.codigo_matricula,
                    'id':this.estudiante_id
                }).then(function(response){
                    me.cerrarModal();
                    me.listarEstudiante(1,'','apellidos');
                }).catch(function(error){
                    console.log(error);
                })
            },
            
            validarEstudiante(){
                this.errorEstudiante=0;
                this.errorMostrarMsjEstudiante=[];
                if(!this.apellidos || !this.nombres || !this.codigo_matricula) this.errorMostrarMsjEstudiante.push("Los campos no pueden estar vacíos");
                if(this.errorMostrarMsjEstudiante.length) this.errorEstudiante=1;
                return this.errorEstudiante;
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "estudiante":{
                        switch(accion){
                            case 'registrar':{
                                this.modal=1;
                                this.tituloModal='Registar Nuevo estudiante'
                                this.apellidos='';
                                this.nombres='';
                                this.codigo_matricula='';
                                this.tipoAccion=1;
                                break;
                            }
                            case 'actualizar':{
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Estudiante';
                                this.tipoAccion=2;
                                this.estudiante_id=data['id'];
                                this.apellidos=data['apellidos'];
                                this.nombres=data['nombres'];
                                this.codigo_matricula=data['codigo_matricula'];
                                break;
                            }
                        }
                    }
                }
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.apellidos='';
                this.nombres='';
                this.codigo_matricula='';
            }
        },
        mounted() {
            this.listarEstudiante(1,this.buscar,this.criterio);
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
