<template>
    <div>
        <span class="like-btn" @click="likeCurso" :class="{ 'like-active': isActive }"></span>
        <p>{{ cantidadLikes }} Les gustó este curso</p>
    </div> 

</template>

<script>
export default {
    props: ['cursoId', 'like', 'likes'],
    data: function() {
        return {
            isActive: this.like,
            totalLikes: this.likes
        }
    },
    methods: {
        likeCurso() {
            axios.post('/cursos/' + this.cursoId)
            .then(respuesta => {
                if(respuesta.data.attached.length > 0 ){
                    this.$data.totalLikes++;
                } else {
                    this.$data.totalLikes--;
                }

                this.isActive = !this.isActive
            })
            .catch(error => {
                if(error.response.status === 401) {
                    window.location = '/register';
                }
            });
        }
    },
    computed: {
        cantidadLikes: function() {
            return this.totalLikes 
        }
    }
}
</script>