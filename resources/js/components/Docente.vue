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
                <i class="fa fa-align-justify"></i> Docentes
                <button type="button" @click="abrirModal('docente','registrar')" class="btn btn-secondary" >
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" v-model="criterio" >
                              <option value="nombres">Nombres</option>
                              <option value="apellidos">Apellidos</option>
                            </select>
                            <input type="text" v-model="buscar" @keyup.enter="listarDocente(1,buscar,criterio)" class="form-control" placeholder="texto a buscar" >
                            <button type="submit" class="btn btn-primary" @click="listarDocente(1,buscar,criterio)" ><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Grado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="docente in arrayDocente" :key="docente.id">
                            <td>
                                <button type="button" @click="abrirModal('docente','actualizar',docente)" class="btn btn-warning btn-sm" >
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                            </td>
                            <td v-text="docente.nombres"></td>
                            <td v-text="docente.apellidos"></td>
                            <td v-text="docente.grado"></td>
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
                            <label class="col-md-3 form-control-label" for="text-input">Nombres</label>
                            <div class="col-md-9">
                                <input type="text" v-model="nombres" class="form-control" placeholder="Nombre del docente">
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Apellidos</label>
                            <div class="col-md-9">
                                <input type="text" v-model="apellidos" class="form-control" placeholder="Apellidos del docente">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Grado</label>
                            <div class="col-md-9">
                                <select class="form-control col-md-3" v-model="grado" >
                                    <option value="Ing">Ing</option>
                                    <option value="Mg">Mg</option>
                                    <option value="Dc">Dc</option>
                                </select>
                            </div>
                        </div>
                        <div v-show="errorDocente" class="form-group row" div-error >
                            
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjDocente" :key="error" v-text="error">
                                    </div>
                                </div>
                            
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarDocente()">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarDocente()">Actualizar</button>
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
                docente_id:0,
                nombres : '',
                apellidos : '',
                grado : 'Ing',
                arrayDocente:[],
                modal : 0,
                tituloModal :'',
                tipoAccion:0,
                errorDocente:0,
                errorMostrarMsjDocente:[],
                pagination :{
                    'total' :0,
                    'current_page' :0,
                    'per_Page' :0,
                    'last_page' :0,
                    'from' :0,
                    'to' :0,
                },
                offset:3,
                criterio: 'nombres',
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
            listarDocente(page,buscar,criterio){
                let me = this;
                var url='/docentes?page=' + page+'&buscar=' +buscar+'&criterio='+criterio;
                //axios.get('/docente').then(function(response){
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayDocente=respuesta.docentes.data;
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
                me.listarDocente(page,buscar,criterio);
                
            },
            registrarDocente(){
                if(this.validarDocente()){
                    return;
                }

                let me = this;
                axios.post('/docentes/registrar' ,{
                    'nombres':this.nombres,
                    'apellidos':this.apellidos,
                    'grado':this.grado,
                }).then(function(response){
                    me.cerrarModal();
                    me.listarDocente(1,'','nombres');
                }).catch(function(error){
                    console.log(error);
                })
            },
            actualizarDocente(){
                if(this.validarDocente()){
                    return;
                }

                let me = this;
                axios.put('/docentes/actualizar' ,{
                    'nombres':this.nombres,
                    'apellidos':this.apellidos,
                    'grado':this.grado,
                    'id':this.docente_id
                }).then(function(response){
                    me.cerrarModal();
                    me.listarDocente(1,'','nombres');
                }).catch(function(error){
                    console.log(error);
                })
            },
            
            validarDocente(){
                this.errorDocente=0;
                this.errorMostrarMsjDocente=[];
                if(!this.nombres || !this.apellidos ) this.errorMostrarMsjDocente.push("Los campos no pueden estar vacíos");
                if(this.errorMostrarMsjDocente.length) this.errorDocente=1;
                return this.errorDocente;
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "docente":{
                        switch(accion){
                            case 'registrar':{
                                this.modal=1;
                                this.tituloModal='Registar Nuevo Docente'
                                this.nombres='';
                                this.apellidos='';
                                //this.grado='';
                                this.tipoAccion=1;
                                break;
                            }
                            case 'actualizar':{
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Docente';
                                this.tipoAccion=2;
                                this.docente_id=data['id'];
                                this.nombres=data['nombres'];
                                this.apellidos=data['apellidos'];
                                this.grado=data['grado'];
                                break;
                            }
                        }
                    }
                }
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombres='';
                this.apellidos='';
                this.grado='Ing';
            }
        },
        mounted() {
            this.listarDocente(1,this.buscar,this.criterio);
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
