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
                    <i class="fa fa-align-justify"></i>Sillabus
                    <button
                        type="button"
                        @click="abrirModal('sillabu', 'registrar')"
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
                                <th>Ver Sillabu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="sillabu in arraySillabu" :key="sillabu.id">
                                <td v-text="sillabu.id"></td>
                                <td v-text="sillabu.grado +'. '+sillabu.nombres+' '+sillabu.apellidos"></td>
                                <td v-text="sillabu.curso+' -> '+sillabu.codigo_curso"></td>
                                
                                <td>
                                    <button type="button" @click="abrirModalImagen('Imagen','ver',sillabu)" class="btn btn-success btn-sm" >
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
                                <label class="col-md-3 form-control-label" for="text-input">Sillabu</label>
                                <div class="col-md-9">
                                    <input type="file" id="sillabu" ref="sillabu" v-on:change="documento()" class="form-control" accept=".docx, .doc, application/pdf"/>
                                </div>
                                
                            </div>
                            <div v-show="errorSillabu" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjSillabu" :key="error" v-text="error">

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
                            @click="registrarSillabu()"
                        >
                            Guardar
                        </button>
                        <button
                            type="button"
                            v-if="tipoAccion == 2"
                            class="btn btn-success"
                            @click="actualizarSillabu()"
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
                    <embed :src="this.sillabu" type="application/pdf" width="100%" height="450px" />
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
            sillabu_id: 0,
            id_docente_curso: 0,
            sillabu: null,
            arraySillabu: [],
            modal: 0,
            modalImagen:0,
            tituloModal: "",
            tipoAccion: 0,
            errorSillabu : 0,
            errorMostrarMsjSillabu :[],
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
        listarSillabu(page,buscar,criterio) {
            let me = this;
            var url='/sillabus?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
            axios
                .get(url)
                .then(function(response) {
                    //axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arraySillabu=respuesta.cursos_docentes.data;
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
            this.sillabu = this.$refs.sillabu.files[0];
        },
        cambiarPagina(page,buscar,criterio) {
            let me = this;
            //actualiza la pagina actual
            me.pagination.current_page = page;
            //
            me.listarSillabu(page,buscar,criterio);
        },
        abrirModal(modelo, accion, data = []) {
            switch (modelo) {
                case "sillabu": {
                    switch (accion) {
                        case "registrar": {
                            this.modal = 1;
                            this.tituloModal = "Registar sillabu";
                            this.id_docente_curso = 0;
                            
                            this.sillabu = "";
                            this.tipoAccion = 1;
                            break;
                        }
                        case "actualizar": {
                            
                            this.modal = 1;
                            this.tituloModal = "Actualizar sillabu";
                            this.tipoAccion = 2;
                            this.sillabu_id = data["id"]; 
                            this.sillabu = data["sillabu"];
                            break;
                        }
                    }
                }
            }
            this.selectDocenteCurso();
        },
        
        registrarSillabu(){
            if(this.validarSillabu()){
                return;
            }
            var me = this;
            let formData = new FormData();
            formData.append('id_docente_curso', me.id_docente_curso);
            formData.append('sillabu', me.sillabu);
            console.log(me.sillabu.name);
            axios.post( '/sillabus/registrar',
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            ).then(function(){
                me.cerrarModal();
                me.listarSillabu(1,'','apellidos');
            })
            .catch(function(error){
            console.log(error);
            });
        },
        actualizarSillabu(){
            if(this.validarSillabu()){
                return;
            }
            var me = this;
            let formData = new FormData();
            formData.append('id',me.sillabu_id);
            
            formData.append('id_docente_curso', me.id_docente_curso);
            formData.append('sillabu', me.sillabu);
            console.log(me.acta.name);
            axios.put( '/sillabus/actualizar',
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
            ).then(function(){
                me.cerrarModal();
                me.listarSillabu(1,'','apellidos');
            })
            .catch(function(error){
            console.log(error);
            });
        },
        validarSillabu(){
            this.errorSillabu=0;
            this.errorMostrarMsjSillabu=[];
            if(!this.id_docente_curso) this.errorMostrarMsjSillabu.push("Seleccione un docente con el curso que dicta");
            if(!this.sillabu) this.errorMostrarMsjSillabu.push("Suba el sillabu");
            if (this.sillabu){
                if (!(/\.(docx|doc|pdf)$/i).test(sillabu.value)) this.errorMostrarMsjSillabu.push("Solo se admiten los formatos: PDF,DOC,DOCX");
            }
            if(this.errorMostrarMsjSillabu.length) this.errorSillabu=1;
            return this.errorSillabu;
        },
        cerrarModal() {
            this.modal = 0;
            this.tituloModal = "";
            this.sillabu_id=0;
            this.id_docente_curso = 0;
            this.sillabu = null;
        },
        abrirModalImagen(modelo, accion, data = []){
                switch(modelo){
                    case "Imagen":
                    {
                        switch(accion){

                            case 'ver':{
                                this.modalImagen=1;
                                this.tituloModal='Sillabu del Curso';
                                this.sillabu_id=data['id'];
                                this.sillabu = data['sillabu'];
                                let rename = this.sillabu.replace('public','storage')
                                this.sillabu = rename;
                                
                                break;
                            }
                        }
                    }
                }

            },
            
            cerrarModalImagen(){
                this.modalImagen=0;
                this.sillabu_id=0;
                this.tituloModal='';
                this.sillabu=null;
            }
    },
    mounted() {
        this.listarSillabu(1,this.buscar,this.criterio);
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
