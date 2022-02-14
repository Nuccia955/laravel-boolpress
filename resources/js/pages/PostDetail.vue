<template>
    <div class="container">
        <div v-if="post">
            <h1 class="mb-2">{{ post.title }}</h1>
            <h3 class="mb-1" v-if="post.category">Category: {{ post.category.name }}</h3>
            <h4 class="mb-1" v-else>Uncathegorized</h4>
            <span class="badge bg-primary text-light" v-for="tag in post.tags" :key="`tag-${tag.id}`">
                {{ tag.title }}
            </span>
            <div class="cover mb-3" v-if="post.cover">
                <img :src="post.cover" :alt="post.title" class="w-50">
            </div>
            <p class="mt-4">{{ post.body }}</p>
        </div>
        <div v-else>Loading Post...</div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'PostDetail',
    data() {
        return {
            post: null,
        }
    },
    created() {
        this.getPost();
    },
    methods: {
        getPost() {
            axios.get(`http://127.0.0.1:8000/api/posts/${this.$route.params.slug}`)
            .then(response => {
                this.post = response.data;
            })
            .catch(err => console.log(err))
        },
    },
}
</script>

<style scoped lang="scss">

</style>