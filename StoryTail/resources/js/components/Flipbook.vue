<template>
    <flipbook class="flipbook" :pages="['../storage/files/books/1/cover/cover1656672283-Asquashandasqueeze.pdf']"></flipbook>
</template>



<script>
import Flipbook from 'flipbook-vue'
export default {
    components: { Flipbook }
}
</script>

<style>
.flipbook {
    width: 90vw;
    height: 90vh;

}
</style>
