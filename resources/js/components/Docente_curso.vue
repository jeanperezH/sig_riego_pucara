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
                <i class="fa fa-align-justify"></i> Docentes y Curso
                <button type="button" @click="abrirModal('docente_curso','registrar')" class="btn btn-secondary" >
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Docente</th>
                            <th>Curso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="docente_curso in arrayDocente_Curso" :key="docente_curso.id">
                            <td>
                                <button type="button" @click="abrirModal('docente_curso','actualizar',docente_curso)" class="btn btn-warning btn-sm" >
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                            </td>
                            <td v-text="docente_curso.grado +'. '+docente_curso.nombres+' '+docente_curso.apellidos"></td>
                            <td v-text="docente_curso.curso+' -> '+docente_curso.codigo_curso"></td>
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
                            <label class="col-md-3 form-control-label" for="text-input">Docente</label>
                            <div class="col-md-9">
                                <select class="form-control" v-model="id_docente" >
                                    <option v-for="docentes in arrayDocente" :key="docentes.id" :value="docentes.id" v-text="docentes.grado+'. '+docentes.apellidos"></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Curso</label>
                            <div class="col-md-9">
                                <select class="form-control" v-model="id_curso" >
                                    <option v-for="cursos in arrayCurso" :key="cursos.id" :value="cursos.id" v-text="cursos.curso+' -> '+cursos.codigo_curso"></option>
                                </select>
                            </div>
                        </div>
                        <div v-show="errorDocente_Curso" class="form-group row" div-error >
                            
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjDocente_Curso" :key="error" v-text="error">
                                    </div>
                                </div>
                            
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarDocente_Curso()">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarDocente_Curso()">Actualizar</button>
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
                docente_curso_id:0,
                id_docente : 0,
                id_curso : '',
                
                arrayDocente_Curso:[],
                modal : 0,
                tituloModal :'',
                tipoAccion:0,
                errorDocente_Curso:0,
                errorMostrarMsjDocente_Curso:[],
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
                buscar:'',
                arrayCurso:[],
                arrayDocente:[]
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
            listarDocente_Curso(page,buscar,criterio){
                let me = this;
                var url='/docentes_cursos?page=' + page+'&buscar=' +buscar+'&criterio='+criterio;
                //axios.get('/docente').then(function(response){
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayDocente_Curso=respuesta.cursos_docentes.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            selectDocente(){
                let me = this;
                var url='/docentes/selectDocente';
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayDocente=respuesta.docentes;
                    
                })
                .catch(function (error){
                    console.log(error);
                });
            },
            selectCurso(){
                let me = this;
                var url='/cursos/selectCurso';
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayCurso=respuesta.cursos;
                    
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
                me.listarDocente_Curso(page,buscar,criterio);
                
            },
            registrarDocente_Curso(){
                if(this.validarDocente_Curso()){
                    return;
                }

                let me = this;
                axios.post('/docentes_cursos/registrar' ,{
                    'id_docente':this.id_docente,
                    'id_curso':this.id_curso,
                }).then(function(response){
                    me.cerrarModal();
                    me.listarDocente_Curso(1,'','nombres');
                }).catch(function(error){
                    console.log(error);
                })
            },
            actualizarDocente_Curso(){
                if(this.validarDocente_Curso()){
                    return;
                }

                let me = this;
                axios.put('/docentes_cursos/actualizar' ,{
                    'id_docente':this.id_docente,
                    'id_curso':this.id_curso,
                    'id':this.docente_curso_id
                }).then(function(response){
                    me.cerrarModal();
                    me.listarDocente_Curso(1,'','nombres');
                }).catch(function(error){
                    console.log(error);
                })
            },
            
            validarDocente_Curso(){
                this.errorDocente_Curso=0;
                this.errorMostrarMsjDocente_Curso=[];
                if(!this.id_docente || !this.id_curso ) this.errorMostrarMsjDocente_Curso.push("Los campos no pueden estar vacíos");
                if(this.errorMostrarMsjDocente_Curso.length) this.errorDocente_Curso=1;
                return this.errorDocente_Curso;
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "docente_curso":{
                        switch(accion){
                            case 'registrar':{
                                this.modal=1;
                                this.tituloModal='Registar Nuevo Docente y Curso'
                                this.id_docente=0;
                                this.id_curso=0;
                                this.tipoAccion=1;
                                break;
                            }
                            case 'actualizar':{
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Docente y Curso';
                                this.tipoAccion=2;
                                this.docente_curso_id=data['id'];
                                this.id_docente=data['id_docente'];
                                this.id_curso=data['id_curso'];
                                break;
                            }
                        }
                    }
                }
                this.selectDocente();
                this.selectCurso();
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.docente_curso_id=0;
                this.id_docente=0;
                this.id_curso=0;

            }
        },
        mounted() {
            this.listarDocente_Curso(1,this.buscar,this.criterio);
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
