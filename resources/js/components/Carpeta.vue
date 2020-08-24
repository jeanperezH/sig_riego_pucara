<template>
    <!-- Contenido Principal -->
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
                    <i class="fa fa-align-justify"></i>Carpeta Académica
                    <button
                        type="button"
                        @click="abrirModal('carpeta', 'registrar')"
                        class="btn btn-success"
                    >
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Docente</th>
                                <th>Curso</th>
                                <th>Ver Carpeta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="carpeta in arrayCarpeta" :key="carpeta.id">
                                <td v-text="carpeta.id"></td>
                                <td v-text="carpeta.grado +'. '+carpeta.nombres+' '+carpeta.apellidos"></td>
                                <td v-text="carpeta.curso+' -> '+carpeta.codigo_curso"></td>
                                
                                <td>
                                    <button type="button" @click="abrirModalImagen('Imagen','ver',carpeta)" class="btn btn-success btn-sm" >
                                        <i class="icon-eye"></i>
                                    </button>
                                    &nbsp;
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']" >
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)" >Sig</a>
                                </li>
                            </ul>
                    </nav>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" tabindex="-1" :class="{ mostrar: modal }" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form
                            action=""
                            method="post"
                            enctype="multipart/form-data"
                            class="form-horizontal"
                        >
                            
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Docente_Curso</label>
                                <div class="col-md-9">
                                    <select class="form-control" v-model="id_docente_curso" >
                                        <option v-for="docente_curso in arrayDocenteCurso" :key="docente_curso.id" :value="docente_curso.id" v-text="docente_curso.grado+'. '+docente_curso.nombres+' '+docente_curso.apellidos+'->'+docente_curso.curso"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Carpeta Académica</label>
                                <div class="col-md-9">
                                    <input type="file" id="carpeta" ref="carpeta" v-on:change="documento()" class="form-control" accept=".docx, .doc, application/pdf"/>
                                </div>
                                
                            </div>
                            <div v-show="errorCarpeta" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjCarpeta" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            @click="cerrarModal()"
                        >
                            Cerrar
                        </button>
                        <button
                            type="button"
                            v-if="tipoAccion == 1"
                            class="btn btn-success"
                            @click="registrarCarpeta()"
                        >
                            Guardar
                        </button>
                        <button
                            type="button"
                            v-if="tipoAccion == 2"
                            class="btn btn-success"
                            @click="actualizarCarpeta()"
                        >
                            Actualizar
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
        <!-- Modal Ver Imagen-->
            <div class="modal" tabindex="-2" :class="{'mostrarImagen' : modalImagen}" role="dialog">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" v-text="tituloModal"></h5>
                    <button type="button" class="close" @click="cerrarModalImagen()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <!--<embed src="storage/IILTR1e7ollf6u4sKPQ6kllpURKcUX71mJqoqCia.pdf" type="application/pdf" width="100%" height="600px" />-->
                    <embed :src="this.carpeta" type="application/pdf" width="100%" height="450px" />
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" @click="cerrarModalImagen()">Close</button>
                    </div>
                </div>
                </div>
            </div>
    </main>
    <!-- /Fin del contenido principal -->
</template>

<script>
export default {
    data() {
        return {
            carpeta_id: 0,
            id_docente_curso: 0,
            carpeta: null,
            arrayCarpeta: [],
            modal: 0,
            modalImagen:0,
            tituloModal: "",
            tipoAccion: 0,
            errorCarpeta : 0,
            errorMostrarMsjCarpeta :[],
            pagination: {
                total: 0,
                current_page: 0,
                per_Page: 0,
                last_page: 0,
                from: 0,
                to: 0
            },
            offset: 3,
            criterio: "apellidos",
            buscar: "",
            arrayDocenteCurso :[],
            
        };
    },
    computed: {
        isActived: function() {
            return this.pagination.current_page;
        },
        //calcula los elementos de la paginacion
        pagesNumber: function() {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + this.offset * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArrary = [];
            while (from <= to) {
                pagesArrary.push(from);
                from++;
            }
            return pagesArrary;
        }
    },
    methods: {
        listarCarpeta(page,buscar,criterio) {
            let me = this;
            var url='/carpetas?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
            axios
                .get(url)
                .then(function(response) {
                    //axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayCarpeta=respuesta.cursos_docentes.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        selectDocenteCurso(){
            let me = this;
            var url='/docentes_cursos/selectDocenteCurso';
            axios.get(url).then(function(response) {
                    var respuesta = response.data;
                    me.arrayDocenteCurso=respuesta.cursos_docentes;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        documento() {
            this.carpeta = this.$refs.carpeta.files[0];
        },
        cambiarPagina(page,buscar,criterio) {
            let me = this;
            //actualiza la pagina actual
            me.pagination.current_page = page;
            //
            me.listarCarpeta(page,buscar,criterio);
        },
        abrirModal(modelo, accion, data = []) {
            switch (modelo) {
                case "carpeta": {
                    switch (accion) {
                        case "registrar": {
                            this.modal = 1;
                            this.tituloModal = "Registar carpeta académica";
                            this.id_docente_curso = 0;
                            
                            this.carpeta = "";
                            this.tipoAccion = 1;
                            break;
                        }
                        case "actualizar": {
                            
                            this.modal = 1;
                            this.tituloModal = "Actualizar carpeta académica";
                            this.tipoAccion = 2;
                            this.carpeta_id = data["id"]; 
                            this.carpeta = data["carpeta"];
                            break;
                        }
                    }
                }
            }
            this.selectDocenteCurso();
        },
        
        registrarCarpeta(){
            if(this.validarCarpeta()){
                return;
            }
            var me = this;
            let formData = new FormData();
            formData.append('id_docente_curso', me.id_docente_curso);
            formData.append('carpeta', me.carpeta);
            console.log(me.carpeta.name);
            axios.post( '/carpetas/registrar',
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            ).then(function(){
                me.cerrarModal();
                me.listarCarpeta(1,'','apellidos');
            })
            .catch(function(error){
            console.log(error);
            });
        },
        actualizarCarpeta(){
            if(this.validarCarpeta()){
                return;
            }
            var me = this;
            let formData = new FormData();
            formData.append('id',me.carpeta_id);
            
            formData.append('id_docente_curso', me.id_docente_curso);
            formData.append('carpeta', me.carpeta);
            console.log(me.acta.name);
            axios.put( '/carpetas/actualizar',
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            ).then(function(){
                me.cerrarModal();
                me.listarCarpeta(1,'','apellidos');
            })
            .catch(function(error){
            console.log(error);
            });
        },
        validarCarpeta(){
            this.errorCarpeta=0;
            this.errorMostrarMsjCarpeta=[];
            if(!this.id_docente_curso) this.errorMostrarMsjCarpeta.push("Seleccione un docente con el curso que dicta");
            if(!this.carpeta) this.errorMostrarMsjCarpeta.push("Suba la carpeta académica");
            if (this.carpeta){
                if (!(/\.(docx|doc|pdf)$/i).test(carpeta.value)) this.errorMostrarMsjCarpeta.push("Solo se admiten los formatos: PDF,DOC,DOCX");
            }
            if(this.errorMostrarMsjCarpeta.length) this.errorCarpeta=1;
            return this.errorCarpeta;
        },
        cerrarModal() {
            this.modal = 0;
            this.tituloModal = "";
            this.carpeta_id=0;
            this.id_docente_curso = 0;
            this.carpeta = null;
        },
        abrirModalImagen(modelo, accion, data = []){
                switch(modelo){
                    case "Imagen":
                    {
                        switch(accion){

                            case 'ver':{
                                this.modalImagen=1;
                                this.tituloModal='Carpeta académica del Curso';
                                this.carpeta_id=data['id'];
                                this.carpeta = data['carpeta'];
                                let rename = this.carpeta.replace('public','storage')
                                this.carpeta = rename;
                                
                                break;
                            }
                        }
                    }
                }

            },
            
            cerrarModalImagen(){
                this.modalImagen=0;
                this.carpeta_id=0;
                this.tituloModal='';
                this.carpeta=null;
            }
    },
    mounted() {
        this.listarCarpeta(1,this.buscar,this.criterio);
        //
    }
};
</script>
<style>
.modal-content {
    width: 100% !important;
    position: absolute !important;
}
.mostrar {
    display: list-item !important;
    opacity: 1 !important;
    position: absolute !important;
    background-color: #5a4f4f7a !important;
}
.mostrarImagen{
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
    color: red !important;
    font-weight: bold;
}
</style>
