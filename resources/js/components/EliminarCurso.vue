<template>
  <input
    type="submit"
    class="btn btn-danger d-block w-100 mb-2"
    value="Eliminar"
    @click="eliminarCurso"
  />
</template>

<script>
export default {
  props: ["cursoId"],
  methods: {
    eliminarCurso() {
      this.$swal({
        title: "¿Deseas eliminar esta receta?",
        text: "Una vez eliminada, no se podra recuperar",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
      }).then((result) => {
        if (result.isConfirmed) {
          const params = {
            id: this.cursoId,
          };
          // Enviar la peticion al servidor
          axios
            .post(`/cursos/${this.cursoId}`, { params, method: "delete" })
            .then((respuesta) => {
              this.$swal({
                title: "Curso Eliminado",
                text: "Se elimino el curso",
                icon: "success",
              });

            //   Eliminar curso del DOM 
            this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
            })
            .catch((error) => {
              consol;
            });
        }
      });
    },
  },
};
</script>